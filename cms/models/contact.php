<?php
class Contact extends CmsAppModel {
    var $useTable = false;
    var $_schema = array(
        'name'		=>array('type'=>'string', 'length'=>100), 
        'email'		=>array('type'=>'string', 'length'=>255), 
        'message'	=>array('type'=>'text')
    );

	var $validate = array(
	    'name' => array(
	        'rule'=>array('minLength', 1), 
	        'message'=>'Name is required' ),
	    'email' => array(
	        'rule'=>'email', 
	        'message'=>'Must be a valid email address' ),
	    'message' => array(
	        'rule'=>array('minLength', 1), 
	        'message'=>'Feedback is required' )
	);
	
	
	
}