<?php
if(empty($USER)) return;
?>

<div style="float: right; margin: 4px 16px 0 0; text-align: right;">
	Hello, <?=$USER;?> | <a href="/logout.php">logout</a>
</div>
