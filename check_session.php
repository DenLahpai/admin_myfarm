<?php  
require_once "functions.php";

if (isset($_SESSION['adminsId'])) {
	$rows = table_admins ('select_one', $_SESSION['adminsId'], NULL);
	$column_name = $_POST['column_name'];
	foreach ($rows as $row) {
		echo $row->$column_name;		
	}
}
else {
	echo 0;
}
?>