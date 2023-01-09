<?php include_once "base.php"; 

$chk = $user = $User->count(['acc'=>$_POST['acc'],'pw'=>$_POST['pw']]);//同時檢查 acc pw
//只會出現 1 跟 0 ，且帳號不能重複，才可以用

if($chk>0){
    echo $chk;// 0 or 1
    $_SESSION['login'] = $_POST['acc'];
}else{
    echo $chk;// 0 or 1
}



?>