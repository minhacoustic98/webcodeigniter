<?php $this->load->view('admin/news/head') ?>
<div class="line"></div>


<div class="wrapper">

    <!-- Form -->
    <form class="form" id="form" action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <div class="widget">
                <div class="title">
                    <img src="<?php echo public_url('admin') ?>/images/icons/dark/add.png" class="titleIcon">
                    <h6>Thêm mới Tin tức</h6>
                </div>

                <ul class="tabs">
                    <li><a href="#tab1">Thông tin chung</a></li>
                    <li><a href="#tab3">Nội dung</a></li>

                </ul>

                <div class="tab_container">
                    <div id="tab1" class="tab_content pd0">
                        <div class="formRow">
                            <label class="formLeft" for="name">Tiêu đề:<span class="req">*</span></label>
                            <div class="formRight">
                         
                           
                                <textarea name="title" id="title" class="editor"></textarea>
                                <div name="title_error" class="clear error">
                                    <?php form_error('title') ?>
                                </div>
                          
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label class="formLeft" for="name">Giới thiệu:<span class="req">*</span></label>
                            <div class="formRight">
                                <span class="oneTwo"><input name="intro" id="intro" _autocheck="true" type="text"></span>
                                <span name="intro_autocheck" class="autocheck"></span>
                                <div name="intro_error" class="clear error">
                                    <?php echo form_error('intro') ?>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label class="formLeft">Hình ảnh:<span class="req">*</span></label>
                            <div class="formRight">
                                <div class="left"><input type="file" id="image" name="image"></div>
                                <div name="image_error" class="clear error">
                                <?php echo form_error('image') ?>
                                </div>
                            </div>
                            <div class="clear">
                           
                            </div>
                        </div>

                        <div class="formRow">
                            <label class="formLeft" for="name">Ngày tạo:<span class="req">*</span></label>
                            <div class="formRight">
                                <span class="oneTwo"><input name="created" class="maskDate" id="created" _autocheck="true" type="text"></span>
                                <span name="intro_autocheck" class="autocheck"></span>
                                <div name="intro_error" class="clear error">
                                    <?php echo form_error('intro') ?>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label class="formLeft" for="name">Đặc điểm:<span class="req">*</span></label>
                            <div class="formRight">
                                <span class="oneTwo"><input name="featured" id="featured" _autocheck="true" type="text"></span>
                                <span name="featured_autocheck" class="autocheck"></span>
                                <div name="featured_error" class="clear error">
                                    <?php echo form_error('featured') ?>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                       
                        <div class="formRow hide"></div>
                    </div>

                 

                    <div id="tab3" class="tab_content pd0">
                        <div class="formRow">
                            <label class="formLeft">Nội dung:</label>
                            <div class="formRight">
                                <textarea name="content" id="content" class="editor"></textarea>
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
                    <input type="submit" value="Thêm mới" class="redB">
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