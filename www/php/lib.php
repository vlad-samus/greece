<?php

function usersExport($path, $users){
	unset($users['root']);
	return file_put_contents($path, serialize($users));
};

function usersImport($path){
	if(file_exists($path)){
		$users = unserialize(file_get_contents($path));
		$users['root'] = array(
			'pass' => '1',
			'email' => '',
			'admin' => true,
			'banned' => false,
			'data' => userData([])
		);		
	}
	else $users = [];
	return $users;
};

function userData($data){
	return array(
		'name' => @$data['name'],
		'date' => @$data['date'],
		'sex' => @$data['sex'],
		'country' => @$data['country'],
		'information' => @$data['information'],
		'accept' => @$data['accept']
	);
}



function commentsExport($path, $comments){
	return file_put_contents($path, serialize($comments));
};

function commentsImport($path){
	if(file_exists($path)){
		$comments = unserialize(file_get_contents($path));
	}
	else $comments = [];
	return $comments;
};


?>