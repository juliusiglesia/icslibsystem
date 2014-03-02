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

			$('#uploadFile').change( checkfile );
			$('#add-field').attr('hidden', 'hidden');
			$('#addButton').click(function(){
				$('#add-field').removeAttr('hidden', 'hidden');
			});

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

			$('#insertButton').click(function(){
				data = JSON.stringify(arrayGlobal);
				console.log(data);
				$.ajax({
					type: "GET",
					url: "<?php echo base_url();?>admin/insert_multiple",
					data: { insert : data }, 

					beforeSend: function() {
						//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
						$("#error_message").html("loading...");
					},

					error: function(xhr, textStatus, errorThrown) {
						$('#error').html(errorThrown);
					},

					success: function( result ){
						$('#error').html( result );
						
					}
				});

			});

			
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
					}
				};

				var blob = file.slice(start, stop + 1);
				reader.readAsBinaryString(blob);
			}

			document.querySelector('#readButton').addEventListener('click', function(evt) {
					readBlob();
				}, false);
	
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
				var headerArr = new Array('materialid', 'isbn', 'name', 'course', 'available', 'access', 'type', 'year', 'edvol', 'requirement', 'quantity', 'status');
				var headStr = "";
				
				for( var i = 0; i < headerArr.length; i++ ){
					headStr = headStr + "<th> " + headerArr[i] + " </th>";
				}
				
				head.append("<tr>"+ headStr + "</tr>");
				for( var i = 1; i < array.length; i+=2){
					var str = "";
					//	console.log( array[i] );
					str = str + "<td class = 'materialid'> " + array[i][0] + " </td>";
					str = str + "<td class = 'isbn'> " + array[i][1] + " </td>";
					str = str + "<td class = 'name'> " + array[i][2] + " </td>";
					str = str + "<td class = 'course'> " + array[i][3] + " </td>";
					str = str + "<td class = 'available'> " + array[i][4] + " </td>";
					str = str + "<td class = 'access'> " + array[i][5] + " </td>";
					str = str + "<td class = 'type'> " + array[i][6] + " </td>";
					str = str + "<td class = 'year'> " + array[i][7] + " </td>";
					str = str + "<td class = 'edvol'> " + array[i][8] + " </td>";
					str = str + "<td class = 'requirement'> " + array[i][9] + " </td>";
					str = str + "<td class = 'quantity'> " + array[i][10] + " </td>";
					str = str + "<td><span class = 'check-error' > </span></td>";
					
					body.append("<tr class = '"+ array[i][0] + "-" + array[i][1] + "' >"+ str + "</tr>");
					
					currentRow = $('#table-data-area tr').get($('#table-data-area tr').length-1).children;

					checkDataInput( array[i] );
				}
			}

			function checkDataInput( arr ){
				checkISBN( arr[1] );
			}

			function checkISBN( isbn ){
				if (isbn == ""){
					$('.isbn').last().attr('style', 'color : red')
					return false;
				} else if ( !( (isbn.match(/^[0-9]{10}$/)) ) ){
					$('.isbn').last().attr('style', 'color : red')
					console.log('error');
					return false;
				} else {
					return true;
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