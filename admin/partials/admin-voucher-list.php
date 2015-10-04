<br/>
<br/>
<div class="container">
<table class="table-hover table-bordered table-condensed table-responsive" id="voucher-list">
	<thead>
		<tr>
		<?php
			echo "<th></th>";
			foreach ($columns as $key => $value) {
				echo "<th>$key</th>";
			}
		?>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach ($vouchers as $voucher) {
				echo "<tr>";
				?>
					<td>
						<form method="POST" action="#voucher-list" onsubmit="return confirm('Deleting this wouldnot delete it from orders. Are you sure you want to delete it?');">
							<input type="hidden" name="voucher_id" value="<?php echo $voucher->id; ?>"/>
							<input type="hidden" name="type" value="del"/>
							<button type="submit" class="btn btn-danger">Delete</button>
						</form>
					</td>

				<?php

				foreach ($columns as $key => $value) {
					echo "<td>";
					$val=$voucher->read_attribute($key);
					if(!is_string($val)&& !is_integer($val) && get_class($val)=="ActiveRecord\DateTime"){
						echo $val->format('Y-m-d H:i:s');
					}else{
						echo $val;
					};
					echo "</td>";
				}
				echo "</tr>";
			}
		?>
	</tbody>
</table>
</div>