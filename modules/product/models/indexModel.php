<?php
// Existing functions remain unchanged
function get_list_cat() {
    $result = db_fetch_array("SELECT * FROM `categories`");
    return $result;
}

function get_cat_by_id($id) {
    $item = db_fetch_row("SELECT * FROM `categories` WHERE `CategoryId` = {$id}");
    return $item;
}

function add_cat($data) {
    return db_insert('categories', $data);
}

function update_cat($id, $data) {
    return db_update('categories', $data, "`CategoryId` = {$id}");
}

function delete_cat($id) {
    return db_delete('categories', "`CategoryId` = {$id}");
}

function check_name_cat($category_name) {
    $result = db_fetch_row("SELECT * FROM `categories` WHERE `Category` = '{$category_name}'");
    return $result ? true : false;
}

function get_list_product() {
    $result = db_fetch_array("SELECT * FROM `products`");
    return $result;
}

function get_list_product_by_page($start, $num_per_page) {
    $result = db_fetch_array("SELECT * FROM `products` LIMIT {$start}, {$num_per_page}");
    return $result;
}

function get_total_product() {
    $result = db_fetch_row("SELECT COUNT(*) as total FROM `products`");
    return $result['total'];
}

// New functions for product management
function add_product($data) {
    return db_insert('products', $data);
}

function check_product_name($name) {
    $result = db_fetch_row("SELECT * FROM `products` WHERE `Name` = '{$name}'");
    return $result ? true : false;
}
?>