<?php
function construct() {
    load_model('index');
    load('lib', 'validation');
    load('lib', 'email');
}

function list_orderAction() {
    load('helper', 'format');
    $num_per_page = 5;
    $search = isset($_GET['s']) ? trim($_GET['s']) : '';
    $status = isset($_GET['status']) ? trim($_GET['status']) : '';
    $total_row = get_total_order($status);
    $num_page = ceil($total_row / $num_per_page);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    if ($page > $num_page) $page = $num_page;
    $start = ($page - 1) * $num_per_page;

    $list_order = get_list_order_by_page($start, $num_per_page, $search, $status);
    if (isset($_POST['sm_action']) && $_POST['actions'] != '0' && !empty($_POST['checkItem'])) {
        $order_ids = array_keys($_POST['checkItem']);
        foreach ($order_ids as $id) {
            update_order_status($id, $_POST['actions']);
        }
        redirect("?mod=order&action=list_order&status=$status");
    }

    $data['list_order'] = $list_order;
    $data['page'] = $page;
    $data['num_page'] = $num_page;
    $data['start'] = $start;
    load_view('list_order', $data);
}

function detail_orderAction() {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $order = get_order_by_id($id);
    if (!$order) {
        redirect("?mod=order&action=list_order");
    }

   if (isset($_POST['sm_status'])) {
    $status = $_POST['status'];
    update_order_status($order['OrderId'], $status);
    // Tải lại dữ liệu mới sau khi cập nhật
    $order = get_order_by_id($order['OrderId']);
}


    $order_items = get_order_items($id);
    $total_items = get_total_items($id);

    $data['order'] = $order;
    $data['order_items'] = $order_items;
    $data['total_items'] = $total_items;
    load_view('detail_order', $data);
}

function edit_orderAction() {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $order = get_order_by_id($id);
    if (!$order) {
        redirect("?mod=order&action=list_order");
    }

    if (isset($_POST['btn_update'])) {
        $status = $_POST['status'];
        update_order_status($id, $status);
        redirect("?mod=order&action=detail_order&id=$id&msg=updated");
    }

    $data['order'] = $order;
    load_view('edit_order', $data);
}


function delete_orderAction() {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    delete_order($id);
    redirect("?mod=order&action=list_order");
}
?>