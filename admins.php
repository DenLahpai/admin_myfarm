<?php
require_once "functions.php";

if (!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
    echo 'email';
}
else {
    $rowCount = table_admins ('check_before_insert', NULL, NULL);
    if ($rowCount == 0) {
        table_admins ('insert', NULL, NULL);
    }
    else {
        echo $rowCount;
    }
}

?>