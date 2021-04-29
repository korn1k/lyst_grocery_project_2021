<?php
    declare(strict_types=1); // strict type checking
    session_start();

    // File: currentLists.php
    // Group: 3
    // Members:
    // 	Mykyta Koryliuk
    // 	Dominick Smith
    // 	Andrew Todd
    // 	Xuezhi Wang
    // 	Katherine Ziomek
    // Purpose of file:
    // This file shows all the saved lists a user has

    //includes go here
    define('__ROOT__', dirname(__FILE__));
    // Includes
    require_once("./navigationBar.php");
    require_once("./connect.php");
    //session variables, etc.
    //uncomment for testing
    // var_dump($_SESSION);

?>

<!DOCTYPE html>
<html lang='en'>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../css/bootstrap.min.css">

        <!--Google Fonts-->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&family=Noto+Sans+KR&display=swap" rel="stylesheet">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="../css/style.css">

        <title>List - All Lists</title>
    </head>
    <body class="bg-light text-dark">

        <!--include nav bar here-->
        <?php
            //this was included for testing purposes only
            //can be removed/changed if another method is used (or if sessions are used) 
            displayNavBar();
        ?>

        <!--using Bootstrap grids to center the lists-->
        <div class="container">
            <div class="row">
                <!--first column-->
                <div class="col-lg-2"></div>
                <!--middle column-->
                <div class="col-lg-8">
                    <!--"Current Saved Lists" heading-->
                    <h1 class="display-4 text-center mb-4 mt-4 NanumGothic">Current Saved Lists</h1>
                    <hr class="bg-muted">

                    <!--table output here-->
                    <?php
                        //call the function to display the saved lists
                        displayAllLists(); 
                    ?>

                    <hr class="bg-muted">

                </div>
            </div>
            <!--third column-->
            <div class="col-lg-2"></div>
        </div>        


        <!--PHP Code and Functions-->
        <?php
        //create a function that will retrieve and display the list summary information from the database
        function displayAllLists() {
            //make a connection to the database
            $db_conn = initialize_database();

            if (!$db_conn){
                //output an error if the connection was unsuccessful
                echo "<p>Error connecting to the database</p>\n";
            } 
            else {
                //prepare the select statement
                //create an SQL query
                $sqlSelectQuery = "select sl.saved_list_id as 'id', sl.title as 'title', c.username as 'creator', sl.modified_date as 'date', sl.customer_id

                    from saved_lists sl
                    inner join customers c on c.customer_id = sl.customer_id

                    where sl.customer_id = :db_user_id

                    order by sl.saved_list_id;";

                    //old code - keep for now in case
                    //"select saved_list_id, title, customer_id from saved_lists order by customer_id;"

                    // assign value to :customer_id based on the session variable for a logged in user
                    //use this to identify if there are saved lists for a logged in user only
                    $data = array(":db_user_id" => $_SESSION['user_id']);

                //prepare query
                $stmt = $db_conn->prepare($sqlSelectQuery);

                if (!$stmt){
                    echo "<p>Error preparing to read data from the database</p>\n";
                } 
                else {
                    // execute query in database - only using the logged in user
                    $status = $stmt->execute($data);

                    if(!$status){
                    echo "<p>Error reading data from the database</p>\n";
                    } 
                    else {
                        //uncomment for testing
                        // echo "<p>Number of rows found is " . $stmt->rowCount() . "</p>\n";

                        //if entries found for a logged in user
                        if ($stmt->rowCount() > 0){
                            //create a variable to store the row count
                            $rowCount = 1;
                            //create a table
                            echo "<table class='table table-striped'";
                            echo "<tr class='bg-primary text-white'>";
                            echo "<th>#</th><th>List Title</th><th>Creator</th><th>Last Updated</th><th>Controls</th>";
                            echo "</tr>\n";
                            //fetch the information from the database and output to the table
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){  
                                    //format the date to be more readable
                                    //grab the date value from the database
                                    $savedDate = $row['date'];
                                    $datepieces = explode(" ", $savedDate);
                                    //store the date
                                    $date = $datepieces[0];
                                    //format the time
                                    $time = $datepieces[1];
                                    $timepieces = explode(":", $time);
                                    //format the hour
                                    //if PM time
                                    if ($timepieces[0] >= 13) {
                                        $hour = $timepieces[0] - 12;
                                        $time = $hour.":".$timepieces[1]." PM";
                                    }
                                    //if AM time
                                    else {
                                        $hour = $timepieces[0];
                                        $time = $hour.":".$timepieces[1]." AM";
                                    }

                                    echo "<tr>";
                                    echo "<td>";
                                    echo $rowCount;
                                    echo "</td><td>";
                                    //check if the list title is blank
                                    if ($row['title'] == "") {
                                        echo "[Untitled]";
                                    }
                                    else {
                                        echo $row['title'];
                                    }
                                    echo "</td><td>";
                                    echo $row['creator'];
                                    echo "</td><td>";
                                    echo $date." at ".$time;
                                    echo "</td><td>";
                                    echo '
                                        <form action="./listPage.php" method="post">
                                            <button type="submit" name="open_list" value="'.$row["id"].'" class="btn btn-primary full-width btn-sm">Open List</button>
                                        </form>
                                    ';
                                    echo "</td>";
                                    echo "</tr>";
                                    
                                    //increment the row count
                                    $rowCount++;
                                }
                            
                            echo "</table>";
                        }
                        else {
                            //Do not output a table if a logged in user does not have any saved lists
                            echo '

                            <form action="./listPage.php" method="post" class="pt-4 pb-4 NanumGothic">
                                <h3 class="display-5 text-center">You do not currently have any saved lists.</h3>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" name="createNewList" class="btn btn-primary half-width-element mt-3 mb-3 p-2">Click Here To Create a New List</button>
                                </div>
                            </form>
                            ';
                        }
                    }
                }
            }        
        }
        ?>    

    </body>
</html>