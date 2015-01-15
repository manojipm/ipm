<section class="main">
   
    
    <div class="container">

        <?php echo $this->Form->create('Payment', array('class' => 'form-horizontal')); ?>
        <?php echo $this->Form->input('Payment.plan_id', array('type' => 'hidden', 'label' => false, 'div' => false, 'value' => $plan_id)); ?>
        <div class="row">
            <div class="container">
                <fieldset>
                    <legend><h1>Upgrade by Paying Here!</h1></legend>

                    <div class="col-md-4 ">
                        <fieldset>
                            <legend><h4>Billing Address</h4></legend>


                            <div class="form-group ">
                                <label class="col-sm-3 control-label" for="Street">Street : <span>*</span></label>
                                <div class="col-sm-9">
                                    <?php echo $this->Form->input('Payment.street', array('label' => false, 'class' => 'form-control', 'required' => true, 'div' => false, 'class' => 'form-control')); ?>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-sm-3 control-label" for="Country">Country : <span>*</span></label>
                                <div class="col-sm-9">
                                    <?php echo $this->Form->input('Payment.country', array('options' => $this->Common->getCountryList(),"style"=>"width:250px;", 'class' => 'select2-me', 'required' => true, 'empty' => 'Please Select one', 'selected' => COUNTRY_CODE, 'label' => false, 'div' => false, 'onchange' => 'selectCity(this.options[this.selectedIndex].value)')); ?>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-sm-3 control-label" for="State">State : <span>*</span></label>
                                <div class="col-sm-9">
                                    <?php echo $this->Form->input('Payment.state', array('options' => $this->Common->getStateList(),"style"=>"width:250px;",  'class' => 'select2-me', 'required' => true, 'empty' => 'Please Select one', 'label' => false, 'div' => false, 'id' => 'state_dropdown', 'onchange' => 'selectState(this.options[this.selectedIndex].value)',)); ?>
                                    <span id="state_loader"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label" for="City">City : <span>*</span></label>
                                <div class="col-sm-9">
                                    <?php echo $this->Form->input('Payment.city', array('label' => false, 'class' => 'form-control', 'required' => true, 'div' => false)); ?>                        
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="Zip">Zip : <span>*</span></label>
                                <div class="col-sm-9">
                                    <?php echo $this->Form->input('Payment.zip', array('label' => false, 'class' => 'form-control', 'required' => true, 'div' => false)); ?>                      
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-4 col-md-offset-4">
                        
                            <fieldset>
                                <legend><h4>Credit and Debit Card</h4></legend>

                                <div class="form-group">
                                    <label class="control-label" for="CardType">Card Type : <span>*</span></label>
                                    <div class="controls ">
                                        <?php
                                        echo $this->Form->input('Payment.card_type', array(
                                            'options' => array(
                                                'Visa' => 'Visa',
                                                'MasterCard' => 'Master Card',
                                                'Discover' => 'Discover',
                                                'Amex' => 'Amex',
                                                'Maestro' => 'Maestro',
                                            ),
                                            "style"=>"width:250px;", 
                                            'required' => true,
                                            'class' => 'select2-me',
                                            'empty' => 'Select Card Type',
                                            'label' => false,
                                            'div' => false
                                                )
                                        );
                                        //col-lg-12 col-md-12 col-sm-4 col-xs-12
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="FirstName">Cardholder's Firstname : <span>*</span></label>
                                    <div class="controls">
                                        <?php echo $this->Form->input('Payment.first_name', array('label' => false, 'class' => 'form-control', 'required' => true, 'div' => false)); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="LastName">Cardholder's Lastname : <span>*</span></label>
                                    <div class="controls">
                                        <?php echo $this->Form->input('Payment.last_name', array('label' => false, 'class' => 'form-control', 'required' => true, 'div' => false)); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="CardNumber">Card Number # : <span>*</span></label>
                                    <div class="controls">
                                        <?php echo $this->Form->input('Payment.card_number', array('size' => "20", 'label' => false, 'class' => 'form-control', 'required' => true, 'div' => false)); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="CsvNumber">Card Verification # : <span>*</span></label>
                                    <div class="controls">
                                        <?php echo $this->Form->input('Payment.CVV2', array('size' => "4", 'label' => false, 'class' => 'form-control', 'required' => true, 'size' => 4, 'div' => false)); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="ExpDate">Expiration Date :  <span>*</span></label>
                                    <div class="controls">
                                        <?php echo $this->Form->input('Payment.exp_date', array('type' => 'date',"style"=>"width:120px;",  'empty' => false, 'label' => false, 'class' => 'select2-me', 'required' => true, 'div' => false, 'dateFormat' => 'MY')) ?>
                                    </div>
                                </div>

                                                    <div class="form-group">
                                                        <label class="control-label" for="DialCode">Dial Code : <span>*</span></label>
                                                        <div class="controls">
                                <?php echo $this->Form->input('Payment.dial_code', array('label' => false, 'class' => 'form-control', 'required' => true, 'div' => false)); ?>
                                                        </div>
                                                    </div>
                                <div class="form-group">
                                    <label class="control-label" for="Phone">Phone : <span>*</span></label>
                                    <div class="controls">
                                        <?php echo $this->Form->input('Payment.phone', array('label' => false, 'class' => 'form-control mask_phone', 'required' => true, 'div' => false)); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="Terms">&nbsp;</label>
                                    <div class="controls">
                                        <?php echo $this->Form->input('Payment.terms', array('type' => 'checkbox', 'checked' => 'checked', 'required' => true, 'label' => false, 'div' => false)); ?>
                                        Terms and Conditions.
                                        <a class='terms_and_conditions' href="#terms_and_conditions" style="text-decoration: none;">Click here.</a>
                                    </div>
                                </div>
                                <?php echo $this->Form->input('Pay', array('type' => 'submit', 'label' => false, 'class' => 'form-control', 'style' => 'float:right;', 'class' => 'btn btn-default')); ?>
                            </fieldset>
                        
                    </div>
                </fieldset>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>

    </div>
    
    
    
    
<!--    <div class="container">
    <div class='row'>
        <div class='col-md-4'>
            
            
        </div>
        <div class='col-md-4'>
          <script src='https://js.stripe.com/v2/' type='text/javascript'></script>
          <form accept-charset="UTF-8" action="/" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="pk_bQQaTxnaZlzv4FnnuZ28LFHccVSaj" id="payment-form" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="?" /><input name="_method" type="hidden" value="PUT" /><input name="authenticity_token" type="hidden" value="qLZ9cScer7ZxqulsUWazw4x3cSEzv899SP/7ThPCOV8=" /></div>
            <div class='form-row'>
              <div class='col-xs-12 form-group required'>
                <label class='control-label'>Name on Card</label>
                <input class='form-control' size='4' type='text'>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-xs-12 form-group card required'>
                <label class='control-label'>Card Number</label>
                <input autocomplete='off' class='form-control card-number' size='20' type='text'>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-xs-4 form-group cvc required'>
                <label class='control-label'>CVC</label>
                <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
              </div>
              <div class='col-xs-4 form-group expiration required'>
                <label class='control-label'>Expiration</label>
                <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
              </div>
              <div class='col-xs-4 form-group expiration required'>
                <label class='control-label'> </label>
                <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-md-12'>
                <div class='form-control total btn btn-info'>
                  Total:
                  <span class='amount'>$300</span>
                </div>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-md-12 form-group'>
                <button class='form-control btn btn-primary submit-button' type='submit'>Pay »</button>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-md-12 error form-group hide'>
                <div class='alert-danger alert'>
                  Please correct the errors and try again.
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class='col-md-4'></div>
    </div>
</div>-->
    
    
    
    
    
    <!--------- terms_and_conditions  ----------->
    <div style='display:none'>
        <div id='terms_and_conditions' style='padding:10px; background:#fff;'>
            <div class="box box-bordered box-color">
                <div class="box-title">
                    <h3><i class="icon-th-list"></i> Terms and Conditions</h3>
                </div>
                <div class="box-content nopadding">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
                    , nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio., nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
                    , nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
                    , nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
                </div>
            </div>
        </div>
    </div>
    <!--------- terms_and_conditions  ----------->


</section>
<?php
//echo $this->Html->css(array('plugins/colorbox/colorbox'));
//echo $this->Html->script(array(
//'jquery-min-2.0.2',
//'jquery-migrate-1.2.1.min',
//'plugins/colorbox/jquery.colorbox'
// )
//);
?>
<script>

</script>
<script type="text/javascript">
    function selectCity(country_id) {
        if (country_id != "-1") {
            loadData('state', country_id);
            $("#city_dropdown").html("<option value='-1'>Select city</option>");
        } else {
            $("#state_dropdown").html("<option value='-1'>Select state</option>");
            $("#city_dropdown").html("<option value='-1'>Select city</option>");
        }
    }

    function selectState(state_id) {
        if (state_id != "-1") {
            loadData('city', state_id);
        } else {
            $("#city_dropdown").html("<option value='-1'>Select city</option>");
        }
    }

    function loadData(loadType, loadId) {
        var dataString = 'loadType=' + loadType + '&loadId=' + loadId;
        $("#" + loadType + "_loader").show();
        $("#" + loadType + "_loader").fadeIn(400).html('Please wait... <?php echo $this->Html->image('loading1.gif'); ?>');
        $.ajax({
            type: "POST",
            url: "<?php echo Router::url(array('controller' => 'men', 'action' => 'get_state_city')); ?>",
            data: dataString,
            cache: false,
            success: function (result) {
                $("#" + loadType + "_loader").hide();
                $("#" + loadType + "_dropdown").html("<option value='-1'>Select " + loadType + "</option>");
                $("#" + loadType + "_dropdown").append(result);
            }
        });
    }
</script>
