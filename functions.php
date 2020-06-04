<?php
require_once "conn.php";

//function to data from the table admins
function table_admins ($job, $var1, $var2) {
	$database = new Database();

	switch ($job) {
		case 'select_one':
			# var1 = adminsId
			$query = "SELECT * FROM admins
				WHERE Id = :adminsId
			;";
			$database->query($query);
			$database->bind(':adminsId', $var1);
			return $r = $database->resultset();
			break;

		case 'self_update':
			if (empty($_REQUEST['password1']) || $_REQUEST['password1'] == NULL || $_REQUEST['password1'] == "") {
				$query = "UPDATE admins SET
					email = :email,
					mobile = :mobile
					WHERE Id = :adminsId
				;";
				$database->query($query);
				$database->bind(':email', trim($_REQUEST['email']));
				$database->bind(':mobile', trim($_REQUEST['mobile']));
				$database->bind(':adminsId', $_SESSION['adminsId']);
				if ($database->execute()) {
					echo "<span class='green'>Your info has been updated! No changes were made to your password!</span>";
				}
				else {
					echo "<span class='error'>There was a connection error! Please try again!</span>";
				}
			}
			else {
				$query = "UPDATE admins SET
					password = :password,
					email = :email,
					mobile = :mobile
					WHERE Id = :adminsId
				;";
				$database->query($query);
				$database->bind(':password', md5($_REQUEST['password1']));
				$database->bind(':email', trim($_REQUEST['email']));
				$database->bind(':mobile', trim($_REQUEST['mobile']));
				$database->bind(':adminsId', $_SESSION['adminsId']);
				if ($database->execute()) {
					echo "<span class='green'>You info and password has been changed!</span>";
				}
				else {
					echo "<span class='error'>There was a connection error! Please try again!</span>";
				}
			}
			break;

		case 'check_before_insert':
			$query = "SELECT * FROM admins
				WHERE username = :username
			;";
			$database->query($query);
			$database->bind(':username', trim($_REQUEST['username']));
			return $r = $database->rowCount();
			break;

		case 'insert':
			$query = "INSERT INTO admins SET
				username = :username,
				password = :password,
				email = :email,
				mobile = :mobile,
				status = :status
			;";
			$database->query($query);
			$database->bind(':username', trim($_REQUEST['username']));
			$database->bind(':password', md5('goodLuckadmin'));
			$database->bind(':email', trim($_REQUEST['email']));
			$database->bind(':mobile', trim($_REQUEST['mobile']));
			$database->bind(':status', 1);
			if ($database->execute()) {
				echo "<span class='green'>Account created successfully!</span>";
			}
			else {
				echo "<span class='error'>There was a connection error! Please try again!</span>";
			}

		case 'select_all':
			$query = "SELECT * FROM admins ORDER BY Id ;";
			$database->query($query);
			return $r = $database->resultset();
			break;

		case 'check_before_update':
			$query = "SELECT Id FROM admins
				WHERE username = :username
				AND Id != :adminsId
				;";
			$database->query($query);
			$database->bind(':username', trim($_REQUEST['username']));
			$database->bind(':adminsId', $_REQUEST['adminsId']);
			return $r = $database->rowCount();
			break;

		case 'update':
			$query = "UPDATE admins SET
				username = :username,
				email = :email,
				mobile = :mobile
				WHERE Id = :adminsId
			;";
			$database->query($query);
			$database->bind(':username', trim($_REQUEST['username']));
			$database->bind(':email', trim($_REQUEST['email']));
			$database->bind(':mobile', trim($_REQUEST['mobile']));
			$database->bind(':adminsId', trim($_REQUEST['adminsId']));
			if ($database->execute()) {
				echo "<span class='green'>User data updated successfully!</span>";
			}
			else {
				echo "<span class='error'>There was a connection error! Please try again!</span>";
			}
			break;

		default:
			# code...
			break;
	}
}

//function to use data from the table users
function table_Users ($job, $var1, $var2, $sorting, $limit) {
	$database = new Database();

	switch ($job) {
		case 'rowCount':
			$query = "SELECT * FROM Users ;";
			$database->query($query);
			return $database->rowCount();
			break;

		case 'select_all':
			$query = "SELECT * FROM Users $sorting LIMIT $limit ;";
			$database->query($query);
			$database->bind(':sorting', $sorting);
			$database->bind(':limit', $limit);
			if ($var1 == 'array') {
				return $database->resultArray();
			}
			else {
				return $database->resultset();
			}

			break;

		case 'search':
			$search = '%'.$_POST['search'].'%';
			$query = "SELECT * FROM Users WHERE 
				CONCAT (
					Username,
					Name,
					Mobile,
					Email,
					Address,
					Town,
					State
				) LIKE :search $sorting LIMIT $limit
			;";
			$database->query($query);
			$database->bind(':search', $search);
			if ($var1 == 'array') {
				return $database->resultArray();
			}
			else {
				return $database->resultset();
			}
			break;	

		case 'reset_password':
			$day = date("d");
			$query = "UPDATE Users SET
				Password = :Password 
				WHERE Id = :UsersId ;";
			$database->query($query);
			$database->bind(':Password', md5('goodluck'.$day));
			$database->bind(':UsersId', $_POST['UsersId']);
			if ($database->execute()) {
				echo "<span class=\"green\">The new password is goodluck".$day."</span>";
			}
			else {
				echo "<span class=\"error\">There was a connection error! Please try again!</span>";
			}
			break;	

		case 'update':
			$query = "UPDATE Users SET 
				Title = :Title,
				Name = :Name,
				Mobile = :Mobile,
				DOB = :DOB,
				Address = :Address,
				Town = :Town,
				State = :State,
				CountryCode = :CountryCode 
				WHERE Id = :UsersId
			;";
			$database->query($query);
			$database->bind(':Title', $_REQUEST['Title']);
			$database->bind(':Name', $_REQUEST['Name']);
			$database->bind(':Mobile', $_REQUEST['Mobile']);
			$database->bind(':DOB', $_REQUEST['DOB']);
			$database->bind(':Address', $_REQUEST['Address']);
			$database->bind(':Town', $_REQUEST['Town']);
			$database->bind(':State', $_REQUEST['State']);
			$database->bind(':CountryCode', $_REQUEST['CountryCode']);
			$database->bind(':UsersId', $_REQUEST['Id']);
			if ($database->execute()) {
				echo "<span class=\"green\">Data updated successfully!</span>";
			}
			else {
				echo "<span class=\"error\">There was a connection error! Please try again!</span>";
			}
			break;
		
		default:
			# code...
			break;
	}
}

//function to use data from the table Messages
function table_Messages ($job, $var1, $var2, $sorting, $limit) {
	$database = new Database();

	switch ($job) {
		case 'select_all':
			$query = "SELECT * FROM Messages $sorting LIMIT $limit ;";
			$database->query($query);
			return $r = $database->resultset();
			break;
		
		default:
			# code...
			break;
	}
}

//function to use data from the table countries
function table_Countries ($job, $var1, $var2) {
	$database = new Database();

	switch ($job) {
		case 'select_all':
			$query = "SELECT * FROM Countries ORDER BY Id ASC ;";
			$database->query($query);
			return $database->resultset();
			break;
		
		default:
			# code...
			break;
	}
}


?>
