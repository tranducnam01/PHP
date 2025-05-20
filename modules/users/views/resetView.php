<html>
    <head>
        <title>Khôi phục mật khẩu</title>
        <link href="public/css/reset.css" rel="stylesheet" type="text/css">
        <link href="public/css/login.css" rel="stylesheet" type="text/css">
        
    </head>
    <body>
        <div id="wp-form-login">
            <h1 class="page-title" style="font-size: 21px !important; padding: 0px 0px 20px; font-weight: 500px;">Khôi phục mật khẩu</h1>
            <form id="form-login" action="" method="POST">
                
                
                <input type="email" name="email" id="email" value="<?php set_value('email') ?>" placeholder="Email">
                <?php echo form_error('email'); ?>
                <input type="submit" id="btn-login" name="btn-reset" value="GỬI YÊU CẦU" placeholder="Gửi yêu cầu">
                <?php echo form_error('account'); ?>
            </form>
            <a href="<?php echo base_url("?mod=users&action=login");?>" id="lost-pass">Đăng nhập |</a>
            <a href="<?php echo base_url("?mod=users&action=reg");?>" id="lost-pass">Đăng ký</a>
        </div>
    </body>
</html>