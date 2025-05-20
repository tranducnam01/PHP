<html>
    <head>
        <title>Trang đăng nhập</title>
        <link href="public/css/reset.css" rel="stylesheet" type="text/css">
        <link href="public/css/login.css" rel="stylesheet" type="text/css">
        
    </head>
    <body>
        <div id="wp-form-login">
            <h1 class="page-title" style="font-size: 21px !important; padding: 0px 0px 20px; font-weight: 500px;">Đăng Nhập</h1>
            <form id="form-login" action="" method="POST">
                
                
                <input type="text" name="username" id="username" value="<?php set_value('username') ?>" placeholder="Username">
                <?php echo form_error('username'); ?>
                <input type="password" name="password" id="password" value="<?php set_value('password') ?>" placeholder="Password">
                <?php echo form_error('password'); ?>
                <input type="submit" id="btn-login" name="btn-login" value="ĐĂNG NHẬP" placeholder="Fullname">
                <?php echo form_error('account'); ?>
            </form>
            <a href="<?php echo base_url("?mod=users&action=reset");?>" id="lost-pass">Quên mật khẩu |</a>   
        </div>
    </body>
</html>