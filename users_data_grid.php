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


$rows_Users = table_Users($job, NULL, NULL, $sorting, $limit);
?>
<div id="response1" style="text-align: center;"></div>
<!-- grid-container -->
<div class="grid-container">
<?php foreach ($rows_Users as $row_Users): ?>
	<!-- grid-item -->
	<div class="grid-item">
		<!-- users-data-grid-items -->
		<div class="users-data-grid-items">
			<form action="#" method="POST" id="<? echo "form".$row_Users->Id; ?>">
				<div>
					<? echo $row_Users->Username; ?>
				</div>
				<div>
					<select name="title" id="<? echo "Title".$row_Users->Id; ?>">
						<?php
						switch ($row_Users->Title) {
							case 'Mr':
								echo "<option value=\"Mr\">Mr.</option>";
								echo "<option value=\"Mrs\">Mr.</option>";
								echo "<option value=\"Ms\">Ms.</option>";
								break;

							case 'Mrs':
								echo "<option value=\"Mr\">Mr.</option>";
								echo "<option value=\"Mrs\" selected>Mrs.</option>";
								echo "<option value=\"Ms\">Ms.</option>";
								break;

							case 'Ms':
								echo "<option value=\"Mr\">Mr.</option>";
								echo "<option value=\"Mrs\">Mrs.</option>";
								echo "<option value=\"Ms\" selected>Ms.</option>";
								break;

							default:
								# code...
								break;
						}
						?>	
					</select>
					<input type="text" class="<? echo "class".$row_Users->Id; ?>" name="Name" id="<? echo "Name".$row_Users->Id; ?>" value="<? echo $row_Users->Name; ?>" readonly>
				</div>
				<div>
					<input type="text" class="<? echo "class".$row_Users->Id; ?>" name="Mobile" id="<? echo "Mobile".$row_Users->Id;?>" value="<? echo $row_Users->Mobile; ?>" readonly>
				</div>
				<div>
					<input type="date" class="<? echo "class".$row_Users->Id; ?>" name="DOB" id="<? echo "DOB".$row_Users->Id; ?>" value="<? echo $row_Users->DOB; ?>" readonly>
				</div>
				<div>
					<textarea class="<? echo "class".$row_Users->Id; ?>" name="Address" id="<? echo "Address".$row_Users->Id; ?>" readonly>
						<?php echo $row_Users->Address; ?>
					</textarea>
				</div>
				<div>
					<input type="text" class="<? echo "class".$row_Users->Id?>" name="Town" id="<? echo "Town".$row_Users->Id; ?>" value="<? echo $row_Users->Town; ?>" readonly>
				</div>
				<div>
					<input type="text" class="<? echo "class".$row_Users->Id?>" name="State" id="<? echo "State".$row_Users->Id;?>" value="<? echo $row_Users->State; ?>" readonly>
				</div>
				<div>
					<select name="CountryCode" id="<? echo "CountryCode".$row_Users->Id; ?>">
						<?php  
						$rows_Countries = table_Countries ('select_all', NULL, NULL);
						foreach ($rows_Countries as $row_Countries) {
							if ($row_Users->CountryCode == $row_Countries->Code) {
								echo "<option value=\"$row_Countries->CountryCode\" selected>".$row_Countries->Country."</option>";
							}
							else {
								echo "<option value=\"$row_Countries->CountryCode\">".$row_Countries->Country."</option>";
							}
						}
						?>
					</select>
				</div>
				<div style="text-align: center;">
					<button type="button" name="button" onclick="allowEditData('<? echo $row_Users->Id; ?>')">Edit</button>
					<button type="button" name="button" id="<? echo "btn-submit".$row_Users->Id; ?>" onclick="updateUsersData('<? echo $row_Users->Id; ?>')"  disabled>Update</button>
					<button type="button" name="button" onclick="resetPassword('<? echo $row_Users->Id; ?>')">Reset Password</button>
				</div>
			</form>
		</div>
		<!-- end of users-data-grid-items -->
	</div>
	<!-- end of grid-item -->
<?php endforeach; ?>	
</div>
<!-- end of grid-container -->