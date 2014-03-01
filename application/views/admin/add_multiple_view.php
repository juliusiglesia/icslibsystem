<?php include 'admin_header.php'; ?></div>
        <div class="mainBody">
            <div class="sidebarMain">
				<ul class="nav nav-pills nav-stacked">
					<li id = "reserved-nav" >
						<a href="<?php echo base_url();?>admin/reservation"><span class="glyphicon glyphicon-import"></span> &nbsp;Reserved Books</a>
					</li>
					<li id = "borrowed-nav" >
						<a href="<?php echo base_url();?>admin/borrowed_books"><span class="glyphicon glyphicon-export"></span> &nbsp;Borrowed Books</a>
					</li>
					<li id = "view-nav" >
						<a href="<?php echo base_url();?>admin/admin_search"><span class="glyphicon glyphicon-search"></span> &nbsp;View All Materials</a>
					</li>
					<li id = "add-nav" >
						<a href="<?php echo base_url();?>admin/add_material"><span class="glyphicon glyphicon-plus"></span> &nbsp;Add A New Material&nbsp;&nbsp;&nbsp;</a>
					</li>
					<li id = "overview-nav">
						<a href="<?php echo base_url();?>admin/home"><span class="glyphicon glyphicon-dashboard"></span> &nbsp;Overview</a>
					</li>	
				</ul>
			</div> 

        <div class="leftMain">
	        <div id="main-page">
		        <div id = "main-content">
		        	<h3> Add multiple materials </h3>
					<input id="uploadFile" type="file" name = "file[]" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
					<button id="readButton" name = "uploadButton"  disabled = "true" > Read File </button>
					
					<span id = "error"> </span>
					<br />
					<table id = "table-data-area" border = "1">
						<thead>

						</thead>
						<tbody>

						</tbody>
					</table>

					<input type = "button" name = "insertButton" id = "insertButton" value = "Insert to Database"/>
					
					<span id = "error"> </span>
				</div>
			</div>
		
    </div>
	<footer>
		<center><p id="small">2013 CMSC 128 AB-6L. All Rights Reserved. <a href="#">Privacy</a> | <a href="#">Terms</a> | <a href="#">About</a> | <a href="#">Contact</a> </p></center>
	</footer>

  	
 
	<script src="<?php echo base_url();?>dist/js/jquery.js"></script>
  	
    <script type="text/javascript" language="javascript">
		$(document).ready(function(){
			var arrayGlobal;

			$('#add-field').attr('hidden', 'hidden');
			$('#addButton').click(function(){
				$('#add-field').removeAttr('hidden', 'hidden');
			});

			$('#insertButton').click(function(){
				data = JSON.stringify(arrayGlobal);
				
				$.ajax({
					type: "POST",
					url: "<?php echo base_url();?>admin/insert_multiple",
					dataType : "html",
					data: { insert : data }, 

					beforeSend: function() {
						//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
						$("#error_message").html("loading...");
					},

					error: function(xhr, textStatus, errorThrown) {
						$('#error').html(errorThrown);
					},

					success: function( result ){
						alert(arrayGlobal);
						$('#error').html( result );
						
					}
				});

			console.log( arrayGlobal );
			});

			$('#type').change( checkType );
			$('#uploadFile').change( checkfile );
			$('#course').change( changeCourseMaterialId );
			$('#type').change( changeCourseMaterialId );
			$('#year').change( changeCourseMaterialId );


			function changeCourseMaterialId(){
				var course = $('#course').val();
				var year = $('#year').val();
				var type = $('#type').val();

				if ( type == "Book" ) $('#course-materialid').html(course+"-");
				else if ( type == "SP" ) $('#course-materialid').html("SP"+year+"-");
				else if ( type == "Thesis" ) $('#course-materialid').html("T-");
				else if ( type == "Reference" ) $('#course-materialid').html("R-");
				else if ( type == "Magazines" ) $('#course-materialid').html("M-");
				else if ( type == "CD" ) $('#course-materialid').html("CD-");
				else if ( type == "Journals" ) $('#course-materialid').html("J-");
			}

			function checkType(){
				var type = $('#type').val();
				if( type == "Magazines" || type == "Journals"  ){
					$('#isbn-label').html("ISSN");
					$('#isbn').removeAttr("disabled", "disabled");
				} else if( type == "Books" || type == "Reference"  ){
					$('#isbn-label').html("ISBN");
					$('#isbn').removeAttr("disabled", "disabled");
				} else{
					$('#isbn').attr("disabled", "disabled");
					
				}
			}

			function checkfile() {
				var validExtension = new Array(".xlsx", ".xls", ".csv");
				var fileExtension = $('#uploadFile').val();
				fileExtension = fileExtension.substring(fileExtension.lastIndexOf('.'));
				if (validExtension.indexOf(fileExtension) < 0) {
					$('#error').html("Invalid file selected, valid files are of " + validExtension.toString() + " types.");
					return false;
				}
				else {
					if (window.File && window.FileReader && window.FileList && window.Blob) {
					  // Great success! All the File APIs are supported.
					$('#error').html("");
					$('#readButton').removeAttr("disabled", "disabled");
					
					return true;
					} else {
						$('#error').html("The File APIs are not fully supported in this browser.");
					
						return false;
					}
				}
			}

			var n = 1;
				
				function deleteRow(row){
					n--;
					
					var i=row.parentNode.parentNode.rowIndex;
					document.getElementById('formTable').deleteRow(i);
				}
			
				function addRow(){
					n++;
					
					var x=document.getElementById('formTable');
					// deep clone the targeted row
					var new_row = x.rows[0].cloneNode(true);
					
					// set the innerHTML of the first row 
					//new_row.cells[0].innerHTML = '';
					
					var inp6 = new_row.cells[6].getElementsByTagName('input')[0];
					inp6.value = n;
					
					// grab the input from the first cell and update its ID and value
					var inp1 = new_row.cells[0].getElementsByTagName('input')[0];
					inp1.name += n;
					inp1.placeholder = 'First Name';
					inp1.required = true;
					inp1.pattern = "[A-Za-z]+";
					inp1.value = '';
					
					// grab the input from the first cell and update its ID and value
					var inp2 = new_row.cells[1].getElementsByTagName('input')[0];
					inp2.name += n;
					inp2.placeholder = 'Middle Name';
					inp2.required = true;
					inp2.pattern = "[A-Za-z]+";
					inp2.value = '';
					
					
					// grab the input from the first cell and update its ID and value
					var inp3 = new_row.cells[2].getElementsByTagName('input')[0];
					inp3.name += n;
					inp3.placeholder = 'Last Name';
					inp3.required = true;
					inp3.pattern = "[A-Za-z]+";
					inp3.value = '';
					
					
					var inp4 = new_row.cells[3].getElementsByTagName('input')[0];
					inp4.disabled = false;
					
					var inp5 = new_row.cells[4].getElementsByTagName('input')[0];
					inp5.disabled = false;
					
					
					// append the new row to the table
					x.appendChild(new_row);
				}

	function readBlob() {

	    var files = document.getElementById('uploadFile').files;
	    if (!files.length) {
	      alert('Please select a file!');
	      return;
	    }

	    var file = files[0];
	    console.log(file);
	    var start = 0;
	    var stop = file.size - 1;

	    var reader = new FileReader();

	    // If we use onloadend, we need to check the readyState.
	    reader.onloadend = function(evt) {
	      if (evt.target.readyState == FileReader.DONE) { // DONE == 2
	        loadTable( evt.target.result );
	//        console.log( evt.target.result );

	      }
	    };

	    var blob = file.slice(start, stop + 1);
	    reader.readAsBinaryString(blob);
	  }
	  
	  document.querySelector('#readButton').addEventListener('click', function(evt) {
	      readBlob();
	  }, false);
	  //arr.splice(2, 0, "Lene");
	// console.log(arr.join());
			function loadTable( data ){
				var arr = data.split("\n");
				var arrTemp = new Array();
				for (var i = 0; i < arr.length; i++) {
					var title = arr[i++];
					arr[i] = arr[i].split(",");
					arr[i].splice(2, 0, title);
					
					var author = arr[i].splice(11, arr[i].length );
					var ptr = 0;
					var nAuthors = author.length/3;
					var authorArr = split( author, nAuthors )
					arr[i].push( authorArr );

				}
					displayTable( arr );
					arrayGlobal = arr;
				
				
			}

			function displayTable( array ){
				var body = $('#table-data-area').find('tbody');
				var head = $('#table-data-area').find('thead');
				var headerArr = new Array('materialid', 'isbn', 'name', 'course', 'available', 'access', 'type', 'year', 'edvol', 'requirement', 'quantity');
				console.log( headerArr );
				var headStr = "";
				for( var i = 0; i < headerArr.length; i++ ){
					headStr = headStr + "<th> " + headerArr[i] + " </th>";
				}
				
				head.append("<tr>"+ headStr + "</tr>");
				for( var i = 1; i < array.length; i+=2){
					var str = "";
	//				console.log( array[i] );
					for( var j = 0; j < 11; j++ ){
	//					console.log(array[i][j]);
						str = str + "<td> " + array[i][j] + " </td>";
					
					}

					body.append("<tr>"+ str + "</tr>");
				}
			}

			function split(arr, n) {
	    var len = arr.length, ret = [], i = 0;
	    while (i < len) {
	        var size = Math.ceil((len - i) / n--);
	        ret.push(arr.slice(i, i += size));
	    }
	    return ret;
	}	
		});
		

	</script>
	<script src="<?php echo base_url();?>dist/js/jquery.js"></script>
    <script src="<?php echo base_url();?>dist/js/bootstrap.js"></script>
    <script src="<?php echo base_url();?>dist/js/holder.js"></script>
	</body>
</html>