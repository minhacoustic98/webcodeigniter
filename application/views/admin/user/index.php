<!-- Common view -->
<?php $this->load->view('admin/user/_common'); ?>


<!-- Main content wrapper -->
<div class="wrapper">
	<div class="widget">
	
		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
			<h6>Danh sách:</h6>
		 	<div class="num f12">Tổng số: <b><?php echo $total_rows ?></b></div>
		</div>
		
		<form action="" method="get" class="form" name="filter">
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
			<thead>
				<tr>
					<td style="width:10px;"><img src="<?php echo public_url('admin'); ?>/images/icons/tableArrows.png" /></td>
					<td style="width:80px;"><?php echo 'STT';?></td>
					<td>Tên:</td>
					<td>Địa chỉ:</td>
					<td>Email:</td>
					<td>Phone:</td>
					
				</tr>
			</thead>
			
 			<tfoot>
				<tr>
					<td colspan="7">
				
							
					     <div class='pagination'>
			               <?php echo $this->pagination->create_links();?>
			            </div>
					</td>
				</tr>
			</tfoot>
 			
			<tbody>
				<!-- Filter -->
				<?php foreach ($list as $row): ?>
					<tr class="row_<?php echo $row->id?>">
						<td><input type="checkbox" name="id[]" value="<?php echo $row->id; ?>" /></td>
						
						<td class="textC"><?php echo $row->id; ?></td>
						
						
						<td><span title="<?php echo $row->name; ?>" class="tipS">
							<?php echo $row->name; ?>
						</span></td>
						
						
						<td><span title="<?php echo $row->email; ?>" class="tipS">
							<?php echo $row->email; ?>
						</span></td>
						
						<td>
							<?php echo $row->phone; ?>
						</td>
						
						<td>
							<?php echo $row->address; ?>
						</td>
						
						
					</tr>
				<?php endforeach; ?>	
				
			</tbody>
		</table>
		</form>
	</div>
</div>
        