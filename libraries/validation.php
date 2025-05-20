<?php
#Tài liệu hỗ trợ :WORDPRESS
/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

function is_username($username) {
    $partten = "/^[A-Za-z0-9_\.]{6,32}$/";
    if (!preg_match($partten, $username, $matchs))
        return false;

    return true;
}

function is_password($password) {
    $partten = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
    if (!preg_match($partten, $password, $matchs))
        return false;

    return true;
}

function is_phone_number($phone) {
    $partten = "/^(09|08|01|03[3|2|6|8|9])+([0-9]{7})$/";
    if (!preg_match($partten, $phone, $matchs))
        return false;

    return true;
}

//function show_array($data){
//    if(is_array($data)){
//        echo "<pre>";
//        print_r($data);
//        echo "</pre>";
//    }
//}

function is_email($email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return false;
        
    }
    return true;
}

function form_error($label_field) {
    global $error;
    if (!empty($error[$label_field])) return "<p class='error'>{$error[$label_field]}</p>";
}


function set_value($label_field) {
    global $$label_field;
    if (!empty($$label_field))
        return $$label_field;
}
