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
			'data' => userData(array())
		);		
	}
	else $users = array();
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
};



function commentsExport($path, $comments){
	return file_put_contents($path, serialize($comments));
};

function commentsImport($path){
	if(file_exists($path)){
		$comments = unserialize(file_get_contents($path));
	}
	else $comments = array();
	return $comments;
};

function commentShown($comment){
	global $USERS;
	$result = false;
	if(empty($comment)){
		$result = false;
	}
	else if($USERS[$comment['user']]['admin']==true){
		$result = true;
	}
	else if(!empty($comment['moderated'])){
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;
};

?>