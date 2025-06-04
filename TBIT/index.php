<?php
session_start();

if(!isset($_GET['vista']) || $_GET['vista']==""){
    $_GET['vista']="login";
}

include "./rep/head.php";
?>

<body>
<?php


// Cargamos la vista correspondiente
if(is_file("./vistas/".$_GET['vista'].".php") && $_GET['vista']!="404"){
    include "./vistas/".$_GET['vista'].".php";
} else {
    include "./vistas/404.php";
}
?>
</body>