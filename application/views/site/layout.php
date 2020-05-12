<html>

<head>
    <?php $this->load->view('site/head'); ?>
</head>

<body>

    <!-- Back to top button -->
    <a href="#" id="back_to_top" style="display: none">
        <img src="<?php echo public_url() ?>site/images/top.png">
    </a>
    <!-- -->

    <div class="wraper">
        <!-- Header -->
        <div class="header">
            <?php $this->load->view('site/header') ?>
        </div>
        <!-- -->

        <div class="container">
            <div class="left">
                <?php $this->load->view('site/left', $this->data) ?>
            </div>

            <div class="content">
                <?php if (isset($message)) : ?>
                    <p><b><?php echo $message ?></b></p>
                <?php endif; ?>

                <?php $this->load->view($temp, $this->data) ?>
            </div>

            <div class="right">
                <?php $this->load->view('site/right', $this->data) ?>
            </div>

            <div class="clear">

            </div>
        </div>
        <center>
            <img src="<?php echo public_url() ?>site/images/bank.png">
        </center>


        <div class="footer">
            <?php $this->load->view('site/footer'); ?>
        </div>

          <!--Chatbot--->
<style>

/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 8px 10px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 0px;
  right: 60px;
  width: 100px;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9999999 !important;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
  
}

/* Full-width textarea */
.form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 100px;
}

/* When the textarea gets focus, do something */
.form-container textarea:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: cyan;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

.chatmsg{
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 100px;
}

.chatlabel{
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #2ED046;
  resize: none;
}
</style>

<button class="open-button" onclick="openForm()"><i class="fa fa-comments-o fa-5" aria-hidden="true"></i> Chat</button>

<div class="chat-popup" id="myForm" style="z-index: 99999 !important;background:#fff;">
  
  <h3 class="chatlabel">Hỗ trợ trực tuyến</h3>
  <div id="chatmsg" class="chatmsg"  style="z-index: 99999 !important;"></div>
  <form action="javascript:void();" class="form-container"  style="z-index: 99999 !important;">
    
    <label for="msg"><b>Lời nhắn:</b></label>
    <textarea placeholder="Hãy viết gì đó.." name="msg" id="msg" required></textarea>

    <button type="submit" class="btn">Gửi lời nhắn</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Hủy tin nhắn</button>
  </form>
  
</div>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}

$(document).ready(function() {

	$(".btn").on('click',function(e){
		if($("#msg").val()=="")
		{
			return;
		}
	   $("#chatmsg").append("<b>Bạn :</b> "+$("#msg").val()+"<br>");
	   sendReceive($("#msg").val());
	   $("#msg").val("");
	});
});

function sendReceive(msg)
{
	$.post( "<?php echo base_url('chatbotfront/get_chat_data'); ?>", { msg: msg })
	  .done(function( data ) {
		//alert( "Data Loaded: " + data );
		var len = $("#chatmsg").html().length;
		if(len>400)
		{
		   $("#chatmsg").html( $("#chatmsg").html().substring(len-200, len-1));
		}
		$("#chatmsg").append("<i>Bot<i>  :"+data+"<br>");
	  }).fail(function( data ) {
		alert( "Data Loaded Fail");
	  });
}
</script>



       
    </div>

  
</body>

</html>



