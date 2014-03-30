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
		        	<br />
						<h2> Add Multiple Materials </h2>
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url(); ?>/admin/home">Home</a></li>
							<li><a href="<?php echo site_url(); ?>/admin/update_material">Add A New Material</a></li>
							<li class="active"> Add Multiple Materials </li>
						</ol>
					<div class = "well">
						<h4><u> Rules in adding multiple materials </u></h4>
						<ul>
							<li>The material ID must match the given format depending on their types. <i>e.g. CS1-A2 (a book for CS1), M-12 (for magazines), R-12 (for references),
								J-12 (for journals), SP1989-12a (for Special Problem papers), T-12 (for Theses),
								CD-12 (for CDs)</i>
							</li>
							<li>A type of a library material must be spelled out correctly (i.e. Book, Magazines,
								References, Journals, SP, Thesis, CD).
							</li>
							<li>Books and references require a 10-digit ISBN while magazines and journals require
								an 8-digit ISSN. Leave the space provided for the materials without ISBN or ISSN. 
							</li>
							<li>For books, the course classification must agree with the material ID. <i>e.g. material ID = CS1-A2; course classification = CS1</i>
							</li>
							<li>Title must be of valid format.</li>
							<li>The valid years in the year of publication is from 1950 to the current year only.</li>
							<li>Editions are optional.</li>
							<li>Accessibility is defined as either: 1 - student, 2 - faculty, 3 - student/faculty, or 4 - room-use</li>
							<li>To indicate if a library material requires a consent from an instructor before it can be
								borrowed, define the requirement as 1. Otherwise, 0.
							</li>
							<li>Authors are included in the end of the file with the format Fist Name, Middle Name, Last Name, [Fist Name, Middle Name, Last Name]</li>
						</ul>
					</div>
					<div class = "well">
						<h4> Sample Format : </h4> <br />
						<span> <strong>Title of the material </strong></span> <br />
						<span> <strong>Material ID,	ISBN/ISSN, Course, Accessibility, Type, Year of publication, Edition/volume, Requirement, Quantity, Author's FName, MName, LName </strong></span> <br />
						<i> Note : All optional and non-applicable fields should be left empty. Multiple authors must be included after the Last Name of the previous author with the required format.</i>
					</div>
					<br />
					<input id="uploadFile" type="file" name = "file[]" accept=".csv" class="col-sm-offset-4" />
					<br />
					<div>
						<div id = "alert"> </div>
					</div>
					
					<table id = "table-data-area" class = "table table-hover tabler-bordered">
						<thead>
						</thead>
						<tbody>
						</tbody>
					</table>
					<input disabled = 'true' class = "btn btn-primary col-md-2 col-sm-offset-4" type = "button" name = "insertButton" id = "insertButton" value = "Insert to Database"/>
				</div>
			</div>
		
    </div>
	
	<!-- Footer -->
	<?php include 'includes/footer.php'; ?>
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
                var validExtension = new Array(".csv");
                var fileExtension = $('#uploadFile').val();
                fileExtension = fileExtension.substring(fileExtension.lastIndexOf('.'));
                if (validExtension.indexOf(fileExtension) < 0) {
                    $('#alert').html("Invalid file selected, valid files are of " + validExtension.toString() + " types.");
                    $('#alert').addClass('alert alert-danger');
                    setTimeout(function(){ $('#alert').fadeOut('slow'); }, 5000);
                    setTimeout(function(){ $('#alert').removeClass('alert alert-danger'); }, 6000);
                    return false;
                }
                else {
                    if (window.File && window.FileReader && window.FileList && window.Blob) {
                      // Great success! All the File APIs are supported.
	                    $('#alert').html("");
	                    readBlob();
	                    return true;
                    } else {
                        $('#alert').html("The File APIs are not fully supported in this browser.");
	                    $('#alert').addClass('alert alert-danger');
	                    setTimeout(function(){ $('#alert').fadeOut('slow'); }, 5000);
	                    setTimeout(function(){ $('#alert').removeClass('alert alert-danger'); }, 6000);
                        return false;
                    }
                }
            }

			$('#insertButton').click(function(){
				data = JSON.stringify(arrayGlobal);
				$.ajax({
					type: "GET",
					url: "<?php echo site_url(); ?>/admin/insert_multiple",
					data: { insert : data }, 

					beforeSend: function() {
						$("#alert").show();
						$("#alert").removeClass("alert alert-success");
						$("#alert").html("<center><img src='<?php echo base_url();?>dist/images/ajax-loader.gif' /></center>");
					},

					error: function(xhr, textStatus, errorThrown) {
						$("#alert").addClass("alert alert-success");
						$("#alert").html( "<strong>" + xhr.status + " " + xhr.statusText + "</strong>");
						$("#alert").fadeIn('slow');
					},

					success: function( result ){
						$('#alert').html("");
						$('#alert').removeClass("alert alert-danger");
						$('#alert').addClass("alert alert-success");
						$('#alert').html("<center>Successfully inserted into database.</center>");
						$("#insertButton").attr('disabled', true);
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
						arrayGlobal = new Array();
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
					
					var author = arr[i].splice(10, arr[i].length );
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
				var headerArr = new Array('materialid', 'isbn/issn', 'name', 'course', 'accessibility', 'type', 'year', 'edition/volume', 'requirement', 'quantity', 'author(s)');
				var headStr = "";
				head.html("");
				body.html("");
				
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
					str = str + "<td class = 'access'> " + array[i][4] + " </td>";
					str = str + "<td class = 'type'> " + array[i][5] + " </td>";
					str = str + "<td class = 'year'> " + array[i][6] + " </td>";
					str = str + "<td class = 'edvol'> " + array[i][7] + " </td>";
					str = str + "<td class = 'requirement'> " + array[i][8] + " </td>";
					str = str + "<td class = 'quantity'> " + array[i][9] + " </td>";
					str = str + "<td><span class = 'authors' >";
					
					for (var j = 0; j < array[i][10].length; j++) {
						str += "-- " + array[i][10][j][0] + " " + array[i][10][j][1]  + " " + array[i][10][j][2] + "<br />";
					}
					
					str = str + " </span></td>";
					
					body.append("<tr class = '"+ array[i][0] + "-" + array[i][1] + "' >"+ str + "</tr>");
					currentRow = $('#table-data-area tr').get($('#table-data-area tr').length-1).children;
					
					checkDataInput( array[i], i );
				}
			}

			function checkDataInput( arr, counter ){
				if( !(arr[5] == 'SP' || arr[5] == 'Thesis' || arr[5] == 'CD')){
					$.ajax({
						type: "POST",
						url: "<?php echo site_url(); ?>/admin/check_add_isbn",
						dataType : "html",
						data: { isbn : arr[1] }, 

						beforeSend: function() {
							//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
							$("#error_message").html("loading...");
						},

						error: function(xhr, textStatus, errorThrown) {
								$('#error_message').html(textStatus);
						},

						success: function( result ){
							if( result != "0" ) {
								$('#alert').html("");
								$('#alert').removeClass("alert alert-danger");
								$('#alert').append("<strong> Error at row " + (counter+1) + ":</strong><br />");
								$('#alert').append("Duplicate ISBN<br />");
								$('#alert').addClass("alert alert-danger");
								$('.isbn').last().attr('style', 'color : red');
							} else {
								$.ajax({
									type: "POST",
									url: "<?php echo site_url(); ?>/admin/check_add_materialid",
									dataType : "html",
									data: { materialid : arr[0] }, 

									beforeSend: function() {
										//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
										$("#error_message").html("loading...");
									},

									error: function(xhr, textStatus, errorThrown) {
											$('#error_message').html(textStatus);
									},

									success: function( result ){
										if( result != "0" ) {
											$('#alert').html("");
											$('#alert').removeClass("alert alert-danger");
											$('#alert').append("<strong> Error at row " + (counter+1) + ":</strong><br />");
											$('#alert').append("Duplicate MaterialID<br />");
											$('#alert').addClass("alert alert-danger");
											$('.materialid').last().attr('style', 'color : red');
										
										} else {
											str = checkISBN( arr[1], arr[5] ) +  checkMatId( arr[0], arr[5], arr[6], arr[3] ) + checkName( arr[2] ) +  checkCourse( arr[3], arr[5] ) + checkAccess( arr[4], arr[5] ) + checkType( arr[5] ) + checkYear( arr[6] ) + checkEdvol( arr[7] ) + checkRequirement( arr[8] ) + checkQuantity( arr[9] );
											$('#alert').html("");
											$('#alert').removeClass("alert alert-danger");

											if ( $.trim(str) == "" ) $("#insertButton").attr('disabled', false);											
											else { 
												$('#alert').addClass("alert alert-danger");
												error = str.split(",");
												$('#alert').append("<strong> Error in row " + (counter+1) + " : </strong><br />");
												for( var i = 0; i < error.length; i++ ){
													
													$('#alert').append(error[i] + "<br />");
												}
												
												$("#insertButton").attr('disabled', true);
											}

										}
									}
								});
							}
						}
					});
				} else {
					$.ajax({
						type: "POST",
						url: "<?php echo site_url(); ?>/admin/check_add_materialid",
						dataType : "html",
						data: { materialid : arr[0] }, 

						beforeSend: function() {
							//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
							$("#error_message").html("loading...");
						},

						error: function(xhr, textStatus, errorThrown) {
								$('#error_message').html(textStatus);
						},

						success: function( result ){
							if( result != "0" ) {
								$('#alert').html("");
								$('#alert').removeClass("alert alert-danger");
								$('#alert').append("<strong> Error at row " + (counter+1) + ":</strong><br />");
								$('#alert').append("Duplicate MaterialID<br />");
								$('#alert').addClass("alert alert-danger");
								$('.materialid').last().attr('style', 'color : red');
							} else {
								str = checkMatId( arr[0], arr[5], arr[6], arr[3] ) + checkName( arr[2] ) +  checkCourse( arr[3], arr[5] ) + checkAccess( arr[4], arr[5] ) + checkType( arr[5] ) + checkYear( arr[6] ) + checkEdvol( arr[7] ) + checkRequirement( arr[8] ) + checkQuantity( arr[9] );
								if ( $.trim(str) == "" ) $("#insertButton").attr('disabled', false);
								else {
									$('#alert').html("");
									$('#alert').removeClass("alert alert-danger");

									if ( $.trim(str) == "" ) $("#insertButton").attr('disabled', false);											
									else { 
										$('#alert').addClass("alert alert-danger");
										error = str.split(",");
										$('#alert').append("<strong> Error in row " + (counter+1) + " : </strong><br />");
										for( var i = 0; i < error.length; i++ ){
											
											$('#alert').append(error[i] + "<br />");
										}
										$("#insertButton").attr('disabled', true);
									}

								}
							}
						}
					});
				}
			}


			function checkISBN( isbn, type ){
				isbn = $.trim(isbn);
				if ( !checkISBNInFile(isbn) ){
					$('.isbn').last().attr('style', 'color : red');
					return "Duplicate ISBN,";
				} 

				if ( (type == 'Book' || type == 'References') && !( (isbn.match(/^[0-9]{10}$/)) ) ){
					$('.isbn').last().attr('style', 'color : red')
					return "Invalid ISBN,";
				
				} else if ( ( type == 'Journals' || type == 'Magazines' ) && !( (isbn.match(/^[0-9]{8}$/)) ) ){
					$('.isbn').last().attr('style', 'color : red')
					return "Invalid ISBN,";
				} else if ( ( type == 'SP' || type == 'Thesis' || type == "CD" ) && isbn != "" ){
					$('.isbn').last().attr('style', 'color : red');
					return "SP/Thesis/CD has no ISBN,";
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
					url: "<?php echo site_url(); ?>/admin/check_add_materialid",
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
					if( arrayGlobal[i][1] == isbn && isbn != ""){
						count++;
					}
				}
				
				if( count == 1 || count == 0) return true;
				else return false;
			}

			function checkISBNInDB( isbn, row ){
				$.ajax({
					type: "POST",
					url: "<?php echo site_url(); ?>/admin/check_add_isbn",
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
					$('.type').last().attr('style', 'color : red');
					$('.materialid').last().attr('style', 'color : red');
					return "Type is required,";					
				} else {
					if ( !checkMaterialIdInFile(materialid) ){
						$('.materialid').last().attr('style', 'color : red');
						return "Duplicate MaterialID,";
					}

					if (materialid == ""){
						$('.materialid').last().attr('style', 'color : red');
						return "MaterialID is required,";
					} else {
						if(type=='Book') {
							var index = materialid.indexOf("-");
							var courseTemp = materialid.slice(0, index);
							if( courseTemp != course ){
								$('.materialid').last().attr('style', 'color : red');
								return "MaterialID must match with the course,";
							} else if ( !materialid.match(/^(CS[0-9]{1,3})-([A-Z][0-9]{1,2})$/) ){
								$('.materialid').last().attr('style', 'color : red');
								return "Invalid Book MaterialID,";
							} else {								
								return "";
							}
						} else if(type=='Magazines') {
							if ( !materialid.match(/^M-([0-9]{1,2})$/) ){
								$('.materialid').last().attr('style', 'color : red');
								return "Invalid Magazine MaterialID,";
						 	}else {								
								return "";
							}
						
						} else if(type=='Thesis') {
							if ( !materialid.match(/^T-([0-9]{1,2})$/) ){
								$('.materialid').last().attr('style', 'color : red');
								return "Invalid Thesis MaterialID,";
							} else {	
								return "";
							}
						} else if(type=='References') {
							if ( !( (materialid.match(/^R-([0-9]{1,2})$/)) ) ){
								$('.materialid').last().attr('style', 'color : red');
								return "Invalid Reference MaterialID,";
							}else {
								return "";
							}
						} else if(type=='Journals') {
							if ( !( (materialid.match(/^J-([0-9]{1,2})$/)) ) ){
								$('.materialid').last().attr('style', 'color : red');
								return "Invalid Journal MaterialID,";
							
							}else {
								return "";
							}
						} else if(type=='SP') {
							if ( !( (materialid.match('/^SP'+year+'-([0-9]{1,2}[a-z]*)$/')) ) ){
								$('.materialid').last().attr('style', 'color : red');
								return "Invalid SP MaterialID,";
							
							}else {
								return "";
							}
						} else if(type=='CD') {
							if ( !materialid.match(/^CD-([0-9]{1,2})$/) ){
								$('.materialid').last().attr('style', 'color : red');
								return "Invalid CD MaterialID,";
							}else {
								return "";
							}
						}
					}
				}

				if ( !checkMaterialIdInFile(materialid) ){
					$('.materialid').last().attr('style', 'color : red');
					return "Duplicate MaterialID,";
				} else {
					return "";
				}
			}
		
			function checkName( name ){
				if (name == ""){
					$('.name').last().attr('style', 'color : red');
					return "Title is required,";
				} else if ( !( (name.match(/^([A-Z][A-Za-z0-9\.\,\-\'\?\!\:]+[\s]*)+$/)) ) ){
					$('.name').last().attr('style', 'color : red');
					return "Invalid title,";
				} else {
					return "";
				}
			}

			function checkAccess( access, type){
				/*
				if(type=="") {
					$('.type').last().attr('style', 'color : red');
					$('.access').last().attr('style', 'color : red');
					return "Type is required,";
				} else {
					if (access == ""){
						$('.access').last().attr('style', 'color : red');
						return "Access is required,";
					}else {
						if(type=='Book') {
							if ( !( (access.match(/^4$/)) ) ){
								$('.access').last().attr('style', 'color : red');
								return "Invalid access,";
 									
 							}else {
								return true;
 							}
 						} else if(type=='Magazines') {
							if ( !( (access.match(/^3$/)) ) ){
								$('.access').last().attr('style', 'color : red');
								return false;
									
							}else {
								return true;
 							}
 						} else if(type=='Thesis') {
 							if ( !( (access.match(/^3$/)) ) ){
 								$('.access').last().attr('style', 'color : red');
 								return false;
 							
 							} else {
								return true;
 							}
 						} else if(type=='References') {
 							if ( !( (access.match(/^2$/)) ) ){
 								$('.access').last().attr('style', 'color : red');
 								return false;
 							}else {
								return true;
 							}
 						} else if(type=='Journals') {
 							if ( !( (access.match(/^4$/)) ) ){
 								$('.access').last().attr('style', 'color : red');
 								return false;
 							}else {
								return true;
 							}
 						} else if(type=='SP') {
 							if ( !( (access.match(/^3$/)) ) ){
 								$('.access').last().attr('style', 'color : red');
 								return false;
 							}else {
								return true;
 							}
 						} else if(type=='CD') {
 							if ( access != '4' ){
 								$('.access').last().attr('style', 'color : red');
 								alert( "invalid" );
 								return false;
 							}else {
								return true;
 							}
 						} else {
 							return true;
 							}
 						}
 					}
 					*/

 					return "";
 				}
			
			function checkCourse( course, type ){
				if(type=="") {
					$('.type').last().attr('style', 'color : red');
					return "Type is required,";
				} else {
					if (course == ""){
						$('.course').last().attr('style', 'color : red');
						return "Course is required,";
					} else {
						if ( !course.match(/^(CS[0-9]{1,3})$/)){
							$('.course').last().attr('style', 'color : red');
							return "Invalid course,";
						} else {
							return "";
						} 
					}
				}
			}		
			

			function checkType( type ) {
				if (type == ""){
					$('.type').last().attr('style', 'color : red');
					return "Type is required,";
				} else if ( !type.match(/^(Book|Thesis|References|SP|Journals|Magazines|CD)$/) ){
					$('.type').last().attr('style', 'color : red');
					return "Invalid Type,";
				} else {
					return "";
				}
			}
			
			function checkYear( year ) {
				var y = new Date();
				current_year = y.getFullYear();
				if (year == ""){
					$('.year').last().attr('style', 'color : red');
					return "Year is required,";
				} else if ( !( (year.match(/^[0-9]{4}$/)) ) ){
					$('.year').last().attr('style', 'color : red');
					return "Invalid year,";	
				} else if( (year < 1950 || year > current_year) ){
					$('.year').last().attr('style', 'color : red');
					return "Invalid year,";	
				} else {
					return "";
				}
			}
			
			function checkEdvol( edvol ) {
				if ( !edvol.match(/^([0-9]{1,2})+$/) && edvol != "" ){
					$('.edvol').last().attr('style', 'color : red');
					return "Invalid edition/volume,";	
				} else {
					return "";
				}
			}
			
			function checkRequirement( requirement ) {
				if (requirement == ""){
					$('.requirement').last().attr('style', 'color : red');
					return "Requirement is required,";	
				} else if ( !( (requirement.match(/^(0|1)$/)) ) ){
					$('.requirement').last().attr('style', 'color : red');
					return "Invalid requirement,";	
				
				} else {
					return "";
				}
			}
			
			function checkQuantity( quantity ) {
				if (quantity == ""){
					$('.quantity').last().attr('style', 'color : red');
					return "Quantity is reuqired,";	
				} else if ( !( (quantity.match(/^[1-9]{1,3}$/)) ) ){
					$('.quantity').last().attr('style', 'color : red');
					return "Invalid quantity,";	
				} else {
					return "";
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