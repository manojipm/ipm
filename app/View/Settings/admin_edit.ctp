<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Settings
        </h1>
        <ol class="breadcrumb">
			<?php
            $this->Html->addCrumb('Dashboard', array('admin'=>true,'controller'=>'dashboards','action'=>'index'));
            $this->Html->addCrumb('Admin Setting');
            echo $this->Html->getCrumbs('  > ');
            ?>
        </ol>
    </section>
	 <?php echo $this->Session->flash(); ?>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-9">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Settings</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php echo $this->Form->create('Setting'); ?>
                        <div class="box-body">
                         <?php
						 foreach($datas as $data){
							 
						 ?>  
                            <div class="form-group">
                             <label><?php echo ucwords(str_replace('_',' ',$data['Setting']['key']));?> <span>(Required Field)</span></label>
								
                               <?php
							   if($data['Setting']['key'] == 'google_analytics_code'){
							   ?> 
                               <textarea rows="5" class="form-control" id="" name="<?php echo $data['Setting']['key']?>[]"><?php echo $data['Setting']['value']?></textarea>
                               <?php
							   }else{
							   ?>
                                <input type="text" class="form-control" name="<?php echo $data['Setting']['key']?>[]" id="" required="required" value="<?php echo $data['Setting']['value']?>" />
                                <?php
							   }
								?>
                                <input type="hidden" class="form-control" name="<?php echo $data['Setting']['key']?>[]" id="" value="<?php echo $data['Setting']['id']?>" />
                            	
                                
                            </div>
                           <?php						   
						 	}						 
						 	?>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                           
                            <?php	echo $this->Form->submit('Submit',array('class' => 'btn btn-primary', 'title' => 'Submit','div'=>false));?>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div><!--/.col (left) -->
            
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->