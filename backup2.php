<h1>Generate Coupons</h1>
<form  id="coupon_form"  >
  <label for="fname">coupon name</label><br>
  <input type="text" id="coupon" name="coupon_name"><br>
  <h2>Coupon Settings</h2>
  <fieldset>
    <legend>General</legend><br>
    <label for="fname">Allowed Uses</label>
    <input type="number" id="allowed_uses" name="allowed_uses" min="0"><br><br>
    <label for="lname">Expiring Date</label>
    <input type="date" id="expiring_date" name="expiring_date"><br><br>
    <label for="birthday">Billing Cycles</label>
    <input type="number" id="cycles" name="cycles"><br><br>
    <?php wp_nonce_field( 'coupon_nonce_action','coupon_nonce' ); ?>
  </fieldset>
  <fieldset>
    <legend>Plan & Frequency Limitation Options</legend><br>
    <label for="vehicle1">Free  </label>
    <input type="checkbox" id="free" name="plan" value="122"><span>the Coupon to be used with this Plan</span><br><br>
    <label for="vehicle1">Basic</label>
    <input type="checkbox" id="basic" name="plan" value="153"><span>the Coupon to be used with this Plan</span><br><br>
    <label for="vehicle1">Standard</label>
    <input type="checkbox" id="standard" name="plan" value="51"><span>the Coupon to be used with this Plan</span><br><br>
    <label for="vehicle1">Premium</label>
    <input type="checkbox" id="premium" name="plan" value="52"><span>the Coupon to be used with this Plan</span><br><br>
    <label for="vehicle1">Monthly</label>
    <input type="checkbox" id="monthly" name="frequency_lo" value="1"><span>the Coupon to be used with this Plan</span><br><br>
    <label for="vehicle1">Quarterly</label>
    <input type="checkbox" id="quarterly" name="frequency_lo" value="3"><span>the Coupon to be used with this Plan</span><br><br>
    <label for="vehicle1">Yearly</label>
    <input type="checkbox" id="yearly" name="frequency_lo" value="12"><span>the Coupon to be used with this Plan</span><br><br>
  </fieldset>
  <h2>Coupon value</h2>
  <label for="birthday">Ennter Coupon Value</label>
    <input type="number" id="value" name="value"><br><br>
  <input type="submit" name="submit"  id="submit" value="Submit">
</form> 

<script>
jQuery(document).ready(function($){
    $('#submit').click(function(event){
      event.preventDefault();
      var all_data = new FormData("#coupon_form");

      $.ajax({
    url: ajaxurl,
    type : 'POST',
    data: {
        action     : 'my_action', // load function hooked to: "wp_ajax_*" action hook
        data : all_data
    },
    success: function(res){
      console.log(res);
    
  

    }
});

    })
   

  });
</script>


