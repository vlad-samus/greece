<?php
if(empty($USER)) return;
?>

<div style="float: right; margin: 4px 16px 0 0; text-align: right;">
	Hello, <?=$USER;?> 

<?php
if(!empty($USER) &&
	($USERS[$USER]['banned']==false) &&
	($USERS[$USER]['admin']==true))
{
?>

	| <a href="/admin.php">admin</a> 

<?php
}
?>

	| <a href="/actions/logout.php">logout</a>
</div>
