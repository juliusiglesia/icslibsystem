<!DOCTYPE html>
<html lang="en">
  <head>
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
      <style type="text/css" id="holderjs-style"></style>
  </head>
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
          <!--Navigation Bar on the right-->
          <ul class="nav navbar-nav navbar-right">
            <?php
              $i = 0;
              foreach($overdueCount as $row)
                //$i++;
                $i = $i + $row['COUNT(librarymaterial.materialid)']; 
              foreach($readytoclaimCount as $row)
                $i = $i + $row['COUNT(librarymaterial.materialid)'];
                //$i++;
            ?>
            <li><a href="<?php echo Site_url();?>/borrower/search_all" style="font-size:17px;" onclick = "this.style.color='white';"><span class="glyphicon glyphicon-search" id="glyphcolor"></span></a></li>
            <li><a href="<?php echo Site_url();?>/borrower/profile" style="font-size:17px;" onclick = "this.style.color='white';"><span class="glyphicon glyphicon-home" id="glyphcolor"></span></a></li>
            <li class="dropdown">
              
              <a  id = "message" class = "notif" href="#" class="dropdown-toggle" data-toggle="dropdown" style="font-size:17px;" onclick = "this.style.color='white';"><span class="glyphicon glyphicon-envelope" id="glyphcolor"></span>
                <?php if($i!=0){?>
                  <span class="badge">
                
                  <?php echo $i?>
                  </span></a>
            <?php }?>
              <ul class="dropdown-menu">
                <li class="dropdown-header">Overdue Books</li>
                <li><a>
                <div  id = "overdue">
                <?php
                    /*Checks if the Overdue books of the logged-in user is not NULL.*/
                    if(!$overdue){  echo "<i> None </i>"; }
                    else{
                      /*Outputs the name of all the books that are overdue.*/
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
                        /*Checks if the reserved books of the logged-in user is not NULL.*/
                        if(!$res){ echo "<i> None </i>"; }
                        else{
                          /*Outputs the name of all the books that are reserved by the logged-in user.*/
                          foreach ($res as $temps) {
                            echo $temps['name'];
                            echo "<br/>";
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
                      /*Checks if the reserved books that are ready to be claimed by the logged-in user is not NULL.*/
                      if(!$readytoclaim){  echo "<i> None </i>"; }
                      else{
                        /*Outputs the material id of all the books that are ready to be claimed by the logged-in user.*/
                        foreach ($readytoclaim as $temp) {
                          echo $temp['materialid'];  echo " until "; echo"<b>"; echo $temp['claimdate'];
                          echo"</b>";
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
    
    /*
    * Ajax for notifications (envelope/message icon)
    */
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
          //Variable declarations
          var overdue = result['overdue'];  
          var fne = result['fineenable'];
          var str = "";
          
          //Checks if the user has overdued books, none will be printed the logged-in user has no overdued books.
          if( overdue.length == 0 ){  str += "<li><a><i> None </i></a></li>"; }

          //Else prints all the name of the overdued books and the fine, if the fine feature is enabled
          else{
              //Prints all the overdued books
              for( var i = 0; i < overdue.length; i++){
                //str += "<li><a>" + overdue[i].name + " <br /> Fine: Php " + overdue[i].user_fine + "</a> </li>";
                //Checks if fine feature is enabled
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

                  //Checks if the user has reserved books, none will be printed if there are no reserved books.
                  if( reserved.length == 0 ){  str += "<li><a><i> None </i></a></li>"; }
                  
                  else{
                      //Prints all the reserved books
                      for( var i = 0; i < reserved.length; i++){
                        str += "<li><a>" + reserved[i].name + "</a> </li>";
                     } 
                  }

                  $('#reserved').html( str );
                  
                 var readytoclaim = result['readytoclaim'];
                  str="";
                  //Checks if the user has reserved books that are ready to be claimed, none will be printed if there are no ready to be claimed books.
                  if( readytoclaim.length == 0 ){  str += "<li><a><i> None </i></a></li>"; }
                  else{
                      //Prints all the reserved books that are ready to be claimed.
                      for( var i = 0; i < readytoclaim.length; i++){
                        str += "<li><a>" + readytoclaim[i].materialid + " until <b>" + readytoclaim[i].claimdate + " </b></a> </li>";
                     } 
                  }

                  $('#ready').html( str );
                  
        }
      });
    });

</script>