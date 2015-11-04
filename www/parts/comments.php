
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
	<form method="post" action="/comment.php" onsubmit="return check();">
		<textarea name="data" id="comment"></textarea>
		<input type="submit" value=" Send ">
	</form>
</div>

<?php

$comments = commentsImport($fileCommentsBase);
foreach ($comments as $index => $comment){
?>
<div class="comment">
	<span class="index"><?=$index; ?></span>
	<span class="user"><?=$comment['user']; ?></span>
	<span class="date"><?=$comment['date']; ?></span>
	<span class="data"><?=$comment['data']; ?></span>
	<span class="bann"><a href="/bann.php?login=<?=$comment['user']; ?>">bann user</a></span>
	<span class="uncomment"><a href="/uncomment.php?comment=<?=$index; ?>">del comment</a></span>
</div>
<?
}

?>