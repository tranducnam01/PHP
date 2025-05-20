<?php 
get_header();
?>

<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách đơn hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=order&action=list_order">Tất cả <span class="count">(<?php echo get_total_order(); ?>)</span></a> |</li>
                            <li class="publish"><a href="?mod=order&action=list_order&status=publish">Đã đăng <span class="count">(<?php echo get_total_order('publish'); ?>)</span></a> |</li>
                            <li class="pending"><a href="?mod=order&action=list_order&status=pending">Chờ xét duyệt <span class="count">(<?php echo get_total_order('pending'); ?>)</span></a> |</li>
                            <li class="trash"><a href="?mod=order&action=list_order&status=trash">Thùng rác <span class="count">(<?php echo get_total_order('trash'); ?>)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="s" id="s" value="<?php echo isset($_GET['s']) ? $_GET['s'] : ''; ?>" placeholder="Tìm theo mã đơn hàng hoặc tên khách hàng">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="POST" action="" class="form-actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option value="publish">Công khai</option>
                                <option value="pending">Chờ duyệt</option>
                                <option value="trash">Bỏ vào thùng rác</option>
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
                                    <td><span class="thead-text">Mã đơn hàng</span></td>
                                    <td><span class="thead-text">Họ và tên</span></td>
                                    <td><span class="thead-text">Số sản phẩm</span></td>
                                    <td><span class="thead-text">Tổng giá</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                    <td><span class="thead-text">Chi tiết</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($list_order)) {
                                    $stt = $start + 1;
                                    foreach ($list_order as $order) {
                                        $order_code = 'WEB' . str_pad($order['OrderId'], 5, '0', STR_PAD_LEFT);
                                        $status_label = $order['Status'] == 'publish' ? 'Hoạt động' : ($order['Status'] == 'pending' ? 'Chờ duyệt' : 'Thùng rác');
                                ?>
                                    <tr>
                                        <td><input type="checkbox" name="checkItem[<?php echo $order['OrderId']; ?>]" class="checkItem"></td>
                                        <td><span class="tbody-text"><?php echo $stt; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $order_code; ?></span></td>
                                        <td>
                                            <div class="tb-title fl-left">
                                                <a href="?mod=order&action=edit_order&id=<?php echo $order['OrderId']; ?>" title=""><?php echo htmlspecialchars($order['Name']); ?></a>
                                            </div>
                                            <ul class="list-operation fl-right">
                                                <li><a href="?mod=order&action=edit_order&id=<?php echo $order['OrderId']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                <li><a href="?mod=order&action=delete_order&id=<?php echo $order['OrderId']; ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </td>
                                        <td><span class="tbody-text"><?php echo $order['TotalItems']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo number_format($order['TotalAmount'], 0, ',', '.') . ' VNĐ'; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $status_label; ?></span></td>
                                        <td><span class="tbody-text"><?php echo date('d-m-Y', strtotime($order['OrderDate'])); ?></span></td>
                                        <td><a href="?mod=orders&action=detail_order&id=<?php echo $order['OrderId']; ?>" title="" class="tbody-text">Chi tiết</a></td>
                                    </tr>
                                <?php
                                        $stt++;
                                    }
                                } else {
                                ?>
                                    <tr>
                                        <td colspan="9" class="tbody-text">Không có đơn hàng nào.</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="tfoot-text">STT</span></td>
                                    <td><span class="tfoot-text">Mã đơn hàng</span></td>
                                    <td><span class="tfoot-text">Họ và tên</span></td>
                                    <td><span class="tfoot-text">Số sản phẩm</span></td>
                                    <td><span class="tfoot-text">Tổng giá</span></td>
                                    <td><span class="tfoot-text">Trạng thái</span></td>
                                    <td><span class="tfoot-text">Thời gian</span></td>
                                    <td><span class="tfoot-text">Chi tiết</span></td>
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
                        <?php if ($page > 1) { ?>
                            <li><a href="?mod=order&action=list_order&status=<?php echo isset($_GET['status']) ? $_GET['status'] : ''; ?>&page=<?php echo $page - 1; ?>" title=""><</a></li>
                        <?php } ?>
                        <?php for ($i = 1; $i <= $num_page; $i++) { ?>
                            <li><a href="?mod=order&action=list_order&status=<?php echo isset($_GET['status']) ? $_GET['status'] : ''; ?>&page=<?php echo $i; ?>" title="" class="<?php echo $i == $page ? 'active' : ''; ?>"><?php echo $i; ?></a></li>
                        <?php } ?>
                        <?php if ($page < $num_page) { ?>
                            <li><a href="?mod=order&action=list_order&status=<?php echo isset($_GET['status']) ? $_GET['status'] : ''; ?>&page=<?php echo $page + 1; ?>" title="">></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('checkAll').addEventListener('change', function() {
    var checkboxes = document.getElementsByClassName('checkItem');
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = this.checked;
    }
});
</script>

<?php 
get_footer();
?>