<?php 
//require_once('../config.php');
$connection = mysqli_connect('localhost','root','','mydatabase');
$mysql_query = mysqli_query($connection, "Select * from country");


while($mysql_rows = mysqli_fetch_array($mysql_query)){
	echo "<div class='form-group'><label class='col-sm-6 control-label'>".$mysql_rows['name']."</label></div><hr>";
}
//close_db($connection);
?> 