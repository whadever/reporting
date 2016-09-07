<section id="content">
<div class="container">
	<!-- Other's Account Info -->
	
			
<table class="table table-bordered">
	<?php 
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

		//After 3 keys are bypassed user info are passed!
		?>
			<tr>
				<td>Id User</td>
				<td><?php echo $user['user_id']; ?></td>
			</tr>
			<tr>
				<td>Username</td>
				<td><?php echo $user['username']; ?></td>
			</tr>

	<?php
	}
	?>
</table>

	<!-- login -->
	<div class="row">
	<?php echo form_open('accounts/login') ?>
		
		<table class="table table-bordered">
			<tr>
				<td>Username</td>
				<td><input type="text" class="form-control" name="username"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" class="form-control" name="password"></td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" value="Sign In">
				</td>
			</tr>
		</table>

	<?php echo form_close() ?>
	</div>
</div>
</section>