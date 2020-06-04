<?php  
require_once "functions.php";
if (empty($_POST['sorting'])) {
	$sorting = 'ORDER BY Id DESC';
}
else {
	$sorting = $_POST['sorting'];
}

if (empty($_POST['limit'])) {
	$limit = 30;
}
else {
	$limit = $_POST['limit'];
}

if (empty($_POST['search'])) {
	$job = "select_all";
}
else {
	$job = 'search';
}

header ('Content-Type: text/csv; charset=utf-8');
header ('Content-Disposition: attachment; filename=Users.csv');
$output = fopen("php://output", "w");
$fields = array(
	'Id',
	'Username',
	'Password',
	'Title',
	'Name',
	'Mobile',
	'Email',
	'DOB',
	'Address',
	'Town',
	'State',
	'CountryCode',
	'Language',
	'Status',
	'Created',
	'Updated'
);
fputcsv($output, $fields);

$rows_Users = table_Users ($job, 'array', NULL, $sorting, $limit);
foreach ($rows_Users as $row_Users) {
	fputcsv($output, $row_Users);
	// print_r($row_Users);
}
fclose($output);

?>