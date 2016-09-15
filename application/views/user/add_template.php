    <link rel="stylesheet" href="<?php echo base_url();?>css/form-builder.css" type="text/css" media="screen" />
<script src="<?php echo base_url();?>js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/form-builder.js" ></script>
<style>
    .frmb a.del-button {
        border: 1px solid #fff;
        color: #000;
        display: inline-block;
        height: 12px;
        line-height: 13px;
        text-align: center;
        text-decoration: none;
        width: 11px;
    }
    .frmb a.del-button, .frmb a.remove {
        border-color: #b3b3b3;
        border-radius: 0 5px 0 0;
        display: inline-block;
        opacity: 0;
        padding: 3px 4px;
        position: absolute;
        right: -1px;
        top: -1px;
        box-sizing: content-box;
    }
    .active-tour #frmb-0-control-box li {
        background-color: unset;
        border: medium none;
    }
    h4{
        font-size: 14px;
    }
</style>

<div class="row" style="background-color: #f4f4f4; padding: 15px 10px">
    <div class="col-xs-12">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <p class="page_subtitle">ADD NEW TEMPLATE</p>
                   
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" style="margin-top: 30px">
    <div class="col-xs-12">
        <div class="container">
            <div class="row" >
                <div class="col-xs-12">
                    <form action="<?php echo base_url('templates/create/'); ?>" method="post">

                    <div class="content-inner row tour tour_4" style="margin-bottom: 20px">
                        <div class="col-md-2">
                            <h4 style="color: #666">Name of the Report</h4>
                        </div>
                       
                        <div class="col-md-7" style="">
                            <input type="text" class="form-control" value="" name="name" required="1" title="Report Name">
                        </div>

                    </div>
                    <div class="content-inner row">
                        <!--<div class="row">
                            <div class="col-md-10" style="background-color: <?php /*echo $color_one; */?>; color: white;"><h4 align="center">Form</h4></div>
                            <div class="col-md-2"  style="background-color: <?php /*echo $color_one; */?>; color: white;"><h4 align="center">Items</h4></div>
                        </div>-->
                        <div class="row" style="margin: 0">
                            <textarea name="fields"></textarea>
                        </div>
                    </div>
                    <div class="row content-inner">
                        <div class="col-md-2 col-md-offset-10" style="text-align: center">
                            <input class="btn" type="submit" value="Save and Assign Staff" style="background-color: #2c3e50; color: white">
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    var current_fields = [];
    
    jQuery(document).ready(function($) {
        'use strict';
        $('textarea').formBuilder();

        $("form").submit(function(){
            $("textarea").val($(".frmb").toXML());
        });

        /*task #4429*/
        $(".frmb-wrap").addClass('tour tour_5');
        $("#frmb-0-cb-wrap").addClass('tour tour_6');
    });

   
</script>