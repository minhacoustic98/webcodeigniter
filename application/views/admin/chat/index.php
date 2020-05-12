<?php  $this->load->view('admin/chat/head') ?>
<!-- Main content wrapper -->
<div class="wrapper">

	<!-- Static table -->
	<div class="widget">
	
		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
			<h6>Danh sách dữ liệu chatbot </h6>
			<div class="num f12">Tổng số: <b><?php echo $total_rows?></b></div>
		</div>
		<form action="" method="get" class="form">
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable taskWidget" id="checkAll">
			<thead>
				<tr>
				     <td style="width:21px;"><img src="<?php echo public_url('admin'); ?>/images/icons/tableArrows.png" /></td>
				    <td>ID</td>
					<td>Câu hỏi</td>
					<td>Nội dung phản hồi</td>
                    <td>Ngày tạo</td>
                    <td>Ngày cập nhật</td>
					<td>Hành động</td>
				</tr>
			</thead>
			
			<tfoot>
				<tr>
					<td colspan="8">
						  <div class="list_action itemActions">
								<a url="<?php echo admin_url('chatbot/delete_all')?>" class="button blueB" id="submit" href="#submit">
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
				<?php foreach ($list as $row => $val): ?>
					 <tr class='row_<?php echo $val['id']?>'>
						<td><input type="checkbox" name="id[]" value="<?php echo $val['id']; ?>" /></td>
						
						<td class="textC"><?php echo $val['id']; ?></td>
						
						
						<td><span title="<?php echo $val['question']; ?>" class="tipS">
							<?php echo $val['question'] ?>
						</span></td>
						
						
						<td><span title="<?php echo $val['answer']; ?>" class="tipS">
							<?php echo $val['answer']; ?>
						</span></td>
						
						
						
						
						
						<td>
							<?php echo get_date($val['created']) ?>
                        </td>
                        
                        <td>
                            <?php if($val['updated'] !=0):?>
								<?php echo get_date($val['updated']) ?>

                            <?php endif?>
						</td>
						<td class="option">
							<a href="<?php echo admin_url('chatbot/delete/'.$val['id'])?>" title="Xóa" class="tipS verify_action" >
							    <img src="<?php echo public_url('admin') ?>/images/icons/color/delete.png" />
                            </a>
                            
                            <a href="<?php echo admin_url('chatbot/edit/'.$val['id']) ?>" title="Chỉnh sửa" class="tipS">
                                <img src="<?php echo public_url('admin') ?>/images/icons/color/edit.png">
                            </a>
						</td>
					</tr>
				<?php endforeach; ?>	
				
			</tbody>
		</table>
		</form>
	</div>
</div>