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
					<div class="col-md-6">
                        <select name="" id="" class="selectpicker">
                        <?php foreach($forms as $form) : ?>
                            <option value="">Select Report</option>
                            <option value=""><?php echo $form->name ?></option>
                        <?php endforeach; ?>
                        </select>
					</div>
					<div class="col-md-6">
                        <select name="" id="" class="selectpicker">
                        <?php foreach($forms as $form) : ?>
                            <option value="">Select Report Period</option>
                            <option value=""></option>
                        <?php endforeach; ?>
                        </select>               
                    </div>
				</div>
				<div class="col-md-6"></div>
			</div>
			<!-- <div class="row">
				<div class="col-md-6">
					<?php print_fields($form_fields, 1); ?>
				</div>
				<div class="col-md-6">
					<?php print_fields($form_fields, 2); ?>
				</div>
			</div> -->
			
		</div>
	</div>
</div>

<?php
function print_fields($form_fields, $col){
?>

    <?php foreach($form_fields as $field): ?>
        <?php if($field->column == $col): ?>
            <?php $required = ($field->required == 1) ? "required" : "";?>
            <div class="form-group">
                <label class="field-label <?php echo $required; ?>" for="field_<?php echo $field->id; ?>"><?php echo $field->title; ?></label>

                <?php if($field->type == 'text'): ?>
                    <textarea name="field_<?php echo $field->id; ?>" class="form-control" id="" placeholder="" <?php echo $required; ?>></textarea>
                <?php endif; ?>

                <?php if($field->type == 'select'): ?>
                    <select name="field_<?php echo $field->id; ?>"  class="form-control">
                        <?php if($required == ""): ?>
                            <option value="">---select---</option>
                        <?php endif; ?>
                        <?php foreach($field->select_options as $val): ?>
                            <option value="<?php echo $val; ?>"> <?php echo $val; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>

                <?php if($field->type == 'date'): ?>
                    <input type="text" name="field_<?php echo $field->id; ?>" class="form-control date" id="" placeholder="" <?php echo $required; ?>>
                <?php endif; ?>

                <?php if($field->type == 'radio-group-yes-no-na'): ?>

                    <input type="radio" name="field_<?php echo $field->id; ?>" value="yes"> Yes
                    <input type="radio" name="field_<?php echo $field->id; ?>" value="no"> No
                    <input type="radio" name="field_<?php echo $field->id; ?>" value="na"> N/A

                <?php endif; ?>

                <?php if($field->type == 'numbers'): ?>

                    <select name="field_<?php echo $field->id; ?>" class="form-control">
                        <?php if($required == ""): ?>
                            <option value="">---select---</option>
                        <?php endif; ?>
                        <?php for($i=0; $i <= 100; $i++ ): ?>
                            <option value="<?php echo $i; ?>"> <?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>

                <?php endif; ?>

                <?php if($field->type == 'document'): ?>
                    <input type="file" name="field_<?php echo $field->id; ?>" class="" id="" <?php echo $required; ?>>
                <?php endif; ?>


            </div>
        <?php endif; ?>
    <?php endforeach; ?>

<?php
}
?>

<script>
    $(document).ready(function(){
        $('.selectpicker').selectpicker();
    });
</script>
