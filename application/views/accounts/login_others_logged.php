<div class="row" style="margin-top:10%;" >
	<div class="col-md-6" id="logo-login" style="min-height:400px;border-right: 2px solid #FFF">
		<?php if($this->session->userdata('user_logged')){
                        $i = 0;
                        foreach ($this->session->userdata as $user)
                        { 
                          //Skip the first 3 keys
                          if($i < 3)
                          {
                            $i++;
                            continue;
                          }else
                          {
                            $i++;
                          }
                          $profile = $this->crud_model->get_by_condition('users',array('id' => $user['user_id']))->row();
                          //After 3 keys are bypassed user info are passed!
                          
                          
                          if($profile->photo == ''){
                            $photo = base_url()."uploads/photos/no-photo.png";
                          }else{
                            $photo = base_url().$profile->photo; 
                          }
                       


                            echo"<a href='".base_url('accounts/switch_account/'.$profile->id)."' style='display:block'><img src='".$photo."' width='50'><div style='display:inline-block'><p>".$profile->name."</p><p>".$profile->email."</p> </div></a>";

                        
                        }

                      } ?>
                      
	</div>
	<div class="col-md-6" style="padding: 10% 2%">
		<div style="background: padding: 6% 2%; border-radius: 4px">
			<form action="<?php echo base_url('accounts/login') ?>" method="post">
				<div class="form-group">
					<div class="input-group">
						
						<span class="input-group-addon" id="username-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
						<input type="text" name="username" placeholder="Username" class="form-control" aria-describedby="username-addon">

					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						
						<span class="input-group-addon" id="username-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
						<input type="password" name="password" placeholder="Password" class="form-control" aria-describedby="username-addon">

					</div>
				</div>

				<div class="form-group">
					<input type="submit" class="btn btn-default form-control" name="login" value="LOGIN">
				</div>

			</form>

			<a class="pull-right" href="">Forgot password?</a>
		</div>
	</div>
</div>