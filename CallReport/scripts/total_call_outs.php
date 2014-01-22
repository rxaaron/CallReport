<?php

    include_once('dbconn.php');

    $select=$db->query("SELECT A.ID, B.HomeName, COUNT(A.NursingHome) AS CallNumber FROM Transaction AS A INNER JOIN NursingHome AS B ON A.NursingHome = B.ID GROUP BY A.NursingHome ORDER BY B.HomeName;");
    
    if($select){
        $json_results = array();
        $labels = array();
        $data = array();
        $tooltips = array();
        while($results=$select->fetch_object()){
            $labels [] = $results->HomeName;
            $data [] = intval($results->CallNumber);
            $tooltips [] = $results->CallNumber;
        }
        $json_results ["labels"] = $labels;
        $json_results ["datas"] = $data;
        $json_results ["tooltips"] = $tooltips;
        echo json_encode($json_results,JSON_PRETTY_PRINT);
    }