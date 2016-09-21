<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap-select.css">
<script src="<?php echo base_url() ?>js/bootstrap-select.js"></script>


<div class="row" style="background-color: #f4f4f4; padding: 15px 10px">
	<div class="col-xs-12">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<p style="font-size: 16px; font-weight: 600; margin: 0; display: inline">SUBMIT REPORT</p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row" style="padding:15px 10px">
	<div class="col-xs-12">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
                    <div class="row">
    					<div class="col-md-6">
                            <select name="form_id" id="form_id" onchange="get_period()" class="form-control">
                                <option value="">Select Report</option>
                            <?php foreach($forms as $form) : ?>
                                
                                <option value="<?php echo $form->id ?>"><?php echo $form->name ?></option>
                            <?php endforeach; ?>
                            </select>
    					</div>
    					<div class="col-md-6">
                            <select name="submit_id" id="period" onchange="display_form()" required="1" class="form-control">
                                <option value="">Select Report Period</option>
                            
                            </select>               
                        </div>
                    </div>
				</div>
				<div class="col-md-6"></div>
			</div>
			<div class="row" id="form_fields">

            </div>
            <div class="row">
                <button type="button" class="btn btn-primary">Preview</button>
                <input type="submit" name="submit" value="Submit">
            </div>
		</div>
	</div>
</div>



<script>
    $(document).ready(function(){
        $('.selectpicker').selectpicker();
    });
</script>

<script>
    function get_period(){
        $('#form_fields').empty();
        var form_id = $('#form_id').val();


        if(form_id != ''){

            $.ajax({

                url :  "<?php echo base_url('form/get_period')?>"+ "/" + form_id,
                type : 'GET',
                cache : false,
                success: function(result){
                    

                    $('#period').empty();
                    $('#period').append(result);
                   
                }

            });

       }else{
            $('#period').empty();
            $('#period').append('<option value="">Select Report Period</option>');
       }
    }
</script>

<script>
    function display_form(){
        var form_id = $('#form_id').val();

        if(form_id != ''){

            $.ajax({

                url :  "<?php echo base_url('form/print_fields')?>"+ "/" + form_id,
                type : 'GET',
                cache : false,
                success: function(result){

                    $('#form_fields').empty();
                    $('#form_fields').append(result);
                   
                }

            });

       }else{
            $('#form_fields').empty();
       }
    }
</script>