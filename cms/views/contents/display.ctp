<div class="main-content">
	<div class="inner">
		<h2><? echo $title_for_view ?></h2>
		<? if (count($tabs) > 1): ?>
			<div class="subnav clearfix">
				<ul>
				<? foreach ($tabs as $index => $tab): ?>
					<? if ($tab['Content']['hidden'] == 1) continue; ?>
					<? if ($index == 0): ?>
						<li><a href="<?= $tab['Content']['permalink'] ?>">Overview</a></li>
					<? else: ?>
						<li><a href="/contents/<?= $tab['Content']['permalink'] ?>"><?= $tab['Content']['title'] ?></a></li>
					<? endif; ?>
				<? endforeach; ?>
				</ul>
			</div>
		<? endif; ?>

		<? echo $content ?>

		<? if ($slug == 'contact'): ?>
		<div id="emailform" class="form" style="width:300px;">
			<? echo $form->create('Contact', array('url' => '/contents/contact')); ?>
				<? echo $form->input('name'); ?>
				<? echo $form->input('email'); ?>
				<? echo $form->input('message', array('type' => 'textarea')); ?>
				<? //echo $form->inputs(); ?>
				
			<? echo $form->end("Send"); ?>
		</div>
		<? endif; ?>
	</div>
</div>
<script language="javascript">
    // display effect
    function displayPulsate(){
       new Effect.Pulsate('flashMessage', { pulses: 3, duration: 1.5 });
    }
    Event.observe(window,'load',displayPulsate,false);
  </script>