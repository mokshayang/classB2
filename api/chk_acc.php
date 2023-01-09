<?php include_once "base.php"; 

echo $user = $User->count(['acc'=>$_POST['acc']]);//只需要檢查 acc
//只會出現 1 跟 0 ，且帳號不能重複，才可以用

// if($user>0){
//     echo 1;
// }else{
//     echo 0;
// }



?>