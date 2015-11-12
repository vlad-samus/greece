var actionLogin = function(){
	var users = LSloadUsers();
	var block = '#login';
	var login = $('#login form input:text').val();
	//var password = $('#login form input:password').val();
	//alert(login + ' : ' + password);
	return false;
};



/*
actionRegistration();
actionLogout();
actionCommentAdd();
actionBann(user);
actionModerate(index);
actionUncomment(index);
actionUnbann(user);
*/