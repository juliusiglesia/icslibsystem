<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title;?></title>
</head>
<body>

<div id="container">
	<h1>Welcome to CodeIgniter!</h1>
	<a href="../admin">home</a>
	<table>
	<form action="update_page" method="post">
		<?php
		if($result != null){
			foreach($result as $row){
				echo "<tr><td><label>Material ID</label></td><td><input type='text' name='materialid' value='".$row->materialid."'/><td></tr>";								
				echo "<tr><td><label>Title</label></td><td><input type='text' name='name' value='".html_escape($row->name)."' required/> <td></tr>";
				echo "<tr><td><label>Course Class</label></td><td><input type='text' name='course' value='". $row->course."' /> <td></tr>";
				
				echo "<tr><td><label>Availability</label></td><td>";
				echo "<input type='radio' name='available' value='1'";
				if($row->available==1)echo "checked";
				echo "/> YES";
				echo "<input type='radio' name='available' value='0'";
				if($row->available==0)echo "checked";
				echo "/> NO";
				echo "</td></tr>";
				
				echo "<tr><td><label>Accessibility</label></td><td>";
				echo "<select name='access' value='".$row->access."'>";
				echo "<option value='1'";
				if($row->access==1)echo "selected>";
				else echo ">";
				echo " Student </option>";
				echo "<option value='2'";
				if($row->access==2)echo "selected>";
				else echo ">";
				echo " Faculty </option>";
				echo "<option value='3'";
				if($row->access==3)echo "selected>";
				else echo ">";
				echo " Room Use </option>";
				echo "<option value='4'";
				if($row->access==4)echo "selected>";
				else echo ">";
				echo " Student/Faculty </option>";
				echo "</select>";
				echo "</td></tr>";
				
				//echo "<tr><td><label>Type</label></td><td><input type='text' name='type' value='". $row->type."'/> <td></tr>";
				echo "<tr><td><label>Type</label></td><td>";
				echo "<select name='type' value='".$row->type."'>";
				echo "<option value='book'";
				if($row->type=="Book")echo "selected>";
				else echo ">";
				echo " Book </option>";
				echo "<option value='sp'";
				if($row->type=="sp")echo "selected>";
				else echo ">";
				echo " SP </option>";
				echo "<option value='thesis'";
				if($row->type=="thesis")echo "selected>";
				else echo ">";
				echo " Thesis </option>";
				echo "<option value='references'";
				if($row->type=="references")echo "selected>";
				else echo ">";
				echo " References</option>";
				echo "<option value='cd'";
				if($row->type=="cd")echo "selected>";
				else echo ">";
				echo " CD </option>";
				echo "<option value='journals'";
				if($row->type=="journals")echo "selected>";
				else echo ">";
				echo " Journals </option>";
				echo "<option value='magazine'";
				if($row->type=="magazine")echo "selected>";
				else echo ">";
				echo " Magazine </option>";
				echo "</select>";
				echo "</td></tr>";
				
				echo "<tr><td><label>Year Published</label></td><td><input type='text' name='year' value='". $row->year."' required/> <td></tr>";
				//echo "<tr><td><label>Ed. vol</label></td><td><input type='text' name='edvol' value='". $row->edvol."' /> <td></tr>";
				//echo "<tr><td><label>Borrowed Count</label></td><td><input type='text' name='borrowedcount' value='". $row->borrowedcount."' /> <td></tr>";
				//echo "<tr><td><label>Requirement</label></td><td><input type='text' name='requirement' value='". $row->requirement."'/> <td></tr>";
				echo "<tr><td><label>Requirement</label></td><td>";
				echo "<input type='radio' name='requirement' value='1'";
				if($row->requirement==1)echo "checked";
				echo "/> COI/COO";
				echo "<input type='radio' name='requirement' value='0'";
				if($row->requirement==0)echo "checked";
				echo "/> None";
				echo "</td></tr>";
				//echo "<tr><td><label>Rating</label></td><td><input type='text' name='rating' value='". $row->rating."'/> <td></tr>";
				echo "<tr><td><label>Quantity</label></td><td><input type='text' name='quantity' value='". $row->quantity."' required/> <td></tr>";
				echo "<tr><td><label>Borrowed Copy</label></td><td><input type='text' name='borrowedcopy' value='". $row->borrowedcopy."' required/> <td></tr>";
				echo "<tr><td><input type = 'submit' /></td></tr>";
			}
		}else{
			echo "Not Available";
		}
		?>
		
	</form>
	</table>
</div>

</body>
</html>