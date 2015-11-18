
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
	LSsave('users', data.filter(function(v){ return !v.login.match(/^root$/i); }));
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
		birthday: '1000-00-00',
		sex: 'm',
		country: 'uk',
		info: ''
	});
	return data;
};

var LSsaveMe = function(me){
	return LSsave('me', me);
};

var LSloadMe = function(){
	return LSload('me', undefined);
};

var LSsaveComments = function(comments){
	return LSsave('comments', comments);
};

var LSloadComments = function(){
	return LSload('comments', []);
};
