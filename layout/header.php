<!DOCTYPE html>
<html>
    <head>
        <title>Quản lý App moblie</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/style.css" rel="stylesheet" type="text/css"/>
        <link href="public/responsive.css" rel="stylesheet" type="text/css"/>


        <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
        <script src="public/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="public/js/main.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div class="wp-inner clearfix">
                        <a href="?page=list_post" title="" id="logo" class="fl-left">ADMIN</a>
                        <ul id="main-menu" class="fl-left">
                            <li>
                                <a href="?mod=customer&action=list_customer" title="">Người dùng</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?mod=customer&action=list_customer" title="">Danh người dùng</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?mod=orders&action=list_order" title="">Đơn Hàng</a>
                              
                            </li>
                            <li>
                                <a href="?mod=product&action=list_product" title="">Sản phẩm</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?mod=product&action=add_product" title="">Thêm mới</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=product&action=list_product" title="">Danh sách sản phẩm</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=product&action=list_cat" title="">Danh mục sản phẩm</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?mod=order&action=detail_order" title="">Quản cáo</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?mod=order&action=list_order" title="">Danh sách banner </a> 
                                    </li>
                                    <li>
                                        <a href="?mod=order&action=list_customer" title="">Thêm danh sách banner</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?page=menu" title="">Menu</a>
                            </li>
                        </ul>
                        <div id="dropdown-user" class="dropdown dropdown-extended fl-right">
                            <button class="dropdown-toggle clearfix" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <div id="thumb-circle" class="fl-left">
                                    <img src="public/images/img-admin.png">
                                </div>
                                <h3 id="account" class="fl-right">Admin</h3>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url("?mod=users&action=info_account");?>" title="Thông tin cá nhân">Thông tin tài khoản</a></li>
                                <li><a href=""<?php echo base_url("?mod=users&action=login");?>" title="Thoát">Thoát</a></li>
                            </ul>
                        </div>
                    </div>
                </div>