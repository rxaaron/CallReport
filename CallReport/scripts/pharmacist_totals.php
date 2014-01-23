<?php

    include_once('dbconn.php');

    $select=$db->query("SELECT B.PharmName, COUNT(A.RPh) AS RPh FROM Transaction AS A INNER JOIN RPh AS B ON A.RPh = B.ID GROUP BY A.RPh ORDER BY B.PharmName;");
    
    if($select){
        $json_results = array();
        $labels = array();
        $data = array();
        $tooltips = array();
        while($results=$select->fetch_object()){
            $labels [] = $results->PharmName;
            $data [] = intval($results->RPh);
            $tooltips [] = $results->RPh;
        }
        $json_results ["labels"] = $labels;
        $json_results ["datas"] = $data;
        $json_results ["tooltips"] = $tooltips;
        echo json_encode($json_results,JSON_PRETTY_PRINT);
    }