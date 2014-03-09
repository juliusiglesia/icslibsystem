<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>

	<body>
		 <?php include 'includes/header.php'; ?>
        <div class="mainBody">
            <?php include 'includes/sidebar.php'; ?>

        <div class="leftMain">
	        <div id="main-page">
		        <div id = "main-content">
		        	<h3> Add multiple materials </h3>
					<input id="uploadFile" type="file" name = "file[]" accept=".csv" />
					<span id = "error"> </span>
					<table id = "table-data-area" border = "1">
						<thead>

						</thead>
						<tbody>

						</tbody>
					</table>

					<input class = "btn btn-primary" type = "button" name = "insertButton" id = "insertButton" value = "Insert to Database"/>
					
					<span id = "error"> </span>
				</div>
			</div>
		
    </div>
	
    <script type="text/javascript" language="javascript">
		
			$('#add-nav').addClass('active');
		$(document).ready(function(){
			var arrayGlobal = new Array();

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
	                    readBlob();
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
					arrayGlobal.push(arr[i]);
				}
				
				displayTable( arrayGlobal );
				
			}

			function displayTable( array ){
				var body = $('#table-data-area').find('tbody');
				var head = $('#table-data-area').find('thead');
				var headerArr = new Array('materialid', 'isbn/issn', 'name', 'course', 'available', 'access', 'type', 'year', 'edvol', 'requirement', 'quantity', 'status');
				var headStr = "";
				
				for( var i = 0; i < headerArr.length; i++ ){
					headStr = headStr + "<th> " + headerArr[i] + " </th>";
				}
				
				head.append("<tr>"+ headStr + "</tr>");
				for( var i = 0; i < array.length; i++){
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
					if ( ( checkDataInput( array[i] ) ) ){
						//enable
						document.getElementById("insertButton").disabled = false; 
					} else{
						//disable
						document.getElementById("insertButton").disabled = true; 
					}
				}
			}

			function checkDataInput( arr ){
				checkISBN( arr[1], arr[6] );
				checkMatId( arr[0], arr[6], arr[7], arr[3] );
				checkName( arr[2] );
				checkCourse( arr[3], arr[6] );
				checkAvailable( arr[4] );
				checkAccess( arr[5], arr[6] );
				checkType( arr[6] );
				checkYear( arr[7] );
				checkEdvol( arr[8] );
				checkRequirement( arr[9] );
				checkQuantity( arr[10] );
				if(checkISBN( arr[1], arr[6] ) && checkMatId( arr[0], arr[6], arr[7], arr[3] ) && checkName( arr[2] ) && checkCourse( arr[3], arr[6] ) && checkAvailable( arr[4] ) && checkAccess( arr[5], arr[6] ) && checkType( arr[6] ) && checkYear( arr[7] ) && checkEdvol( arr[8] ) && checkRequirement( arr[9] ) && checkQuantity( arr[10] )  ) {
					return true;
				}
					return false;
			}

			function checkISBN( isbn, type ){
				isbn = $.trim(isbn);
				if ( (type == 'Book' || type == 'References') && !( (isbn.match(/^[0-9]{10}$/)) ) ){
					$('.isbn').last().attr('style', 'color : red')
				
				} else if ( ( type == 'Journals' || type == 'Magazine' ) && !( (isbn.match(/^[0-9]{8}$/)) ) ){
					$('.isbn').last().attr('style', 'color : red')
				
				} else if ( ( type == 'SP' || type == 'Theis' ) && isbn != "" ){
					$('.isbn').last().attr('style', 'color : red');
				
				} else if( type != 'SP' || type != 'Theis' ){
					checkISBNInDB( isbn, $('.isbn').last() );
				}

				if ( !checkISBNInFile(isbn) ){
					$('.isbn').last().attr('style', 'color : red');
				
				} else {
					return true;
				}
			}
			
			function checkMaterialIdInFile( materialid ){
				var count = 0;
				for( var i = 0; i < arrayGlobal.length; i++ ){
					if( arrayGlobal[i][0] == materialid ){
						count++;
					}
				}
				
				if( count == 1 ) return true;
				else return false;
			}

			function checkMaterialIdInDB( materialid, row ){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url();?>admin/check_materialid",
					dataType : "html",
					data: { materialid : materialid }, 

					beforeSend: function() {
						//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
						$("#error_message").html("loading...");
					},

					error: function(xhr, textStatus, errorThrown) {
							$('#error_message').html(textStatus);
					},

					success: function( result ){
						if( result != "0" ) {
							row.attr('style', 'color : red');
						
						} else {
						
						}
					}
				});
			}

			function checkISBNInFile( isbn ){
				var count = 0;
				for( var i = 0; i < arrayGlobal.length; i++ ){
					if( arrayGlobal[i][1] == isbn ){
						count++;
					}
				}
				
				if( count == 1 ) return true;
				else return false;
			}

			function checkISBNInDB( isbn, row ){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url();?>admin/check_isbn",
					dataType : "html",
					data: { isbn : isbn }, 

					beforeSend: function() {
						//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
						$("#error_message").html("loading...");
					},

					error: function(xhr, textStatus, errorThrown) {
							$('#error_message').html(textStatus);
					},

					success: function( result ){
						if( result != "0" ) {
							row.attr('style', 'color : red');
						
						} else {
						
						}
					}
				});
			}

			function checkMatId( materialid, type, year, course ){
				if(type == "") {
					$('.type').last().attr('style', 'color : red')
					$('.materialid').last().attr('style', 'color : red')					
				} else {
					if (materialid == ""){
						$('.materialid').last().attr('style', 'color : red')
					} else {
						if(type=='Book') {
							var index = materialid.indexOf("-");
							var courseTemp = materialid.slice(0, index);
							if( courseTemp != course ){
								$('.materialid').last().attr('style', 'color : red')
							
							} else if ( !materialid.match(/^(CS[0-9]{1,3})-([A-Z][0-9]{1,2})$/) ){
								$('.materialid').last().attr('style', 'color : red')
							} else {								
							
							}
						} else if(type=='Magazine') {
							if ( !materialid.match(/^M-([0-9]{1,2})$/) ){
								$('.materialid').last().attr('style', 'color : red')
						
						 	}else {								
							
							}
						
						} else if(type=='Thesis') {
							if ( !materialid.match(/^T-([0-9]{1,2})$/) ){
								$('.materialid').last().attr('style', 'color : red')
							} else {	
							
							}
						} else if(type=='References') {
							if ( !( (materialid.match(/^R-([0-9]{1,2})$/)) ) ){
								$('.materialid').last().attr('style', 'color : red')
							}else {
							
							}
						} else if(type=='Journals') {
							if ( !( (materialid.match(/^J-([0-9]{1,2})$/)) ) ){
								$('.materialid').last().attr('style', 'color : red')
							
							}else {
							
							}
						} else if(type=='SP') {
							if ( !( (materialid.match('/^SP'+year+'-([0-9]{1,2}[a-z]*)$')) ) ){
								$('.materialid').last().attr('style', 'color : red')
							
							}else {
								
							}
						}
					}
				}

				checkMaterialIdInDB( materialid, $('.materialid').last() );

				if ( !checkMaterialIdInFile(materialid) ){
					$('.materialid').last().attr('style', 'color : red');
				
				} else {
				
				}

			}
		
			function checkName( name ){
				if (name == ""){
					$('.name').last().attr('style', 'color : red')
				
				} else if ( !( (name.match(/^([A-Z][A-Za-z0-9\.\,\-\'\?\!\:]+[\s]*)+$/)) ) ){
					$('.name').last().attr('style', 'color : red')
				
				} else {
				
				}
			}

			function checkAccess( access, type){
				if(type=="") {
					$('.type').last().attr('style', 'color : red');
					$('.access').last().attr('style', 'color : red');
				} else {
					if (access == ""){
						$('.access').last().attr('style', 'color : red');
					}else {
						if(type=='Book') {
							if ( !( (access.match(/^4$/)) ) ){
								$('.access').last().attr('style', 'color : red');
 									
 							}else {
								return true;
 							}
 						} else if(type=='Magazine') {
							if ( !( (access.match(/^3$/)) ) ){
								$('.access').last().attr('style', 'color : red');
									
							}else {
								return true;
 							}
 						} else if(type=='Thesis') {
 							if ( !( (access.match(/^3$/)) ) ){
 								$('.access').last().attr('style', 'color : red')
 							
 							} else {
								return true;
 							}
 						} else if(type=='References') {
 							if ( !( (access.match(/^2$/)) ) ){
 								$('.access').last().attr('style', 'color : red');
 							
 							}else {
								return true;
 							}
 						} else if(type=='Journals') {
 							if ( !( (access.match(/^4$/)) ) ){
 								$('.access').last().attr('style', 'color : red');
 							
 							}else {
								return true;
 							}
 						} else if(type=='SP') {
 							if ( !( (access.match(/^3$/)) ) ){
 								$('.access').last().attr('style', 'color : red');
 							
 							}else {
								return true;
 							}
 						} else {
 							$('.type').last().attr('style', 'color : red');

							return true;
 							}
 						}
 					}
 				}
			
			function checkCourse( course, type ){
				if(type=="") {
					$('.type').last().attr('style', 'color : red')
					$('.access').last().attr('style', 'color : red')
				} else {
					if (course == ""){
						$('.course').last().attr('style', 'color : red')
					}else {
						if(type=='Book') {
							if ( !( (course.match(/^(CS[0-9]{1,3})$/)) ) ){
								$('.course').last().attr('style', 'color : red')
								
							}else {
								return true;
							}
						} else if(type=='References') {
							if ( !( (course.match(/^(CS[0-9]{1,3})$/)) ) ){
								$('.course').last().attr('style', 'color : red')
								
							}else {
								return true;
							}
						}else if(type == 'Journals' || type == 'Magazine' || type == 'SP') {
							if ( ( (course.match(/^(CS[0-9]{1,3})$/)) ) ){
								$('.course').last().attr('style', 'color : red')
								return false;
							}else {
								return true;
							}
						} else {
							$('.type').last().attr('style', 'color : red')
							$('.access').last().attr('style', 'color : red')
						}		
					}
				}
			}


			function checkType( type ) {
				if (type == ""){
					$('.type').last().attr('style', 'color : red')
				} else if ( !( (type.match(/^(Book|Thesis|References|SP|Journals|Magazine)$/)) ) ){
					$('.type').last().attr('style', 'color : red')
					console.log('error');
				} else {
					//return true;
				}
			}
			
			function checkYear( year ) {
				var y = new Date();
				current_year = y.getFullYear();
				if (year == ""){
					$('.year').last().attr('style', 'color : red')
				} else if ( !( (year.match(/^[0-9]{4}$/)) ) ){
					$('.year').last().attr('style', 'color : red')	
				} else if( (year < 1950 || year > current_year) ){
					$('.year').last().attr('style', 'color : red')
					console.log('error');
				} else {
					return true;
				}
			}
			
			function checkEdvol( edvol ) {
				if (edvol == ""){
					$('.edvol').last().attr('style', 'color : red')
				} else if ( !( (edvol.match(/^([0-9]{1,2})+$/)) ) ){
					$('.edvol').last().attr('style', 'color : red')
				
				} else {
					//return true;
				}
			}
			
			function checkRequirement( requirement ) {
				if (requirement == ""){
					$('.requirement').last().attr('style', 'color : red')
				} else if ( !( (requirement.match(/^(0|1)$/)) ) ){
					$('.requirement').last().attr('style', 'color : red')
				
				} else {
					//return true;
				}
			}
			
			function checkQuantity( quantity ) {
				if (quantity == ""){
					$('.quantity').last().attr('style', 'color : red')
				} else if ( !( (quantity.match(/^[1-9]{1,3}$/)) ) ){
					$('.quantity').last().attr('style', 'color : red')
				} else {
					//return true;
				}
			}

			function checkAvailable( available ) {
				if (available == ""){
					$('.available').last().attr('style', 'color : red')
				} else if ( !( (available.match(/^(0|1)$/)) ) ){
					$('.available').last().attr('style', 'color : red')
				
				} else {
					//return true;
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
	</body>
</html>