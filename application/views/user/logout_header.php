<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url(); ?>dist/images/fav.png">

    <title>ICS-iLS</title>

    <link href="<?php echo base_url(); ?>dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url(); ?>dist/css/carousel.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>dist/css/modulestyle.css" rel="stylesheet">
  <style type="text/css" id="holderjs-style"></style></head>
<!-- NAVBAR
==================================================-->
  <body>
  <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo base_url(); ?>dist/images/logo.png" height="70px"></a>
        </div>
       <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo Site_url();?>/borrower/profile" style="font-size:17px;" onclick = "this.style.color='white';"><span class="glyphicon glyphicon-home" id="glyphcolor"></span></a></li>
            <li class="dropdown">
              <a  id = "message" class = "notif" href="#" class="dropdown-toggle" data-toggle="dropdown" style="font-size:17px;" onclick = "this.style.color='white';"><span class="glyphicon glyphicon-envelope" id="glyphcolor"></span></a>
                <?php
                 // if($overdue || $res || $readytoclaim){ echo "<span class='glyphicon glyphicon-exclamation-sign'></span>"; }
                ?>
              <ul class="dropdown-menu">
                <li class="dropdown-header">Overdue Books</li>
                <li><a>
                <div  id = "overdue">
                <?php
                    if(!$overdue){  echo "<i> None </i>"; }
                    else{
                      foreach ($overdue as $temps) {
                        echo $temps['name']; 
                        echo "<br/>";
                      }
                    }
                  ?>
                </div>
                 </a></li>
                 <li class="divider"></li>
                 <li  class="dropdown-header">Reserved Books</li>
                 <li><a>
                    <div id = "reserved" >
                      <?php
                        if(!$res){ echo "<i> None </i>"; }
                        else{
                          foreach ($res as $temps) {
                            echo $temps['name'];
                          } 
                        }
                      ?>
                    </div>
                  </a></li>
                 </a></li>
                 <li class="divider"></li>
                 <li  class="dropdown-header">Ready to claim</li>
                 <li><a>
                  <div id="ready">
                    <?php
                      
                      if(!$readytoclaim){  echo "<i> None </i>"; }
                      else{
                        foreach ($readytoclaim as $temps) {
                          echo $temps['materialid'];  echo " until "; echo"<b>"; echo $temps['claimdate'];  echo"</b>";
                        } 
                      }
                    ?>
                  </div>
                 </a></li>
              </ul> <!--notifs-->
            </li>
            <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="font-size:17px;" onclick = "this.style.color='white';"><span class="glyphicon glyphicon-cog" id="glyphcolor" ></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url();?>dist/pdf/user/ILS MANUAL.pdf" target="_blank">Operations Manual</a></li>
                    <li><a href="<?php echo base_url();?>dist/pdf/user/ILS FAQ.pdf" target="_blank">FAQs</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo site_url();?>/logout?">Logout</a></li>
                  </ul>
                 </li>
          </ul> <!--buong menu-->
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <script type = "text/javascript" src = "<?php echo base_url();?>dist/js/jquery-2.1.0.min.js"></script>
    <script type="text/javascript">
    //$("a.tooltipLink").tooltip();
    
    $('#message').click(function(){
      $.ajax({
        url: "<?php echo site_url();?>/borrower/get_message",
        dataType : "json",
        beforeSend: function() {
          //$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
          $("#error_message").html("loading...");
        },

        error: function(xhr, textStatus, errorThrown) {
            $('#error_message').html(textStatus);
        },

        success: function( result ){
          var overdue = result['overdue'];
          var fne = result['fineenable'];
          var str = "";
          
          if( overdue.length == 0 ){  str += "<li><a><i> None </i></a></li>"; }
                  else{
                     for( var i = 0; i < overdue.length; i++){
                        //str += "<li><a>" + overdue[i].name + " <br /> Fine: Php " + overdue[i].user_fine + "</a> </li>";
                        if(fne[0].fineenable == 1){
                          str += "<li><a>" + overdue[i].name + " <br /> Fine: Php " + overdue[i].user_fine + "</a> </li>";
                        }
                        else{
                          str += "<li><a>" + overdue[i].name + "<br/> </a> </li>";
                        }

                     } 
                  }
          
          $('#overdue').html( str );
                  str="";
                  var reserved = result['reserved'];
                  if( reserved.length == 0 ){  str += "<li><a><i> None </i></a></li>"; }
                  else{
                     for( var i = 0; i < reserved.length; i++){
                        str += "<li><a>" + reserved[i].name + "</a> </li>";
                     } 
                  }

                  $('#reserved').html( str );
                  
          var readytoclaim = result['readytoclaim'];
                  str="";
                  if( readytoclaim.length == 0 ){  str += "<li><a><i> None </i></a></li>"; }
                  else{
                     for( var i = 0; i < readytoclaim.length; i++){
                        str += "<li><a>" + readytoclaim[i].name + " until <b>" + readytoclaim[i].claimdate + " </b></a> </li>";
                     } 
                  }

                  $('#ready').html( str );
                  
        }
      });
    });

</script>