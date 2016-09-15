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
					<p class="page_subtitle">YOUR REPORTS</p>
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


<script>
	$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<!-- get timezone -->
<!-- 
<script type="text/javascript" src="<?php echo base_url().'js/timezone.js' ?>">
</script>
<script type="text/javascript">
  $(document).ready(function(){
    var tz = jstz.determine();
    var timezone = tz.name();
    alert(timezone);
  });
</script> -->