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
        background-image: url("<?php echo base_url().'assets/123.jpg' ?>");
        background-position: center;
        background-attachment: fixed;
        background-size: cover;
      }
      .form-control{
        background:rgba(200,200,200,0.5);
        color: white;
        font-size: 16px;
      }
      .input-group-addon{
        background: rgba(200,200,200,0.5);
        min-width: 40px;
      }
      i{
        color:white;
      }
      a{
        color: #fbb900 ;
      }
      a:hover{
        color: #fbb900;
        text-decoration: underline;
        -webkit-transition: all 0.3s ease-in;
        -moz-transition: all 0.3s ease-in;
        -ms-transition: all 0.3s ease-in;
        -o-transition: all 0.3s ease-in;
        transition: all 0.3s ease-in;
      }
      .form-control:focus {
          border-color: #fbb900;
          outline: 0;
          -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
          box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
      }

      .btn-default{
        background: rgba(200,200,200,0.5);
        color: white;
      }
      .btn-default.active, .btn-default.focus, .btn-default:active, .btn-default:focus, .btn-default:hover, .open>.dropdown-toggle.btn-default {
          color: #feb811;
          background: rgba(200,200,200,0.5);
          border-color: #ccc;
          -webkit-transition: all 0.3s ease-in;
          -moz-transition: all 0.3s ease-in;
          -ms-transition: all 0.3s ease-in;
          -o-transition: all 0.3s ease-in;
          transition: all 0.3s ease-in;
      }
      input::-webkit-input-placeholder { /* WebKit, Blink, Edge */
          color:    #fff !important;
      }
      input:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
         color:    #fff !important;
         opacity:  1 !important;
      }
      input::-moz-placeholder { /* Mozilla Firefox 19+ */
         color:    #fff !important;
         opacity:  1 !important;
      }
      input:-ms-input-placeholder { /* Internet Explorer 10-11 */
         color:    #fff !important;
      }


    </style>

  </head>

  <body>
    
    <div class="container">
      <?php echo $body ?>
    </div>

  </body>
</html>