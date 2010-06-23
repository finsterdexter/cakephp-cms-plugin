<?php // echo $javascript->link('prototype-1.6.0.3',false); ?>

<div id="main-content" class="clearfix sub yui-skin-sam">
	
	<?php echo $this->element('yui_editor'); ?>
	
<div class="inner admin">
<h2>Content Management</h2>
<div class="contents form">
<?php echo $this->element('content_selector'); ?>

<? if (isset($crumbs) && is_array($crumbs)): ?>
	<div class="breadcrumbs">
		Adding Page Under: <strong><?= implode(" &raquo; ", $crumbs); ?></strong>
	</div>
<? endif; ?>

<?php echo $form->create('Content');?>
	<fieldset>
 		<legend><?php __('Add Content');?></legend>
	<?php
		echo $form->input('parent_id', array('type'=>'hidden'));
		echo $form->input('title', array('label' => 'Page Title'));
		echo $form->input('sort_order');
		echo $form->input('permalink', array('onkeyup' => 'permalinkIt(this)'));
	?>
	
<script type="text/javascript" charset="utf-8">
//<![CDATA[
// permalinkIt = function(elm) {
// 	var val = elm.value;
// 	val = val.replace(/--/ig,'').replace(/[^A-Z0-9]/ig,'-').replace(/--/ig,'-').toLowerCase();
// 	$('ContentPermalink').value = val;
// }
//]]>
</script>
	
	<?php
		echo $form->input('hidden', array('label' => 'Hide page from navigation', 'type' => 'checkbox'));
		//echo $form->input('leadin', array('style'=>'width:500px'));
		echo $form->input('content', array('style'=>'width:99%', 'rows'=>'25'));
		// echo $form->input('nl2br');
	?>
	</fieldset>
	<div class="input"><input type="submit" name="save" id="save" value="Save" class="bttn"></div>
<?php echo $form->end();?>
</div>
</div>
</div>