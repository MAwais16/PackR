<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin/partials
 */
?>
<br/>
<br/>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="container">
<table class="table-hover table-bordered table-condensed table-responsive">
	<thead>
		<tr>
		<?php
			foreach ($columns as $key => $value) {
				echo "<th>$key</th>";
			}
		?>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach ($orders as $order) {
				echo "<tr>";
				foreach ($columns as $key => $value) {
					echo "<td>";
					$val=$order->read_attribute($key);
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