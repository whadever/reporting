<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap-select.css">
<script src="<?php echo base_url() ?>js/bootstrap-select.js"></script>

<style>
	#fields{
		margin-top:20px;
	}

	#fields .form-control{
		border-radius: 10px;
		border:1px solid black;
	}

</style>

<div class="row" style="background-color: #f4f4f4; padding: 15px 10px">
	<div class="col-xs-12">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<p style="font-size: 16px; font-weight: 600; margin: 0; display: inline">ASSIGN AND FREQUENCY</p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_open_multipart('templates/staff_add/') ?>
<div class="row" style="padding:15px 10px">
	<div class="col-xs-12">
		<div class="container">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="row" id="fields">
						<div class="col-md-3">
							<label for="">REPORT NAME</label>
						</div>
						<div class="col-md-9">
							<input disabled type="text" name="report_name" value="<?php echo $form->name ?>" class="form-control">
						</div>
					</div>
					<div class="row" id="fields">
						<div class="col-md-3">
							<label for="">ASSIGN STAFF(s)</label>
						</div>

						<div class="col-md-9">
							<select name="staffs[]" class="multiselect" id="staffs" multiple>
							<?php foreach($staffs as $staff): ?>
				                <option value="<?php echo $staff->id; ?>" <?php echo (in_array($staff->id,$form_users)) ? "selected" : ""; ?>><?php echo $staff->name; ?></option>

				            <?php endforeach; ?>
				            </select>
						</div>
					</div>
					<div class="row" id="fields">
						<div class="col-md-3">
							<label for="">FREQUENCY</label>
						</div>
						<div class="col-md-9">
						<strong>
							<input type="radio" name="report_frequency" value="daily"> DAILY <br>
							<input type="radio" name="report_frequency" value="weekly"> WEEKLY <br>
							<input type="radio" name="report_frequency" value="fortnightly"> FORTNIGHTLY <br>
							<input type="radio" name="report_frequency" value="monthly"> MONTHLY <br>
							<input type="radio" name="report_frequency" value="yearly"> YEARLY <br>
							<input type="radio" name="report_frequency" value="custom"> CUSTOM DATE <br>
						</strong>
						</div>
					</div>
					<div class="row" id="fields">
						<div class="col-md-3">
							<label for="">DEADLINE</label>
						</div>
						<div class="col-md-9">
							<input type="time" name="deadline" class="form-control">
						</div>
					</div>
					<div class="row" id="fields">
						<div class="col-md-3">
							<label for="">NOTIFY MANAGERS</label>
						</div>
						<div class="col-md-9">
							<select name="managers[]" class="multiselect" id="managers" multiple>
							<?php foreach($managers as $manager): ?>
				                <option value="<?php echo $manager->id; ?>" <?php echo (in_array($manager->id,$form_users)) ? "selected" : ""; ?>><?php echo $manager->name; ?></option>

				            <?php endforeach; ?>
				            </select>
						</div>
					</div>
				</div>
				<div class="col-md-2"></div>
			</div>
			<div class="row" style="padding-top:50px;">	
				<div class="col-md-4">	</div>
				<div class="col-md-4">
					<div class="row">
						<div class="col-md-2"></div>	
						<div class="col-md-8">
							<input type="hidden" name="manager_id" value="<?php echo $form->manager_id ?>">	
							<input type="hidden" name="form_id" value="<?php echo $form->id ?>">
							<input type="submit" name="save" value="SAVE" class="btn btn-primary form-control" style="border-radius:10px;">
						</div>
						<div class="col-md-2"></div>
					</div>
				</div>
				<div class="col-md-4">	</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close() ?>
<script>
	$(document).ready(function(){
        $('.multiselect').selectpicker();
   	});
</script>