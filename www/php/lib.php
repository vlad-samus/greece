<?php

function usersExport($path, $users){
	unset($users['root']);
	return file_put_contents($path, serialize($users));
};

function usersImport($path){
	if(file_exists($path)){
		$users = unserialize(file_get_contents($path));
		$users['root'] = array(
			'login' => 'root',
			'pass' => '1',
			'email' => 'root@localhost',
			'admin' => true,
			'banned' => false,
			'name' => 'root',
			'birthday' => '0000-00-00',
			'sex' => '',
			'country' => 'uk',
			'info' => 'root info'
		);		
	}
	else $users = array();
	return $users;
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

function commentShown($comment, $showAdmin = true){
	if(!is_array($comment)) return false;
	elseif($comment['moderated']==true) return true;
	elseif($showAdmin){
		$user = $comment['user'];
		global $USERS;
		return $USERS[$user]['admin']==true;
	}
	return false;
};

?>