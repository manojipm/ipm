<section class="main">
    <div class="container">

      <div class="row">
        <div class="col-sm-12">
		  <h1>Introduction Letter</h1>
          <div class="login-cell">
            <?php $user_id = $this->Session->read('Auth.User.id');
				echo $this->Form->create('Introletter', array('type' => 'file', 'class' => 'row man-register'));
				echo $this->Form->input('Introletter.user_id', array('type' => 'hidden', 'value'=>$user_id)); 
				echo $this->Form->input('Introletter.id', array('type' => 'hidden')); 
			?>
              <div class="form-group col-sm-12 col-lg-12">
                <label class="control-label" for="email">Title <span>*</span></label>
                <div class="controls">
                  <?php echo $this->Form->input('Introletter.title', array('label' => false,'required' => true, 'div' => false, 'class' => 'form-control')); ?>
                </div>
              </div>
			  
			  
              <div class="form-group  col-sm-12 col-lg-12">
                <label class="control-label" for="password">Description <span>*</span></label>
                <div class="controls">
				<?php echo $this->Form->textarea('Introletter.description', array('label' => false,'required' => true, 'rows' => 20, 'div' => false, 'class' => 'form-control')); ?>
                </div>
              </div>
			  
			  
              <div class="form-group col-sm-12">
                <div class="form-actions">
                  <button class="btn btn-primary pull-right" type="submit">Submit</button>
                </div>
              </div>
			  
			  
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>