<?php
require_once "functions.php";
$rows_admins = table_admins ('select_all', NULL, NULL);
?>
<!-- table-container -->
<div class="table-container">
    <div id="response1" style="text-align: center;"></div>
    <!-- admins-data-table -->
    <div class="admins-data-table">
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>###</th>
                </tr>
            </thead>
            <tbody>
                <? foreach ($rows_admins as $row_admins): ?>
                    <form id="<? "form".$row_admins->Id; ?>" action="test.php" method="POST">
                        <tr>
                            <td>
                                <input class="<? echo "class".$row_admins->Id; ?>" type="text" name="username" id="<? echo "username".$row_admins->Id ?>" value="<? echo $row_admins->username; ?>" readonly>
                            </td>
                            <td>
                                <input class="<? echo "class".$row_admins->Id; ?>" type="text" name="email" id="<? echo "email".$row_admins->Id; ?>" value="<? echo $row_admins->email; ?>" readonly>
                            </td>
                            <td>
                                <input class="<? echo "class".$row_admins->Id; ?>" type="text" name="mobile" id="<? echo "mobile".$row_admins->Id; ?>" value="<? echo $row_admins->mobile; ?>" readonly>
                            </td>
                            <td>
                            <button type="button" name="button" id="btn-edit" onclick="allowEditData('<? echo $row_admins->Id; ?>')">Edit</button>
                    <button type="button" name="button" id="<? echo "btn-submit".$row_admins->Id; ?>" onclick="updateAdminsData('<? echo $row_admins->Id; ?>')"  disabled>Update</button>
                            </td>
                        </tr>
                    </form>        
                <? endforeach; ?>
            </tbody>
        </table>    
    </div>
    <!-- end of admins-data-table -->
</div>
<!-- end of table-container -->