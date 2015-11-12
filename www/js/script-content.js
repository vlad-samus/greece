var commentsRefresh = function(){
	var users = LSloadUsers();
	var comments = LSloadComments();
	var me = LSloadMe();
	me = users.find(function(user){ return user['login']==me;});
	var div_comments = 'div.comments';
	$(div_comments).css('display', 'none');
	$(div_comments).empty();
	for(var index in comments){
		var comment = comments[index];
		var user = comment['user'];
		var date = comment['date'];
		var data = comment['data'];
		var moderated = comment['moderated'];
		var div_comment_view = $('<div class="comment-view" id="comment-' + index + '"></div>').appendTo(div_comments);
		$('<span class="index">' + index + '</span>').appendTo(div_comment_view);
		$('<span class="user">' + user + '</span>').appendTo(div_comment_view);
		$('<span class="date">' + date + '</span>').appendTo(div_comment_view);
		$('<span class="data">' + data + '</span>').appendTo(div_comment_view);
		$('<span class="moderated">' + (moderated ? 'moderated' : 'not moderated') + '</span>').appendTo(div_comment_view);
		if(!me || !me['admin']) continue;
		var span = $('<span class="bann"></span>').appendTo(div_comment_view);
		var a = $('<a href="#">bann user</a>').appendTo(span);
		a.click(function(){actionBann(user);});
		var span = $('<span class="moderate"></span>').appendTo(div_comment_view);
		var a = $('<a href="#">moderate</a>').appendTo(span);
		a.click(function(){actionModerate(index);});
		var span = $('<span class="uncomment"></span>').appendTo(div_comment_view);
		var a = $('<a href="#">del comment</a>').appendTo(span);
		a.click(function(){actionUncomment(index);});
	}
	$(div_comments).css('display', 'block');
};