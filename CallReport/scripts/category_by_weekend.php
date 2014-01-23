<?php

    include_once('dbconn.php');

    $select=$db->query("SELECT B.CategoryName, SUM(CASE WHEN DAYOFWEEK(A.DateOfCall) = 1 OR DAYOFWEEK(A.DateOfCall) = 7 THEN 1 ELSE 0 END) AS Weekend, SUM(CASE WHEN DAYOFWEEK(A.DateOfCall) > 1 AND DAYOFWEEK(A.DateOfCall) < 7 THEN 1 ELSE 0 END) AS Weekday FROM Transaction AS A INNER JOIN Category AS B ON A.Category = B.ID GROUP BY A.Category ORDER BY B.CategoryName;");
    
    if($select){
        $json_results = array();
        $labels = array();
        $dataleft = array();
        $dataright = array();
        $tooltips = array();
        while($results=$select->fetch_object()){
            $labels [] = $results->CategoryName;
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