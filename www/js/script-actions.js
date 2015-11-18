
var doToolbarFill = function(){
	var login = LSloadMe();
	if(!login) return;
	var user = LSloadUsers().find(function(v){ return login==v.login; });
	if(!user) return;
	$('#toolbar span.login').html(user.login);
	if(user.admin){
		$('#toolbar span.admin').css('display', 'inline');
	}
};

var doRegistrationViewFill = function(){
	var login = LSloadMe();
	if(!login) return;
	var user = LSloadUsers().find(function(v){ return login==v.login; });
	if(!user) user = { login: '', email: '', admin: '', banned: '', name: '', birthday: '', sex: '', country: '', info: '' };
	$('#registration-view span.login').html(user.login);
	$('#registration-view span.email').html(user.email);
	$('#registration-view span.admin').html(user.admin ? 'admin' : 'user');
	$('#registration-view span.banned').html(user.banned ? 'banned' : 'not banned');
	$('#registration-view span.name').html(user.name);
	$('#registration-view span.birthday').html(user.birthday);
	$('#registration-view span.sex').html(user.sex.match(/m/i) ? 'male' : user.sex.match(/f/i) ? 'female' : 'none');
	$('#registration-view span.country').html(user.country);
	$('#registration-view span.info').html(user.info);
};

var doAdminUsers = function(){
	var login = LSloadMe();
	if(!login) return;
	var user = LSloadUsers().find(function(v){ return login==v.login; });
	if(!user || !user.admin) return;
	var doAdminUser = function(user){
		var userD = {
			wrapper: $('<div class="user"></div>'),
			login: $('<span class="login"></span>'),
			password: $('<span class="password"></span>'),
			email: $('<span class="email"></span>'),
			admin: $('<span class="admin"></span>'),
			banned: $('<span class="banned"></span>'),
			name: $('<span class="name"></span>'),
			birthday: $('<span class="birthday"></span>'),
			sex: $('<span class="sex"></span>'),
			country: $('<span class="country"></span>'),
			info: $('<span class="info"></span>'),
			bann: $('<span class="bann"></span>'),
			unbann: $('<span class="unbann"></span>'),
			abann: $('<a href="#">bann user</a>'),
			aunbann: $('<a href="#">unbann user</a>')
		};
		// append
		userD.wrapper.appendTo('div.users');
		userD.login.appendTo(userD.wrapper);
		userD.password.appendTo(userD.wrapper);
		userD.email.appendTo(userD.wrapper);
		userD.admin.appendTo(userD.wrapper);
		userD.banned.appendTo(userD.wrapper);
		userD.name.appendTo(userD.wrapper);
		userD.birthday.appendTo(userD.wrapper);
		userD.sex.appendTo(userD.wrapper);
		userD.country.appendTo(userD.wrapper);
		userD.info.appendTo(userD.wrapper);
		userD.bann.appendTo(userD.wrapper);
		userD.unbann.appendTo(userD.wrapper);
		userD.abann.appendTo(userD.bann);
		userD.aunbann.appendTo(userD.unbann);
		// fill
		userD.login.html(user.login);
		userD.password.html(user.password);
		userD.email.html(user.email);
		userD.admin.html(user.admin ? 'admin' : 'user');
		userD.banned.html(user.banned ? 'banned' : 'not banned');
		userD.name.html(user.name);
		userD.birthday.html(user.birthday);
		userD.sex.html(user.sex.match(/m/i) ? 'male' : user.sex.match(/f/i) ? 'female' : 'none');
		userD.country.html(user.country);
		userD.info.html(user.info);
		// links
		userD.abann.click(function(){ actionBann(user.login); return false; });
		userD.aunbann.click(function(){ actionUnbann(user.login); return false; });
	};
	LSloadUsers().filter(function(user){
		return !user.login.match(/^root$/i);
	}).forEach(function(user){
		doAdminUser(user);
	});
};

var PAGE = 0;
var doCommentsFill = function(_page){
	var login = LSloadMe();
	var users = LSloadUsers();
	var user = users.find(function(v){ return login==v.login; });
	var doCommentFill = function(comment, index){
		var commentD = {
			wrapper: $('<div class="comment-view"></div>'),
			index: $('<span class="index"></span>'),
			user: $('<span class="user"></span>'),
			date: $('<span class="date"></span>'),
			data: $('<span class="data"></span>'),
			moderated: $('<span class="moderated"></span>'),
			bann: $('<span class="bann"></span>'),
			moderate: $('<span class="moderate"></span>'),
			uncomment: $('<span class="uncomment"></span>'),
			abann: $('<a href="#">bann user</a>'),
			amoderate: $('<a href="#">moderate</a>'),
			auncomment: $('<a href="#">del comment</a>')
		};
		// append
		commentD.wrapper.appendTo('div.comments');
		commentD.index.appendTo(commentD.wrapper);
		commentD.user.appendTo(commentD.wrapper);
		commentD.date.appendTo(commentD.wrapper);
		commentD.data.appendTo(commentD.wrapper);
		if(user && user.admin && !user.banned){
			commentD.moderated.appendTo(commentD.wrapper);
			commentD.bann.appendTo(commentD.wrapper);
			commentD.moderate.appendTo(commentD.wrapper);
			commentD.uncomment.appendTo(commentD.wrapper);
		}
		commentD.abann.appendTo(commentD.bann);
		commentD.amoderate.appendTo(commentD.moderate);
		commentD.auncomment.appendTo(commentD.uncomment);
		// fill
		commentD.index.html(index + 1);
		commentD.user.html(comment.user);
		commentD.date.html(comment.date);
		commentD.data.html(comment.data);
		commentD.moderated.html(comment.moderated ? 'moderated' : 'not moderated');
		// links
		commentD.abann.click(function(){ actionBann(comment.user); return false; });
		commentD.amoderate.click(function(){ actionModerate(comment.index); return false; });
		commentD.auncomment.click(function(){ actionUncomment(comment.index); return false; });
	};
	var doPageFill = function(page, sep){
		var pageD = {
			wrapper: $('<span class="page"></span>'),
			sep: $('<span></span>'),
			apage: $('<a href="#"></a>')
		};
		// append
		pageD.wrapper.appendTo('div.pages');
		pageD.sep.appendTo(pageD.wrapper);
		pageD.apage.appendTo(pageD.wrapper);
		// fill
		pageD.sep.html(sep);
		pageD.apage.html(page + 1);
		// links
		pageD.apage.click(function(){
			$('div.comments').css('display', 'none');
			$('div.comments').empty();
			$('div.pages').css('display', 'none');
			$('div.pages').empty();
			doCommentsFill(page);
			$('div.comments').css('display', 'block');
			$('div.pages').css('display', 'block');
			return false; 
		});
	};
	var comments = LSloadComments().filter(function(comment){ return comment; });
	if(!user || !user.admin || user.banned){
		comments = comments.filter(function(comment){
			return comment.moderated || users.some(function(v){ return comment.user==v.login && v.admin && !v.banned; });
		});
	}
	var comments_count = comments.length;
	var comment_per_page = 10;
	var page = $.isNumeric(_page) ? _page : PAGE;
	PAGE = page;
	var page_count = Math.ceil(comments_count/comment_per_page);
	for(var index=page*comment_per_page; index<Math.min(comments_count, (page+1)*comment_per_page); index++){
		var comment = comments[index];
		doCommentFill(comment, index);
	}
	for (var index=0; index<page_count; index++){
		doPageFill(index, index==0 ? '' : '|');
	}
};

var actionLogin = function(){
	if (LSloadMe()) return;
	var login = $('#login form input[name=login]').val().toLowerCase().trim();
	var password = $('#login form input[name=password]').val();
	if(login && password && LSloadUsers().some(function(v){ return login==v.login && password==v.pass && !v.banned; })){
		LSsaveMe(login);
		$('#login').css('display', 'none');
		$('#login form').trigger('reset');
		doToolbarFill();
		$('#toolbar').css('display', 'block');
		//
		$('#registration-add').css('display', 'none');
		$('#registration-add form').trigger('reset');
		//
		$('#comment-add').css('display', 'block');
	}
	else{
		alert('Error: 403!');
	}
};

var actionLogout = function(){
	if (!LSloadMe()) return;
	LSsaveMe(undefined);
	$('#toolbar').css('display', 'none');
	if(location.pathname.match(/^[\/][\#]?$/i)){
		$('#login form').trigger('reset');
		$('#login').css('display', 'block');		
	}
	//
	$('#registration-add form').trigger('reset');
	$('#registration-add').css('display', 'block');
	doRegistrationViewFill();
	$('#registration-view').css('display', 'none');
	//
	$('div.users').css('display', 'none');
	$('div.users').empty();
	doAdminUsers();
	$('div.users').css('display', 'block');
	//
	$('#comment-add').css('display', 'none');
	//
	$('div.comments').css('display', 'none');
	$('div.comments').empty();
	$('div.pages').css('display', 'none');
	$('div.pages').empty();
	doCommentsFill();
	$('div.comments').css('display', 'block');
	$('div.pages').css('display', 'block');
};

var actionRegistration = function(){
	if (LSloadMe()) return;
	var name = $('#registration-add form input[name=name]').val();
	var login = $('#registration-add form input[name=login]').val().toLowerCase().trim();
	var password = $('#registration-add form input[name=password]').val();
	var password2 = $('#registration-add form input[name=password2]').val();
	var email = $('#registration-add form input[name=email]').val().toLowerCase().trim();
	var birthday = $('#registration-add form input[name=birthday]').val();
	var sex = $('#registration-add form input[name=sex]:checked').val();
	var country = $('#registration-add form select[name=country]').val();
	var info = $('#registration-add form textarea[name=info]').val();
	var accept = $('#registration-add form input[name=accept]:checked').val();
	var users = LSloadUsers();
	if(login && password && password===password2 && name && email && birthday && sex && country && accept 
		&& !users.some(function(v){ return login==v.login || email==v.email; })){
		users.push({
			name: name,
			login: login,
			pass: password,
			admin: false,
			banned: false,
			email: email,
			birthday: birthday,
			sex: sex,
			country: country,
			info: info
		});
		LSsaveUsers(users);
		LSsaveMe(login);
		$('#registration-add').css('display', 'none');
		$('#registration-add form').trigger('reset');
		doToolbarFill();
		$('#toolbar').css('display', 'block');
		$('#login').css('display', 'none');
		$('#login form').trigger('reset');
		doRegistrationViewFill();
		$('#registration-view').css('display', 'block');
	}
	else{
		alert('Error: 403!');
	}
};

var actionBann = function(login){
	var users = LSloadUsers();
	var userBann = users.find(function(v){ return login==v.login; });
	var login = LSloadMe();
	if(!login) return;
	var user = users.find(function(v){ return login==v.login; });
	if(!user || !user.admin || user.banned) return;
	userBann.banned = true;
	LSsaveUsers(users);
	//
	$('div.users').css('display', 'none');
	$('div.users').empty();
	doAdminUsers();
	$('div.users').css('display', 'block');
};

var actionUnbann = function(login){
	var users = LSloadUsers();
	var userUnbann = users.find(function(v){ return login==v.login; });
	var login = LSloadMe();
	if(!login) return;
	var user = users.find(function(v){ return login==v.login; });
	if(!user || !user.admin || user.banned) return;
	userUnbann.banned = false;
	LSsaveUsers(users);
	//
	$('div.users').css('display', 'none');
	$('div.users').empty();
	doAdminUsers();
	$('div.users').css('display', 'block');
};

var actionCommentAdd = function(){
	var login = LSloadMe();
	if (!login) return;
	var data = $('#comment-add form textarea[name=data]').val();
	if(data && LSloadUsers().some(function(v){ return login==v.login && !v.banned; })){
		var comments = LSloadComments();
		comments.push({
			index: comments.length,
			user: login,
			date: '',
			data: data,
			moderated: false
		});
		LSsaveComments(comments);
		$('#comment-add form').trigger('reset');
		//
		$('div.comments').css('display', 'none');
		$('div.comments').empty();
		$('div.pages').css('display', 'none');
		$('div.pages').empty();
		doCommentsFill();
		$('div.comments').css('display', 'block');
		$('div.pages').css('display', 'block');
	}
	else{
		alert('Error: 403!');
	}
};

var actionModerate = function(index){
	var login = LSloadMe();
	if(!login) return;
	var user = LSloadUsers().find(function(v){ return login==v.login; });
	if(!user || !user.admin || user.banned) return;
	var comments = LSloadComments();
	if(index<0 || index>=comments.length || !comments[index]) return;
	comments[index].moderated = true;
	LSsaveComments(comments);
	//
	$('div.comments').css('display', 'none');
	$('div.comments').empty();
	$('div.pages').css('display', 'none');
	$('div.pages').empty();
	doCommentsFill();
	$('div.comments').css('display', 'block');
	$('div.pages').css('display', 'block');
};

var actionUncomment = function(index){
	var login = LSloadMe();
	if(!login) return;
	var user = LSloadUsers().find(function(v){ return login==v.login; });
	if(!user || !user.admin || user.banned) return;
	var comments = LSloadComments();
	if(index<0 || index>=comments.length) return;
	comments[index] = false;
	LSsaveComments(comments);
	//
	$('div.comments').css('display', 'none');
	$('div.comments').empty();
	$('div.pages').css('display', 'none');
	$('div.pages').empty();
	doCommentsFill();
	$('div.comments').css('display', 'block');
	$('div.pages').css('display', 'block');
};
