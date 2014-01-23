<?php

    include_once('dbconn.php');

    $select=$db->query("SELECT A.ID, B.HomeName, SUM(CASE WHEN DAYOFWEEK(A.DateOfCall) = 1 OR DAYOFWEEK(A.DateOfCall) = 7 THEN 1 ELSE 0 END) AS Weekend, SUM(CASE WHEN DAYOFWEEK(A.DateOfCall) > 1 AND DAYOFWEEK(A.DateOfCall) < 7 THEN 1 ELSE 0 END) AS Weekday FROM Transaction AS A INNER JOIN NursingHome AS B ON A.NursingHome = B.ID GROUP BY A.NursingHome ORDER BY B.HomeName;");
    
    if($select){
        $json_results = array();
        $labels = array();
        $dataleft = array();
        $dataright = array();
        $tooltips = array();
        while($results=$select->fetch_object()){
            $labels [] = $results->HomeName;
            $dataright [] = intval($results->Weekday);
            $dataleft [] = intval($results->Weekend);
        }
        $json_results ["labels"] = $labels;
        $json_results ["left"] = $dataleft;
        $json_results ["right"] = $dataright;
        $json_results ["title.right"] = "Weekdays";
        $json_results ["title.left"] = "Weekends";
        $json_results ["gutter.center"] = 150;
        echo json_encode($json_results,JSON_PRETTY_PRINT);
    }