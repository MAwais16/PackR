<div class="row">

    <div class="col-md-3">
        <img src="<?php
        echo PACKR_BASE_URL.'/public/images/vislog_logo.png'; ?>" class="img-responsive"/>
    </div>
    <div class="col-md-8 col-md-offset-1">
        <ul class="progress-indicator">

            <?php


            foreach ($steps as $item) {
                if($item[1]){
                    echo "<li class='completed'> <span class='bubble'></span>$item[0]</li>";
                }else{
                    echo "<li> <span class='bubble'></span>$item[0]</li>";
                }
            }
            
            ?>
        </ul>
    </div>
</div>
<br/>