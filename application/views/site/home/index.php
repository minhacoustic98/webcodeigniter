<?php $this->load->view('site/slide',$this->data) ?>
<div class="box-center"><!-- The box-center product-->
             <div class="tittle-box-center">
		        <h2>Sản phẩm mới</h2>
		      </div>
          <div class="box-content-center product"><!-- The box-content-center -->
               <?php foreach($product_newest as $product):?>
		                                <div class="product_item">
                          
                       <h3>
                         <a href="<?php echo base_url('product/view/'.$product->id)?>" title="<?=$product->name?>">
                           <?=$product->name?>
                                     </a>
	                   </h3>
                       <div class="product_img">
                             <a href="<?php echo base_url('product/view/'.$product->id)?>" title="Sản phẩm">
                                <img src="<?php echo base_url('upload/product/'.$product->image_link) ?>" alt="<?=$product->name?>">
                            </a>
                       </div>
                       <p class="price">
                             <?php if($product->discount>0):?>
                                <?php $price_new=$product->price-$product->discount; ?>
                                <?php echo number_format($price_new); ?>đ <span class="price_old"><?php echo number_format($product->price) ?>đ</span>
                             <?php else:?>
                                 <?php echo number_format($product->price) ?>đ
                             <?php endif;?>
		                   </p>
                        <center>
                        <div class='raty' style='margin:10px 0px' id='9' data-score='4'></div>

                        </center>
                       <div class="action">
                           <p style="float:left;margin-left:10px">Lượt xem: <b><?=$product->view?></b></p>
	                       <a class="button" href="them-vao-gio-9.html" title="Mua ngay">Mua ngay</a>
	                       <div class="clear"></div>
                       </div>
                   </div>
               <?php endforeach;?>
                          
               
		            <div class="clear"></div>
		      </div><!-- End box-content-center -->
</div>


<div class="box-center"><!-- The box-center product-->
             <div class="tittle-box-center">
		        <h2>Sản phẩm mua nhiều</h2>
		      </div>
          <div class="box-content-center product"><!-- The box-content-center -->
               <?php foreach($product_buyed as $product):?>
		                                <div class="product_item">
                          
                       <h3>
                         <a href="<?php echo base_url('product/view/'.$product->id)?>" title="<?=$product->name?>">
                           <?=$product->name?>
                                     </a>
	                   </h3>
                       <div class="product_img">
                             <a href="<?php echo base_url('product/view/'.$product->id)?>" title="Sản phẩm">
                                <img src="<?php echo base_url('upload/product/'.$product->image_link) ?>" alt="<?=$product->name?>">
                            </a>
                       </div>
                       <p class="price">
                             <?php if($product->discount>0):?>
                                <?php $price_new=$product->price-$product->discount; ?>
                                <?php echo number_format($price_new); ?>đ <span class="price_old"><?php echo number_format($product->price) ?>đ</span>
                             <?php else:?>
                                 <?php echo number_format($product->price) ?>đ
                             <?php endif;?>
		                   </p>
                        <center>
                        <div class='raty' style='margin:10px 0px' id='9' data-score='4'></div>

                        </center>
                       <div class="action">
                           <p style="float:left;margin-left:10px">Lượt xem: <b><?=$product->view?></b></p>
	                       <a class="button" href="them-vao-gio-9.html" title="Mua ngay">Mua ngay</a>
	                       <div class="clear"></div>
                       </div>
                   </div>
               <?php endforeach;?>
                          
               
		            <div class="clear"></div>
		      </div><!-- End box-content-center -->
</div>