
<!-- Second row with version -->
<br/>
<form action="" method="POST">

    <div class="row">
        <div><h2 class="col-md-12"><?php _e("Your order overview",$this->plugin_name);?></h2></div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-6">
            <h4><?php _e("Billing Address",$this->plugin_name);?></h4>
            <div><?php echo $_SESSION['PackR_companyName']; ?></div>
            <div><?php echo $_SESSION['PackR_firstName']." ".$_SESSION['PackR_lastName']; ?></div>
            <div><?php echo $_SESSION['PackR_street']; ?></div>
            <div><?php echo $_SESSION['PackR_postalCode']." ".$_SESSION['PackR_city']." ".$_SESSION['PackR_country']; ?></div>
            <div><?php echo $_SESSION['PackR_extraAddress'];?></div>
            <br/>
            <div>
                <b>Email</b>:<?php echo $_SESSION['PackR_email']; ?>
            </div>
        </div>
    </div>
    <br/>

    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><?php _e("Product",$this->plugin_name);?></th>
                        <th><?php _e("Price",$this->plugin_name);?></th>
                        <th><?php _e("Tax",$this->plugin_name);?></th>
                        <th><?php _e("Total Price",$this->plugin_name);?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>

                            <div class="col-md-2">
                                <img src="<?php echo $imgSrc; ?>"/>
                            </div>
                            <div class="col-md-2">
                                <h4><?php echo $package;?></h4>
                                <small><?php echo $package." ".__("version subscription for one year",$this->plugin_name);?></small>
                                <p><?php //_e("Your order overview",$this->plugin_name);?></p>
                            </div>

                            <!-- <div class="media">
                              <div class="media-left">
                                <a href="#">
                                    <img src="{{productImageSrc}}"/>
                                </a>
                            </div>
                            <div class="media-body">
                                <h5 class="media-heading">{{productVal}}</h5>
                                <small>{{productVal1}}</small>
                                <p>{{productVal2}}</p>
                            </div>
                        </div> -->
                    </td>
                    <td><?php echo $price." €";?></td>
                    <td><?php echo $tax." %";?></td>
                    <td><?php echo $price." €";?></td>
                </tr>

                <tr>
                    <th colspan="3" class="text-right"><?php _e("Total Net",$this->plugin_name);?></th>
                    <td><?php echo $price." €";?></td>
                </tr>

                <tr>
                    <th colspan="3" class="text-right"><?php _e("plus $tax % vat",$this->plugin_name);?></th>
                    <td><?php echo $taxPrice." €";?></td>
                </tr>

                <tr class="active">
                    <th colspan="3" class="text-right"><?php _e("Total Gross",$this->plugin_name);?></th>
                    <td><?php echo $price+$taxPrice." €";?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</br>


<div class="row">
    <h4><?php _e("Payment",$this->plugin_name);?></h4>
    <div class="checkbox">
        <label>
          <input type="checkbox" name="sepa" value="sepa"/><?php _e("I Agree to ",$this->plugin_name);?><a href=""> <?php _e("SEPA Terms & Conditions",$this->plugin_name);?> </a>
      </label>
  </div>
</div>

<div class="row">
    <div class="checkbox">
        <label>
          <input type="checkbox" name="terms" value="terms"/> <?php _e("I Agree to ",$this->plugin_name);?> <a href="/termsandconditions"><?php _e("Terms & Conditions",$this->plugin_name);?></a>
      </label>
  </div>
</div>

<div class="row">
    <div class="checkbox">
        <label>
            <input type="checkbox" name="privacy" value="privacy"/> <?php _e("I Agree to ",$this->plugin_name);?> <a href="/privacypolicy"> <?php _e("privacy policy",$this->plugin_name); ?> </a>
        </label>
    </div>
</div>

<br/>
<div>
    <button type="submit" class="btn btn-primary"><?php _e("Confirm & Finish",$this->plugin_name);?></button>
</div>

</form>

