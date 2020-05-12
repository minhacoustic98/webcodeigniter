<?php $this->load->view('admin/menu/head') ?>
<div class="line"></div>
<div class="wrapper">
    <div class="widget">

        <div class="title">

            <h6>Thêm mới menu-danh mục:</h6>
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
                    <label class="formLeft" for="param_level">Cấp độ:</label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="level" id="level" _autocheck="true" type="text" value="<?php echo set_value('level') ?>"></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error">
                            <?php echo  form_error('username') ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label class="formLeft" for="param_sort_order">Thứ tự:</label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="sort_order" id="sort_order" _autocheck="true" type="text"></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error">
                        <?php echo  form_error('sort_order') ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label class="formLeft" for="param_sort_order">Danh mục cha:</label>
                    <div class="formRight">
                        <span class="oneTwo">
                            <select name="parent_id" id="parent_id">
                               <option value="0">Là danh mục cha</option>
                                <?php foreach($list as $row): ?>
                                    <option value="<?=$row->id?>"><?=$row->name?></option>
                                <?php endforeach;?>
                            </select>
                        </span>

                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error">
                        <?php echo  form_error('parent_id') ?>
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