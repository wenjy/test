<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
$array = [
    ['name' => 'aaa', 'sex' => 1],
    ['name' => 'bbb', 'sex' => 1],
    ['name' => 'bbb', 'sex' => 1],
];
?>
<script>
    (function (d, w, array) {
        console.log(array)
    })(Document, window, <?= json_encode($array);?>)
</script>
</body>
</html>
