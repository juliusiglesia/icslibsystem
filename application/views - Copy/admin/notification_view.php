<?php

/*
*	Filename: notification_view.php
*	Project Name: ICS Library System
*	Date Created: 26 January 2014
*	Created by: Charlene C. Canedo
*
*/	

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title> ICSLibrarySystem : Notification </title>
	</head>
	<body>
    <h1>Hello Admin!</h1>
    <?php echo form_open('admin/notification', array('name' => 'form')); ?>
        <table border="0">
            <tr>
                <td>ID-Number:</td>
                <td> 
				<select name="idnumber"> 
				<?php foreach($groups as $row){ echo '<option value="'.$row->idnumber.'">'.$row->idnumber.'</option>';}?>
				</select></td>
            </tr> 
			<tr>
                <td>Message:</td>
				<td>
				<label> Notify </label><input type="radio" name="message" value="1" ></input>
				<label> Near Due </label><input type="radio" name="message" value="2" ></input>
				<label> Over Due </label><input type="radio" name="message" value="3" ></input>
				<label> Received </label><input type="radio" name="message" value="4" ></input>
				</td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Submit"></input></td>
            </tr>        
        </table>
    <?php echo form_close(); ?>
	</body>
</html>