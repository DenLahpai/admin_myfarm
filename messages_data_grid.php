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
<!-- <div class="grid-container"> -->
<?php foreach ($rows_Messages as $row_Messages): ?>
	<div class="messages-data">
		<?php if ($row_Messages->Seen == 0): ?>
			<div class="unread-message" id="<? echo "messagesId".$row_Messages->Id; ?>">
			<?php else: ?>
			<div id="<? echo "messagesId".$row_Messages->Id; ?>">
		<?php endif ?>				
			<div>
				From: <? echo $row_Messages->Name.' ['.$row_Messages->Email.']' ; ?>
			</div>
			<div>
				<? echo $row_Messages->Message; ?>
			</div>
			<div style="font-style: italic;">
				<? echo $row_Messages->Created; ?>
			</div>
			<div style="text-align: center;">
				<span class="green-ballot" title="Mark as Read" onclick="readUnread('1', <? echo $row_Messages->Id; ?>);">&#10004;</span> 
				&nbsp; 
				<span class="red-cross" title="Mark as Unread" onclick="readUnread('0', <? echo $row_Messages->Id; ?>)">&#10008;</span>
			</div>
		</div>
	</div>			
<?php endforeach ?>
