<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=transaction.xls");
header("Pragma: no-cache");
header("Expires: 0");
?> 
<table>
		<thead>
			<tr>
				<td>STT</td>
				<td style="width:60px;">ID</td>
					<td>Amount</td>
					<td>Payment Gate</td>
					<td>Status</td>
					
					<td style="width:75px;">Date created</td>
			
			</tr>
		</thead>
		
		<tbody class="list_item">
		        
		        <?php foreach ($list as $k => $row):?>
			      <tr class='row_<?php echo $row->id?>'>
			      <td class="textC"><?php echo $k + 1?></td>
					
					<td class="textC"><?php echo $row->id?></td>
					
					<td>
					  <?php echo number_format($row->amount)?>VND				
					 </td>
				    <td><?php echo $row->payment?></td>
					<td>
					<?php 
					if($row->status == 0)
					{
					    echo 'NOT PAY YET';
					}elseif ($row->status == 1)
					{
					    echo 'PAY SUCCESSFULLY';
					}else{
					    echo 'FAILED';
					}
					?>
					</td>
					
					
					<td class="textC"><?php echo get_date($row->created)?></td>
					
				</tr>
			<?php endforeach;?>	
		</tbody>
</table>
		