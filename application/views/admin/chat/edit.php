<?php $this->load->view('admin/chat/head') ?>
<div class="line"></div>
<div class="wrapper">
    <div class="widget">

        <div class="title">

            <h6>Cập nhật dữ liệu train:</h6>
        </div>

        <form class="form" id="form" action="" method="post" enctype="multipart/form-data">
            <fieldset>
                <div class="formRow">
                    <label class="formLeft" for="param_question">Câu hỏi:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="question" id="question" _autocheck="true" type="text" value="<?php echo $info['question'] ?>"></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error">
                        <?php echo form_error('question') ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label class="formLeft" for="param_answer">Câu trả lời:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="answer" id="answer" _autocheck="true" type="text" value="<?php echo $info['answer'] ?>"></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error">
                            <?php echo form_error('answer') ?>
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