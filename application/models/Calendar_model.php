<?php 
	
	class Calendar_model extends CI_Model{

		var $conf;

		function __construct(){
			parent::__construct();

			$this->conf = array(
            'start_day' => 'sunday',
            'show_next_prev' => true,
            'next_prev_url' => base_url('main/index/'),
            'day_type' => 'short'
            );

			$this->conf['template'] = '
				{table_open}<table border="0" cellpadding="0" cellspacing="0">{/table_open}

		        {heading_row_start}<tr>{/heading_row_start}

		        {heading_previous_cell}<th style="text-align:right" class="cal-header"><a href="{previous_url}"><i class="fa fa-caret-left fa-4x" aria-hidden="true"></i></a></th>{/heading_previous_cell}
		        {heading_title_cell}<th class="cal-header" colspan="{colspan}">{heading}</th>{/heading_title_cell}
		        {heading_next_cell}<th style="text-align: left" class="cal-header"><a href="{next_url}"><i class="fa fa-caret-right fa-4x" aria-hidden="true"></i></a></th>{/heading_next_cell}

		        {heading_row_end}</tr>{/heading_row_end}

		        {week_row_start}<tr>{/week_row_start}
		        {week_day_cell}<th class="calendar-day-head">{week_day}</th>{/week_day_cell}
		        {week_row_end}</tr>{/week_row_end}

		        {cal_row_start}<tr class="calendar-row">{/cal_row_start}
		        {cal_cell_start}<td class="calendar-day-np">{/cal_cell_start}
		        {cal_cell_start_today}<td class="today">{/cal_cell_start_today}
		        {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

		        {cal_cell_content}
		        	<div class="day-number">{day}</div>
		        	<div class="content-wrapper">{content}</div>
		        {/cal_cell_content}
		        {cal_cell_content_today}<div class="highlight day-number">{day}
		        	<div class="content-wrapper">{content}</div>{/cal_cell_content_today}

		        {cal_cell_no_content}<div class="day-number">{day}</div>{/cal_cell_no_content}
		        {cal_cell_no_content_today}<div class="highlight day-number">{day}</div>{/cal_cell_no_content_today}

		        {cal_cell_blank}&nbsp;{/cal_cell_blank}

		        {cal_cell_other}<div class="day-number">{day}</div>{/cal_cel_other}

		        {cal_cell_end}</td>{/cal_cell_end}
		        {cal_cell_end_today}</td>{/cal_cell_end_today}
		        {cal_cell_end_other}</td>{/cal_cell_end_other}
		        {cal_row_end}</tr>{/cal_row_end}

		        {table_close}</table>{/table_close}
			';

		}

		function generate($year,$month,$user_id){
			

	        $this->load->library('calendar',$this->conf);

	        $red = 'purple';

	        $this->db->select('form_submits.*,forms.name as report_name,forms.frequency,forms.report_color,users.name');
	        $this->db->from('form_submits');
	        $this->db->join('forms','forms.id = form_submits.form_id');
	        $this->db->join('users', 'users.id = form_submits.user_id');
	        $this->db->where('form_submits.user_id',$user_id);
	        $user_reports = $this->db->get()->result();

	        $data = array();

	        foreach($user_reports as $report){
	        	$date = explode(' ', $report->deadline);
	        	$date = explode('-', $date[0]);
	        	$report_year = $date[0];
	        	$report_month = $date[1];
	        	$report_day = $date[2];

	        	if($year == $report_year && $month == $report_month){
	        		$content = 'Not Submitted';
	        		if($report->submit_date != NULL){
	        			$content = 'submitted on '.$report->submit_date;
	        		}

	        		if(array_key_exists($report_day,$data)){
	        			array_push($data[$report_day],'<a class="content" data-toggle="tooltip" data-placement="top" title="'.$content.'" style="background-color:'.$report->report_color.'" href="">'.$report->report_name.'</a>');
	        			

	        		}else{
	        			$data[$report_day] = array('<a class="content" data-toggle="tooltip" data-placement="top" title="'.$content.'" style="background-color:'.$report->report_color.'" href="">'.$report->report_name.'</a>');
	        		}

	        		
	        	}


	        }
	       

	        $data_view = array();

	        if($data){
	        	foreach ($data as $day => $value) {
	        		$view = implode(' ',$value);
	        		$data_view[$day] = $view; 
	        	}
	        }

	        

	       

	        return $this->calendar->generate($year,$month,$data_view);
		}

	}

 ?>