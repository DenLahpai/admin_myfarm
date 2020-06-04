<?php  
require_once "functions.php";
$rowCount = table_Messages ('rowCount', NULL, NULL, NULL, NULL);
?>
<section id="messages-menu">
	<!-- menu-bar -->
	<div class="menu-bar">
		<!-- menu-bar-items -->
		<div class="menu-bar-items">
			<div class="menu-bar-item">
				<select name="sorting" id="sorting" onchange="reloadMessagesData();">
					<option value="ORDER BY Id DESC">Newest to Oldest</option>
					<option value="ORDER BY Id ASC">Oldest to Newest</option>
					<option value="ORDER BY Name ASC">By Name: A to Z</option>
					<option value="ORDER BY Name DESC">By Name: Z to A</option>	
				</select>	
			</div>
			<div class="menu-bar-item">
					<select name="limit" id="limit" onchange="reloadMessagesData()">
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
				<button type="button" id="btn-search" onclick="reloadMessagesData();">Search</button>
			</div>
			<div class="menu-bar-item">
				<button type="button" id="btn-export" onclick="exportData('export_users_data.php');">Export</button>
			</div>			
		</div>
		<!-- end of menu-bar-items -->
	</div>
	<!-- end of menu-bar -->
</section>