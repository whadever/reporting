<section id="content">
<div class="container">
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