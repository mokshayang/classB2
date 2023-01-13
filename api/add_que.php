<?php include_once "base.php";

if(isset($_POST['subject']) && $_POST['subject'] != ""){
    $Que->save( ['text'=>$_POST['subject'],'count'=>0,'parent'=>0] );
    $parent = $Que->max('id');
    $sub=$Que->find(['text'=>$_POST['subject']]);
    foreach($_POST['option'] as $opt){
        if(trim($opt) != ""){
        $Que->save( ['text'=>$opt,'count'=>0,'parent'=>$parent] );
        }
    }

}
to("../back.php?do=que");