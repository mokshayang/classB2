<?php include_once "base.php";
if(isset($_POST['del'])){//此行 考試可以不用  只會警告  undefined
    foreach($_POST['del'] as $id){
        $User->del($id);
    }
 }
to("../back.php?do=admin");

?>