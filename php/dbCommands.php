<?php

// File: db_select_insert.php
// Group: 3
// Members:
// 	Mykyta Koryliuk
// 	Dominick Smith
// 	Andrew Todd
// 	Xuezhi Wang
// 	Katherine Ziomek
// Purpose of file:
// This file contains functions for queries that select/insert from/to the database.



require('./connect.php');

$connection = initialize_database();

// <----- SELECTS ----->

function select_saved_list_id_from_saved_lists()
{
    try {
        $sql = "SELECT saved_list_id FROM saved_lists WHERE customer_id = '$_SESSION[user_id]' ORDER BY saved_list_id DESC LIMIT 1";

        $stmt = $GLOBALS['connection']->query($sql);
        $count = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!empty($count['saved_list_id'])) return $count['saved_list_id'];
    } catch (PDOException $err) {
        echo $err;
    }
}

function select_item_id_from_items($item_name)
{
    try {
        $sql = "SELECT item_id FROM items WHERE item_name = '$item_name'";

        $stmt = $GLOBALS['connection']->query($sql);
        $count = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!empty($count['item_id'])) return $count['item_id'];
    } catch (PDOException $err) {
        echo $err;
    }
}

function select_all_from_current_list($saved_list_id)
{
    try {
        $sql = "SELECT current_list.current_list_id, saved_lists.saved_list_id, saved_lists.title, saved_lists.notes, items.item_name, quantity 
                FROM current_list 
                INNER JOIN saved_lists ON saved_lists.saved_list_id = current_list.list_id 
                INNER JOIN items ON current_list.item_id = items.item_id
                WHERE list_id = '$saved_list_id'";
        $stmt = $GLOBALS['connection']->query($sql);
        $count = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($count)) return $count;
    } catch (PDOException $err) {
        echo $err;
    }
}

// <----- INSERTS ----->

function insert_into_saved_lists($title, $notes)
{
    try {
        $sql = "INSERT INTO saved_lists(title, notes, customer_id) VALUES(:title, :notes, :customer_id)";
        $data = ['title' => $title, 'notes' => $notes, 'customer_id' => $_SESSION["user_id"]]; // $_COOKIE['user_id];

        $GLOBALS['connection']->prepare($sql)->execute($data);
    } catch (PDOException $err) {
        echo $err;
    }
}

function insert_into_items($item_name)
{
    try {
        $sql = "INSERT INTO items (item_name) VALUES(:item_name)";
        $data = ['item_name' => $item_name];

        $GLOBALS['connection']->prepare($sql)->execute($data);
    } catch (PDOException $err) {
        echo $err;
    }
}

function insert_into_current_list($list_id, $item_id, $quantity, $notes)
{
    if($quantity !== "") { // quantity listed 
        try {
            $sql = "INSERT INTO current_list(list_id, item_id, quantity, notes) VALUES(:list_id, :item_id, :quantity, :notes)";
            $data = ['list_id' => $list_id, 'item_id' => $item_id, 'quantity' => $quantity, 'notes' => $notes];

            $GLOBALS['connection']->prepare($sql)->execute($data);
        } catch (PDOException $err) {
            echo $err;
        }
    }
    else { // no quantity
        try {
            $sql = "INSERT INTO current_list(list_id, item_id, notes) VALUES(:list_id, :item_id, :notes)";
            $data = ['list_id' => $list_id, 'item_id' => $item_id, 'notes' => $notes];

            $GLOBALS['connection']->prepare($sql)->execute($data);
        } catch (PDOException $err) {
            echo $err;
        }
    }
}

// <----- DELETES ----->

function delete_current_list_id_from_current_list($current_list_id)
{
    try {
        $sql = "DELETE FROM current_list WHERE current_list_id = '$current_list_id'";

        $GLOBALS['connection']->prepare($sql)->execute();
    } catch (PDOException $err) {
        echo $err;
    }
}

// <----- UPDATES ----->

function update_title_notes_on_saved_lists($saved_list_id, $title, $notes)
{
    try {
        $sql = "UPDATE saved_lists SET title = '$title', notes = '$notes', modified_date = CURRENT_TIMESTAMP WHERE saved_list_id = '$saved_list_id'";
        
        $GLOBALS['connection']->prepare($sql)->execute();
    } catch (PDOException $err) {
        echo $err;
    }
}

function update_item_id_and_quantity_on_current_list($current_list_id, $item_id, $quantity, $saved_list_id)
{
    try {
        $sql = "UPDATE current_list SET item_id = '$item_id', quantity = '$quantity' WHERE current_list_id = '$current_list_id'";
        
        $GLOBALS['connection']->prepare($sql)->execute();
    } catch (PDOException $err) {
        echo $err;
    }

    // update modified date
    try {
        $sql = "UPDATE saved_lists SET modified_date = CURRENT_TIMESTAMP WHERE saved_list_id = '$saved_list_id'";
        
        $GLOBALS['connection']->prepare($sql)->execute();
    } catch (PDOException $err) {
        echo $err;
    }
}
