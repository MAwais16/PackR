<form action="" method="POST">
	
	<div class="row">
		<h2><?php _e("Address & Payment",$this->plugin_name);?></h2>
		<p><?php _e("Please fill in your billing, address and your payment details.",$this->plugin_name);?></p>
	</div>
	
	<div class="row">
		<div class="col-md-10"><h4><?php _e("Account",$this->plugin_name);?></h4></div>
	</div>

	<div class="row center-block">
		<div class="col-md-4">

			<div class="form-group <?php if($resp['email'][0]){echo "has-error";}?>">
				<label for="email"><?php _e("Email",$this->plugin_name);?></label>
				<input type="text" class="form-control" id="email" placeholder="Email" name="email" value="<?php if(!$resp['email'][0]){echo $resp['email'][2];}?>"/>
			</div>
		</div>

		<div class="col-md-4 col-md-offset-1">
			<div class="form-group <?php if($resp['username'][0]){echo "has-error";}?>">
				<label for="username"><?php _e("Username",$this->plugin_name);?></label>
				<input type="username" class="form-control" id="username" name="username" placeholder="username" value="<?php if(!$resp['username'][0]){echo $resp['username'][2];}?>"/>
			</div>
		</div>

	</div>

	<div class="row">
		<div class="">
			<h3><?php _e("Billing and Shipping Address",$this->plugin_name);?></h3>
		</div>
		<br>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group <?php if($resp['companyName'][0]){echo "has-error";}?>">
						<label class="sr-only" for="companyName"><?php _e('Company Name',$this->plugin_name);?></label>
						<input type="text" class="form-control" id="companyName" name="companyName" placeholder="<?php _e('Company Name',$this->plugin_name);?>" value="<?php if(!$resp['companyName'][0]){echo $resp['companyName'][2];}?>">
					</div>

					<div class="row">
						<div class="form-group col-md-6 <?php if($resp['firstName'][0]){echo "has-error";}?>">
							<label class="sr-only" for="firstName"><?php _e('First Name',$this->plugin_name);?></label>
							<input type="text" class="form-control" id="firstName" name="firstName" placeholder="<?php _e('First Name',$this->plugin_name);?>" value="<?php if(!$resp['firstName'][0]){echo $resp['firstName'][2];}?>"/>
						</div>

						<div class="form-group col-md-6 <?php if($resp['lastName'][0]){echo "has-error";}?>">
							<label class="sr-only" for="lastName"><?php _e('Last Name',$this->plugin_name);?></label>
							<input type="text" class="form-control" id="lastName" name="lastName" placeholder="<?php _e('Last Name',$this->plugin_name);?>" value="<?php if(!$resp['lastName'][0]){echo $resp['lastName'][2];}?>">
						</div>
					</div>

					<div class="form-group <?php if($resp['street'][0]){echo "has-error";}?>">
						<label class="sr-only" for="street"><?php _e('Street Address',$this->plugin_name);?></label>
						<input type="text" class="form-control" id="street" name="street" placeholder="<?php _e('Street Address',$this->plugin_name);?>" value="<?php if(!$resp['street'][0]){echo $resp['street'][2];}?>">
					</div>

					<div class="row">
						<div class="form-group col-md-4 <?php if($resp['postalCode'][0]){echo "has-error";}?>">
							<label class="sr-only" for="postalCode"><?php _e('Postal Code',$this->plugin_name);?></label>
							<input type="text" class="form-control" id="postalCode" name="postalCode" placeholder="<?php _e('Postal Code',$this->plugin_name);?>" value="<?php if(!$resp['postalCode'][0]){echo $resp['postalCode'][2];}?>"/>
						</div>

						<div class="form-group col-md-8 <?php if($resp['city'][0]){echo "has-error";}?>">
							<label class="sr-only" for="city"><?php _e('City',$this->plugin_name);?></label>
							<input type="text" class="form-control" id="city" name="city" placeholder="<?php _e('City',$this->plugin_name);?>" value="<?php if(!$resp['city'][0]){echo $resp['city'][2];}?>"/>
						</div>
					</div>

					
					<select name="country" class="form-control">
						<option value="DE">Deutschland</option>
						<option value="AT">Österreich</option>
						<option value="CH">Schweiz</option>
						<option value="BE">Belgien</option>
						<option value="DK">Dänemark</option>
						<option value="EE">Estland</option>
						<option value="FI">Finnland</option>
						<option value="FR">Frankreich</option>
						<option value="IE">Irland</option>
						<option value="IT">Italien</option>
						<option value="HR">Kroatien</option>
						<option value="LI">Liechtenstein</option>
						<option value="LU">Luxemburg</option>
						<option value="NL">Niederlande</option>
						<option value="SE">Schweden</option>
						<option value="CZ">Tschechische Republik</option>
						<option value="HU">Ungarn</option>
					</select>

					<br/>
					
					<div class="form-group">
						<label class="sr-only" for="extraAddress"><?php _e('Extra address line (Optional)',$this->plugin_name);?></label>
						<input type="text" class="form-control" id="extraAddress" name="extraAddress" placeholder="<?php _e('Extra address line (Optional)',$this->plugin_name);?>" value="<?php if(!$resp['extraAddress'][0]){echo $resp['extraAddress'][2];}?>">
					</div>
				</div>
				<div class="col-md-4 col-md-offset-1">
					<h4><?php _e('Message',$this->plugin_name);?></h4>
					<textarea name="message" class="form-control"><?php _e('Your message here',$this->plugin_name);?></textarea>
				</div>
			</div>
		</div>
	</div>



	<div class="row">
		<div class="">
			<h3><?php _e('Payment',$this->plugin_name);?></h3>
		</div>
		<br>
		
		<div class="col-md-4">
			<div class="">
				<h4 class=""><?php _e('SEPA Direct Debit',$this->plugin_name);?></h4>
				<div class="">
					<div class="form-group <?php if($resp['accountOwner'][0]){echo "has-error";}?>">
						<label class="sr-only" for="accountOwner"><?php _e('Account Owner',$this->plugin_name);?></label>
						<input type="text" class="form-control" id="accountOwner" name="accountOwner" placeholder="<?php _e('Account Owner',$this->plugin_name);?>" value="<?php if(!$resp['accountOwner'][0]){echo $resp['accountOwner'][2];}?>">
					</div>
					<div class="form-group <?php if($resp['iban'][0]){echo "has-error";}?>">
						<label class="sr-only" for="iban"><?php _e('IBAN',$this->plugin_name);?></label>
						<input type="text" class="form-control" id="iban" name="iban" placeholder="<?php _e('IBAN',$this->plugin_name);?>" value="<?php if(!$resp['iban'][0]){echo $resp['iban'][2];}?>">
					</div>
					<div class="form-group <?php if($resp['bic'][0]){echo "has-error";}?>">
						<label class="sr-only" for="bic"><?php _e('BIC',$this->plugin_name);?></label>
						<input type="text" class="form-control" id="bic" name="bic" placeholder="<?php _e('BIC',$this->plugin_name);?>" value="<?php if(!$resp['bic'][0]){echo $resp['bic'][2];}?>"/>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">

		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<h4><?php _e('UST-IdNr. (for foreign corporate clients)',$this->plugin_name);?></h4>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label class="sr-only" for="ustID"><?php _e('UST-IdNr. (for foreign corporate clients)',$this->plugin_name);?></label>
				<input type="text" class="form-control" id="ustID" name="ustID" placeholder="z.B AT2737489723xxx" value="<?php if(!$resp['ustID'][0]){echo $resp['ustID'][2];}?>"/>
			</div>
		</div>
		
	</div>
	<input type="hidden" value="<?php echo $sepaRefNum;?>" name="sepaRefNum" />
	<br/>
	<div class="row">
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary"><?php _e('Proceed to Order Summary',$this->plugin_name);?></button>
		</div>
	</div>

</form>