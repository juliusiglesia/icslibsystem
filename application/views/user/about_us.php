<?php 

	if($this->session->userdata('email'))
		include 'logout_header.php'; 
	else
		include 'home_header.php';

?>
  <div class="container" id="margin">
    <div class="row" id="margin2">
      <div class="col-md-2 col-md-offset-3">
		<p id="pimg"><img id="imgsize" src="<?php echo base_url(); ?>dist/images/dev/sir.png"/><span id="popup">Sir Regi</span></p>
      </div>
	  <div class="col-md-2">
		<p id="pimg"><img id="imgsize" src="<?php echo base_url(); ?>dist/images/dev/gail.png"/><span id="popup">PM Gail Ramirez</span></p>
      </div>
	   <div class="col-md-2">
		<p id="pimg"><img id="imgsize" src="<?php echo base_url(); ?>dist/images/dev/mamkim.png"/><span id="popup">Ma'am Kim</span></p>
      </div>
    </div>

    <div class="row" id="margin2">
      <div class="col-md-2 col-md-offset-1">
            <p id="pimg"><img id="imgsize" src="<?php echo base_url(); ?>dist/images/dev/yanyan.png"/><span id="popup">TL Yanyan Tarong</span></p>
            <p id="pimg"><img id="imgsize" src="<?php echo base_url(); ?>dist/images/dev/leona.png"/><span id="popup">Leona Jolloso</span></p>
            <p id="pimg"><img id="imgsize" src="<?php echo base_url(); ?>dist/images/dev/cha.png"/><span id="popup">Chandelle Marquez</span></p>
            <p id="pimg"><img id="imgsize" src="<?php echo base_url(); ?>dist/images/dev/mac.png"/><span id="popup">Mac Reyes</span></p>
      </div>
      <div class="col-md-2">
            <p id="pimg"><img id="imgsize" src="<?php echo base_url(); ?>dist/images/dev/johana.png"/><span id="popup">TL Johana Galag</span></p>
            <p id="pimg"><img id="imgsize" src="<?php echo base_url(); ?>dist/images/dev/jenina.png"/><span id="popup">Jenina Escorial</span></p>
            <p id="pimg"><img id="imgsize" src="<?php echo base_url(); ?>dist/images/dev/willen.png"/><span id="popup">Willen Hernandez</span></p>
            <p id="pimg"><img id="imgsize" src="<?php echo base_url(); ?>dist/images/dev/edlex.png"/><span id="popup">Edlex Purification</span></p>
      </div>
      <div class="col-md-2">
            <p id="pimg2"><img id="imgsize" src="<?php echo base_url(); ?>dist/images/dev/julius2.png"/><span id="popup">TL Julius Iglesia</span></p>
            <p id="pimg"><img id="imgsize" src="<?php echo base_url(); ?>dist/images/dev/jett.png"/><span id="popup">Jett Calleja</span></p>
            <p id="pimg"><img id="imgsize" src="<?php echo base_url(); ?>dist/images/dev/charlene.png"/><span id="popup">Charlene Cañedo</span></p>
            <p id="pimg"><img id="imgsize" src="<?php echo base_url(); ?>dist/images/dev/nicholo.png"/><span id="popup">Nicholo Domiguez</span></p>
      </div>
      <div class="col-md-2">
            <p id="pimg"><img id="imgsize" src="<?php echo base_url(); ?>dist/images/dev/fred.png"/><span id="popup">TL Fred Fernandez</span></p>
            <p id="pimg"><img id="imgsize" src="<?php echo base_url(); ?>dist/images/dev/harvey.png"/><span id="popup">Harvey Cruzada</span></p>
            <p id="pimg"><img id="imgsize" src="<?php echo base_url(); ?>dist/images/dev/kat.png"/><span id="popup">Kat Espalmado</span></p>
            <p id="pimg"><img id="imgsize" src="<?php echo base_url(); ?>dist/images/dev/adrian.png"/><span id="popup">Adrian Leal</span></p>
      </div>
      <div class="col-md-2">
            <p id="pimg"><img id="imgsize" src="<?php echo base_url(); ?>dist/images/dev/claire2.png"/><span id="popup">TL Clarianne Cruz</span></p>
            <p id="pimg"><img id="imgsize" src="<?php echo base_url(); ?>dist/images/dev/kares.png"/><span id="popup">Kares Enriquez</span></p>
            <p id="pimg"><img id="imgsize" src="<?php echo base_url(); ?>dist/images/dev/eizel.png"/><span id="popup">Eizel Landicho</span></p>
            <p id="pimg"><img id="imgsize" src="<?php echo base_url(); ?>dist/images/dev/peewee.png"/><span id="popup">Peewee Vinoya</span></p>
      </div>
    </div>

    <br/><br/><br/><br/>

    <?php include 'home_footer.php'; ?>

</body>
</html>