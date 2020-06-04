<?php
require_once "functions.php";
$rowCount = table_Users ('rowCount', NULL, NULL, NULL, NULL);
?>
<section id="users-menu">
	<!-- menu-bar-->
	<div class="menu-bar">
		<!-- menu-bar-items -->
		<div class="menu-bar-items">
			<div class="menu-bar-item" onclick="changeData('users-data', 'users_data_grid.php'); change_users_data_page('users_data_grid.php');">
				Grid View
			</div>
			<div class="menu-bar-item" onclick="changeData('users-data', 'users_data_table.php'); change_users_data_page('users_data_table.php');">
				Table View
			</div>
			<div class="menu-bar-item">
				<input type="hidden" name="data_page" id="data_page" value="users_data_grid.php">
			</div>								
			<div class="menu-bar-item">
				<select name="sorting" id="sorting" onchange="reloadUsersData();">
					<option value="ORDER BY Id DESC">Newest to Oldest</option>
					<option value="ORDER BY Id ASC">Oldest to Newest</option>
					<option value="ORDER BY Username ASC">By Username: A to Z</option>
					<option value="ORDER BY Username DESC">By Username: Z to A</option>
					<option value="ORDER BY Name ASC">By Name: A to Z</option>
					<option value="ORDER BY Name DESC">By Name: Z to A</option>
					<option value="ORDER BY Town ASC">By Town: A to Z</option>
					<option value="ORDER BY Town DESC">By Tonw: Z to A</option>
				</select>	
			</div>
			<div class="menu-bar-item">
				<select name="limit" id="limit" onchange="reloadUsersData()">
					<?php
					$i = 30;
					while ($i <= $rowCount + 30) {
						echo "<option value=\"$i\">".$i."</option>";
						$i += 30;
					}
					?> 
				</select>
			</div>
			<div class="menu-bar-item">
				<input type="text" name="search" id="search">
				<button type="button" id="btn-search" onclick="reloadUsersData();">Search</button>
			</div>
			<div class="menu-bar-item">
				<button type="button" id="btn-export" onclick="exportData('export_users_data.php');">Export</button>
			</div>
		</div>
		<!-- menu-bar-items -->		
	</div>
	<!-- end of menu-bar -->
	
</section>