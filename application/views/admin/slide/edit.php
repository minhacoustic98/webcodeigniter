<?php $this->load->view('admin/slide/head') ?>
<div class="line"></div>
<div class="wrapper">
    <div class="widget">

        <div class="title">

            <h6>Chỉnh sửa slide:</h6>
        </div>

        <form class="form" id="form" action="" method="post" enctype="multipart/form-data">
            <fieldset>
                <div class="formRow">
                    <label class="formLeft" for="param_name">Tên slide:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="name" id="name" _autocheck="true" type="text" value="<?php echo $info->name ?>"></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error">
                            <?php echo form_error('name') ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label class="formLeft">Hình ảnh:<span class="req">*</span></label>
                    <div class="formRight">
                        <div class="left"><input type="file" id="image_link" name="image_link"></div>
                        <div name="image_error" class="clear error">
                            
                        </div>
                        <div class="img-displayed" style="margin-top: 30px">
                            <img src="<?php echo base_url('upload/slide/'.$info->image_link) ?>" alt="">
                        </div>
                    </div>
                    <div class="clear">

                    </div>
                </div>

                <div class="formRow">
                    <label class="formLeft" for="image_name">Tên hình ảnh (tùy chọn):</label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="image_name" id="image_name" _autocheck="true" type="text" value="<?php echo $info->image_name ?>"></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error">
                          
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label class="formLeft" for="link">Đường link:</label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="link" id="link" _autocheck="true" type="text" value="<?php echo $info->link ?>"></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error">
                          
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label class="formLeft" for="param_sort_order">Thứ tự:</label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="sort_order" id="sort_order" _autocheck="true" type="text" value="<?php echo $info->sort_order ?>"></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error">
                          
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

               


                <div class="formSubmit">
                    <input type="submit" value="Cập nhật" class="redB">
                    <input type="reset" value="Hủy bỏ" class="basic">
                </div>
            </fieldset>
        </form>
    </div>


</div>