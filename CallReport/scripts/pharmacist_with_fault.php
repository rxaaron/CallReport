<?php

    include_once('dbconn.php');

    $select=$db->query("SELECT B.PharmName, SUM(CASE WHEN A.NHFault = 1 THEN 1 ELSE 0 END) AS NursingHomeFault, SUM(CASE WHEN A.EncoreFault = 1 THEN 1 ELSE 0 END) AS EncoreFault FROM Transaction AS A INNER JOIN RPh AS B ON A.RPh = B.ID GROUP BY A.RPh ORDER BY B.PharmName;");
    
    if($select){
        $json_results = array();
        $labels = array();
        $dataleft = array();
        $dataright = array();
        while($results=$select->fetch_object()){
            $labels [] = $results->PharmName;
            $dataleft [] = intval($results->NursingHomeFault);
            $dataright [] = intval($results->EncoreFault);
            
        }
        $json_results ["labels"] = $labels;
        $json_results ["left"] = $dataleft;
        $json_results ["right"] = $dataright;
        $json_results ["title.left"] = "Nursing Home Fault";
        $json_results ["title.right"] = "Encore Fault";
        $json_results ["gutter.center"] = 100;
        echo json_encode($json_results,JSON_PRETTY_PRINT);
    }