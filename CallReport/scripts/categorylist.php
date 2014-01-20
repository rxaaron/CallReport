<?php

    include_once('dbconn.php');

    $select=$db->query("SELECT ID, CategoryName FROM Category WHERE Active = true ORDER BY CategoryName;");
    
    if($select){
        while($results=$select->fetch_object()){
            echo "<option value=\"".$results->ID."\">".$results->CategoryName."</option>";
        }
    }

?>