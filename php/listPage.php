<?php

declare(strict_types=1); // strict type checking
session_start();

// File: listPage.php
// Group: 3
// Members:
//   Mykyta Koryliuk
//   Dominick Smith
//   Andrew Todd
//   Xuezhi Wang
//   Katherine Ziomek
// Purpose of file:
// This is the UI for the list page of our application, which also contains PHP code.


//Uncomment for debugging
// var_dump($_POST);
// var_dump($_SESSION);
//includes go here
define('__ROOT__', dirname(__FILE__));
// Includes
require_once("./navigationBar.php");
require('./list_page.php');
require('./DeleteOrSelectList.php');
//session variables, etc.

if (!isset($_POST['open_list']) && !isset($_POST['deleteListButton']) && !isset($_POST['update_list']) && !isset($_POST['save_new_list']) && !isset($_POST['add_new_to_existing']) && !isset($_POST['delete_item'])) {
    unset($_SESSION['open_list']);
    unset($_SESSION['list_title']);
    unset($_SESSION['general_notes']);
    $_SESSION['clearAllButton'] = false;
}

if (isset($_POST['open_list'])) {
    $_SESSION['open_list'] = $_POST['open_list'];
    $_SESSION['clearAllButton'] = true;
    
    display_all_list_items(1);
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css" />

  <!--Google Fonts-->
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&family=Noto+Sans+KR&display=swap" rel="stylesheet" />

  <!-- Custom CSS -->
  <link rel="stylesheet" href="../css/style.css" />

  <title>Lyst - List Page</title>
</head>

<body class="bg-light text-dark">

  <!--include nav bar here-->
  <?php
  //this was included for testing purposes only
  //can be removed/changed if another method is used (or if sessions are used) 
  displayNavBar();
  ?>

  <!--Use Bootstrap grids to create sections on the list page-->
  <!--Note: the entire page is a form-->
  <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
    <div class="container">
      <!--output a dismissable alert with instructions for the user
      if they are not opening up an existing list-->
      <?php
        if(!isset($_POST["open_list"]) and !isset($_POST["add_new_to_existing"])){
          echo '
          <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>Welcome to your grocery list!</strong><br>Please use the form controls on the right to add items, quantities, and notes to your list.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          ';
        }

      ?>


      <div class="row">
        <!--Div containing the list title-->
        <div class="col-lg-8">
          <!--Title-->
          <div class="form-group">
            <input type="title" class="form-control" id="title" name="list_title" placeholder="Enter list title" 
            <?php
            //                   if(isset($_SESSION['clearAllButton']) && $_SESSION['clearAllButton'] == true) {
            //                       echo 'value=""';
            //                   }

            if (isset($_SESSION['list_title'])) {
              echo "value='$_SESSION[list_title]'";
            }
            ?> />
          </div>
        </div>
        <!--Div containing the "Notes" heading-->
        <div class="col-md-4">
          <!--"Notes" heading-->
          <h3 class="display-5 text-center mb-4 NanumGothic">
            General Notes
          </h3>
        </div>
      </div>
      <div class="row">
        <!--Div containing the list-->
        <div class="col-lg-8">
          <div class="paper mb-5">
            <div class="lines">
              <!--ATTENTION-->
              <!--This Div contains the list information-->
              <!--any functions written to extract list items would be getting the information from the following div element:-->
              <div class="text" spellcheck="false" id="notesText"><?php
                if (isset($_POST['save_new_list'])) {
                  $_SESSION['clearAllButton'] = false;
                  perform_list_insertions_into_current_saved_lists();
                  //set a session variable for the chosen modal
                  $_SESSION['modal'] = "saved";
                  //redirect
                  ?>
                  <script type="text/javascript">
                  window.location.href = './modals/modalsLists.php';
                  </script>
                  <?php

                }

                if (isset($_POST['update_list'])) {
                  $_SESSION['clearAllButton'] = true;
                  
                  // var_dump($_POST['current_list_id']);
                  // var_dump($_POST['items']);
                  // var_dump($_POST['quantity']);

                  update_list();

                  //set a session variable for the chosen modal
                  $_SESSION['modal'] = "updated";
                  //redirect
                  ?>
                  <script type="text/javascript">
                  window.location.href = './modals/modalsLists.php';
                  </script>
                  <?php

                }

                if (isset($_POST['delete_item'])) {
                  $_SESSION['clearAllButton'] = true;
                  
                  update_list_with_items();

                  display_all_list_items();

                }

                if (isset($_POST['open_list'])) {
                  display_all_list_items();
                }

                if (isset($_SESSION['clearAllButton']) && $_SESSION['clearAllButton'] == true) {
                  echo "";
                } else if (!isset($_SESSION['clearAllButton']) || (isset($_SESSION['clearAllButton']) && $_SESSION['clearAllButton'] == false)) {
                  //echo 'Welcome to your grocery list!<br>
                            //Please use the form controls on the right to begin adding items to the list<br>';
                }

                if (isset($_POST['add_new_to_existing'])) {
                  perform_single_list_insertion_into_items();
                  display_all_list_items();

                  //echo '<script>alert("New item was added!");</script>';
                }
                ?></div>
            </div>
            <div class="holes hole-top"></div>
            <div class="holes hole-middle"></div>
            <div class="holes hole-bottom"></div>
          </div>
        </div>
        <!--Div containing the list controls-->
        <div class="col-md-4">
          <!--Notes textarea-->
          <div class="form-group">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="general_notes" 
            <?php
              if (isset($_SESSION['clearAllButton']) && $_SESSION['clearAllButton'] == true) {
                echo 'placeholder="Enter notes"';
              } else if (isset($_SESSION['clearAllButton']) && !$_SESSION['clearAllButton']) {
                echo 'placeholder="Enter notes"';
              }
              ?>><?php
          if (isset($_SESSION['general_notes'])) {
            echo $_SESSION['general_notes'];
          }
          ?></textarea>
          </div>
          <hr class="bg-light mt-4" />
          <div class="form-group">
            <?php if (isset($_SESSION['open_list'])) { ?>
              <p class='NanumGothic text-center'>Enter new items here:</p>
              <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="form-group">
                        <label for="items" class='NanumGothic'>Items</label>
                        <input type="text" class="form-control" id="items" name="item" placeholder="...">
                    </div>
                    <div class="form-group">
                        <label for="quantity" class='NanumGothic'>Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quant" placeholder="...">
                    </div>
<!-- 
                <input placeholder="..." type="text" class="form-control" name="item" id="items" />
                <input placeholder="quantity" type="number" class="form-control" name="quant" id="quantity" /> -->
                <input type="submit" class="btn btn-primary full-width mt-3 mb-3 p-2" name="add_new_to_existing" value="Add Item to List" />
              </form>
            <?php } else { ?>
              <p class='NanumGothic text-center'>Enter new items here:</p>
                    <div class="form-group">
                        <label for="items" class='NanumGothic'>Items</label>
                        <input type="text" class="form-control" id="items" placeholder="...">
                    </div>
                    <div class="form-group">
                        <label for="quantity" class='NanumGothic'>Quantity</label>
                        <input type="number" class="form-control" id="quantity" placeholder="...">
                    </div>              
              <!-- <input placeholder="..." type="text" class="form-control" id="items" />
              <input placeholder="quantity" type="number" class="form-control" id="quantity" /> -->
              <button type="button" class="btn btn-primary full-width mt-3 mb-3 p-2" onclick="AddNewItems();">
                Add Item to List
              </button>
            <?php } ?>
          </div>
          <hr class="bg-light mt-4" />

          <!--Optional space for budget information-->
          <!--Possibly added in sprint 2 or 3?-->

          <!--List Control Buttons-->
          <!--heading-->
          <h3 class="display-5 text-center mt-3 mb-3 NanumGothic">
            List Controls
          </h3>
          <!--"Clear All" Button-->
          <button type="submit" name='clearAllButton' class="btn btn-primary full-width mt-3 mb-3 p-2">
            Clear All
          </button>
          <?php if (!isset($_SESSION['open_list'])) { ?>
            <!--"Save New List" Button-->
            <button type="submit" name="save_new_list" class="btn btn-primary full-width mt-3 mb-3 p-2">
              Save New List
            </button>
          <?php } ?>
          <?php
          if (isset($_SESSION['open_list'])) {
          ?>
            <!--"Update List" Button-->
            <button type="submit" name="update_list" class="btn btn-primary full-width mt-3 mb-3 p-2">
              Update List
            </button>
            <!--"Delete List" Button-->
            <button type="submit" name='deleteListButton' class="btn btn-primary full-width mt-3 mb-3 p-2">
              Delete Saved List
            </button>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </form>

  <script src="../js/AddNewItems.js"></script>

  <!--error modals-->
    <!--Error modal for an empty item-->
    <div class="modal" id="emptyFields" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Error!</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Item cannot be added.</p>
                <p>Item field cannot be blank.</p>
            </div>
            </div>
        </div>
    </div>  

    <!--Error modal for an empty item-->
    <div class="modal" id="itemLength" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Error!</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Item name is too long.</p>
                <p>Please limit item name to 50 characters or less!</p>
            </div>
            </div>
        </div>
    </div>      

</body>

</html>