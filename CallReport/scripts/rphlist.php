<?php

    include_once('dbconn.php');

    $select=$db->query("SELECT ID, PharmName FROM RPh WHERE Active = true ORDER BY PharmName;");
    
    if($select){
        while($results=$select->fetch_object()){
            echo "<option value=\"".$results->ID."\">".$results->PharmName."</option>";
        }
    }

?>