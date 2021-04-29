<?php
// File: list_page.php
// Group: 3
// Members:
// 	Mykyta Koryliuk
// 	Dominick Smith
// 	Andrew Todd
// 	Xuezhi Wang
// 	Katherine Ziomek
// Purpose of file:
//  This file handles all actions after the user submits the listPage.php form


//Uncomment for debugging
// var_dump($_POST);
// var_dump($_SESSION);

require('./dbCommands.php');

function validate_input($data)
{
    return trim(stripslashes(htmlspecialchars($data)));
}

function check_if_item_is_in_db_and_return($item)
{
    $selected_item = select_item_id_from_items($item);
    
    if (!$selected_item) {
        insert_into_items($item);
        
        $selected_item = select_item_id_from_items($item);
    }
    
    return $selected_item;
}

function perform_single_list_insertion_into_items()
{
    $item_id = check_if_item_is_in_db_and_return(validate_input($_POST['item']));
    $quantity = validate_input($_POST['quant']);
    $notes = 'none';
    
    if ($item_id) {
        $open_list = $_SESSION['open_list'];
        
        insert_into_current_list($open_list, $item_id, $quantity, $notes);
    }
}

function perform_list_insertions_into_current_saved_lists()
{
    $title = validate_input($_POST['list_title']);
    $general_notes = !empty($_POST['general_notes']) ? validate_input($_POST['general_notes']) : 'none';
    $notes = !empty($_POST['notes']) ? validate_input($_POST['notes']) : 'none';
    $items = $_POST['items'];
    $quantity = $_POST['quantity'];
    
    insert_into_saved_lists($title, $general_notes);
    
    foreach ($items as $index => $new_item_name) {
        if (!empty($new_item_name)) {
                $item_id = check_if_item_is_in_db_and_return(validate_input($new_item_name));
                $qnt = !empty($quantity[$index]) ? number_format($quantity[$index]) : null;
                
                if ($item_id) {
                    $new_list_id = select_saved_list_id_from_saved_lists();
                    
                    insert_into_current_list($new_list_id, $item_id, $qnt, $notes);
                }
        }
    }
}

function update_list_with_items()
{
    $list = $_POST['delete_item'];
    $current_list_id = array_search('remove', $list);
    
    delete_current_list_id_from_current_list($current_list_id);
}

// IMPLEMENT QUANTITY PROGRESSION
function update_list()
{
    $saved_list_id = $_SESSION['open_list'];
    
    $title = validate_input($_POST['list_title']);
    $general_notes = !empty($_POST['general_notes']) ? validate_input($_POST['general_notes']) : 'none';
    
    $quantity = $_POST['quantity'];
    $items = $_POST['items'];
    $current_list_id = $_POST['current_list_id'];
    
    foreach ($items as $index => $item) {
        $item_name = !empty($item) ? validate_input($item) : 'empty item';
        $item_id = check_if_item_is_in_db_and_return(validate_input($item_name));
        
        $qnt = !empty($quantity[$index]) ? validate_input($quantity[$index]) : null;
        
        if (!empty($current_list_id[$index])) {
            update_item_id_and_quantity_on_current_list($current_list_id[$index], $item_id, $qnt, $saved_list_id);
        } else {
            insert_into_current_list($saved_list_id, $item_id, $qnt, $general_notes);
        }
    }
    
    update_title_notes_on_saved_lists($saved_list_id, $title, $general_notes);
    display_all_list_items();
}

function display_all_list_items($mode = 0)
{
    $saved_list_id = $_SESSION['open_list'];
    $all_items = select_all_from_current_list($saved_list_id);
    
    if (!empty($all_items)) {
        if ($mode == 0) {
            //creating headings for the items
            echo "
            <div class='container'>
                <div class='row ml-3'>
                    <div class='col NanumGothic'>
                        <h4>Item</h4>
                    </div>
                    <div class='col NanumGothic'>
                        <h4>Quantity</h4>
                    </div>
                    <div class='col'></div>
                </div>
            </div>
            
            ";
            foreach ($all_items as $item_collection) {
                echo "<div class='container'>";
                echo "<div class='row m-2'>";
                echo "<div class='col'>";
                echo "<input type='text' class='form-control input-sm' name='items[]' value='$item_collection[item_name]' /></div>";
                echo "<div class='col'>";
                echo "<input type='text' class='form-control input-sm' name='quantity[]' value='$item_collection[quantity]' /></div>";
                echo "<input type='text' style='display: none;' name='current_list_id[]' value='$item_collection[current_list_id]' />";
                echo "<div class='col'>";
                echo "<input type='submit' class='btn btn-secondary btn-sm pr-2 pl-2 mt-1 mb-1' name='delete_item[$item_collection[current_list_id]]' value='remove' /></div>";
                echo "</div></div>";
            }
        } else if ($mode == 1) {
            $_SESSION['list_title'] = $all_items[0]['title'];
            $_SESSION['general_notes'] = $all_items[0]['notes'];
        }
    } else {
        //echo "You have nothing to display!";
    }
}
