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

$rows_Messages = table_Messages ($job, NULL, NULL, $sorting, $limit);
?>
<!-- grid-container -->
<div class="grid-container">
<?php foreach ($rows_Messages as $row_Messages): ?>
	<!-- grid-item -->
		<div class="grid-item">
			<!-- messages-data-grid-items -->
			<div class="messages-data-grid-items">
				<div>
					From: <? echo $row_Messages->Name.' ['.$row_Messages->Email.']' ; ?>
				</div>
				<div>
					<? echo $row_Messages->Message; ?>
				</div>
				<div style="font-style: italic;">
					<? echo $row_Messages->Created; ?>
				</div>
			</div>
			<!-- end message-data-grid-items -->
		</div>
	<!-- end of grid-item -->
<?php endforeach ?>
</div>
<!-- end of grid-container -->