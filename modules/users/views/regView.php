<html>
    <head>
        <title>Trang đăng nhập</title>
        <link href="public/css/reset.css" rel="stylesheet" type="text/css">
        <link href="public/css/login.css" rel="stylesheet" type="text/css">
        
    </head>
    <body>
        <div id="wp-form-login">
            <h1 class="page-title" style="font-size: 21px !important; padding: 0px 0px 20px; font-weight: 500px;">ĐĂNG KÝ TÀI KHOẢN</h1>
            <form id="form-login" action="" method="POST">
                <input type="text" name="fullname" id="fullname" value="<?php set_value('fullname') ?>" placeholder="Fullname">
                <?php echo form_error('fullname'); ?>
                <input type="text" name="email" id="email" value="<?php set_value('email') ?>" placeholder="Email">
                <?php echo form_error('email'); ?>
                <input type="text" name="username" id="username" value="<?php set_value('username') ?>" placeholder="Username">
                <?php echo form_error('username'); ?>
                <input type="password" name="password" id="password" value="<?php set_value('password') ?>" placeholder="Password">
                <?php echo form_error('password'); ?>
                <input type="submit" id="btn-login" name="btn-reg" value="ĐĂNG KÝ" placeholder="Fullname">
                <?php echo form_error('account'); ?>
            </form>
            <a href="<?php echo base_url("?mod=users&action=login");?>" id="lost-pass">Đăng nhập</a>
        </div>
    </body>
</html>