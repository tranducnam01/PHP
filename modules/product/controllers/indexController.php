<?php
function construct() {
    load_model('index');
    load('lib', 'validation');
    load('lib', 'email');
}

function indexAction() {
    load('helper', 'format');
    load_view('list_product');
}

function add_productAction() {
    global $error, $success;
    $error = array();
    $success = '';

    if (isset($_POST['btn-submit'])) {
        // Validate inputs
        if (empty($_POST['name'])) {
            $error['name'] = "Tên sản phẩm không được để trống";
        } elseif (check_product_name($_POST['name'])) {
            $error['name'] = "Tên sản phẩm đã tồn tại";
        } else {
            $name = trim($_POST['name']);
        }

        if (empty($_POST['price'])) {
            $error['price'] = "Giá sản phẩm không được để trống";
        } elseif (!is_numeric($_POST['price']) || $_POST['price'] < 0) {
            $error['price'] = "Giá sản phẩm phải là số không âm";
        } else {
            $price = $_POST['price'];
        }

        if (empty($_POST['pieces'])) {
            $error['pieces'] = "Số lượng không được để trống";
        } elseif (!is_numeric($_POST['pieces']) || $_POST['pieces'] < 0) {
            $error['pieces'] = "Số lượng phải là số không âm";
        } else {
            $pieces = (int)$_POST['pieces'];
        }

        if (empty($_POST['category_id'])) {
            $error['category_id'] = "Vui lòng chọn danh mục";
        } else {
            $category_id = (int)$_POST['category_id'];
        }

        // Validate image URL
        $img = '';
        if (empty($_POST['img'])) {
            $error['img'] = "URL hình ảnh không được để trống";
        } else {
            $img = trim($_POST['img']);
            // Kiểm tra định dạng URL hợp lệ và đuôi ảnh
            if (!filter_var($img, FILTER_VALIDATE_URL) || !preg_match('/\.(jpg|jpeg|png|gif)$/i', $img)) {
                $error['img'] = "URL hình ảnh không hợp lệ (phải là jpg, jpeg, png, hoặc gif)";
            }
        }

        $product_code = trim($_POST['product_code']);
        $desc = trim($_POST['desc']);
        $status = (int)$_POST['status'];

        // If no errors, insert product
        if (empty($error)) {
            $data = [
                'Name' => $name,
                'CategoryId' => $category_id,
                'Price' => $price,
                'Pieces' => $pieces,
                'Img' => $img
            ];
            add_product($data);
            $success = "Thêm sản phẩm thành công!";
            redirect("?mod=product&action=list_product");
        }
    }

    $data['error'] = $error;
    $data['success'] = $success;
    load_view('add_product', $data);
}
function list_catAction() {
    load('helper', 'format');
    $list_cat = get_list_cat();
    $data['list_cat'] = $list_cat;
    load_view('list_cat', $data);
}

function list_productAction() {
    load('helper', 'format');
    $num_per_page = 5;
    $total_row = get_total_product();
    $num_page = ceil($total_row / $num_per_page);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    if ($page > $num_page) $page = $num_page;
    $start = ($page - 1) * $num_per_page;

    $list_product = get_list_product_by_page($start, $num_per_page);
    $data['list_product'] = $list_product;
    $data['page'] = $page;
    $data['num_page'] = $num_page;
    load_view('list_product', $data);
}

function add_catAction() {
    global $error, $Category;
    $error = array();
    if (isset($_POST['btn-add'])) {
        if (empty($_POST['Category'])) {
            $error['Category'] = "Không được để trống danh mục";
        } else {
            $Category = trim($_POST['Category']);
            if (check_name_cat($Category)) {
                $error['Category'] = "Tên danh mục đã tồn tại";
            }
        }

        if (empty($error)) {
            $data = ['Category' => $Category];
            add_cat($data);
            redirect("?mod=product&action=list_cat");
        }
    }
    load_view('add_cat');
}

function edit_catAction() {
    $id = $_GET['id'];
    $cat = get_cat_by_id($id);

    if (isset($_POST['btn-edit'])) {
        $category = $_POST['category'];
        if (!empty($category)) {
            $data = ['Category' => $category];
            update_cat($id, $data);
            redirect("?mod=product&action=list_cat");
        }
    }

    $data['cat'] = $cat;
    load_view('edit_cat', $data);
}

function delete_catAction() {
    $id = $_GET['id'];
    delete_cat($id);
    redirect("?mod=product&action=list_cat");
}
?>