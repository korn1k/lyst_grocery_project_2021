<?php


//require('./connect.php');

$conn = initialize_database();

function delete_user($user_id,$saved_list_id)
{
    echo 'delete';

    try {
        //sql to delete a record
        $sql = "DELETE FROM current_list WHERE list_id = '$saved_list_id' ";
        $sql2 = "DELETE FROM saved_lists WHERE saved_list_id = '$user_id'";
        $sql3 = "DELETE FROM customers WHERE customer_id = '$user_id' ";
	$GLOBALS['conn']->prepare($sql)->execute();
	$GLOBALS['conn']->prepare($sql2)->execute();
	$GLOBALS['conn']->prepare($sql3)->execute();
    	//echo "Record deleted successfully";
        
        //set a session variable for the chosen modal
        $_SESSION['modal'] = "deletedUser";
        //redirect
        ?>
        <script type="text/javascript">
        window.location.href = './modals/modalsUserInfo.php';
        </script>
        <?php


    } catch (PDOException $err) {
        //comment this out when ready to merge
        echo $err;
    }

}

if (isset($_POST['deletedUser'])) {
    

    delete_list($saved_list_id);
}
?>
