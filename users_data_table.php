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
<!-- table-container -->
<div class="table-container">
	<!-- report-table -->
	<div class="users-data-table">
		<table>
			<thead>
				<tr>
					<th>Username</th>
					<th>Name</th>
					<th>Mobile</th>
					<th>Email</th>
					<th>DOB</th>
					<th>Town</th>
					<th>State</th>
					<th>CountryCode</th>
					<th>###</th>										
				</tr>
			</thead>
			<tbody>
				<?php foreach ($rows_Users as $row_Users): ?>
					<tr>
						<td>
							<input class="<? echo 'class'.$row_Users->Id; ?>" type="text" name="Username" id="<? echo 'Username'.$row_Users->Id; ?>" value="<? echo $row_Users->Username ?>" readonly>
						</td>
						<td>
							<select name="title" id="<? echo "Title".$row_Users->Id; ?>">
								<?php
								switch ($row_Users->Title) {
									case 'Mr':
										echo "<option value=\"Mr\">Mr.</option>";
										echo "<option value=\"Mrs\">Mrs.</option>";
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
							<input class="<? echo 'class'.$row_Users->Id; ?>" type="text" name="Name" id="<? echo 'Name'.$row_Users->Id; ?>" value="<? echo $row_Users->Name; ?>" readonly>
						</td>
						<td>
							<input class="<? echo 'class'.$row_Users->Id; ?>" type="text" name="Mobile" id="<? echo 'Mobile'.$row_Users->Id; ?>" value="<? echo $row_Users->Mobile; ?>" readonly>
						</td>
						<td>
							<input class="<? echo 'class'.$row_Users->Id; ?>"  type="text" name="Email" id="<? echo 'Email'.$row_Users->Id; ?>" value="<? echo $row_Users->Email; ?>" readonly>
						</td>
						<td>
							<input class="<? echo 'class'.$row_Users->Id; ?>" type="date" name="DOB" id="<? echo 'DOB'.$row_Users->Id; ?>" value="<? echo $row_Users->DOB; ?>" readonly>
						</td>
						<td>
							<input type="hidden" name="Address" id="<? echo 'Address'.$row_Users->Id ?>" value="<? echo $row_Users->Address ?>">
							<input class="<? echo 'class'.$row_Users->Id; ?>" type="text" name="Town" id="<? echo 'Town'.$row_Users->Id; ?>" value="<? echo $row_Users->Town ?>" readonly>
						</td>
						<td>
							<input class="<? echo 'class'.$row_Users->Id ?>" type="text" name="State" id="<? echo 'State'.$row_Users->Id ?>" value="<? echo $row_Users->State ?>" readonly>
						</td>
						<td>
							<select name="CountryCode" id="<? echo 'CountryCode'.$row_Users->Id ?>">
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
						</td>
						<td>
							<button type="button" name="button" onclick="allowEditData('<? echo $row_Users->Id; ?>')">Edit</button>
							<button type="button" name="button" id="<? echo "btn-submit".$row_Users->Id; ?>" onclick="updateUsersData('<? echo $row_Users->Id; ?>')"  disabled>Update</button>
							<button type="button" name="button" onclick="resetPassword('<? echo $row_Users->Id; ?>')">Reset Password</button>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
	<!-- end of users-data-table -->
</div>
<!-- end of table-container -->