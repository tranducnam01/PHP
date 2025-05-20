<?php
defined('APPPATH') OR exit('Không được quyền truy cập phần này');

// Include file config/database (chỉ để tham chiếu, không kết nối trực tiếp)
require_once CONFIGPATH . DIRECTORY_SEPARATOR . 'database.php';

// Include các tệp cấu hình khác (nếu cần thiết trong plugin)
require_once CONFIGPATH . DIRECTORY_SEPARATOR . 'config.php';
require_once CONFIGPATH . DIRECTORY_SEPARATOR . 'email.php';
require_once CONFIGPATH . DIRECTORY_SEPARATOR . 'autoload.php';

// Include core database (thay bằng logic WordPress nếu cần)
require_once LIBPATH . DIRECTORY_SEPARATOR . 'database.php';

// Include core base
require_once COREPATH . DIRECTORY_SEPARATOR . 'base.php';

// Tạm thời bỏ qua logic autoload phức tạp, thay bằng tải thủ công nếu cần
if (isset($autoload) && is_array($autoload)) {
    foreach ($autoload as $type => $list_auto) {
        if (!empty($list_auto)) {
            foreach ($list_auto as $name) {
                // Tải thủ công, đảm bảo đường dẫn chính xác
                $file_path = APPPATH . $type . DIRECTORY_SEPARATOR . $name . '.php';
                if (file_exists($file_path)) {
                    require_once $file_path;
                }
            }
        }
    }
}

// Không sử dụng db_connect() trực tiếp, thay bằng $wpdb của WordPress
// Nếu cần truy vấn cơ sở dữ liệu tùy chỉnh, thêm logic sau:
add_action('init', function() use ($db) {
    global $wpdb;
    // Ví dụ: Nếu bạn muốn sử dụng $db để truy vấn bảng tùy chỉnh
    // $results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}your_table");
    // Xóa hoặc điều chỉnh logic db_connect nếu không cần
});

// Tải router (nếu cần tích hợp routing tùy chỉnh trong WordPress)
require_once COREPATH . DIRECTORY_SEPARATOR . 'router.php';