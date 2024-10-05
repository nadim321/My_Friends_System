<?php
// session destory and logout
session_start();
session_destroy();
header('Location: index.php');
?>