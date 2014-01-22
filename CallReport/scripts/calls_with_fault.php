<?php

    include_once('dbconn.php');

    $select=$db->query("SELECT B.HomeName, SUM(CASE WHEN A.NHFault = 1 THEN 1 ELSE 0 END) AS NursingHomeFault, SUM(CASE WHEN A.EncoreFault = 1 THEN 1 ELSE 0 END) AS EncoreFault FROM Transaction AS A INNER JOIN NursingHome AS B ON A.NursingHome = B.ID GROUP BY A.NursingHome ORDER BY B.HomeName;");
    
    if($select){
        $json_results = array();
        $labels = array();
        $data = array();
        $tooltips = array();
        $key = array("Nursing Home Fault","Our Fault");
        while($results=$select->fetch_object()){
            $labels [] = $results->HomeName;
            $data [] = array(intval($results->NursingHomeFault),intval($results->EncoreFault));
            $tooltips [] = array("Nursing Home Fault","Encore Fault");
            
        }
        $json_results ["labels"] = $labels;
        $json_results ["datas"] = $data;
        $json_results ["tooltips"] = $tooltips;
        $json_results ["key"] = $key;
        echo json_encode($json_results,JSON_PRETTY_PRINT);
    }