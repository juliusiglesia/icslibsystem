<div class="pager">
	<!--<img src="../addons/pager/icons/first.png" class="first" alt="First" />
	<img src="../addons/pager/icons/prev.png" class="prev" alt="Prev" />-->
	<img class="first" style="cursor:pointer" src = "<?php echo base_url()?>dist/images/first.png" />
	<img class="prev" style="cursor:pointer" src = "<?php echo base_url()?>dist/images/prev.png" />
	<strong> <span class="pagedisplay"></span></strong> <!--this can be any element, including an input-->
	<img class="next" style="cursor:pointer" src = "<?php echo base_url()?>dist/images/next.png" />
	<img class="last" style="cursor:pointer" src = "<?php echo base_url()?>dist/images/last.png" />
	<br/>
	<span>Page size: </span>
	<select class="pagesize" title="Select page size">
		<option value="10">10</option>
		<option value="20">20</option>
		<option value="30">30</option>
		<option value="40">40</option>
	</select>
	<span>Go to: </span>
	<select class="gotoPage" title="Select page number"></select>
</div>