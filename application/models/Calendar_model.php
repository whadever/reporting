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
		        	<div>{day}</div>
		        	<div>{content}</div>
		        {/cal_cell_content}
		        {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

		        {cal_cell_no_content}{day}{/cal_cell_no_content}
		        {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

		        {cal_cell_blank}&nbsp;{/cal_cell_blank}

		        {cal_cell_other}{day}{/cal_cel_other}

		        {cal_cell_end}</td>{/cal_cell_end}
		        {cal_cell_end_today}</td>{/cal_cell_end_today}
		        {cal_cell_end_other}</td>{/cal_cell_end_other}
		        {cal_row_end}</tr>{/cal_row_end}

		        {table_close}</table>{/table_close}
			';

		}

		function generate($year,$month){
			

	        $this->load->library('calendar',$this->conf);

	        $red = 'red';

	        $data = array('<a class="content" data-toggle="tooltip" data-placement="top" title="Submitted on 2016-09-20" style="background-color:'.$red.'" href="">test1</a>',
	        	'<a class="content" data-toggle="tooltip" data-placement="top" title="Submitted on 2016-09-13" style="background-color:blue" href="">test2</a>');

	        $content = implode(' ',$data);

	        $data_cal = array(

	        		'20' => $content,

	        	);

	        return $this->calendar->generate($year,$month,$data_cal);
		}

	}

 ?>