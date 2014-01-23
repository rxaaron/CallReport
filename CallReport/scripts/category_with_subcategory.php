<?php

    include_once('dbconn.php');
    
    $category=$db->query("SELECT ID, CategoryName FROM Category WHERE Active = True ORDER BY CategoryName;");
    if($category){
        $json_results = array();
        $labels = array();
        $data = array();
        $tooltips = array();
        $key = array();
                
        while($cats=$category->fetch_object()){
            $subcategory=$db->query("SELECT B.SubName, COUNT(A.SubCategory) AS SubCats FROM Transaction AS A INNER JOIN SubCategory AS B ON A.SubCategory = B.ID WHERE A.Category = ".$cats->ID." GROUP BY A.SubCategory;");
            $labels [] = $cats->CategoryName;
            if($subcategory){
                $subdata = array();
                while($subcats=$subcategory->fetch_object()){
                    $subdata [] = intval($subcats->SubCats);
                    $tooltips [] = $subcats->SubName;
                    $key [] = $subcats->SubName;
                }
                $data [] = $subdata;
            }
            
        }
            
        $json_results ["labels"] = $labels;
        $json_results ["datas"] = $data;
        $json_results ["tooltips"] = $tooltips;
        $json_results ["labels.ingraph"] = $key;
        echo json_encode($json_results,JSON_PRETTY_PRINT);
    }