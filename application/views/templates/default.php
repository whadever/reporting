<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> <?php echo $title ?> | Reporting System</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url() ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url() ?>css/custom.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>js/bootstrap.min.js"></script>

    <!-- CSS and Javascript -->
    <style>
    body{
      font-family: 'helvetica', sans-serif !important;
    }

    .sidenav {
        height: 100%; /* 100% Full-height */
        width: 40px; /* 0 width - change this with JavaScript */
        position: fixed; /* Stay in place */
        z-index: 1; /* Stay on top */
        top: 0;
        left: 0;
        background-color: #5c5c5c; /* Black*/
        color: #fff;
        overflow-x: hidden; /* Disable horizontal scroll */
        padding-top: 20px; /* Place content 60px from the top */
        transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */

    }

    /* The navigation menu links */
    .sidenav a {
        padding: 8px 17px 5px 12px;
        text-decoration: none;
        font-size: 16px !important;
        color: #fff;
        display: block;
        transition: 0.3s;
        
    }

    /* When you mouse over the navigation links, change their color */
    .sidenav a:hover, .offcanvas a:focus{
      background-color: rgba(236, 240, 241,0.5);
        color: #f1f1f1;
    }

    /* Position and style the close button (top right corner) */
    .closebtn{
        position: absolute;
        top: 0;
        right: 15px;
        margin-left: 50px;
    }
    .closebtn:hover{
      background-color: transparent!important;
      color: red !important;
    }

    /* Style page content - use this if you want to push the page content to the right when you open the side navigation */
    #main {
        transition: margin-left .5s;
        padding: 0px;
        margin-left: 30px;
    }

    /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
    @media screen and (max-height: 450px) {
        .sidenav {padding-top: 15px;}
        .sidenav a {font-size: 18px;}
    }

    /*#menu-button{
      
      background-color: transparent;
      border: none;
      border-radius: 5px;
      margin-left: 12px;
      margin-bottom: 10px;

      

    }

    #menu-button:hover{
      background-color: rgba(236, 240, 241,0.5);
      -webkit-transition: all 1s ease;
      -moz-transition: all 0.6s ease;
      -ms-transition: all 0.6s ease;
      -o-transition: all 0.6s ease;
      transition: all 0.6s ease;
    }
*/
    #background-btn{

      padding-top: 10px;
      padding-bottom: 10px;
      padding-left: 0;
      padding-right: 0;

    }
    .bottom-align-text {
      position: absolute;
      bottom: 0;
      width: 100%;
      font-size: 11px;
      line-height: 11px;
      display: none;
    }
    .bottom-align-text-2 {
      position: absolute;
      bottom: 0;
      width: 100%;
      font-size: 11px;
      margin-bottom: 35px;
      line-height: 11px;
      display: none;
    }
    #mySidenav .fa{
      font-size: 19px;
    }
    
    

  </style>
  </head>
  <body>
    <div class="container-fluid">
      <div id="mySidenav" class="sidenav" >
       <a id="menu-button" onclick="openNav()" style="cursor:pointer"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
        <div class="company_logo" style="display:none;margin-bottom: 10px; padding-left: 15px; padding-bottom:20px; border-bottom:7px solid #000">
          <img src="<?php echo base_url()?>assets/william_platform_logo.png" width="100px" style="margin-left:15%;">
        </div>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" style="border-bottom: none;font-size:25px!important; display:none">&times;</a>
        <a href="<?php echo base_url('') ?>"><i class="fa fa-home" aria-hidden="true"></i><span class="menu-text pull-right" style="display:none">Home</span></a>
        <a href="<?php echo base_url('') ?>"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i><span class="menu-text pull-right" style="display:none">Submit</span></a>
        <a href="<?php echo base_url('') ?>"><i class="fa fa-file-text" aria-hidden="true"></i><span class="menu-text pull-right" style="display:none">Template</span></a>
        <a href="<?php echo base_url('') ?>"><i class="fa fa-cogs" aria-hidden="true"></i><span class="menu-text pull-right" style="display:none">Settings</span></a>
        <a href="<?php echo base_url('') ?>"><i class="fa fa-question" aria-hidden="true"></i><span class="menu-text pull-right" style="display:none">FAQ and How</span></a>
        <a href="<?php echo base_url('') ?>"><i class="fa fa-headphones" aria-hidden="true"></i><span class="menu-text pull-right" style="display:none">Customer Service</span></a>
        <div class="bottom-align-text-2 text-center">Williams Business Solutions Reporting System V1.0</div>
        <div class="bottom-align-text text-center">For help and feedback contact office@williamsbusiness.co.nz</div>
      </div>

       <div id="main" >
          
             
           <div class="row" style="padding: 30px 20px 20px 20px; text-align:right">
             <div class="col-xs-12">
                
                <a class="pull-right" style="height: 50px; width: 50px; border-radius: 10px; background: url('<?php echo base_url() ?>assets/123.jpg')"></a>
                <p class="pull-right" style="margin-right: 10px; font-size: 18px">Welcome to Reporting System,<br><?php echo 'John' ?></p>
             </div>
           </div>

          
              <?php echo $body ?>
           
          
      </div>
    </div>
    
     <script>
    /* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
      function openNav() {
          document.getElementById("mySidenav").style.width = "200px";
          document.getElementById("main").style.marginLeft = "200px";
          
          
          $('.menu-text').show();
          $('.company_logo').show();
          $('#menu-button').hide();
          $('.closebtn').show();
          $('.bottom-align-text').show();
          $('.bottom-align-text-2').show();

      }

      /* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
      function closeNav() {
          document.getElementById("mySidenav").style.width = "40px";
          document.getElementById("main").style.marginLeft = "30px";

          $('.menu-text').hide();
          $('.company_logo').hide();
          $('#menu-button').show();
          $('.closebtn').hide();
          $('.bottom-align-text').hide();
          $('.bottom-align-text-2').hide();
      }
  </script>
  </body>
</html>