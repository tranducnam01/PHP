<?php
function get_list_order_by_page($start, $num_per_page, $search = '', $status = '') {
    $where = '';
    if ($search) {
        $where .= "WHERE u.`Name` LIKE '%$search%' OR o.OrderId LIKE '%$search%'";
    }
    if ($status) {
        $where .= ($where ? ' AND ' : 'WHERE ') . "o.Status = '$status'";
    }
    $result = db_fetch_array("
        SELECT o.*, u.Name, SUM(od.Quantity) as TotalItems
        FROM `orders` o
        LEFT JOIN `users` u ON o.UserId = u.UserId
        LEFT JOIN `orderitems` od ON o.OrderId = od.OrderId
        $where
        GROUP BY o.OrderId
        LIMIT $start, $num_per_page
    ");
    return $result;
}

function get_total_order($status = '') {
    $where = $status ? "WHERE Status = '$status'" : '';
    $result = db_fetch_row("SELECT COUNT(*) as total FROM `orders` $where");
    return $result['total'];
}

function update_order_status($order_id, $status) {
    $data = [
        'Status' => $status
    ];
    return db_update('orders', $data, "`OrderId` = {$order_id}");
}




function delete_order($id) {
    return db_delete('orders', "`OrderId` = $id");
}

function get_order_by_id($id) {
    $result = db_fetch_row("
        SELECT o.*, u.Name
        FROM `orders` o
        LEFT JOIN `users` u ON o.UserId = u.UserId
        WHERE o.OrderId = $id
    ");
    return $result;
}

function get_order_items($order_id) {
    $result = db_fetch_array("
        SELECT oi.*, p.Name as ProductName, p.Img
        FROM `orderitems` oi
        LEFT JOIN `products` p ON oi.ProductId = p.ProductId
        WHERE oi.OrderId = $order_id
    ");
    return $result;
}

function get_total_items($order_id) {
    $result = db_fetch_row("SELECT SUM(Quantity) as total FROM `orderitems` WHERE OrderId = $order_id");
    return $result['total'] ?: 0;
}
?>