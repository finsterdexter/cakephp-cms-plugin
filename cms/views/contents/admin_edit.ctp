<?php // echo $javascript->link('prototype-1.6.0.3',false); ?>

<div id="main-content" class="clearfix sub yui-skin-sam">
	
	<?php echo $this->element('yui_editor'); ?>
	
<div class="inner admin">
<h2>Content Management</h2>
<div class="contents form">
<?php echo $this->element('content_selector'); ?>
<?php echo $form->create('Content');?>
	<fieldset>
 		<legend><?php __('Edit Content');?></legend>
	<?php
		echo $form->input('id');
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
		// echo $form->input('leadin', array('style'=>'width:500px'));
		echo $form->input('hidden', array('label' => 'Hide page from navigation', 'type' => 'checkbox'));
		echo $form->input('content', array('style'=>'width:100%', 'rows'=>'25'));
		// echo $form->input('nl2br');
	?>
	</fieldset>
	<div class="input"><input type="submit" name="save" id="save" value="Save" class="bttn"></div>
<?php echo $form->end();?>
	<a href="/admin/cms/contents/delete/<?= $this->data['Content']['id'] ?>" id="delete_button" onclick="return confirm('Are you sure you want to delete this page?');">Delete</a>
</div>

</div>
</div>