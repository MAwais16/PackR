<br/>
<div class="sepaInner">
	<div class="container-fluid">


		<div class="row">
			<p><b><?php _e("Mandate reference",$this->plugin_name);?>:</b> <?php echo $sepaRefNum; ?></p>
			<p><b><?php _e("Creditor identifier",$this->plugin_name);?>:</b> DE83ZZZ00001786476</p>
		</div>
		<br>

		<address class="row">
			NETVAI UG (haftungsbeschränkt)<br/>
			Schauenburgerstr. 116<br/>
			24118 Kiel<br/>
			Deutschland
		</address>
		<br>  
		<div class="row">
			<p>
				<?php
				_e("By signing this mandate form, you authorise (A) NETVAI UG to send instructions to your bank to debit your account and (B) your bank to debit your account in accordance with the instructions from NETVAI UG.",$this->plugin_name);
				?>
			</p>
		</div>
		<div class="row">
			<p>
				<?php

				_e("This mandate is only intended for business to business transactions. You are not entitled to a refund from your bank after your account has been debited, but you are entitled to request your bank not to debit your account up until the day on which the payment is due.",$this->plugin_name);
				?>
			</p>
		</div>

		<br/>
		<div class="row">
			<div class="col-md-6 packrBold">
				<?php _e("Name of the debtor",$this->plugin_name);?>
			</div>
			<div class="col-md-4">
				<?php echo $_SESSION['PackR_companyName'];?>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 packrBold">
				<?php _e("SWIFT BIC",$this->plugin_name);?>
			</div>
			<div class="col-md-4">
				<?php echo $_SESSION['PackR_bic'];?>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 packrBold">
				<?php _e("Account number IBAN",$this->plugin_name);?>
			</div>
			<div class="col-md-4">
				<?php 
			if(strlen($_SESSION['PackR_iban'])>2){ //add actual iban length check later 
				echo "************".substr($_SESSION['PackR_iban'],strlen($_SESSION['PackR_iban'])-2,strlen($_SESSION['PackR_iban']));
			}
			?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 packrBold">
			<?php _e("Street",$this->plugin_name);?>
		</div>
		<div class="col-md-4">
			<?php echo $_SESSION['PackR_street'];?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 packrBold">
			<?php _e("Postal code and city",$this->plugin_name);?>
		</div>
		<div class="col-md-4">
			<?php echo $_SESSION['PackR_postalCode'].", ".$_SESSION['PackR_city'];?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 packrBold">
			<?php _e("Country",$this->plugin_name);?>
		</div>
		<div class="col-md-4">
			<!-- should add country no country code -->
			<?php echo $_SESSION['PackR_country'];?> 
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 packrBold">
			<?php _e("Person signing",$this->plugin_name);?>
		</div>
		<div class="col-md-4">
			<?php echo $_SESSION['PackR_firstName']." ".$_SESSION['PackR_lastName'];?>
		</div>
	</div>	

	<div class="row">
		<div class="col-md-6 packrBold">
			<?php _e("City or town of signing",$this->plugin_name);?>
		</div>
		<div class="col-md-4">
			<?php echo $_SESSION['PackR_city'];?>
		</div>
	</div>	

	<div class="row">
		<div class="col-md-6 packrBold">
			<?php _e("Type of payment",$this->plugin_name);?>
		</div>
		<div class="col-md-4">
			<?php _e("Recurrent payment",$this->plugin_name);?>
		</div>
	</div>	


	<div class="row">
		<div class="col-md-6 packrBold">
			<?php _e("Date",$this->plugin_name);?>
		</div>
		<div class="col-md-4">
			<?php echo date("F j, Y");?>
		</div>
	</div>	

	<br/>
	<div class="row">
		<p>
			<i>
				<?php _e("Approved by",$this->plugin_name); 
				echo " ".$_SESSION['PackR_email'];
				?>
			</i>
		</p>
	</div>

</div>
</div>

<div>
		<div class="checkbox">
			<label>
				<!-- on change function hooked in js -->
				<input type="checkbox" name="" value="" style="width:auto;height:auto;" id="cb_pop_sepa"/> 
				<?php _e("I certify that the above information is correct and that I am authorized to sign for the above mentioned bank account.. I give NETVAI UG the authorization to debit the above mentioned bank account.",$this->plugin_name);?> 
			</label>
		</div>
	</div>