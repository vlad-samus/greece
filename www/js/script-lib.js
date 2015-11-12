
var typeOf = function(obj, value){
	var result = {}.toString.call(obj).toLowerCase().match(/\s([a-zA-Z]+)/)[1];
	return (value==undefined) ? result : (result==value);
};

var LSsave = function(name, data){
	data = JSON.stringify(data);
	localStorage.setItem(name, data);
};

var LSload = function(name, def){
	var data = localStorage.getItem(name);
	if(data==undefined) return def;
	if(data==null) return def;
	try{
		return JSON.parse(data);
	}
	catch(e){
		return def;
	}
};

var LSsaveUsers = function(data){
	if(!typeOf(data, 'array')) return;
	LSsave('users', data.filter(function(v){ return v['login']!='root';}));
};

var LSloadUsers = function(){
	var data = LSload('users', []);
	data.push({
		login: 'root',
		pass: '1',
		admin: true,
		banned: false,
		name: 'root',
		email: 'root@localhost',
		birthday: '0000-00-00',
		sex: '',
		country: 'uk',
		info: ''
	});
	return data;
};

var LSsaveMe = function(me){
	return LSsave('me', me);
};

var LSloadMe = function(){
	return LSload('me', undefined)
};

var LSsaveComments = function(comments){
	return LSsave('comments', comments);
};

var LSloadComments = function(){
	return LSload('comments', []);
};


var buildUserObject = function(login, password, admin, banned, name, email, birthday, sex, country, info){
	// login
	if(!typeOf(login, 'string')) throw 'Error: wrong login';
	login = login.trim().toLowerCase();
	if(!(login.length>0)) throw 'Error: wrong login length';
	// password
	if(!typeOf(password, 'string')) throw 'Error: wrong password';
	// admin
	admin = typeOf(admin, 'boolean') ? admin : false;
	// banned
	banned = typeOf(banned, 'boolean') ? banned : false;
	// name
	if(!typeOf(name, 'string')) throw 'Error: wrong name';
	name = name.trim();
	if(!(name.length>0)) throw 'Error: wrong name length';
	// email
	if(!typeOf(email, 'string')) throw 'Error: wrong email';
	email = email.trim().toLowerCase();
	if(!(email.length>0)) throw 'Error: wrong email length';
	if(!email.match(/^[\w\d\.\-\_]+[\@][\w\d\.\-\_]+/i)) throw 'Error: wrong name length';
	// birthday
	if(!typeOf(birthday, 'string')) throw 'Error: wrong birthday';
	birthday = birthday.trim();
	// sex
	if(!typeOf(sex, 'string')) throw 'Error: wrong sex';
	sex = sex.trim();
	if(!(sex.length>0)) throw 'Error: wrong sex length';
	// country
	if(!typeOf(country, 'string')) throw 'Error: wrong country';
	country = country.trim();
	if(!(country.length>0)) throw 'Error: wrong country length';
	// info
	if(!typeOf(info, 'string')) throw 'Error: wrong info';
	info = info.trim();
	// return
	return {
		login: login,
		password: password,
		admin: admin,
		banned: banned,
		name: name,
		email: email,
		birthday: birthday,
		sex: sex,
		country: country,
		info: info
	};
};
