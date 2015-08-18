<div class="container-fluid">
	
	
	<?php
	//requires $error, $errorDescription, $response array; 

	if ($error){
		?>
		<div class="alert alert-danger" role="alert">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<span class="sr-only">Error:</span>
			<?php
			if($resp){
				?>
			<ul><?php
			foreach ($resp as $key => $value) {
				if($value[0]){
					echo "<li>".$key." is ".$value[1]."</li>";
				}
			}
			?>
		</ul>
		<?php
	}else{
		echo $errorDescription;
	}
	echo "</div>";
}

//$steps required
require_once("header-row.php");

require_once ($form);

require_once("footer-row.php");


?>

</div>