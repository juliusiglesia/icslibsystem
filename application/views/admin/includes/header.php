 <?php
     $logged_in = $this->session->userdata('user');
    
    if($logged_in) {
?>
         <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a  href="<?php echo site_url();?>/admin/home" class="navbar-brand" style = "cursor: pointer;"><img src="<?php echo base_url();?>dist/images/icslogo.png" height="40px;" > ICS Library - Admin Dashboard</a>
                </div>
                <div class="navbar-collapse collapse">
                    <form class="navbar-form navbar-right" role="form">
        		         <div class="btn-group">
                            <div class="dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-cog" style = "font-size : 20px; margin-top: 10px; cursor: pointer;"></span>
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </div>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo site_url();?>/admin/settings">Settings</a></li>
                                <li><a target= "_blank" href="<?php echo base_url()?>/dist/pdf/admin/ILS MANUAL-admin.pdf">Help</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo site_url();?>/admin/logout">Log-out</a></li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php }else { ?>
        <br/ >
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand"><img src="<?php echo site_url();?>/dist/images/logo4.png" height="40px"></a>
                </div>
            </div>
        </div>
<?php } ?>

<script type="text/javascript">
    $("#logout").click(function(){
        window.location.href = "<?php echo site_url();?>/admin/logout";
    });
</script>
