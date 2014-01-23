<?php

    include_once('dbconn.php');

    $select=$db->query("SELECT B.CategoryName, COUNT(A.Category) AS Category FROM Transaction AS A INNER JOIN Category AS B ON A.Category = B.ID GROUP BY A.Category ORDER BY B.CategoryName;");
    
    if($select){
        $json_results = array();
        $labels = array();
        $data = array();
        $tooltips = array();
        while($results=$select->fetch_object()){
            $labels [] = $results->CategoryName;
            $data [] = intval($results->Category);
            $tooltips [] = $results->Category;
        }
        $json_results ["labels"] = $labels;
        $json_results ["datas"] = $data;
        $json_results ["tooltips"] = $tooltips;
        echo json_encode($json_results,JSON_PRETTY_PRINT);
    }