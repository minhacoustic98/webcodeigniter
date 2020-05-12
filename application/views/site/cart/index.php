<div class="box-center">
    <!-- The box-center product-->
    <div class="tittle-box-center">
        <h2>Thông tin giỏ hàng (Có <?php echo $total_items ?>) sản phẩm</h2>
    </div>
    <style>
        #cart_contents td{
            border:1px solid #ccc;
            padding:10px;
        }
        
    </style>
    <div class="box-content-center product">
      <?php if($total_items>0): ?>
        <form action="<?php echo base_url('cart/update') ?>" method="POST">


  
        <table id="cart_contents">
            <thead>
                <th>Sản phẩm</th>
                <th>Giá bán</th>
                <th>Số lượng</th>
                <th>Tổng số</th>
                <th>Xóa</th>
            </thead>

            <tbody>
               <?php $total_amount=0; ?>
                <?php foreach ($carts as $row) : ?>
                    <?php $total_amount+=$row['subtotal'] ?>
                    <tr>
                        <td>
                            <?= $row['name'] ?>
                        </td>

                        <td>
                            <?= $row['price'] ?>
                        </td>

                        <td>
                            <input type="text" size="5" name="qty_<?=$row['id']?>" value="<?=$row['qty']?>">
                        </td>

                        <td>
                            <?= number_format($row['subtotal']) ?>
                        </td>

                        <td>
                            <a href="<?php echo base_url('cart/delete/'.$row['id']) ?>">Xóa</a>
                        </td>
                    </tr>

    
                <?php endforeach; ?>


                <tr>
                        <td colspan="5"><a href="<?php echo base_url('cart/delete') ?>">Xóa toàn bộ</a></td>
                 </tr>

                <tr>
                        <td colspan="5">Tổng số tiền thanh toán: <?php echo '<b style="color:red">'.$total_amount.' đ </b>' ?></td>
                 </tr>

                 <tr>
                        <td colspan="5"><button type="submit">Cập nhật</button>
                        <a href="<?php echo site_url('order/checkout') ?>" class="button">Mua hàng</a>
                        </td>
                 </tr>
            </tbody>
        </table>

        </form>
                <?php else:?>
                    <p>Không có sản phẩm trong giỏ hàng!</p>
                <?php endif;?>
    </div>
</div>