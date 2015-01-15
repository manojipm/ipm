<section class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-push-3 col-sm-12 col-sm-push-0">

            </div>
            <?php echo $this->Form->create('Plan', array('url'=>array('controller' => 'men','action' => 'payment'), 'class' => 'form-horizontal form-bordered')); ?>
            <div class="row">
                <div class="col-md-3 col-md-pull-6 col-sm-6  col-sm-pull-0" style="width:40%;">
                    <div class="panel panel-primary">
                        
                        <div class="panel-body">
                            <ul class="girls-online-left">
                                <?php 
                                if(isset($plans) && !empty($plans)){
                                    foreach($plans as $plan){//pr($plan);
                                        if(isset($plan['Plan']['type']) && $plan['Plan']['type'] == 'Free'){
                                ?>
                                <li> 
                                    <table class="table-hover">
                                        <tr>
                                            <td style="width:161px;">
                                                <h5>
                                                    <input checked="checked" type="radio" name="data[Plan][id]" id="" value="" />
                                                    <a href="javascript:void(0);"> <?php echo ucfirst($plan['Plan']['title']);?> </a>
                                                </h5>
                                            </td>
                                            <td style="width:33px;">
                                                    <?php echo ($plan['Plan']['discount']) ? $plan['Plan']['discount'] : '0.00'; ?> % Off
                                            </td>
                                            <td colspan="2" style="width:185px;">
                                            You are a Free member now.
                                            <strong><?php echo $this->Html->link('Upgrade',array('controller'=>'men','action'=>'buy_credit'))?></strong>  to a new Plan !
                                                
                                            </td>
                                            
                                        </tr>
                                    </table>
                                </li>
                                     
                                <?php   }else{
                                ?>
                                <li> 
                                    <table class="table-hover">
                                        <tr>
                                            <td style="width:161px;">
                                                <h5>
                                                    <input type="radio" name="data[Plan][id]" id="plan-<?php echo $plan['Plan']['id'];?>" value="<?php echo $plan['Plan']['id'];?>" />
                                                    <a href="javascript:void(0);"> <?php echo ucfirst($plan['Plan']['title']);?> </a>
                                                </h5>
                                            </td>
                                            <td style="width:70px;">
                                                <p>
                                                    <?php echo ($plan['Plan']['discount']) ? $plan['Plan']['discount'] : '0.00'; ?> % 
                                                </p>Off
                                            </td>
                                            <td style="width:130px;">
                                                <p>
                                                <?php echo number_format($plan['Plan']['amount'], 2).' '.CURRENCY;?> 
                                                <?php echo $plan['Plan']['credits'];?>
                                                </p>
                                                credits
                                                
                                            </td>
                                            <td style="width:100px;">
                                                <p>
                                                <?php 
                                                if(isset($plan['Plan']['amount']) && !empty($plan['Plan']['amount']) && isset($plan['Plan']['credits']) && !empty($plan['Plan']['credits'])){
                                                    $division = ($plan['Plan']['amount']/$plan['Plan']['credits']);
                                                    $division = number_format($division, 2).' '.CURRENCY.' / credit';
                                                }
                                                echo isset($division) ? $division : '' ;

                                                ?>
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </li>
                                <?php  }
                                    }
                                } 
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class=" col-md-3 col-sm-6" style="  float: right;margin-top: -482px; width: 60%;">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <ul class="girls-online-left">
                                <li> 
                                    <table class="table-hover table-bordered">
                                        <tr>
                                            <td colspan="<?php echo count($plansArr);?>">
                                                <h3>
                                                   Membership Levels 
                                                </h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:135px;">
                                            </td>
                                            <?php 
                                                if(isset($plansArr) ){
                                                    foreach($plansArr as $value){
                                            ?>
                                            <td style="width:135px;">
                                                <h5>
                                                    <a href="javascript:void(0);" style="text-decoration: none;"> <?php echo ucfirst($value);?> </a>
                                                </h5>
                                            </td>
                                            <?php 
                                                    }
                                                }
                                            ?>
                                        </tr>
                                        <?php 
                                        if(isset($plansActivityArr)){
                                            foreach($plansActivityArr as $key => $value){ //pr($value)
                                        ?>
                                        <tr>
                                            <td style="width:180px;">
                                                    <?php echo $key;?>
                                            </td>
                                            <?php 
                                            if(isset($value)){
                                                foreach($value as $v){
                                            ?>
                                            <td style="width:135px;">
                                                    <?php echo $v;?>
                                            </td>
                                            <?php
                                                }
                                            } 
                                            ?>
                                            
                                        </tr>
                                        <?php 
                                            }
                                        } 
                                        
                                        ?>
                                    </table>
                                    
                                    
                                    
                                    
                                </li>
                                
                                    
                            </ul>
                            
                        </div>
                            
                    </div>
                    <div>
                        <span style="float: right;">
                          <?php echo $this->Form->input('Next',array('type'=>'submit','label'=>false,'class'=>'btn btn-default'));?>
                        </span>
                    </div>
                    
                </div>        
            </div>
            <?php echo $this->Form->end(); ?>
            
        </div>
    </div>
</section>