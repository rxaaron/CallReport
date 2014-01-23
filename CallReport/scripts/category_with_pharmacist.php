<?php
    
    include_once('dbconn.php');

    $select=$db->query("SELECT B.CategoryName, SUM(CASE WHEN A.RPh = 1 THEN 1 ELSE 0 END) AS AaronT, SUM(CASE WHEN A.RPh = 2 THEN 1 ELSE 0 END) AS AaronG, SUM(CASE WHEN A.RPh = 3 THEN 1 ELSE 0 END) AS RickL, SUM(CASE WHEN A.RPh = 4 THEN 1 ELSE 0 END) AS RobL FROM Transaction AS A INNER JOIN Category AS B ON A.Category = B.ID GROUP BY A.Category ORDER BY B.CategoryName;");
    
    if($select){
        $json_results = array();
        $labels = array();
        $data = array();
        $tooltips = array();
        $key = array("Aaron T","Aaron G","Rick L","Rob L");
        while($results=$select->fetch_object()){
            $labels [] = $results->CategoryName;
            $data [] = array(intval($results->AaronT),intval($results->AaronG),intval($results->RickL),intval($results->RobL));
            $tooltips [] = "Aaron T";
            $tooltips [] = "Aaron G";
            $tooltips [] = "Rick L";
            $tooltips [] = "Rob L";
            
        }
        $json_results ["labels"] = $labels;
        $json_results ["datas"] = $data;
        $json_results ["tooltips"] = $tooltips;
        $json_results ["key"] = $key;
        echo json_encode($json_results,JSON_PRETTY_PRINT);
    }