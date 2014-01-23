<?php

    include_once('dbconn.php');
    
    $select=$db->query("SELECT B.HomeName, SUM(CASE WHEN A.Category = 1 THEN 1 ELSE 0 END) AS NewOrder, SUM(CASE WHEN A.Category = 2 THEN 1 ELSE 0 END) AS Admission, SUM(CASE WHEN A.Category = 3 THEN 1 ELSE 0 END) AS Refill, SUM(CASE WHEN A.Category = 4 THEN 1 ELSE 0 END) AS Error FROM Transaction AS A INNER JOIN NursingHome AS B ON A.NursingHome = B.ID GROUP BY A.NursingHome ORDER BY B.HomeName;");
    
    if($select){
        $json_results = array();
        $labels = array();
        $data = array();
        $tooltips = array();
        $key = array("New Order","Admission","Refill","Error");
        while($results=$select->fetch_object()){
            $labels [] = $results->HomeName;
            $data [] = array(intval($results->NewOrder),intval($results->Admission),intval($results->Refill),intval($results->Error));
            $tooltips [] = "New Order";
            $tooltips [] = "Admission";
            $tooltips [] = "Refill";
            $tooltips [] = "Error";
            
        }
        $json_results ["labels"] = $labels;
        $json_results ["datas"] = $data;
        $json_results ["tooltips"] = $tooltips;
        $json_results ["key"] = $key;
        echo json_encode($json_results,JSON_PRETTY_PRINT);
    }