


<?php

function construct() {
//    echo "Dùng chung, load đầu tiên";
    load_model('index');
    load('lib', 'validation');
    load('lib', 'email');
}

function regAction() {
    global $error, $username, $password, $email, $fullname;
    if (isset($_POST['btn-reg'])) {
        $error = array();
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống họ tên";
        } else {
            $fullname = $_POST['fullname'];
        }
        #Kiểm tra username
        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống tên đăng nhập";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Tên đăng nhập không đúng định dạng";
            } else {
                $username = $_POST['username'];
            }
        }
        #Kiểm tra password
        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống mậ khẩu";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Mật khẩu không đúng định dạng";
            } else {
                $password = md5($_POST['password']);
            }
        }
        #Kiểm tra email
        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống email";
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "Mật khẩu không đúng định dạng";
            } else {
                $email = $_POST['email'];
            }
        }
        if (empty($error)) {
            if (!user_exists($username, $email)) {
                $active_token = md5($username . time());
                $data = array(
                    'fullname' => $fullname,
                    'username' => $username,
                    'password' => $password,
                    'email' => $email,
                    'active_token' => $active_token,
                    'reg_date' => time()
                );
                add_user($data);
                $link_active = base_url("?mod=users&action=active&active_token={$active_token}");
                $content = "<p>Chào bạn {$fullname}</p>
<P>Bạn vui lòng click vào đường link này để kích hoạt tài khoản: Link</P>
<P>Nếu không phải bạn đăng ký tài khoản thì hãy bỏ qua email này</P>
<p>HIHI</p>";
                echo send_mail('tranngocvien10a2@gmail.com', 'Trần Ngọc Viên', $content, $link_active);

                //Thông báo
//                redirect("?mod=users&action=login");
            } else {
                $error['account'] = "Email hoặc username đã không tồn tại trên hệ thống";
            }
        }
    }global $error, $username, $password, $email, $fullname;
    if (isset($_POST['btn-login'])) {
        $error = array();

        #Kiểm tra username
        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống tên đăng nhập";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Tên đăng nhập không đúng định dạng";
            } else {
                $username = $_POST['username'];
            }
        }
        #Kiểm tra password
        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống mậ khẩu";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Mật khẩu không đúng định dạng";
            } else {
                $password = md5($_POST['password']);
            }
        }

        if (empty($error)) {
            if (check_login($username, $password)) {
                //Lưu trữ phiên đăng nhập
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $username;
                // Chuyển hướng vào trong hệ thống
                global $config;
                redirect($config['base_url']);
            } else {
                $error['account'] = "Tên đăng nhập hoặc mật khẩu không đúng";
            }
        }
    }
    load_view('login');
    load_view('reg');
}

function loginAction() {
    global $error, $username, $password;
    if (isset($_POST['btn-login'])) {
        $error = array();

        #Kiểm tra username
        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống tên đăng nhập";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Tên đăng nhập không đúng định dạng";
            } else {
                $username = $_POST['username'];
            }
        }
        #Kiểm tra password
        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống mậ khẩu";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Mật khẩu không đúng định dạng";
            } else {
                $password = md5($_POST['password']);
            }
        }

        if (empty($error)) {
            if (check_login($username, $password)) {
                //Lưu trữ phiên đăng nhập
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $username;
                // Chuyển hướng vào trong hệ thống
                global $config;
                redirect($config['base_url']);
            } else {
                $error['account'] = "Tên đăng nhập hoặc mật khẩu không đúng";
            }
        }
    }
    load_view('login');
}

function activeAction() {
    $active_token = $_GET['active_token'];
    $link_login = base_url("?mod=users&action=login");

//    echo $active_token;
    if (check_active_token($active_token)) {
        active_user($active_token);
        echo "Bạn đã kích hoạt thành công, vui lòng click vào link sau để đăng nhập <a href = '{$link_login}'>link</a>";
    } else {
        echo "Yêu cầu kích hoạt không hợp lệ hoặc tài khoản đã được kích hoạt trước đó";
    }
}

function logoutAction() {
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect("?mod=users&action=login");
}

function resetAction() {
    global $error, $username, $password, $email;
    $reset_token = isset($_GET['reset_token']) ? $_GET['reset_token'] : null;
    if (!empty($reset_token)) {
        if (check_reset_token($reset_token)) {
            if (isset($_POST['btn-new-pass'])) {
                $error = array();
                #Kiểm tra password
                if (empty($_POST['password'])) {
                    $error['password'] = "Không được để trống mậ khẩu";
                } else {
                    if (!is_password($_POST['password'])) {
                        $error['password'] = "Mật khẩu không đúng định dạng";
                    } else {
                        $password = md5($_POST['password']);
                    }
                }
                if (empty($error)) {
                    $data = array(
                        'password' => $password
                    );
                    update_pass($data, $reset_token);
                    redirect("?mod=users&action=resetOk");
                }
            }
            load_view('newPass');
        } else {
            echo "Yêu cầu lấy lại mật khẩu không hợp lệ";
        }
    } else {
        if (isset($_POST['btn-reset'])) {
            $error = array();

            if (empty($_POST['email'])) {
                $error['email'] = "Không được để trống email";
            } else {
                if (!is_email($_POST['email'])) {
                    $error['email'] = "Email không đúng định dạng";
                } else {
                    $email = $_POST['email'];
                }
            }
            if (empty($error)) {
                if (check_email($email)) {
                    $reset_token = md5($email . time());
                    $data = array(
                        'reset_token' => $reset_token
                    );
                    //Cập nhật mã reset pass cho user cần khôi phục mật khẩu
                    update_reset_token($data, $email);

                    //Gửi link khôi phục vào email của người dùng
                    $link = base_url("?mod=users&action=reset&reset_token={$reset_token}");
                    $content = "<p>Bạn vui lòng click vào link sau để thiết lập lại mật khẩu: {$link}</p>
                            <p>Nếu không phải yêu cầu của bnj, bạn vui lòng bỏ qua email này</p>
                            <p>Trần Ngọc Viên</p>";
                    send_mail($email, '', 'Khôi phục mật khẩu PHP MASTER', $content);
                } else {
                    $error['account'] = "Email không tồn tại trên hệ thống";
                }
            }
        }

        load_view('reset');
    }
}

function resetOkAction() {
    load_view('resetOk');
}

function info_accountAction() {
      global $error, $username, $email;
    if (isset($_POST['btn-submit'])) {
        $error = array();
        $display_name = $_POST['display-name'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $address = $_POST['address'];

        // Validate các trường
        if (empty($display_name)) {
            $error['display_name'] = "Tên hiển thị không được để trống";
        }
        if (!is_email($email)) {
            $error['email'] = "Email không đúng định dạng";
        }

        if (empty($error)) {
            $data = array(
                'display_name' => $display_name,
                'email' => $email,
                'tel' => $tel,
                'address' => $address
            );
            update_user_info($_SESSION['user_login'], $data); // bạn cần viết hàm này trong model
        }
    }

    load_view('info_account');
}

function change_passAction(){
    load_view('change_pass');
}



?>