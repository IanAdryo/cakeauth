<?php
class User extends AppModel {
	var $name = 'User';
	var $displayField = 'name';
	var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter your name',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'username' => array(
			'The_username_must_be_betwween_5_and_15_characters' => array(
				'rule' => array('between', 5, 15),
				'message' => 'The username must be betwween 5 and 15 characters'
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter a Username',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'Please enter other Username'
			)
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter a password',
			),
			'The_password_must_be_betwween_5_and_15_characters' => array(
				'rule' => array('between', 5, 15),
				'message' => 'The password must be betwween 5 and 15 characters'
			),
			'The passwords do not match' => array(
				'rule' => 'matchPasswords',
				'message' => 'The passwords do not match'
			)
		),
		
	);
	
	public function matchPasswords($data) {
		
		if ($data['password'] == $this->data['User']['password_confirmation']) {

			return true;
		}
		$this->invalidate('password_confirmation', 'The passwords do not match');
		return false;
	}

	var $hasMany = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	function hashPasswords($data) {

		if (isset($this->data['Users']['password'])) {

			$this->data['User']['password'] = Security::hash($this->data['Users']['password'], null, true);
			return $data;
		}
		return $data;
	}

	function beforeSave(){

		$this->hashPasswords(null, true);
		return true;
	}

}
