<?php
    // File: navigationBar.php
    // Group: 3
    // Members:
    // 	Mykyta Koryliuk
    // 	Dominick Smith
    // 	Andrew Todd
    // 	Xuezhi Wang
    // 	Katherine Ziomek
    // Purpose of file:    
    // This file contains a function that will output the navigation bar on other pages
    // Backup of the HTML code created in navigationBar-backup.html if the HTML code needs to be restored
    // PHP Function can be edited as necessary

	session_start();

	function logincheck(){
		$id = $_SESSION["user_id"];
		if($id == ""){
            //set a session variable for the chosen modal
            $_SESSION['modal'] = "pleaseLogin";
            //redirect
            header('Location: ./modals/modalsRegLogin.php');
			exit();
		}
	}
	logincheck();

    //new user info
    function infocheck(){
        try {

                define("servername", "mysql:host=localhost;dbname=lyst_database");
                define("username", "lyst_admin");
                define("password", "!lystProject2021!");
                $conn = new PDO(servername, username, password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // connect to DB
                $dbh = $conn;
            
                //Select in sql
                $userid = $_SESSION["user_id"];
                $sql = "select email_address,username,city,province_id,country_id from lyst_database.customers where customer_id='$userid'";
                $stmt = $dbh->query($sql);
                $row = $stmt->fetch(PDO::FETCH_BOTH);
                if (empty($row[0])) {
                    //error
                        //set a session variable for the chosen modal
                        $_SESSION['modal'] = "incorrectUserPassword";
                        //redirect
                        header('Location: ./modals/modalsRegLogin.php');
                } else {
                    //Correct
                    
                    $local2 = "./userInformaton.php";
                    if($row[2]=='none'){
                        //set a session variable for the chosen modal
                        $_SESSION['modal'] = "completeInfo";
                        //redirect
                        header('Location: ./modals/modalsRegLogin.php');                        
                        // echo '<script>alert("Please complete your information");window.location.href="./userInformation.php";</script>';
                    }
                    if($row[3]==1){
                        //set a session variable for the chosen modal
                        $_SESSION['modal'] = "completeInfo";
                        //redirect
                        header('Location: ./modals/modalsRegLogin.php');                            
                        // echo '<script>alert("Please complete your information");window.location.href="./userInformation.php";</script>';
                    }
                    if($row[4]==1){
                        //set a session variable for the chosen modal
                        $_SESSION['modal'] = "completeInfo";
                        //redirect
                        header('Location: ./modals/modalsRegLogin.php');                            
                        // echo '<script>alert("Please complete your information");window.location.href="./userInformation.php";</script>';
                    }
                }
            
            
            
        } catch (PDOException $e) {
                //check error
                // echo $e->getMessage() . '<br>';
                // //error line
                // echo $e->getLine() . '<br>';
                // echo $e->__toString() . '<br>';
        }
            
    }

    if(!strpos($_SERVER['PHP_SELF'],'userInformation.php')){

        infocheck();

    }

    function displayNavBar() {
        echo '
            <!--Include JS scripts and CSS scripts for the nav bar to work-->
            <!--Must be included with PHP echo or the nav bar will not work-->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="../css/bootstrap.min.css">
            <link rel="stylesheet" href="../css/style.css"> 

            <nav class="navbar navbar-dark bg-primary sticky-top NotoSansKRFont mb-4">
		<div>
                	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                  		<span class="navbar-toggler-icon"></span>
                	</button>
			<h3 class="navbar-text display-5 mr-5" href="#">Lyst</h3>
		</div>
            	
		<div class="navbar-text display-5 ">Hi, '.$_SESSION["username"].'</div>

                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                    <!--Nav Bar Information-->
                        <li class="nav-item">
                            <!--can re-direct if we add a homepage in sprint 3-->
                            <a class="nav-link" href="#">Home - Coming Soon!</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="currentLists.php">See All Lists</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="listPage.php">Create A New List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="userInformation.php">Account Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./logout.php">Logout</a>
                        </li>    
                    </ul>
                </div>  
            </nav>';
    }
?>
