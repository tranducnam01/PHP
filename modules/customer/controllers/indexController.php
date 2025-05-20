<?php
function construct() {
    load_model('index');
    load('lib', 'validation');
    load('lib', 'email');
}

function list_customerAction() {
    load('helper', 'format');
    $num_per_page = 5;
    $search = isset($_GET['s']) ? trim($_GET['s']) : '';
    $total_row = get_total_customer($search);
    $num_page = ceil($total_row / $num_per_page);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    if ($page > $num_page) $page = $num_page;
    $start = ($page - 1) * $num_per_page;

    $list_customer = get_list_customer_by_page($start, $num_per_page, $search);
    if (isset($_POST['sm_action']) && $_POST['actions'] == '1' && !empty($_POST['checkItem'])) {
        foreach ($_POST['checkItem'] as $id => $value) {
            delete_customer($id);
        }
        redirect("?mod=customer&action=list_customer");
    }

    $data['list_customer'] = $list_customer;
    $data['page'] = $page;
    $data['num_page'] = $num_page;
    $data['start'] = $start;
    load_view('list_customer', $data);
}

function edit_customerAction() {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $customer = get_customer_by_id($id);
    if (!$customer) {
        redirect("?mod=customer&action=list_customer");
    }
    // Thêm logic chỉnh sửa nếu cần
    $data['customer'] = $customer;
    load_view('edit_customer', $data);
}

function delete_customerAction() {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    delete_customer($id);
    redirect("?mod=customer&action=list_customer");
}

// Các hàm khác như indexAction, add_productAction, v.v. giữ nguyên
?>