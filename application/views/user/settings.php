<style>
	.avatar{
	  border-radius: 10px;
	  border: 1px solid black;
	  height:60px; 
	  width:60px; 
	  background-size:cover;
	  background-position: center center; 
	}

	#fields .form-control{
		width: 60%;
		display: inline-block;
		border:1px solid black;
		border-radius: 10px;
	}

	#fields label{
		width: 25%;
	}
</style>

<div class="row" style="background-color: #f4f4f4; padding: 15px 10px">
	<div class="col-xs-12">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<p style="font-size: 16px; font-weight: 600; margin: 0; display: inline">SETTINGS</p>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="row" style="padding:15px 10px">
	<div class="col-xs-12">
		<div class="container">
		<?php echo form_open_multipart('user/save_settings/'.$users->id) ?>
		<div class="row">
			<div class="col-xs-3 col-sm-2 col-md-1">
				<div class="avatar" style="background-image : url(<?php echo base_url().$users->photo ?>); ">
				</div>
				
			</div>
			<div class="col-xs-9 col-sm-10 col-md-11">
				<strong><p>Change Profile Picture</p>
				<input type="file" name="photo"></strong>
			</div>
		</div>
		
		<div class="row" id="fields" style="padding-top:20px">	
			
			<div class="col-md-6">
				<div class="form-group">	
					<label for="">Name</label>
					<input type="text" class="form-control" name="name" value="<?php echo $users->name ?>">
				</div>
				<div class="form-group">	
					<label for="">Address</label>
					<input type="text" class="form-control" name="address" value="<?php echo $users->address ?>">
				</div>
				<div class="form-group">	
					<label for="">Phone No.</label>
					<input type="text" class="form-control" name="phone_number" value="<?php echo $users->phone_number ?>">
				</div>
				<div class="form-group">	
					<label for="">Mobile No.</label>
					<input type="text" class="form-control" name="mobile_number" value="<?php echo $users->mobile_number ?>">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">	
					<label for="">Username</label>
					<input type="text" class="form-control" name="username" value="<?php echo $users->username ?>" disabled="disabled">
				</div>
				<div id="changepassword">	
					
					<a onclick="change_password()" style="cursor:pointer;">Change Password</a>
				</div>
			</div>

		</div>
		<div class="row" style="padding-top:50px;">	
			<div class="col-md-4">	</div>
			<div class="col-md-4">
				<div class="row">	
					<div class="col-md-6">	
						<a href="	" class="btn btn-primary form-control" style="border-radius:10px;">BACK</a>
					</div>
					<div class="col-md-6">	
						<input type="submit" name="save" value="SAVE" class="btn btn-primary form-control" style="border-radius:10px;">
					</div>
				</div>
			</div>
			<div class="col-md-4">	</div>
		</div>
		<?php echo form_close() ?>
			
		</div>
	</div>
</div>
<script>
	function change_password(){
		$('#changepassword').empty();
		$('#changepassword').append('<div class="form-group"><label for="old_pass">Old Password</label> <input type="text" class="form-control" name="old_pass"></div><div class="form-group"><label for="new_pass">New Password</label> <input type="text" name="new_pass" class="form-control"></div><div class="form-group"><label for="re_pass">Re-Type Password</label> <input type="text" class="form-control" name="re_pass"></div>');
	}
	function check_password(){
		var password = $("#old_pass").val();
	}
</script>