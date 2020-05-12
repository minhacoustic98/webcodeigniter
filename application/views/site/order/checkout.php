<div class="box-center">
    <!-- The box-center product-->
    <div class="tittle-box-center">
        <h2>Thông tin nhận hàng thành viên</h2>
    </div>
    <div class="box-content-center product">
        <!-- The box-content-center -->
        <h1>Vui lòng nhập</h1>
            <form enctype="multipart/form-data" action="<?php echo base_url('order/checkout') ?>" method="post" class="t-form form_action">

            <div class="form-row">
						<label class="form-label" for="param_email">Tổng tiền thanh toán : <b style="color:red"><?php echo number_format($total_amount) ?>&nbsp;VNĐ</b></label>
						<div class="clear"></div>
				  </div>
                  
                  
            <div class="form-row">
						<label class="form-label" for="param_email">Email:<span class="req">*</span></label>
						<div class="form-item">
							<input type="text" value="<?php echo isset($user->email)? $user->email : '' ?>" name="email" id="email" class="input">
							<div class="clear"></div>
							<div id="email_error" class="error">
                                <?php echo form_error('email') ?>
                            </div>
						</div>
						<div class="clear"></div>
				  </div>
				  
				
				  
				
				  <div class="form-row">
						<label class="form-label" for="param_name">Họ và tên:<span class="req">*</span></label>
						<div class="form-item">
							<input type="text" value="<?php echo  isset($user->name)? $user->name : '' ?>" name="name" id="name" class="input">
							<div class="clear"></div>
							<div id="name_error" class="error">
                            <?php echo form_error('name') ?>
                            </div>
						</div>
						<div class="clear"></div>
				  </div>
				  <div class="form-row">
						<label class="form-label" for="param_phone">Số điện thoại:<span class="req">*</span></label>
						<div class="form-item">
							<input type="text" value="<?php echo isset($user->phone)? $user->phone : '' ?>" name="phone" id="phone" class="input">
							<div class="clear"></div>
							<div id="phone_error" class="error">
                               <?php echo form_error('phone') ?>
                            </div>
						</div>
						<div class="clear"></div>
				  </div>
				  
				  <div class="form-row">
						<label class="form-label" for="param_address">Ghi chú:<span class="req">*</span></label>
						<div class="form-item">
							<textarea name="message" id="message" class="input"></textarea>
							<div class="clear"></div>
							<div id="address_error" class="error"></div>
						</div>
						<div class="clear"></div>
				  </div>
                  
                  
                  <div class="form-row">
						<label class="form-label" for="param_address">Phương thức thanh toán:<span class="req">*</span></label>
						<div class="form-item">
						     <select name="payment" id="payment">
                                 <option >Chọn cổng thanh toán</option>
                                 <option value="COD">Thanh toán khi nhận hàng</option>
                                 <option value="NGANLUONG">Thanh toán bằng ngân lượng</option>
                             </select>
						</div>
						<div class="clear"></div>
				  </div>
				
				  
				  <div class="form-row">
						<label class="form-label">&nbsp;</label>
						<div class="form-item">
				           	<input type="submit" name="submit" value="Thanh toán" class="button">
						</div>
				   </div>
            </form>
   

      
        <div class="clear"></div>
       

    </div><!-- End box-content-center -->
</div>