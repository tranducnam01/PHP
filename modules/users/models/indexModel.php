<?php
function  update_pass($data, $reset_token){
    db_update('admin', $data, "`reset_token` = '{$reset_token}'");
}
function check_reset_token($reset_token){
    $check_email = db_num_rows("SELECT * FROM `admin` WHERE `reset_token` = '{$reset_token}' ");
    echo $check_email;
    if($check_email > 0)
        return true;
    return false;
}
function update_reset_token($data, $email){
    db_update('admin', $data, "`email` = '{$email}'");
}
function check_email($email){
    $check_email = db_num_rows("SELECT * FROM `admin` WHERE `email` = '{$email}' ");
    echo $check_email;
    if($check_email > 0)
        return true;
    return false;
}
function check_login($username, $password){
    $check_user = db_num_rows("SELECT * FROM `admin` WHERE `username` = '{$username}' AND `password` = '{$password}'");
    echo $check_user;
    if($check_user > 0)
        return true;
    return false;
}

function info_user($label = 'id'){
    $user_login = $_SESSION['user_login'];
    $user = db_fetch_array("SELECT * FROM `admin` WHERE `username` = '{$user_login}'");
    return $user[$label];
}

function add_user($data){
    return db_insert('admin', $data);
}

function user_exists($username, $email){
    $check_user = db_num_rows("SELECT * FROM `admin` WHERE `email` = '{$email}' OR `username` = '{$username}'");
    echo $check_user;
    if($check_user > 0)
        return true;
    return false;
}

function get_list_users() {

    $result = db_fetch_array("SELECT * FROM `admin`");
    return $result;
}

function get_user_by_id($id) {
    $item = db_fetch_row("SELECT * FROM `admin` WHERE `user_id` = {$id}");
    return $item;
}


function active_user($active_token){
    return db_update('admin', array('is_active' => 1), "`active_token` = '{$active_token}'");
}

function check_active_token($active_token){
    $check = db_num_rows("SELECT * FROM `admin` WHERE `active_token` = '{$active_token}' AND  `is_active` = '0'");
    if($check > 0)
        return true;
    return false;
}
function check_reg_time($active_token){
     $check = db_num_rows("SELECT * FROM `admin` WHERE `active_token` = '{$active_token}' AND  `is_active` = '0'");
    if($check = 0){
        db_delete('admin', "`is_active` = '0'");
    }
    return true;
}