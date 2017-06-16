<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
$db = json_decode(file_get_contents('db.json'), true);
if (!isset($_GET['item'])) {
    foreach ($db as $img => $objs) {
        echo $img . ',';
    }
}

?>
<?php if (isset($_GET['item'])):
    $cur = $db[$_GET['item']];
    ?>

    <map name="mainmap">
        <?php foreach ($cur as $index => $value): ?>
            <area shape="rect" coords="<?= $value[1] ?>" title="<?= $value[0] ?>" alt="" href="#">
        <?php endforeach; ?>
    </map>
    <img src="img/<?= $_GET['item'] ?>" alt="pic" usemap="#mainmap">

<?php endif; ?>
</body>
</html>
