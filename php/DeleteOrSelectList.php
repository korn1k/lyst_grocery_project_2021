<?php

// File: DeleteOrSelectList.php
// Group: 3
// Members:
// 	Mykyta Koryliuk
// 	Dominick Smith
// 	Andrew Todd
// 	Xuezhi Wang
// 	Katherine Ziomek
// Purpose of file:
// This file contains functions for deleting a list from the database.

//require('./connect.php');

$conn = initialize_database();

function delete_list($saved_list_id)
{

    try {
        //sql to delete a record 
        $sql = "DELETE FROM current_list WHERE list_id = '$saved_list_id' " ;
        $sql2 = "DELETE FROM saved_lists WHERE saved_list_id = '$saved_list_id'";
        
        $GLOBALS['conn']->prepare($sql)->execute();
        $GLOBALS['conn']->prepare($sql2)->execute();
        //echo "Record deleted successfully";
        unset($_SESSION['list_title']);
        unset($_SESSION['general_notes']);

        //set a session variable for the chosen modal
        $_SESSION['modal'] = "deleted";
        //redirect
        ?>
        <script type="text/javascript">
        window.location.href = './modals/modalsLists.php';
        </script>
        <?php
    
    } catch(PDOException $err) {
        echo $err;
    }
    
}

if (isset($_POST['deleteListButton'])) {
    $saved_list_id = $_SESSION['open_list'];

    delete_list($saved_list_id);
}

?>
