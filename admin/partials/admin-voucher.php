<br/>
<br/>

<div class="container bg-info" style="padding:5px;">

	<h2>Vouchers</h2>

	<?php
		
		if($resp["isError"]){
			echo "<div class='bg-danger'><p>".$resp['errorDescription']."</p></div>";
		}
	?>

	<form action="" method="POST">
		
		<div class="row">

			<div class="col-md-7">
				<div class="form-group">
					<label class="" for="voucher_code"><?php _e('Voucher Code',$this->plugin_name);?></label>
					<input type="text" class="form-control" id="voucher_code" name="voucher_code" placeholder="<?php _e('Voucher Code',$this->plugin_name);?>" value="">
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<label class="" for="voucher_count"><?php _e('Voucher count',$this->plugin_name);?></label>
					<input type="text" class="form-control" id="voucher_count" name="voucher_count" placeholder="10" value="">
				</div>
			</div>

		</div>
		
		<div class="row">
			<div class="col-md-5">
				<div class="form-group">
					<label class="" for="voucher_description_basic"><?php _e('Basic Package Description',$this->plugin_name);?></label>
					<input type="text" class="form-control" id="voucher_description_basic" name="voucher_description_basic" placeholder="<?php _e('Description to display for basic package for this voucher',$this->plugin_name);?>" value="">
				</div>
			</div>

			<div class="col-md-5">
				<div class="form-group">
					<label class="" for="voucher_description_professional"><?php _e('Professional Package Description',$this->plugin_name);?></label>
					<input type="text" class="form-control" id="voucher_description_professional" name="voucher_description_professional" placeholder="<?php _e('Description to display for professional package for this voucher',$this->plugin_name);?>" value="">
				</div>
			</div>

		</div>

		<div class="row">
			<div class="col-md-10">
				<input type="hidden" name="type" value="save"/>
				<button type="submit" class="btn btn-default"><?php _e('save',$this->plugin_name);?></button>
			</div>
		</div>

	</form>
</div>