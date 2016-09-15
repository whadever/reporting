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
		<div class="row">
			<div class="col-xs-3 col-sm-2 col-md-1">
				<div class="avatar" style="background-color : grey ; ">
				</div>
				
			</div>
			<div class="col-xs-9 col-sm-10 col-md-11">
				<strong><p>Change Profile Picture</p>
				<input type="file"></strong>
			</div>
		</div>
		<div class="row" id="fields" style="padding-top:20px">	
			<div class="col-md-6">
				<div class="form-group">	
					<label for="">Name:</label>
					<input type="text" class="form-control">
				</div>
				<div class="form-group">	
					<label for="">Address:</label>
					<input type="text" class="form-control">
				</div>
				<div class="form-group">	
					<label for="">Phone No.:</label>
					<input type="text" class="form-control">
				</div>
				<div class="form-group">	
					<label for="">Mobile No.:</label>
					<input type="text" class="form-control">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">	
					<label for="">Usename:</label>
					<input type="text" class="form-control">
				</div>
				<div class="form-group">	
					<label for="">Password:</label>
					<a href="">Change Password</a>
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
						<a href="	" class="btn btn-primary form-control" style="border-radius:10px;">SAVE</a>
					</div>
				</div>
			</div>
			<div class="col-md-4">	</div>
		</div>
			
		</div>
	</div>
</div>