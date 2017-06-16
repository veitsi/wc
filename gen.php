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
    <form name="frm" action="db.php" method="post">
        <input name="imgname" type="hidden" value="<?=basename($_FILES["fileToUpload"]["name"])?>">
        <input name="cur" type="hidden" value="www">
        <input type="submit">
    </form>

<?php endif; ?>


<script src="jquery.min.js"></script>
<script src="jquery.imgareaselect/scripts/jquery.imgareaselect.js"></script>
<script>
    var db = [];
    var key = '<?=basename($_FILES["fileToUpload"]["name"])?>';
    console.log('key -'+key);
    cur=[];
    console.log(cur);

    function faa(img, selection) {
        console.log('selected '+selection.x1+','+selection.x2);
        var descr = prompt("Please enter description", "cool place");
        cur.push([descr, ''+selection.x1+','+ selection.y1 +','+
        selection.x2+','+ selection.y2]);
        console.log(cur);
        $("input[name=cur]").val(JSON.stringify(cur));
        console.log($("input[name=cur]").val());
    }
    function finished() {
//        alert('start');
        $.post('db.php',{'db':db}, function sended() {
            console.log($("input[name=db]").val());
        })
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