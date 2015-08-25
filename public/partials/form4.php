<br/>
<div class="row jumbotron">
	<h2><?php _e("Thank you!",$this->plugin_name);?></h2>
	<p><?php 

	_e("Dear ",$this->plugin_name);
	echo $_SESSION['PackR_firstName']." ".$_SESSION['PackR_lastName'];
	_e(" thank you for your subscription.",$this->plugin_name);
	
	?></p>
</div>