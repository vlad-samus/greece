

var actionLogin = function(){
	$('#form-login').css('display', 'none');
};

var formLoginSubmit = function(){
	actionLogin();
	return false;
};

var setupFormLogin = function(){
	alert(3);
	$('#form-login').on('submit', formLoginSubmit);
};

var setupUserBar = function(){
	$('#user-bar').empty();
};

window.onload = function (){
//	setupUserBar();
//	scriptInclude('/js/script-login.js');
//	formLoginSetup();
};