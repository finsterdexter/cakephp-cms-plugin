<?php

/*

--
-- Table structure for table `contents`
--

CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `controller` varchar(64) NOT NULL default '',
  `action` varchar(64) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `leadin` text NOT NULL,
  `content` text NOT NULL,
  `nl2br` tinyint(1) NOT NULL default '1',
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

*/

class Content extends CmsAppModel
{
	var $name = 'Content';
	
	var $validate = array(
		// 'permalink' => 'isUnique',
		'title' => array(
			'rule' => '/.+/',
			'required' => true,
			'allowEmpty' => false,
			'message' => 'You must enter a title for your content.',
		),
	);
	
	var $actsAs = array(
		'Sluggable' => array(
			'label' => 'title',
			'slug' => 'permalink',
			'overwrite' => false,
		),
		'Tree' => array(
		),
	);
	
		
}
