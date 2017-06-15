<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="jquery.imgareaselect/css/imgareaselect-default.css">
</head>
<body>
<?php if(!isset($_POST["submit"])):?>
<form action="gen.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
<?php endif; ?>
<?php if(isset($_POST["submit"])):
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
?>
<img id="photo" src='<?=$target_file?>'>
<?php endif; ?>


<script src="jquery.min.js"></script>
<script src="jquery.imgareaselect/scripts/jquery.imgareaselect.js"></script>
<script>
    function faa() {

    }
    $(document).ready(function () {
        $('img#photo').imgAreaSelect({
            handles: true,
            onSelectEnd: faa
        });
    });
</script>
</body>
</html>