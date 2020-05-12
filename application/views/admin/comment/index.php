
<!-- Common -->
<?php $this->load->view('admin/comment/head'); ?>

<!-- Main content wrapper -->
<div class="wrapper">

	<!-- Static table -->
	<div class="widget">
	
		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
			<h6>Danh sách phản hồi về sản phẩm </h6>
			<div class="num f12">Tổng số: <b><?php echo $total_rows?></b></div>
		</div>
		<form action="" method="get" class="form">
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable taskWidget" id="checkAll">
			<thead>
				<tr>
				     <td style="width:21px;"><img src="<?php echo public_url('admin'); ?>/images/icons/tableArrows.png" /></td>
				    <td>ID</td>
					<td>Họ tên</td>
					<td>Email</td>
					<td>Nội dung</td>
					<td>Ngày tạo</td>
					<td>Hành động</td>
				</tr>
			</thead>
			
			<tfoot>
				<tr>
					<td colspan="8">
						  <div class="list_action itemActions">
								<a url="<?php echo admin_url('comment/delete_all')?>" class="button blueB" id="submit" href="#submit">
									<span style="color:white;">Xóa hết</span>
								</a>
						 </div>
							
							
					     <div class='pagination'>
			               <?php echo $this->pagination->create_links();?>
			            </div>
					</td>
				</tr>
			</tfoot>
			
			<tbody>
			      <!-- Filter -->
				<?php foreach ($list as $row): ?>
					 <tr class='row_<?php echo $row->id?>'>
						<td><input type="checkbox" name="id[]" value="<?php echo $row->id; ?>" /></td>
						
						<td class="textC"><?php echo $row->id; ?></td>
						
						
						<td><span title="<?php echo $row->user_name; ?>" class="tipS">
							<?php echo $row->user_name; ?>
						</span></td>
						
						
						<td><span title="<?php echo $row->user_email; ?>" class="tipS">
							<?php echo $row->user_email; ?>
						</span></td>
						
						
						
						<td>
							<?php echo $row->content; ?>
						</td>
						
						<td>
							<?php echo get_date($row->created) ?>
						</td>
						<td class="option">
							<a href="<?php echo admin_url('comment/del/'.$row->id)?>" title="Xóa" class="tipS verify_action" >
							    <img src="<?php echo public_url('admin') ?>/images/icons/color/delete.png" />
							</a>
						</td>
					</tr>
				<?php endforeach; ?>	
				
			</tbody>
		</table>
		</form>
	</div>
</div>
        