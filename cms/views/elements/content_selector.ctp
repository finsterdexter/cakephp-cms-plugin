<fieldset>
	<legend><?php __('Select');?></legend>
	<? $count = 0; ?>
	<? foreach ($nav_path as $nav): $count++; ?>
		<div class="content-select">
		<?php echo $form->create('Content', array('id'=>'ContentNav')); ?>
			<?php
				// display first box
				echo $form->input("id", array(
					'type' => 'select',
					'options' => $nav['siblings'],
					'onchange' => "if(this.options[this.selectedIndex].value!='')location.href='/admin/cms/contents/edit/'+this.options[this.selectedIndex].value.replace(/id/,'');",
					'label' => '',
					'selected' => @$nav['Content']['id'], // if nothing is selected, then show "--select subpage--"
					'empty' => '--select subpage--',
				));
			?>
		<?php echo $form->end();?>
		<? if ($count > 1): ?>
			<a href="/admin/cms/contents/add/parentid:<?= $nav['Content']['parent_id'] ?>/">+ new page</a>
		<? endif; ?>
		</div>
	<? endforeach; ?>
	<? if (count($nav_path) == 0 || (count($nav_path) < MAX_DEPTH && isset($nav_path[count($nav_path)-1]['Content']['id']))): ?>
		<div class="content-select">
			<a href="/admin/cms/contents/add/parentid:<?= $nav_id ?>/">+ new subpage</a>
		</div>
	<? endif; ?>
</fieldset>

<?php

/*

1. display first box, just all pages where parentid = 0
2. get nav path?
3. foreach nav path as $nav get pages where parentid = $nav and display selectbox with those pages, also display new page link
4. check max depth; if we are not at max depth display the new subpage link



*/

?>