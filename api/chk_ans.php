<?php
session_start();
// 當get到的值與session裡已經存放的值做比對，成功傳1 否則0
echo ($_SESSION['ans']==$_GET['ans'])?1:0;

?>