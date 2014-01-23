<?php

    include_once('dbconn.php');

    $select=$db->query("SELECT B.PharmName, SUM(CASE WHEN DAYOFWEEK(A.DateOfCall) = 1 OR DAYOFWEEK(A.DateOfCall) = 7 THEN 1 ELSE 0 END) AS Weekend, SUM(CASE WHEN DAYOFWEEK(A.DateOfCall) > 1 AND DAYOFWEEK(A.DateOfCall) < 7 THEN 1 ELSE 0 END) AS Weekday FROM Transaction AS A INNER JOIN RPh AS B ON A.RPh = B.ID GROUP BY A.RPh ORDER BY B.PharmName;");
    
    if($select){
        $json_results = array();
        $labels = array();
        $dataleft = array();
        $dataright = array();
        $tooltips = array();
        while($results=$select->fetch_object()){
            $labels [] = $results->PharmName;
            $dataright [] = intval($results->Weekday);
            $dataleft [] = intval($results->Weekend);
        }
        $json_results ["labels"] = $labels;
        $json_results ["left"] = $dataleft;
        $json_results ["right"] = $dataright;
        $json_results ["title.right"] = "Weekdays";
        $json_results ["title.left"] = "Weekends";
        $json_results ["gutter.center"] = 100;
        echo json_encode($json_results,JSON_PRETTY_PRINT);
    }