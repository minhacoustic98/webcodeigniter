<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=product_order.xls");
header("Pragma: no-cache");
header("Expires: 0");
?> 
<table>
		<thead>
			<tr>
				<td>STT</td>
				<td style="width:60px;">Product No.</td>
				<td>Product</td>
				<td style="width:200px;">Price</td>
				<td style="width:75px;">Quantity</td>
				<td style="width:150px;">Amount</td>
				<td style="width:120px;">Order status</td>
				<td style="width:120px;">Transaction status</td>
				<td style="width:100px;">Created</td>
			
			</tr>
		</thead>
		
		<tbody class="list_item">
		        
		        <?php foreach ($list as $k => $row):?>
			      <tr class='row_<?php echo $row->id?>'>
					<td class="textC"><?php echo $k + 1?></td>
					
					<td class="textC"><?php echo $row->id?></td>
					
					<td>
					<b><?php echo $row->product_name?></b>
					</td>
					
					<td class="textR">
					    <?php if($row->discount > 0){?>
                               <?php 
                               $price_new = $row->price - $row->discount;
                               ?>
                               <?php echo number_format($price_new)?> VND
	                       <p style='text-decoration:line-through'><?php echo number_format($row->price)?> đ</p>
                           <?php }else{?>
                                 <?php echo number_format($row->price)?> VND
                           <?php }?>
					</td>
					
					<td class="textC"><?php echo $row->quantity?></td>
					
                    <td class="textC"><?php echo $row->_amount?></td>
                    
                    <td class="status textC">
						<span class="<?php echo $row->_order_status; ?>">
						<?php echo $row->_order_status ?>
						</span>
					</td>
					
					
					<td class="status textC">
						<span class="<?php echo $row->_status; ?>">
						<?php echo $row->_status ?>
						</span>
					</td>
					
					
					
					<td class="textC"><?php echo mdate('%d-%m-%Y',$row->created)?></td>
					
				</tr>
			<?php endforeach;?>	
		</tbody>
</table>
		