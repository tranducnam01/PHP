<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">

        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách sản phẩm</h3>
                    <a href="?mod=product&action=add_product" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(69)</span></a> |</li>
                            <li class="publish"><a href="">Đã đăng <span class="count">(51)</span></a> |</li>
                            <li class="pending"><a href="">Chờ xét duyệt<span class="count">(0)</span> |</a></li>
                            <li class="pending"><a href="">Thùng rác<span class="count">(0)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="s" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="GET" action="" class="form-actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option value="1">Công khai</option>
                                <option value="1">Chờ duyệt</option>
                                <option value="2">Bỏ vào thủng rác</option>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Mã sản phẩm</span></td>
                                    <td><span class="thead-text">Hình ảnh</span></td>
                                    <td><span class="thead-text">Tên sản phẩm</span></td>
                                    <td><span class="thead-text">Giá</span></td>
                                    <td><span class="thead-text">Danh mục</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stt = 1;
                                foreach ($list_product as $product) {
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                        <td><span class="tbody-text"><?php echo $stt++; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $product['ProductId']; ?></span></td>
                                        <td>
                                            <div class="tbody-thumb">
                                                <img src="<?php echo $product['Img']; ?>" alt="" style="width: 80px;">
                                            </div>
                                        </td>


                                        <td class="clearfix">
                                            <div class="tb-title fl-left">
                                                <a href="#" title=""><?php echo $product['Name']; ?></a>
                                            </div>
                                            <ul class="list-operation fl-right">
                                                <li><a href="#" title="Sửa" class="edit"><i class="fa fa-pencil"></i></a></li>
                                                <li><a href="#" title="Xóa" class="delete"><i class="fa fa-trash"></i></a></li>
                                            </ul>
                                        </td>
                                        <td><span class="tbody-text"><?php echo number_format($product['Price'], 0, ',', '.') . 'đ'; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $product['CategoryId']; ?></span></td>
                                        <td><span class="tbody-text">Hoạt động</span></td>
                                        <td><span class="tbody-text">Admin</span></td>
                                        <td><span class="tbody-text">12-07-2016</span></td>
                                    </tr>
                                <?php } ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="tfoot-text">STT</span></td>
                                    <td><span class="tfoot-text">Mã sản phẩm</span></td>
                                    <td><span class="tfoot-text">Hình ảnh</span></td>
                                    <td><span class="tfoot-text">Tên sản phẩm</span></td>
                                    <td><span class="tfoot-text">Giá</span></td>
                                    <td><span class="tfoot-text">Danh mục</span></td>
                                    <td><span class="tfoot-text">Trạng thái</span></td>
                                    <td><span class="tfoot-text">Người tạo</span></td>
                                    <td><span class="tfoot-text">Thời gian</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <ul id="list-paging" class="fl-right">
                        <?php if ($page > 1): ?>
                            <li><a href="?mod=product&action=list_product&page=<?php echo $page - 1; ?>" title=""><</a></li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $num_page; $i++): ?>
                            <li>
                                <a href="?mod=product&action=list_product&page=<?php echo $i; ?>" title="" <?php if ($i == $page) echo 'class="active"'; ?>>
                                    <?php echo $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($page < $num_page): ?>
                            <li><a href="?mod=product&action=list_product&page=<?php echo $page + 1; ?>" title="">></a></li>
                        <?php endif; ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>