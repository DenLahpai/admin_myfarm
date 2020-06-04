<?php  
require_once "functions.php";
if (isset($_POST['UsersId'])) {
	echo table_Users ('reset_password', NULL, NULL, NULL, NULL);
}
?>