<style>
	.search{
		display: inline;
		margin-left: 10px;
		width: 200px;
		
	}
	input::-webkit-input-placeholder { /* WebKit, Blink, Edge */
          color:    #000 !important;
          font-size: 10px !important;
          margin-left: 3px !important;
      }
      input:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
         color:    #000 !important;
         opacity:  1 !important;
         font-size: 10px !important;
         margin-left: 3px !important;
      }
      input::-moz-placeholder { /* Mozilla Firefox 19+ */
         color:    #000 !important;
         opacity:  1 !important;
         font-size: 10px !important;
         margin-left: 3px !important;
      }
      input:-ms-input-placeholder { /* Internet Explorer 10-11 */
         color:    #000 !important;
         font-size: 10px !important;
         margin-left: 3px !important;
      }
     
</style>

<div class="row" style="background-color: #f4f4f4; padding: 15px 10px">
	<div class="col-xs-12">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<p style="font-size: 16px; font-weight: 600; margin: 0; display: inline">Report Templates</p>
					<input type="text" class="search pull-right form-control" name="name_search" placeholder="Search report by name" style="margin-right: 0">
					<input type="text" class="search pull-right form-control" name="date_search" placeholder="Search report by date">
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row" style="margin-top: 5%">
	<div class="col-xs-12">
		<div class="container">
			<div class="row">
				<div class="col-xs-12" style="padding: 0 5%">
					<button class="btn btn-danger pull-right" style="padding: 5px;font-size: 12px; margin-left: 5px">Deactivate Report Temporary</button>
					<a class="pull-right" style="font-size: 16px" href="<?php echo base_url('templates/add_template') ?>">+ Add Template</a>
					<table class="table">
						<thead>
							<tr style="background-color: #F4F4F4;border: 2px solid #F4F4F4; font-weight:bold">
								<th>Name</th>
								<th>Created By</th>
								<th>Staff</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody style="border: 2px solid #ddd">
							<?php foreach($forms as $form): ?>
							<tr>
								<td width="35%"><?php echo $form->name ?></td>
								<td width="20%"><?php echo $form->manager_name ?></td>
								<td width="25%"><?php echo implode('<br>',$form_staffs[$form->id]) ?></td>
								<td width="20%">edit copy delete</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
						

					</table>
				</div>
			</div>
		</div>
	</div>
</div>