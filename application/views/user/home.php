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
     
	option {
		padding: 6px 12px;
	}
	
	#cal-body td {
		border: 1px solid gray;
		height: 100px;
		margin: 2px;
		padding: 18px 8px 8px;
		position: relative;
		vertical-align: top;
		width: 14.28%;
	}
	#cal-body td.today{
		border: 2px solid #cc1618;
	}
	.day-number {
		color: #cc1618;
		left: 2px;
		position: absolute;
		top: 0;
	}
	.status-complete{
		color: green;
	}
	.status-overdue{
		color: red;
	}
	.status-ontheway{
		color: #fab800;
	}
	#cal-body{
		
		margin-top: 20px;
	}
	#cal-body th{
		text-align:center;

	}
	#cal-body table{
		width: 100%;
	}
	#cal-body .content {
	    border-radius: 10px;
	    display: block;
	    width: 110px;
	    padding-left: 5px;
	    color: white;
	    margin-top: 5px;
	}

	a:hover{
		text-decoration: none;
	}
	
	.cal-header .fa {
		font-size: 44px;
	}
	.cal-header {
		font-size: 30px;
	}

	.cal-header a{
		color: black;
	}
	.cal-header a:hover{
		text-decoration: none;
		color: black;
	}

	.calendar-row li {
		border-bottom: 1px dashed;
		list-style: none;
		color: black;
	}
	.calendar-row li:hover {
		cursor: pointer;
	}
	.calendar-row li:last-child {
		border: medium none;
	}
	table.calendar{
		border-collapse: separate;
	}
	#my-tasks:focus {
		outline: medium none;
	}
	#my-tasks{
		color:#fab800 !important;
		font-size: 24px
	}
	#my-tasks.active{
		color:white !important;
	}
	div.jquery-gdakram-tooltip div.content {
		background-color: white;
		border: 5px solid #671329;
		border-radius: 1em;
		float: left;
		min-height: 200px;
		padding: 10px;
		width: 280px;
		color: black;
	}
	div.jquery-gdakram-tooltip div.content h1 {
		border-bottom: 1px solid #c4c4c4;
		font-size: 14px;
		margin-top: 8px;
		padding-bottom: 5px;
	}
	#overlay {
		background-color: #000;
		background-image: url("<?php echo base_url(); ?>images/ajax-loading.gif");
		background-position: 50% center;
		background-repeat: no-repeat;
		height: 100%;
		left: 0;
		opacity: 0.5;
		position: fixed;
		top: 0;
		width: 100%;
		z-index: 10000;
	}
	.ui-datepicker-calendar {
		display: none;
	}
	.calendar-row li.overdue{
		color: red;
	}
	.calendar{
		width: 100%;
	}
	.calendar-day-head{
		text-align: center;
		background-color: #f4f4f4;
		padding: 10px;
		border: 1px solid #BBB;
	}
</style>

<div class="row" style="background-color: #f4f4f4; padding: 15px 10px">
	<div class="col-xs-12">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<p style="font-size: 16px; font-weight: 600; margin: 0; display: inline">Your Reports</p>
					<input type="text" class="search pull-right form-control" name="name_search" placeholder="Search report by name" style="margin-right: 0">
					<input type="text" class="search pull-right form-control" name="date_search" placeholder="Search report by date">
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div id="cal-body" class="wrap">
					<?php echo $calendar ?>
				</div>
			</div>
		</div>
			
		</div>
	</div>
</div>


<!-- <script>
	var dt = new Date();
	var month = dt.getMonth()+1, year = dt.getFullYear();
	var base_url = '<?php echo base_url(); ?>';

	$(document).ready(function(){

		load_calendar();

    });

    function load_calendar(){
		$("#cal-body").load(base_url + 'main/get_calendar/'+month+"/"+year);
	}

</script> -->

<script>
	$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>