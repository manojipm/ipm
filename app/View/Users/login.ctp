<section class="main">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h1>Login Here !</h1>
          <div class="login-cell">
           <?php echo $this->Form->create('User',array('class'=>'form-horizontal')); ?>
			
			<span class="message"><?php echo $this->Session->flash();  ?></span>
			<?php 
				// Check Remeber username and password
				if(isset($_COOKIE["username"]) && !empty($_COOKIE["username"]) && isset($_COOKIE["password"]) && !empty($_COOKIE["password"])){
					$this->request->data['User']['email'] = $_COOKIE["username"];
					$this->request->data['User']['password'] = $_COOKIE["password"];
					$this->request->data['User']['remember'] = 1;
				}
			?>
				
			   <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-2 control-label" for="email">Email id</label>
                  <div class="col-md-4">
					<?php  echo $this->Form->input('email',array('id'=>'email', 'class'=>'form-control input-md', 'label'=>false,'placeholder'=>'Enter email address here...','type'=>'email',  "required"));   ?>
                  </div>
                </div>
                
                <!-- Password input-->
                <div class="form-group">
                  <label class="col-md-2 control-label" for="password">Password</label>
                  <div class="col-md-4">
					<?php  echo $this->Form->input('password',array('label'=>false,'id'=>'password','placeholder'=>'Enter your password here...','type'=>'password', 'class'=>'form-control input-md', "required"));   ?>
                  </div>
                </div>
                
                <!-- Multiple Checkboxes (inline) -->
                <div class="form-group">
                  <label class="col-md-2 control-label" for="checkboxes"></label>
                  <div class="col-md-4">
                    <label class="checkbox-inline" for="checkboxes-0">
						<?php  echo $this->Form->input('remember',array('hiddenField'=>false,'id'=> "checkboxes-0", 'label'=>false,'div'=>false,'type'=>'checkbox', ));   ?>
                      Remember Me </label>
                  </div>
                </div>
                
                <!-- Button -->
                <div class="form-group">
                  <label class="col-md-2 control-label" for="loginbutton"></label>
                  <div class="col-md-4">
                    <button id="loginbutton" name="loginbutton" class="btn btn-primary">Login</button>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="loginbutton"></label>
                  <div class="col-md-4">
                    <a href="#">Forgot Password</a>
                  </div>
                </div>
   
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>