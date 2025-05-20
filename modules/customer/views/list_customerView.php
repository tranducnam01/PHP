<?php 
get_header();
?>

<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách khách hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=customer&action=list_customer">Tất cả <span class="count">(<?php echo get_total_customer(); ?>)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="s" id="s" value="<?php echo isset($_GET['s']) ? $_GET['s'] : ''; ?>" placeholder="Tìm theo tên hoặc email">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="POST" action="" class="form-actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option value="1">Xóa</option>
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
                                    <td><span class="thead-text">Họ và tên</span></td>
                                    <td><span class="thead-text">Email</span></td>
                                    <td><span class="thead-text">Số điện thoại</span></td>
                                    <td><span class="thead-text">Địa chỉ</span></td>
                                    <td><span class="thead-text">Đơn hàng</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($list_customer)) {
                                    $stt = $start + 1; // $start từ phân trang
                                    foreach ($list_customer as $customer) {
                                ?>
                                    <tr>
                                        <td><input type="checkbox" name="checkItem[<?php echo $customer['UserId']; ?>]" class="checkItem"></td>
                                        <td><span class="tbody-text"><?php echo $stt; ?></span></td>
                                        <td>
                                            <div class="tb-title fl-left">
                                                <a href="?mod=customer&action=edit_customer&id=<?php echo $customer['UserId']; ?>" title=""><?php echo htmlspecialchars($customer['Name']); ?></a>
                                            </div>
                                            <ul class="list-operation fl-right">
                                                <li><a href="?mod=customer&action=edit_customer&id=<?php echo $customer['UserId']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                <li><a href="?mod=customer&action=delete_customer&id=<?php echo $customer['UserId']; ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </td>
                                        <td><span class="tbody-text"><?php echo htmlspecialchars($customer['Email']); ?></span></td>
                                        <td><span class="tbody-text"><?php echo isset($customer['Phone']) ? htmlspecialchars($customer['Phone']) : 'N/A'; ?></span></td>
                                        <td><span class="tbody-text"><?php echo isset($customer['Address']) ? htmlspecialchars($customer['Address']) : 'N/A'; ?></span></td>
                                        <td><span class="tbody-text"><?php echo isset($customer['OrderCount']) ? $customer['OrderCount'] : 0; ?></span></td>
                                        <td><span class="tbody-text"><?php echo isset($customer['CreatedAt']) ? date('d-m-Y', strtotime($customer['CreatedAt'])) : 'N/A'; ?></span></td>
                                    </tr>
                                <?php
                                        $stt++;
                                    }
                                } else {
                                ?>
                                    <tr>
                                        <td colspan="8" class="tbody-text">Không có khách hàng nào.</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="tfoot-body">STT</span></td>
                                    <td><span class="tfoot-body">Họ và tên</span></td>
                                    <td><span class="tfoot-body">Email</span></td>
                                    <td><span class="tfoot-body">Số điện thoại</span></td>
                                    <td><span class="tfoot-body">Địa chỉ</span></td>
                                    <td><span class="tfoot-body">Đơn hàng</span></td>
                                    <td><span class="tfoot-body">Thời gian</span></td>
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
                            <li><a href="?mod=customer&action=list_customer&page=<?php echo $page - 1; ?>" title=""><</a></li>
                        <?php } ?>
                        <?php for ($i = 1; $i <= $num_page; $i++) { ?>
                            <li><a href="?mod=customer&action=list_customer&page=<?php echo $i; ?>" title="" class="<?php echo $i == $page ? 'active' : ''; ?>"><?php echo $i; ?></a></li>
                        <?php } ?>
                        <?php if ($page < $num_page) { ?>
                            <li><a href="?mod=customer&action=list_customer&page=<?php echo $page + 1; ?>" title="">></a></li>
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