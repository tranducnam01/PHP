<?php 
get_header();
?>

<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <?php if (!empty($error)) { ?>
                        <div class="error">
                            <?php foreach ($error as $err) { echo "<p>$err</p>"; } ?>
                        </div>
                    <?php } ?>
                    <?php if (!empty($success)) { ?>
                        <div class="success">
                            <p><?php echo $success; ?></p>
                        </div>
                    <?php } ?>
                    <form method="POST">
                        <label for="name">Tên sản phẩm</label>
                        <input type="text" name="name" id="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" required>
                        <label for="price">Giá sản phẩm</label>
                        <input type="number" step="0.01" name="price" id="price" value="<?php echo isset($_POST['price']) ? $_POST['price'] : ''; ?>" required>
                        <label for="pieces">Số lượng</label>
                        <input type="number" name="pieces" id="pieces" value="<?php echo isset($_POST['pieces']) ? $_POST['pieces'] : ''; ?>" required>
                        <label for="img">URL hình ảnh</label>
                        <input type="text" name="img" id="img" value="<?php echo isset($_POST['img']) ? $_POST['img'] : ''; ?>" placeholder="Nhập URL hình ảnh (jpg, jpeg, png, gif)" required>
                        <div id="uploadFile">
                            <img src="<?php echo isset($_POST['img']) ? $_POST['img'] : 'public/images/img-thumb.png'; ?>" alt="Thumbnail Preview" id="thumbnail-preview" style="max-width: 200px;">
                        </div>
                        <label>Danh mục sản phẩm</label>
                        <select name="category_id" required>
                            <option value="">-- Chọn danh mục --</option>
                            <?php
                            $list_cat = get_list_cat();
                            if (!empty($list_cat)) {
                                foreach ($list_cat as $cat) {
                                    $selected = (isset($_POST['category_id']) && $_POST['category_id'] == $cat['CategoryId']) ? 'selected' : '';
                                    echo "<option value='{$cat['CategoryId']}' $selected>{$cat['Category']}</option>";
                                }
                            }
                            ?>
                        </select>
                        <button type="submit" name="btn-submit" id="btnAsc">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('img').addEventListener('input', function() {
    var imgUrl = this.value;
    var preview = document.getElementById('thumbnail-preview');
    preview.src = imgUrl || 'public/images/img-thumb.png';
});
</script>

<?php 
get_footer();
?>