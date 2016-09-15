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
							<input type="text" name="report_name" class="form-control">
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
							<input type="time" class="form-control">
						</div>
					</div>
					<div class="row" id="fields">
						<div class="col-md-3">
							<label for="">NOTIFY MANAGERS</label>
						</div>
						<div class="col-md-9">
							<input type="text" class="form-control">
						</div>
					</div>
				</div>
				<div class="col-md-2"></div>
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
		</div>
	</div>
</div>