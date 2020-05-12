<?php $this->load->view('admin/product/head') ?>
<div class="line"></div>


<div class="wrapper">

    <!-- Form -->
    <form class="form" id="form" action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <div class="widget">
                <div class="title">
                    <img src="<?php echo public_url('admin') ?>/images/icons/dark/add.png" class="titleIcon">
                    <h6>Chỉnh sửa thông tin Sản phẩm</h6>
                </div>

                <ul class="tabs">
                    <li><a href="#tab1">Thông tin chung</a></li>
                    <li><a href="#tab2">Thông tin kèm theo</a></li>
                    <li><a href="#tab3">Nội dung</a></li>

                </ul>

                <div class="tab_container">
                    <div id="tab1" class="tab_content pd0">
                        <div class="formRow">
                            <label class="formLeft" for="name">Tên:<span class="req">*</span></label>
                            <div class="formRight">
                                <span class="oneTwo"><input name="name" id="name" _autocheck="true" type="text" value="<?php echo $product->name ?>"></span>
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
                                <img src="<?php echo base_url('upload/product/'.$product->image_link) ?>" alt="">
                                <div class="left"><input type="file" id="image" name="image"></div>
                                <div name="image_error" class="clear error">
                                <?php echo form_error('image') ?>
                                </div>
                            </div>
                            <div class="clear">
                           
                            </div>
                        </div>

                        <div class="formRow">
                            <?php $img_lst=json_decode($product->image_links);
                                  
                            ?>
                            <label class="formLeft">Ảnh kèm theo:</label>
                            <div class="formRight">
                                <div class="left"><input type="file" id="image_list" name="image_list[]" multiple="">
                              
                                </div>

                                <div name="image_list_error" class="clear error"></div>

                                <div class="img-list" style="display:flex;margin-top:50px;">
                                    <?php foreach($img_lst as $imgs): ?>
                                            <img  src="<?php echo base_url('upload/product/'.$imgs) ?>" alt="">

                                        <?php endforeach;?>
                                    </div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <!-- Price -->
                        <div class="formRow">
                            <label class="formLeft" for="param_price">
                                Giá :
                                <span class="req">*</span>
                            </label>
                            <div class="formRight">
                                <span class="oneTwo">
                                    <input name="price" style="width:100px" id="price" class="format_number" _autocheck="true" type="text" value="<?php echo $product->price ?>">
                                    <img class="tipS" title="Giá bán sử dụng để giao dịch" style="margin-bottom:-8px" src="<?php echo public_url('admin') ?>/crown/images/icons/notifications/information.png">
                                </span>
                                <span name="price_autocheck" class="autocheck"></span>
                                <div name="price_error" class="clear error">
                                <?php echo form_error('price') ?>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <!-- Price -->
                        <div class="formRow">
                            <label class="formLeft" for="discount">
                                Giảm giá (VNĐ)
                                <span></span>:
                            </label>
                            <div class="formRight">
                                <span>
                                    <input name="discount" style="width:100px" id="discount" class="format_number" type="text" value="<?php echo $product->discount ?>">
                                    <img class="tipS" title="Số tiền giảm giá" style="margin-bottom:-8px" src="<?php echo public_url('admin') ?>/crown/images/icons/notifications/information.png">
                                </span>
                                <span name="discount_autocheck" class="autocheck"></span>
                                <div name="discount_error" class="clear error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>


                        <div class="formRow">
                            <label class="formLeft" for="catalog">Thể loại:<span class="req">*</span></label>
                            <div class="formRight">
                                <select name="catalog" id="catalog" class="left">
                                    <option value=""></option>
                                    <!-- kiem tra danh muc co danh muc con hay khong -->

                                    <?php foreach ($menu as $row) : ?>
                                        <?php if (count(($row->subs)) > 0) : ?>
                                            <optgroup label="<?php echo $row->name ?>">
                                                <?php foreach ($row->subs as $sub) : ?>
                                                    <option value="<?php echo $sub->id ?>"
                                                        <?php if($sub->id==$product->menu_id) echo 'selected' ?>
                                                                        >
                                                    
                                                    
                                                    <?php echo $sub->name ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </optgroup>
                                        <?php else : ?>
                                            <option value="<?php echo $row->id ?>"  <?php if($row->id==$product->menu_id) echo 'selected' ?>><?php echo $row->name ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <span name="cat_autocheck" class="autocheck"></span>
                                <div name="cat_error" class="clear error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>


                        <!-- warranty -->
                        <div class="formRow">
                            <label class="formLeft" for="warranty">
                                Bảo hành :<span class="req">*</span>
                            </label>
                            <div class="formRight">
                                <span class="oneFour"><input name="warranty" id="warranty" type="text" value="<?php echo $product->warranty ?>"></span>
                                <span name="warranty_autocheck" class="autocheck"></span>
                                <div name="warranty_error" class="clear error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <!-- quantity -->
                        <div class="formRow">
                            <label class="formLeft" for="quantity">
                                Số lượng :<span class="req">*</span>
                            </label>
                            <div class="formRight">
                                <span class="oneFour"><input name="quantity" id="quantity" type="number" value="<?php echo $product->quantity ?>"></span>
                                <span name="quantity_autocheck" class="autocheck"></span>
                                <div name="quantity_error" class="clear error">
                                <?php echo form_error('quantity') ?>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label class="formLeft" for="gift">Tặng quà:</label>
                            <div class="formRight">
                                <span class="oneTwo"><textarea name="gift" id="gift" rows="4" cols=""><?php echo $product->gifts ?>"</textarea></span>
                                <span name="sale_autocheck" class="autocheck"></span>
                                <div name="sale_error" class="clear error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow hide"></div>
                    </div>

                    <div id="tab2" class="tab_content pd0">

                        

                        <div class="formRow">
                            <label class="formLeft" for="featured">Đặc điểm sản phẩm:</label>
                            <div class="formRight">
                                <span class="oneTwo"><textarea name="featured" id="featured" _autocheck="true" rows="4" cols=""><?php echo $product->featured ?></textarea></span>
                                <span name="featured_autocheck" class="autocheck"></span>
                                <div name="featured_error" class="clear error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label class="formLeft" for="displayed">
                                Hiển thị :
                            </label>
                            <div class="formRight">
                                <span class="oneFour">
                                    <select name="display" id="display">
                                        <option value="0" <?php if($product->is_displayed==1) echo 'selected' ?>>Không hiển thị</option>
                                        <option value="1" <?php if($product->is_displayed==1) echo 'selected' ?>>Hiển thị</option>
                                    </select>
                                </span>
                                <span name="warranty_autocheck" class="autocheck"></span>
                                <div name="warranty_error" class="clear error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>
           
                        <div class="formRow hide"></div>
                    </div>

                    <div id="tab3" class="tab_content pd0">
                        <div class="formRow">
                            <label class="formLeft">Nội dung:</label>
                            <div class="formRight">
                                <textarea name="content" id="content" class="editor"><?php echo $product->content ?></textarea>
                                <div name="content_error" class="clear error">
                                    <?php form_error('content') ?>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow hide"></div>
                    </div>


                </div><!-- End tab_container-->

                <div class="formSubmit">
                    <input type="submit" value="Cập nhật" class="redB">
                    <input type="reset" value="Hủy bỏ" class="basic">
                </div>
                <div class="clear"></div>
            </div>
        </fieldset>
    </form>
</div>

<div class="clear mt30"></div>

<script type="text/javascript">
    (function($) {
        $(document).ready(function() {
            var main = $('#form');

            // Tabs
            main.contentTabs();
        });
    })(jQuery);
</script>