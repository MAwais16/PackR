
<!-- Second row with version -->
<br/>
<form action="" method="POST">
    <div class="row">
        <div class="col-md-8">
            <h4><?php _e("Which version of vislog you would like to you use?",$this->plugin_name); ?></h4></div>
            <div class="" style="float:right;margin-right:100px;"> 
                <div class="price_badge">
                    <p class="price" style="font-size:14px;left-margin:20px;margin-top:15px;"><?php _e("from",$this->plugin_name);?></p>
                    <p class="price" style="font-size:25px;top:-10px;position:relative;"><?php _e("39 €",$this->plugin_name);?></p>
                </div>

            </div>
            <div style="clear:right;"></div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-4 col-md-offset-1 ">
                <div class="panel panel-default package">
                    <div class="panel-heading text-center">
                        <h3 class="panel-title">Basic</h3>
                    </div>
                    <div class="panel-body packImg">
                        <img src="<?php echo PACKR_BASE_URL. '/public/images/basic.png'; ?>" class="img-responsive center-block"/>
                    </div>
                    <table class="table text-center">
                        <tr class="bg-info"><td><?php _e("€ 39 net / month",$this->plugin_name);?></td></tr>
                        <tr><td><?php _e("Interactive Map",$this->plugin_name);?></td></tr>
                        <tr><td><?php _e("Order Management",$this->plugin_name);?></td></tr>
                        <tr><td><?php _e("Marketplace",$this->plugin_name);?></td></tr>
                        <tr><td><?php _e("Communication",$this->plugin_name);?></td></tr>
                        <tr><td><?php _e("Up to 5 contacts (outgoing)",$this->plugin_name);?></td></tr>
                        <tr><td><?php _e("Up to 5 contacts (inbound)",$this->plugin_name);?></td></tr>
                    </table>
                    <div class="panel-footer">
                        <div class="radio-wrapper">
                            <input type="radio" name="package" value="basic" id="radio-basic"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1">
                <div class="panel panel-default package">
                    <div class="panel-heading text-center">
                        <h3 class="panel-title">Professional</h3>
                    </div>
                    <div class="panel-body packImg">
                       <img src="<?php echo PACKR_BASE_URL . '/public/images/professional.png'; ?>" class="img-responsive center-block"/>
                    </div>
                    <table class="table text-center">
                        <tr class="bg-info"><td><?php _e("€ 69 net / month",$this->plugin_name);?></td></tr>
                        <tr><td><?php _e("Interactive Map",$this->plugin_name);?></td></tr>
                        <tr><td><?php _e("Order Management",$this->plugin_name);?></td></tr>
                        <tr><td><?php _e("Marketplace",$this->plugin_name);?></td></tr>
                        <tr><td><?php _e("Communication",$this->plugin_name);?></td></tr>
                        <tr><td><?php _e("Unlimited contacts (outgoing)",$this->plugin_name);?></td></tr>
                        <tr><td><?php _e("Unlimited contacts (inbound)",$this->plugin_name);?></td></tr>
                    </table>
                    <div class="panel-footer">
                        <div class="radio-wrapper">
                            <input type="radio" name="package" value="professional" id="radio-professional"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" value="1" name="step"/>
        <br/>
        <!-- Third Row -->
        <div class="row bg-info">
            <div class='col-md-1'>
            </div>
            <div class='col-md-11 '>
                <h4><?php _e("Period of Validity",$this->plugin_name);?>:</h4>
                <p><?php _e("The subscription is initially for one year and will be automatically extended for another year unless written notice is given within 3 months before year ends",$this->plugin_name);?></p>
            </div>
        </div>

        <br/>
        <div class="row bg-info">
            <h4><?php _e("Details",$this->plugin_name);?></h4>
            <div class="col-md-2"><?php _e("Voucher:",$this->plugin_name);?></div>
            <div class="col-md-2">
                <input class="form-control" id="voucher_code" name="voucher_code" type="text" placeholder='<?php _e("Enter voucher code",$this->plugin_name);?>' />
            </div>
            <div class="col-md-2">
                <button class="btn" onclick="return PackR.onVoucherSubmit();" id="bt_voucher"><?php _e("Add Voucher",$this->plugin_name);?></button>
            </div>
            <br/>
            <br/>
            <div class="col-md-12 voucher_result">
                <br/>
            </div>
        </div>
        <br/>
        <div class="row">
            <button type='submit' class="btn btn-primary"><?php _e("Go to Address & Payment",$this->plugin_name);?></button>
        </div>

    </form>