<?php
get_header();
?>

<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <div id="content" class="detail-exhibition fl-right">
            <div class="section" id="info">
                <div class="section-head">
                    <h3 class="section-title">Thông tin đơn hàng</h3>
                </div>
                <ul class="list-item">
                    <li>
                        <h3 class="title">Mã đơn hàng</h3>
                        <span class="detail"><?php echo htmlspecialchars($order['OrderId']); ?></span>
                    </li>
                    <li>
                        <h3 class="title">Tên khách hàng</h3>
                        <span class="detail"><?php echo htmlspecialchars($order['Name']); ?></span>
                    </li>
                    <li>
                        <h3 class="title">Địa chỉ nhận hàng</h3>
                        <span class="detail"><?php echo htmlspecialchars($order['ShippingAddress'] . ' / ' . $order['PhoneNumber']); ?></span>
                    </li>
                    <li>
                        <h3 class="title">Phương thức thanh toán</h3>
                        <span class="detail"><?php echo htmlspecialchars($order['PaymentMethod'] ?: 'Thanh toán khi nhận hàng'); ?></span>
                    </li>
                    <form method="POST" action="">
                        <li>
                            <h3 class="title">Tình trạng đơn hàng</h3>
                            <select name="status">
                                <option value="Hủy Đơn" <?php echo $order['Status'] == 'Hủy Đơn' ? 'selected' : ''; ?>>Hủy Đơn</option>
                                <option value="Đang xử lý" <?php echo $order['Status'] == 'Đang xử lý' ? 'selected' : ''; ?>>Đang xử lý</option>
                                <option value="Đã xử lý" <?php echo $order['Status'] == 'Đã xử lý' ? 'selected' : ''; ?>>Đã xử lý</option>
                                <option value="Thành công" <?php echo $order['Status'] == 'Thành công' ? 'selected' : ''; ?>>Thành công</option>
                            </select>
                            <input type="submit" name="sm_status" value="Cập nhật đơn hàng">
                        </li>
                    </form>

                </ul>
            </div>
            <div class="section">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm đơn hàng</h3>
                </div>
                <div class="table-responsive">
                    <table class="table info-exhibition">
                        <thead>
                            <tr>
                                <td class="thead-text">STT</td>
                                <td class="thead-text">Ảnh sản phẩm</td>
                                <td class="thead-text">Tên sản phẩm</td>
                                <td class="thead-text">Đơn giá</td>
                                <td class="thead-text">Số lượng</td>
                                <td class="thead-text">Thành tiền</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($order_items)) {
                                $stt = 1;
                                foreach ($order_items as $item) {
                                    ?>
                                    <tr>
                                        <td class="thead-text"><?php echo $stt; ?></td>
                                        <td class="thead-text">
                                            <div class="thumb">
                                                <img src="<?php echo htmlspecialchars($item['Img'] ?: 'public/images/img-product.png'); ?>" alt="">
                                            </div>
                                        </td>
                                        <td class="thead-text"><?php echo htmlspecialchars($item['ProductName']); ?></td>
                                        <td class="thead-text"><?php echo number_format($item['Price'], 0, ',', '.') . ' VNĐ'; ?></td>
                                        <td class="thead-text"><?php echo $item['Quantity']; ?></td>
                                        <td class="thead-text"><?php echo number_format($item['totalAmount'], 0, ',', '.') . ' VNĐ'; ?></td>
                                    </tr>
                                    <?php
                                    $stt++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6" class="thead-text">Không có sản phẩm nào trong đơn hàng.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="section">
                <h3 class="section-title">Giá trị đơn hàng</h3>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <span class="total-fee">Tổng số lượng</span>
                            <span class="total">Tổng đơn hàng</span>
                        </li>
                        <li>
                            <span class="total-fee"><?php echo $total_items; ?> sản phẩm</span>
                            <span class="total"><?php echo number_format($order['TotalAmount'], 0, ',', '.') . ' VNĐ'; ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>