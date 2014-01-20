<?php

    include_once('dbconn.php');
    
    $select=$db->query("SELECT ID, SubName FROM SubCategory WHERE Active = true AND AssociatedCategory = ".$_POST['category']." ORDER BY SubName;");
    echo "<option value=\"0\">Select One</option>";
    if($select){
        while($results=$select->fetch_object()){
            echo "<option value=\"".$results->ID."\">".$results->SubName."</option>";
        }
    }

?>
