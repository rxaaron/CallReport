<?php

    include_once('dbconn.php');

    $select=$db->query("SELECT ID, HomeName FROM NursingHome WHERE Active = true ORDER BY HomeName;");
    
    if($select){
        while($results=$select->fetch_object()){
            echo "<option value=\"".$results->ID."\">".$results->HomeName."</option>";
        }
    }

?>