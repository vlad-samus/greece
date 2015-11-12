
var setupClean = function(){
	//$('#login').css('display', 'none');
	$('#login form').attr('action', '#');
	$('#login form').on('submit', function(){ return actionLogin(); });

	$('#registration-add').css('display', 'none');
	$('#registration-add form').attr('action', '#');
	$('#registration-add form').on('submit', function(){ return actionRegistration(); });

	//$('#toolbar').css('display', 'none');
	//$('#toolbar span.login').empty();
	//$('#toolbar span.admin').css('display', 'none');
	//$('#toolbar span.logout a').attr('href', '#');
	//$('#toolbar span.logout a').on('click', function(){ return actionLogout(); });

	$('#comment-add').css('display', 'none');
	$('#comment-add form').attr('action', '#');
	$('#comment-add form').on('submit', function(){ return actionCommentAdd(); });

	//$('div.comments').css('display', 'none');
	//$('div.comments').empty();
	//$('div.pages').css('display', 'none');
	//$('div.pages').empty();
	//commentsRefresh();


	//$('div.users').css('display', 'none');
	$('div.users div.user').css('display', 'none');
	$('div.users').empty();

	var d = $('<div style="border: 1px solid red;"> c</div>').appendTo('div.comments');
	var a = $('<div style="border: 1px solid red;"> a</div>').appendTo(d);
	$('<div style="border: 1px solid red;"> b</div>').appendTo(a);

};

window.onload = function (){
	setupClean();
};