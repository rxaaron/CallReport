<?php

    include_once('dbconn.php');
    
    if(!$dbh){
        echo "ERROR:  Could not connect.";
    } else {
        if(isset($_POST['calldate'])){
            $calldate=$_POST['calldate'];
            $nursinghome=$_POST['nursinghome'];
            $rph=$_POST['rph'];
            $category=$_POST['category'];
            $subcategory=$_POST['subcategory'];
            if(!empty($_POST['detail'])){
                $detail=$_POST['detail'];
            }else{
                $detail=NULL;
            }
            if(isset($_POST['nhfault'])){
                $nhfault=TRUE;
            }else{
                $nhfault=FALSE;
            }
            if(isset($_POST['ourfault'])){
                $ourfault=TRUE;
            }else{
                $ourfault=FALSE;
            }
            if(!empty($_POST['comments'])){
                $comments=$_POST['comments'];
            }else{
                $comments=NULL;
            }
        
            $stmt = $dbh->prepare("INSERT INTO Transaction (DateOfCall, NursingHome, RPh, Category, SubCategory, Detail, Comments, NHFault, EncoreFault) VALUES (:doc,:nh,:rph,:cat,:subcat,:detail,:comm,:nhf,:ourf);");
            $stmt->execute(array(':doc'=>$calldate,':nh'=>$nursinghome,':rph'=>$rph,':cat'=>$category,':subcat'=>$subcategory,':detail'=>$detail,':comm'=>$comments,':nhf'=>$nhfault,':ourf'=>$ourfault));
        
        }
    }
?>
