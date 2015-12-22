
var ajaxLogin = function(){
	var login = $('#login form input[name=login]').val();
	var password = $('#login form input[name=password]').val();	
	$.ajax({
		cache: false,
		data: {
			action: 'login',
			login: login,
			password: password
		},
		dataType: 'text',
		error: function(error){ alert(error); },
		success: function(data){
			if(data.match(/success/)){
				location.reload();
			}
			else{
				alert(data);
				$('#login form').trigger('reset');
			}
		},
		type: 'POST',
		url: '/ajax.php'
	});
};

var ajaxLogout = function(){
	$.ajax({
		cache: false,
		data: {action: 'logout'},
		dataType: 'text',
		error: function(error){ alert(error); },
		success: function(data){
			if(data.match(/success/)){
				location.reload();
			}
			else{
				alert(data);
			}
		},
		type: 'POST',
		url: '/ajax.php'
	});
};

var ajaxUserBann = function(a, i){
	var p = a.parentNode.parentNode;
	var login = $(p).find('span.login').html().trim();
	$.ajax({
		cache: false,
		data: {action: 'bann', login: login},
		dataType: 'text',
		error: function(error){ alert(error); },
		success: function(data){
			if(data.match(/error/)){
				alert(data);
			}
			else{
				$(p.parentNode).animate({
					opacity: 0.75,
					left: "+=50",
					height: "toggle"
				}, 1000, function(){
					$(p).find('span.banned').html(data);
					$(p.parentNode).animate({
						opacity: 0.25,
						left: "-=50",
						height: "toggle"
					}, 1000, function(){
						$(p.parentNode).css('opacity', 1);
					});
				});
			}
		},
		type: 'POST',
		url: '/ajax.php'
	});
};

var ajaxUserUnbann = function(a, i){
	var p = a.parentNode.parentNode;
	var login = $(p).find('span.login').html().trim();
	$.ajax({
		cache: false,
		data: {action: 'unbann', login: login},
		dataType: 'text',
		error: function(error){ alert(error); },
		success: function(data){
			if(data.match(/error/)){
				alert(data);
			}
			else{
				$(p.parentNode).animate({
					opacity: 0.75,
					left: "+=50",
					height: "toggle"
				}, 1000, function(){
					$(p).find('span.banned').html(data);
					$(p.parentNode).animate({
						opacity: 0.25,
						left: "-=50",
						height: "toggle"
					}, 1000, function(){
						$(p.parentNode).css('opacity', 1);
					});
				});
			}
		},
		type: 'POST',
		url: '/ajax.php'
	});
};

var ajaxRegistration = function(){
};

var ajaxCommentAdd = function(){
};
