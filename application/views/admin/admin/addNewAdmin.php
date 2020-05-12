<?php $this->load->view('admin/admin/head') ?>
<div class="line"></div>
<div class="wrapper">
    <div class="widget">

        <div class="title">

            <h6>Thêm mới quản trị viên:</h6>
        </div>

        <form class="form" id="form" action="" method="post" enctype="multipart/form-data">
            <fieldset>
                <div class="formRow">
                    <label class="formLeft" for="param_name">Tên:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="name" id="name" _autocheck="true" type="text" value="<?php echo set_value('name') ?>"></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error">
                        <?php echo form_error('name') ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label class="formLeft" for="param_username">Username:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="username" id="username" _autocheck="true" type="text" value="<?php echo set_value('username') ?>"></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error">
                            <?php echo  form_error('username') ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label class="formLeft" for="param_pass">Password:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="password" id="password" _autocheck="true" type="password"></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error">
                        <?php echo  form_error('password') ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label class="formLeft" for="param_repass">Nhập lại mật khẩu:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="repass" id="repass" _autocheck="true" type="password"></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error">
                        <?php echo form_error('repass') ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                
                <div class="formSubmit">
	           			<input type="submit" value="Thêm mới" class="redB">
	           			<input type="reset" value="Hủy bỏ" class="basic">
	           		</div>
            </fieldset>
        </form>
    </div>


</div>