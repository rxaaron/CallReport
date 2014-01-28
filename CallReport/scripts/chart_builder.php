<?php
    include_once('dbconn.php');
    
    $cond = array();
    $sort = array();
    
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $cond [] = "A.DateOfCall BETWEEN '".date("Y-m-d",strtotime($startdate))."' AND '".date("Y-m-d",strtotime($enddate))."'";
    
    $fault = $_POST['fault'];
    if($fault==1){
        $cond [] = "A.NHFault = true";
    }elseif($fault==2){
        $cond [] = "A.EncoreFault = true";
    }
    
    $nursinghome = $_POST['nursinghome'];
    if($nursinghome!=0){
        $cond [] = "A.NursingHome = ".$nursinghome;
    }
    
    $rph = $_POST['RPh'];
    if($rph!=0){
        $cond [] = "A.RPh = ".$rph;
    }
    
    $category = $_POST['category'];
    if($category!=0){
        $cond [] = "A.Category = ".$category;
    }
    
    $sort1 = $_POST['sort1'];
    $sort2 = $_POST['sort2'];
    $sort3 = $_POST['sort3'];
    $sort4 = $_POST['sort4'];
    $sort [] = $sort1;
    if($sort2!="0"){
        $sort [] = $sort2;
    }
    if($sort3!="0"){
        $sort [] = $sort3;
    }
    if($sort4!="0"){
        $sort [] = $sort4;
    }

    $query = "SELECT A.ID, DAYNAME(A.DateOfCall) AS DayOfWeek, A.DateOfCall, B.HomeName, C.PharmName, D.CategoryName, E.SubName, A.Detail, A.NHFault, A.EncoreFault, A.Comments FROM Transaction AS A INNER JOIN NursingHome AS B ON A.NursingHome = B.ID INNER JOIN RPh AS C ON A.RPh = C.ID INNER JOIN Category AS D ON A.Category = D.ID INNER JOIN SubCategory AS E ON A.SubCategory = E.ID WHERE ".implode(' AND ',$cond)." ORDER BY ".implode(', ',$sort).";";
    
    $select = $db->query($query);
    if($select){
        $c=true;
        while($results=$select->fetch_object()){
            echo "<div class='borderbox ".(($c=!$c)?'':'odd')."'>";
            echo "<div class='pure-u-1-6'>".$results->DayOfWeek."<br>".date("m/d/y",strtotime($results->DateOfCall))."</div><div class='pure-u-1-3'>".$results->HomeName."</div><div class='pure-u-1-6'>".$results->CategoryName." --<br>".$results->SubName."</div><div class='pure-u-1-6'><button class='pure-button pure-button-primary' name='detailbtn' id='btn".$results->ID."' value='detail".$results->ID."'>Details</button></div>";
            echo "<div class='pure-u-1-6'><div class='pure-controls'><label for='nhf".$results->ID."' class='pure-checkbox'>";
            if($results->NHFault===1){
                echo "<input type='checkbox' id='nhf".$results->ID."' checked disabled>NH Fault</label>";
            }else{
                echo "<input type='checkbox' id='nhf".$results->ID."' disabled>NH Fault</label>";
            }
            echo "<br><label for='ourf".$results->ID."' class='pure-checkbox'>";
            if($results->EncoreFault===1){
                echo "<input type='checkbox' id='ourf".$results->ID."' checked disabled>Our Fault</label>";
            }else{
                echo "<input type='checkbox' id='ourf".$results->ID."' disabled>Our Fault</label>";
            }
            echo "</div>";
            echo "</div>";
            echo "<div class='pure-u-1 info-hidden' id='detail".$results->ID."'>";
            echo "<div class='pure-u-1-6'>Pharmacist:<br>".$results->PharmName."</div><div class='pure-u-1-3'>Detail:<br>".$results->Detail."</div><div class='pure-u-1-2'>Comments:<br>".$results->Comments."</div>";
            echo "</div>";
            echo "</div>";
        }
    } 