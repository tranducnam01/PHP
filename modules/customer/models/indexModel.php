<?php
function get_list_customer() {
    $result = db_fetch_array("SELECT * FROM `users`");
    return $result;
}

function get_list_customer_by_page($start, $num_per_page, $search = '') {
    $where = $search ? "WHERE `Name` LIKE '%$search%' OR `Email` LIKE '%$search%'" : '';
    $result = db_fetch_array("SELECT * FROM `users` $where LIMIT $start, $num_per_page");
    return $result;
}

function get_total_customer($search = '') {
    $where = $search ? "WHERE `Name` LIKE '%$search%' OR `Email` LIKE '%$search%'" : '';
    $result = db_fetch_row("SELECT COUNT(*) as total FROM `users` $where");
    return $result['total'];
}

function delete_customer($id) {
    return db_delete('users', "`UserId` = $id");
}

function get_customer_by_id($id) {
    return db_fetch_row("SELECT * FROM `users` WHERE `UserId` = $id");
}
?>