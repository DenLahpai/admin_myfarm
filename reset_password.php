<?php
require_once "functions.php";

if (!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
    echo 'email';
}
else {
    $rowCount = table_admins ('self_update', NULL, NULL);
}

?>