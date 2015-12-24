
var goLang = function(host){
	location.assign('http://' + host + location.pathname);
};

var setupClean = function(){
	// user: login
	$('#login').css('display', 'none');
	$('#login form').attr('action', '#');
	$('#login form').on('submit', function(){ actionLogin(); return false; });
	$('#login form').on('reset', function(){ 
		$('#login form input[name=login]').val('');
		$('#login form input[name=password]').val('');	
		return false; 
	});
	$('#login form').trigger('reset');

	// user: toolbar
	$('#toolbar').css('display', 'none');
	$('#toolbar span.login').empty();
	$('#toolbar span.admin').css('display', 'none');
	//$('#toolbar span.admin a').attr('href', '#'); // !!!
	//$('#toolbar span.admin a').on('click', function(){ return actionAdmin(); return false; }); // !!!
	$('#toolbar span.logout a').attr('href', '#');
	$('#toolbar span.logout a').on('click', function(){ actionLogout(); return false; });

	// user: registration
	$('#registration-add').css('display', 'none');
	$('#registration-add form').attr('action', '#');
	$('#registration-add form').on('submit', function(){ actionRegistration(); return false; });
	$('#registration-add form').on('reset', function(){
		$('#registration-add form input[name=name]').val('');
		$('#registration-add form input[name=login]').val('');
		$('#registration-add form input[name=password]').val('');
		$('#registration-add form input[name=password2]').val('');
		$('#registration-add form input[name=email]').val('');
		$('#registration-add form input[name=birthday]').val('');
		$('#registration-add form input[name=sex]').each(function(){ this.checked = false; });
		$('#registration-add form select[name=country] option').each(function(){ this.selected = false; });
		$('#registration-add form textarea[name=info]').val('');
		$('#registration-add form input[name=accept]').each(function(){ this.checked = false; });
		return false;
	});
	$('#registration-add form').trigger('reset');
	$('#registration-view').css('display', 'none');
	$('#registration-view span.login').html('');
	$('#registration-view span.email').html('');
	$('#registration-view span.admin').html('');
	$('#registration-view span.banned').html('');
	$('#registration-view span.name').html('');
	$('#registration-view span.birthday').html('');
	$('#registration-view span.sex').html('');
	$('#registration-view span.country').html('');
	$('#registration-view span.info').html('');

	// admin: users list
	$('div.users').css('display', 'none');
	$('div.users').empty();

	// comment: add
	$('#comment-add').css('display', 'none');
	$('#comment-add form').attr('action', '#');
	$('#comment-add form').on('submit', function(){ actionCommentAdd(); return false; });
	$('#comment-add form').on('reset', function(){
		$('#registration-add form textarea[name=data]').val('');
		return false;
	});
	$('#comment-add form').trigger('reset');

	// comment: view + pages
	$('div.comments').css('display', 'none');
	$('div.comments').empty();
	$('div.pages').css('display', 'none');
	$('div.pages').empty();

};

var setupFill = function(){
	// user login
	if(LSloadMe()){
		doToolbarFill();
		$('#toolbar').css('display', 'block');
	}
	else if(location.pathname=='/'){
		$('#login form').trigger('reset');
		$('#login').css('display', 'block');
	}
	// user registration
	if(LSloadMe()){
		doRegistrationViewFill();
		$('#registration-view').css('display', 'block');
	}
	else{
		$('#registration-add form').trigger('reset');
		$('#registration-add').css('display', 'block');
	}
	// admin: users list
	doAdminUsers();
	$('div.users').css('display', 'block');
	// comment: add
	if(LSloadMe()){
		$('#comment-add').css('display', 'block');
	}
	// comment: view
	doCommentsFill();
	$('div.comments').css('display', 'block');
	$('div.pages').css('display', 'block');
};

var setupAjax = function(){
	// user: login
	$('#login form').attr('action', '#');
	$('#login form').on('submit', function(){ ajaxLogin(); return false; });

	// user: toolbar
	$('#toolbar span.logout a').attr('href', '#');
	$('#toolbar span.logout a').on('click', function(){ ajaxLogout(); return false; });

	// user: registration
	//$('#registration-add form').attr('action', '#');
	//$('#registration-add form').on('submit', function(){ ajaxRegistration(); return false; });

	// admin: users list
	//$('div.users').css('display', 'none');
	//$('div.users').empty();
	$('div.users div.user span.bann a').each(function(index, element){
		$(element).attr('href', '#');
		$(element).on('click', function(){ ajaxUserBann(element, index); return false; });
	});
	$('div.users div.user span.unbann a').each(function(index, element){
		$(element).attr('href', '#');
		$(element).on('click', function(){ ajaxUserUnbann(element, index); return false; });
	});

	// comment: add
	//$('#comment-add form').attr('action', '#');
	//$('#comment-add form').on('submit', function(){ ajaxCommentAdd(); return false; });

	// comment: view + pages
	//$('div.comments').css('display', 'none');
	//$('div.comments').empty();
	//$('div.pages').css('display', 'none');
	//$('div.pages').empty();
};

$(document).ready(function (){
	//return ;
	setupAjax();
	//setupClean();
	//setTimeout(function(){ setupFill(); }, 50);
});
