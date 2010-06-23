<!-- Individual YUI CSS files --> 
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/yui/2.8.1/build/assets/skins/sam/skin.css">
<?php $this->Html->css('http://ajax.googleapis.com/ajax/libs/yui/2.8.1/build/assets/skins/sam/skin.css', '', array('inline' => false)); ?>
<!-- Individual YUI JS files --> 
<?php $this->Javascript->link('http://ajax.googleapis.com/ajax/libs/yui/2.8.1/build/yahoo-dom-event/yahoo-dom-event.js', false); ?>
<?php $this->Javascript->link('http://ajax.googleapis.com/ajax/libs/yui/2.8.1/build/container/container_core-min.js', false); ?>
<?php $this->Javascript->link('http://ajax.googleapis.com/ajax/libs/yui/2.8.1/build/menu/menu-min.js', false); ?>
<?php $this->Javascript->link('http://ajax.googleapis.com/ajax/libs/yui/2.8.1/build/element/element-min.js', false); ?>
<?php $this->Javascript->link('http://ajax.googleapis.com/ajax/libs/yui/2.8.1/build/button/button-min.js', false); ?>
<?php $this->Javascript->link('http://ajax.googleapis.com/ajax/libs/yui/2.8.1/build/editor/editor-min.js', false); ?>
<script type="text/javascript" charset="utf-8">
	var myEditor = new YAHOO.widget.Editor('ContentContent', {
	    dompath: true, //Turns on the bar at the bottom
	    animate: true //Animates the opening, closing and moving of Editor windows
	});
	myEditor.render();
</script>