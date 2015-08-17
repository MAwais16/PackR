<form action="" method="POST">
	
	<div class="row">
		<h2>{{title}}</h2>
		<p>{{titleDescription}}</p>
	</div>
	
	<div class="row">
		<div class="col-md-10"><h4>{{titleAccount}}</h4></div>
	</div>

	<div class="row center-block">
		<div class="col-md-4">

			<div class="form-group {% if resp['email'][0] %}has-error{% endif %}">
				<label for="email">{{emailLabel}}</label>
				<input type="text" class="form-control" id="email" placeholder="Email" name="email" value="{% if not resp['email'][0] %}{{resp['email'][2]}}{% endif %}"/>
			</div>

		</div>

		<div class="col-md-4 col-md-offset-1">
			<div class="form-group {% if resp['password'][0] %}has-error{% endif %}">
				<label for="password">{{passwordLabel}}</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="{{passwordLabel}}"/>
			</div>

			<div class="form-group {% if resp['confirmPassword'][0] %}has-error{% endif %}">
				<label for="confirmPassword">{{confirmPasswordLabel}}</label>
				<input type="password" class="form-control" id="confirmPassword" placeholder="{{confirmPasswordLabel}}" name="confirmPassword"/>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="">
			<h3>{{title2}}</h3>
		</div>
		<br>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group {% if resp['companyName'][0] %}has-error{% endif %}">
						<label class="sr-only" for="companyName">{{companyNameLabel}}</label>
						<input type="text" class="form-control" id="companyName" name="companyName" placeholder="{{companyNameLabel}}" value="{% if not resp['companyName'][0] %}{{resp['companyName'][2]}}{% endif %}">
					</div>

					<div class="row">
						<div class="form-group col-md-6 {% if resp['firstName'][0] %}has-error{% endif %}">
							<label class="sr-only" for="firstName">{{firstNameLabel}}</label>
							<input type="text" class="form-control" id="firstName" name="firstName" placeholder="{{firstNameLabel}}" value="{% if not resp['firstName'][0] %}{{resp['firstName'][2]}}{% endif %}"/>
						</div>

						<div class="form-group col-md-6 {% if resp['lastName'][0] %}has-error{% endif %}">
							<label class="sr-only" for="lastName">{{lastNameLabel}}</label>
							<input type="text" class="form-control" id="lastName" name="lastName" placeholder="{{lastNameLabel}}" value="{% if not resp['lastName'][0] %}{{resp['lastName'][2]}}{% endif %}">
						</div>
					</div>

					<div class="form-group {% if resp['street'][0] %}has-error{% endif %}">
						<label class="sr-only" for="street">{{streetLabel}}</label>
						<input type="text" class="form-control" id="street" name="street" placeholder="{{streetLabel}}" value="{% if not resp['street'][0] %}{{resp['street'][2]}}{% endif %}">
					</div>

					<div class="row">
						<div class="form-group col-md-4 {% if resp['postalCode'][0] %}has-error{% endif %}">
							<label class="sr-only" for="postalCode">{{postalCodeLabel}}</label>
							<input type="text" class="form-control" id="postalCode" name="postalCode" placeholder="{{postalCodeLabel}}" value="{% if not resp['postalCode'][0] %}{{resp['postalCode'][2]}}{% endif %}"/>
						</div>

						<div class="form-group col-md-8 {% if resp['city'][0] %}has-error{% endif %}">
							<label class="sr-only" for="city">{{cityLabel}}</label>
							<input type="text" class="form-control" id="city" name="city" placeholder="{{cityLabel}}" value="{% if not resp['city'][0] %}{{resp['city'][2]}}{% endif %}"/>
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
						<label class="sr-only" for="extraAddress">{{extraAddLineLabel}}</label>
						<input type="text" class="form-control" id="extraAddress" name="extraAddress" placeholder="{{extraAddLineLabel}}" value="{% if not resp['extraAddress'][0] %}{{resp['extraAddress'][2]}}{% endif %}">
					</div>
				</div>
				<div class="col-md-4 col-md-offset-1">
					<h4>{{tittleMessageBox}}</h4>
					<textarea name="message" class="form-control">{{textArealabel}}</textarea>
				</div>
			</div>
		</div>
	</div>



	<div class="row">
		<div class="">
			<h3>{{title3}}</h3>
		</div>
		<br>
		
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">{{paymentM1}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group {% if resp['accountNumber'][0] %}has-error{% endif %}">
						<label class="sr-only" for="accountNumber">{{accountNumberLabel}}</label>
						<input type="text" class="form-control" id="accountNumber" name="accountNumber" placeholder="{{accountNumberLabel}}" value="{% if not resp['accountNumber'][0] %}{{resp['accountNumber'][2]}}{% endif %}">
					</div>
					<div class="form-group {% if resp['iban'][0] %}has-error{% endif %}">
						<label class="sr-only" for="iban">{{ibanLabel}}</label>
						<input type="text" class="form-control" id="iban" name="iban" placeholder="{{ibanLabel}}" value="{% if not resp['iban'][0] %}{{resp['iban'][2]}}{% endif %}">
					</div>
					<div class="form-group {% if resp['bic'][0] %}has-error{% endif %}">
						<label class="sr-only" for="bic">{{bicLabel}}</label>
						<input type="text" class="form-control" id="bic" name="bic" placeholder="{{bicLabel}}" value="{% if not resp['bic'][0] %}{{resp['bic'][2]}}{% endif %}"/>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">

		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label class="" for="ustID">{{foreignLic}}</label>
				<input type="text" class="form-control" id="ustID" name="ustID" placeholder="z.B AT2737489723xxx" value="{% if not resp['ustID'][0] %}{{resp['ustID'][2]}}{% endif %}"/>
			</div>
		</div>
		<div class="col-md-6">
			<input type="hidden" name="step" value="2"/>
		</div>
	</div>

	<br/>
	<div class="row">
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary">{{bt_submit}}</button>
		</div>
	</div>

</form>