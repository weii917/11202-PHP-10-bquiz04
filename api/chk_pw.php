<?php
include_once 'db.php';

$table=$_POST['table'];
unset($_POST['table']);
$db=new DB($table);
$chk=$db->count($_POST);

// 依傳過來的資料表可能是mem或是admin，將acc存進，以區分是會員還是管理著要分開存放session依據$table不同欄位名稱
if($chk){
    echo $chk;
    $_SESSION[$table]=$_POST['acc'];

}else{
    echo $chk;
}