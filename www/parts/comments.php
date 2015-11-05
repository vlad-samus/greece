
<script type="text/javascript">
	function check(form){
		var textarea = document.getElementById('comment');
		var text = textarea.innerHTML;
		if (text.match('(?:^|[\s])xxx(?:[\s]|$)')){
			alert('!!!');
			return false;
		}
		return true;
	}
</script>

<div>
	<form method="post" action="/actions/comment.php" onsubmit="return check();">
		<textarea name="data" id="comment"></textarea>
		<input type="submit" value=" Send ">
	</form>
</div>

<?php

$comments = commentsImport($fileCommentsBase);
$page = intval(@$_GET['page']);
$per_page = 10;
$data_count = count($comments);
for ($index=$page*$per_page; $index<min(($page+1)*$per_page,$data_count); $index++){ 
	$comment = $comments[$index];
?>
<div class="comment">
	<span class="index"><?=$index+1; ?></span>
	<span class="user"><?=$comment['user']; ?></span>
	<span class="date"><?=$comment['date']; ?></span>
	<span class="data"><?=$comment['data']; ?></span>

<?php
	if(!empty($USER) &&
		($USERS[$USER]['banned']==false) &&
		($USERS[$USER]['admin']==true))
	{
?>

	<span class="bann"><a href="/actions/bann.php?login=<?=$comment['user']; ?>">bann user</a></span>
	<span class="uncomment"><a href="/actions/uncomment.php?comment=<?=$index; ?>">del comment</a></span>

<?php
	}
?>

</div>
<div class="pages">

<?
}
for ($index=0; $index<ceil($data_count/$per_page); $index++){ 
?>

	<a href="?page=<?=$index; ?>"><?=$index+1; ?></a>

<?
}
?>

</div>
