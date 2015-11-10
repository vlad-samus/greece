<?php

if(!empty($USER)){
?>

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

<div class="comment-add">
	<form method="post" action="/actions/comment.php" onsubmit="return check();">
		<input name="user" type="hidden" value="<?=$USER; ?>" >
		<textarea name="data" id="comment"></textarea>
		<input type="submit" value=" Send ">
	</form>
</div>

<?php
}
?>

<div class="comments">
<?php

$comments = commentsImport($fileCommentsBase);
if(empty($USER) || !$USERS[$USER]['admin']){
	$comments = array_filter($comments, commentShown);
}
$page = intval(@$_GET['page']);
$per_page = 10;
$data_count = count($comments);
$i = -1;
$num = 0;
foreach($comments as $index => $comment){
	$i++;
	$num++;
	if($i<$page*$per_page) continue;
	if($i>=min(($page+1)*$per_page,$data_count)) break;
?>
	<div class="comment">
		<span class="index"><?=$num; ?></span>
		<span class="user"><?=$comment['user']; ?></span>
		<span class="date"><?=$comment['date']; ?></span>
		<span class="data"><?=$comment['data']; ?></span>
		<span class="moderated"><?=$comment['moderated'] ? 'm1' : 'm0'; ?></span>

<?php
	if(!empty($USER) &&
		($USERS[$USER]['banned']==false) &&
		($USERS[$USER]['admin']==true))
	{
?>

		<span class="bann"><a href="/actions/bann.php?login=<?=$comment['user']; ?>">bann user</a></span>
		<span class="moderate"><a href="/actions/moderated.php?comment=<?=$index; ?>">moderate</a></span>
		<span class="uncomment"><a href="/actions/uncomment.php?comment=<?=$index; ?>">del comment</a></span>

<?php
	}
?>

	</div>

<?
}
?>

</div>
<div class="pages">

<?
for ($index=0; $index<ceil($data_count/$per_page); $index++){ 
?>

	<span><a href="?page=<?=$index; ?>"><?=$index+1; ?></a></span>

<?
}
?>

</div>
