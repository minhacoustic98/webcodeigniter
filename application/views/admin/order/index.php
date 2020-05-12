
<!-- Common -->
<?php $this->load->view('admin/order/_common'); ?>

<!-- Main content wrapper -->
<div class="wrapper">

	<div class="widget">
		<div class="title">
			<span class="titleIcon"><img src="<?php echo public_url('admin/images/icons/tableArrows.png'); ?>" /></span>
			<h6>Danh sách đơn hàng</h6>
			
		 	<div class="num f12">Tổng số: <b><?php echo $total_rows?></b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">
		
			
			<thead>
				<tr>
					<td style="width:60px;">Mã</td>
					<td>Sản phẩm</td>
					<td style="width:80px;">Giá</td>
					<td style="width:50px;">Số lượng</td>
					<td style="width:70px;">Thanh toán</td>
					<td style="width:75px;">Đơn hàng</td>
					<td style="width:75px;">Giao dịch</td>
					<td style="width:75px;">Ngày tạo</td>
					<td style="width:55px;">Hành động</td>
				</tr>
			</thead>
			
 			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="9">
						
					     <div class='pagination'>
			               <?php echo $this->pagination->create_links();?>
			            </div>
					</td>
				</tr>
			</tfoot>
			
			<tbody class="list_item">
			     <?php foreach ($list as $row):?>
			      <tr class='row_<?php echo $row->id?>'>
					
					<td class="textC"><?php echo $row->id?></td>
					
					<td>
					<div class="image_thumb">
						<img src="<?php echo base_url('upload/product/'.$row->image_link)?>" height="50">
						<div class="clear"></div>
					</div>
					
					<a href="<?php echo site_url('product/view/'.$row->product_id)?>" class="tipS" title="" target="_blank">
					<b><?php echo $row->product_name?></b>
					</a>	
					</td>
					
					<td class="textR">
					    <?php if($row->discount > 0){?>
                               <?php 
                               $price_new = $row->price - $row->discount;
                               ?>
                               <?php echo number_format($price_new)?> đ
	                       <p style='text-decoration:line-through'><?php echo number_format($row->price)?> đ</p>
                           <?php }else{?>
                                 <?php echo number_format($row->price)?> đ
                           <?php }?>
					</td>
					
					<td class="textC"><?php echo $row->quantity?></td>
					
					<td class="textC"><?php echo number_format($row->money)?> đ</td>
					
					
					<td class="status textC">
						<span class="<?php echo $row->order_status; ?>">
							<?php if($row->order_status==1):?>
								Đã gửi hàng
							<?php elseif($row->order_status==0) : ?>
								Đang gửi hàng
							<?php else:?>
								Chưa gửi hàng/Gủi thất bại
						    <?php endif?>
						</span>
					</td>
					
					<td class="status textC">
						<span class="<?php echo $row->status; ?>">
						<?php if($row->status==1):?>
								Thanh toán thành công
							<?php elseif($row->status==0) : ?>
								Chưa thanh toán
							<?php else:?>
								Thanh toán thất bại
						    <?php endif?>
						</span>
					</td>
					
					<td class="textC"><?php echo mdate('%d-%m-%Y',$row->created)?></td>
					
					<td class="textC">
							<a href="<?php echo admin_url('transaction/view/'.$row->transaction_id) ?>" class="lightbox">
								<img src="<?php echo public_url('admin') ?>/images/icons/color/view.png" />
							</a>
					</td>
				</tr>
			<?php endforeach;?>	
			</tbody>
			
		</table>
	</div>
	
</div>
        