<?php  
require_once "functions.php";
$database = new Database();
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$query = "SELECT * FROM admins 
	WHERE BINARY username = :username
	AND BINARY password = :password
	AND status = 1
;";
$database->query($query);
$database->bind(':username', $username);
$database->bind(':password', md5($password));
echo $rowCount = $database->rowCount();
$rows = $database->resultset();
if ($rowCount == 1) {
	foreach ($rows as $row) {
		$_SESSION['adminsId'] = $row->Id;
		$_SESSION['username'] = $row->username;
	}
}
?>