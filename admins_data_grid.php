<?php
require_once "functions.php";
$rows_admins = table_admins ('select_all', NULL, NULL);
?>
<div id="response1" style="text-align: center;"></div>
<!-- grid-container -->
<div class="grid-container">
<?php foreach($rows_admins as $row_admins): ?>
    <!--grid-item  -->
    <div class="grid-item">
        <!-- admins-data-grid-items -->
        <div class="admins-data-grid-items">
              <form id="<?php echo "form".$row_admins->Id; ?>" action="admins_data_update.php" method="POST">
                <div>
                    <input type="text" class="<? echo "class".$row_admins->Id; ?>" name="username" id="<? echo "username".$row_admins->Id; ?>" value="<? echo $row_admins->username; ?>" readonly>
                </div>
                <div>
                    <input type="text" class="<? echo "class".$row_admins->Id; ?>" name="email" id="<? echo "email".$row_admins->Id; ?>" value="<? echo $row_admins->email; ?>" readonly>
                </div>
                <div>
                    <input type="text" class="<? echo "class".$row_admins->Id; ?>" name="mobile" id="<? echo "mobile".$row_admins->Id; ?>" value="<? echo $row_admins->mobile; ?>" readonly>
                </div>
                <div>
                    <input type="hidden" name="adminsId" id="<? echo "adminsId".$row_admins->Id; ?>" value="<? echo $row_admins->Id; ?>">
                </div>
                <div style="text-align: center;">
                    <button type="button" name="button" id="btn-edit" onclick="allowEditData('<? echo $row_admins->Id; ?>')">Edit</button>
                    <button type="button" name="button" id="<? echo "btn-submit".$row_admins->Id; ?>" onclick="updateAdminsData('<? echo $row_admins->Id; ?>')"  disabled>Update</button>
                </div>
                <!-- <div style="text-align: center;" id="<? //echo "response".$row_admins->Id; ?>"></div> -->
            </form>
        </div>
        <!-- end of admin-data-grid-items -->
    </div>
    <!-- end of grid-item -->
<?php endforeach; ?>    
</div>
<!-- end of grid-container -->
