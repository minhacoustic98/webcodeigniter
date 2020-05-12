  <script type="text/javascript">
  	$(document).ready(function() {
  		$('a.tab').click(function() {
  			var an_di = $('a.selected').attr('rel'); //lấy title của thẻ <a class='active'>
  			$('div#' + an_di).hide(); //ẩn thẻ <div id='an_di'>
  			$('a.selected').removeClass('selected');
  			$(this).addClass('selected');
  			var hien_thi = $(this).attr('rel'); //lấy title của thẻ <a> khi ta kick vào nó
  			$('div#' + hien_thi).show(); //hiện lên thẻ <div id='hien_thi'>
  		});
  	});
  </script>



  <!-- zoom image -->
  <script src="<?php echo public_url() ?>/site/jqzoom_ev/js/jquery.jqzoom-core.js" type="text/javascript"></script>
  <link rel="stylesheet" href="<?php echo public_url() ?>/site/jqzoom_ev/css/jquery.jqzoom.css" type="text/css">
  <script type="text/javascript">
  	$(document).ready(function() {
  		$('.jqzoom').jqzoom({
  			zoomType: 'standard',
  		});
  	});
  </script>
  <!-- end zoom image -->

  <!-- Raty -->
  <script type="text/javascript">
  	$(document).ready(function() {
  		//raty
  		$('.raty_detailt').raty({
  			score: function() {
  				return $(this).attr('data-score');
  			},
  			half: true,
  			click: function(score, evt) {
  				var rate_count = $('.rate_count');
  				var rate_count_total = rate_count.text();
  				$.ajax({
  					url: '<?php echo site_url('product/raty') ?>',
  					type: 'POST',
  					data: {
  						'id': '<?php echo $product->id ?>',
  						'score': score
  					},
  					dataType: 'json',
  					success: function(data) {
  						if (data.complete) {
  							var total = parseInt(rate_count_total) + 1;
  							rate_count.html(parseInt(total));
  						}
  						alert(data.msg);
  					}
  				});
  			}
  		});
  	});
  </script>
  <!--End Raty -->

  <style>
  	.send-comment {
  		cursor: pointer;
  	}

  	.send-comment:hover {
  		background: blueviolet !important;

  	}
  </style>

  <div class="box-center">
  	<!-- The box-center product-->
  	<div class="tittle-box-center">
  		<h2>Chi tiết sản phẩm</h2>
  	</div>
  	<div class="box-content-center product">
  		<!-- The box-content-center -->
  		<div class='product_view_img'>
  			<a href="<?php echo base_url('upload/product/' . $product->image_link) ?>" class="jqzoom" rel='gal1' title="triumph">
  				<img src="<?php echo base_url('upload/product/' . $product->image_link) ?>" alt='Tivi LG 520' style="width:280px !important">
  			</a>
  			<div class='clear' style='height:10px'></div>
  			<div class="clearfix">
  				<ul id="thumblist">
  					<li>
  						<a class="zoomThumbActive" href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo base_url('upload/product/' . $product->image_link) ?>',largeimage: '<?php echo base_url('upload/product/' . $product->image_link) ?>'}">
  							<img src='<?php echo base_url('upload/product/' . $product->image_link) ?>'>
  						</a>
  					</li>
  					<?php if (is_array($image_list)) : ?>
  						<?php foreach ($image_list as $img) : ?>
  							<li>
  								<a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo base_url('upload/product/' . $img) ?>',largeimage: '<?php echo base_url('upload/product/' . $img) ?>'}">
  									<img src='<?php echo base_url('upload/product/' . $img) ?>'>
  								</a>
  							</li>
  						<?php endforeach; ?>
  					<?php endif; ?>
  				</ul>
  			</div>
  		</div>

  		<div class='product_view_content'>
  			<h1><?php echo $product->name ?></h1>



  			<p class='option'>
  				Giá:
  				<?php if ($product->discount > 0) : ?>
  					<?php $price_new = $product->price - $product->discount; ?>
  					<span class='product_price'><?php echo number_format($price_new) ?> đ</span>
  					<span class="price_old"><?php echo number_format($product->price) ?> đ</span>
  				<?php else : ?>
  					<span class='product_price'><?php echo number_format($product->price) ?> đ</span>
  				<?php endif; ?>


  			</p>

  			<p class='option'>
  				Danh mục:
  				<a href="<?php echo base_url('product/catalog/' . $catalog->id) ?>" title="<?php echo $catalog->name ?>">
  					<b><?php echo $catalog->name ?></b>
  				</a>
  			</p>

  			<p class='option'>
  				Lượt xem: <b><?php echo $product->view ?></b>
  			</p>
  			<?php if ($product->warranty != '') : ?>
  				<p class='option'>
  					Bảo hành: <b><?php echo $product->warranty ?></b>
  				</p>
  			<?php endif; ?>
  			<?php if ($product->gifts != '') : ?>
  				<p class='option'>
  					Tặng quà: <b><?php echo $product->gifts ?></b>
  				</p>
  			<?php endif; ?>

  			Đánh giá &nbsp;
  			<span class='raty_detailt' style='margin:5px' id='9' data-score='<?php echo $product->raty ?>'></span>
  			| Tổng số: <b class='rate_count'><?php echo $product->rate_count ?></b>

  			<div class='action'>
  				<a class='button' style='float:left;padding:8px 15px;font-size:16px' href="<?php echo base_url('cart/add/' . $product->id) ?>" title='Mua ngay'>Thêm vào giỏ hàng</a>
  				<div class='clear'></div>
  			</div>

  		</div>
  		<div class='clear' style='height:15px'></div>
  		<center>
  			<!-- AddThis Button BEGIN -->
  			<script type="text/javascript">
  				var switchTo5x = true;
  			</script>
  			<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
  			<script type="text/javascript">
  				stLight.options({
  					publisher: "19a4ed9e-bb0c-4fd0-8791-eea32fb55964",
  					doNotHash: false,
  					doNotCopy: false,
  					hashAddressBar: false
  				});
  			</script>
  			<span class='st_facebook_hcount' displayText='Facebook'></span>
  			<span class='st_fblike_hcount' displayText='Facebook Like'></span>
  			<span class='st_googleplus_hcount' displayText='Google +'></span>
  			<span class='st_twitter_hcount' displayText='Tweet'></span>
  			<!-- AddThis Button END -->
  		</center>
  		<div class='clear' style='height:10px'></div>
  		<table width="100%" cellspacing="0" cellpadding="3" border="0" class="tbsicons">
  			<tbody>
  				<tr>
  					<td width="25%"><img alt="Phục vụ chu đáo" src="<?php echo public_url('site') ?>/images/icon-services.png">
  						<div>Phục vụ chu đáo</div>
  					</td>
  					<td width="25%"><img alt="Giao hàng đúng hẹn" src="<?php echo public_url('site') ?>/images/icon-shipping.png">
  						<div>Giao hàng đúng hẹn</div>
  					</td>
  					<td width="25%"><img alt="Đổi hàng trong 24h" src="<?php echo public_url('site') ?>/images/icon-delivery.png">
  						<div>Đổi hàng trong 24h</div>
  					</td>
  				</tr>
  			</tbody>
  		</table>
  	</div>
  </div>



  <div class="usual" id="usual1">
  	<ul>
  		<li><a title="Chi tiết sản phẩm" rel='tab2' href='javascript:void(0)' class="tab selected">Chi tiết sản phẩm</a></li>


  	</ul>
  </div><!-- end  <div class="usual" id="usual1">-->

  <div class="usual-content">
  	<div id="tab2">
  		<?php echo $product->content ?>
  		<!-- comment facebook -->

  	</div>

  </div>


  <div class="container">
  	<div class="mt-5">
  		<h3>Comment đánh giá sản phẩm</h3>
  	</div>
	   <?php 
			   if(isset($user_login))
			   {
				   $user_name=$user_login->name;
				   $user_email=$user_login->email;

			   }
	   ?>
  	<form method="post" class="mt-5" action="<?php echo base_url('product/insert') ?>">
  		<div class="row">
  			<div class="col-md-12">
  				<h4>Comment mới</h4>
  			</div>
  			<div class="col-md-6">
  				<div class="form-group">
  					<input type="text" name="u_name" class="form-control" placeholder="Enter Name" value="<?php if(isset($user_name)) echo $user_name ?>">
  				</div>
  			
  				<div class="form-group">
  					<input type="text" name="u_email" class="form-control" placeholder="Enter email addres" value="<?php if(isset($user_email)) echo $user_email ?>">
  				</div>
  			</div>
  			<div class="col-md-6">
  				<div class="form-group">
  					<textarea placeholder="Enter your comments here..." style="border-radius:5px;resize:none" class="form-control" cols="34" rows="5" name="comment"></textarea>
				  </div>

				  <div class="form-group">
				     <input type="hidden" name="product_ids" value="<?php echo $product_id ?>"/>
				  </div>	
  			</div>
  			<div class="col-md-12">
  				<input type="submit" name="add" value="Comment" class="btn btn-block btn-primary">
  			</div>
  		</div>
  	</form>
  	<div class="row comments" style="margin-top: 20px">
  		<div class="pl-3 pr-3">
  			<h3>Phản hồi:</h3>
  			<table class="table table-hover ">
  				<?php if (!empty($html)) {
						echo $html;
					} else
						echo 'Hiện chưa có phản hồi nào'
					?>



  			</table>
  		</div>
  	</div>
  </div>

  <style>

	  .btn-primary{
		  padding:10px;
		  color:#fff;
		  font-weight: 700;
		  background: #3B5998;
		  cursor: pointer;
	  }
	  .form-group{
		  margin:15px 0;
	  }
  	.table {
  		width: 100%;
  		margin-bottom: 1rem;
  		color: #212529;
  		border-collapse: collapse;

  	}

  	.table p {
  		padding-bottom: 1rem;
  	}

  	.comment_reply:hover {
  		background: cyan !important;
  		color: gold !important;
  	}

  	.table td,
  	.table th {
  		padding: .75rem;
  		vertical-align: top;
  		border-top: 1px solid #dee2e6;
  	}

  	#reply input,.form-group input {
  		display: block;
  		margin-bottom: 1rem;
  		/* height: 30px; */
  		padding: 5px;
  		border: 1px solid #ccc;
  		border-radius: 5px;
  		width: 45%;
  	}

  	#reply input[type="submit"] {
  		width: 10%;
  		margin-top: 10px;
  		color: #fff;
  		background: blue;
  		cursor: pointer;
  		border: none;
  	}

  	.pl-5,
  	.px-5 {
  		padding-left: 3rem !important;
  	}

  	.pr-5,
  	.px-5 {
  		padding-right: 3rem !important;
  	}
  </style>

  <script type="text/javascript">
  	$(document).ready(function() {

  		$('.comment_reply').click(function(event) {
  			$('.reply_form').html('');
  			var cid = $(this).attr('data-parent');
  			var pid = <?php echo $product_id ?>;
  			var content = '';
  			content += '<form method="post" id="reply" ><div class="row"><div class="col-md-12">';
  			content += '<h6>Reply comment</h6></div><div class="col-md-6"><div class="form-group">';
  			content += '<input type="text"  name="name"  class="form-control" placeholder="Enter Name" ></div>';
  			content += '<div class="form-group"><input type="text"  name="email"   class="form-control" placeholder="Enter email"></div></div>';
  			content += '<div class="col-md-6"><div class="form-group"><textarea rows="5" cols="50" placeholder="Enter your comments here..."  class="form-control" rows="5" name="comment"></textarea></div></div><div class="col-md-12"><input type="hidden" name="parent" value="' + cid + '" /><input type="hidden" name="product_id" value="' + pid + '"/><input type="submit" name="reply" value="Reply" class="btn btn-block btn-primary"></div></div></form>';
  			$('#reply_form' + cid).html(content);
  		});

  		$(document).on('submit', 'form#reply', function(event) {
  			event.preventDefault();
  			//alert("Was preventDefault() called: " + event.isDefaultPrevented()); 
  			var formdata = new FormData($(this)[0]);
  			$.ajax({
  				url: "<?php echo base_url('product/reply') ?>",
  				type: 'post',
  				data: formdata,
  				processData: false,
  				contentType: false,
  				success: function(response) {
  					data = JSON.parse(response);
  					if (data.result == true) {
						location.reload();
  					} else {
  						alert(data.errors);
  					}
  				}
  			});
  		});
  	});
  </script>