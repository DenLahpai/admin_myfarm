<?php
require_once "functions.php";
$column = $_REQUEST['column'];
$rows_admins = table_admins('select_one', $_SESSION['adminsId'], NULL);
foreach ($rows_admins as $row_admins) {
    echo $row_admins->$column;
}

?>