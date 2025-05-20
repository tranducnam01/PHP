<?php 
get_header();
?>

<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới danh mục</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="Category">Tên danh mục</label>
                        <input 
                            type="text" 
                            name="Category" 
                            id="Category" 
                            value="<?php echo isset($Category) ? htmlspecialchars($Category) : ''; ?>"
                        >
                        <?php if (!empty($error['Category'])): ?>
                            <p style="color:red;"><?php echo $error['Category']; ?></p>
                        <?php endif; ?>
                        
                        <button type="submit" name="btn-add" id="btn-add">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
get_footer();
?>
