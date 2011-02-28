<?php
class ContentsController extends CmsAppController {

	var $name = 'Contents';
	var $helpers = array('Html', 'Form', 'Javascript');
	var $layout = 'default';
	var $components = array('Email');
	var $uses = array('Cms.Contact', 'Cms.Content');
	
	function _getContentFromPath($path) {
		// if (!count($path) || empty($path[0])) {
		// 	$this->redirect('/');
		// }
		// if (!isset($path[1])) {
		// 	$path[1] = '';
		// }
		// 
		// $content = $this->Content->find('first', array(
		// 	'conditions' => array(
		// 		'Content.section' => $path[0],
		// 		'Content.slug' => $path[1],
		// 	),
		// ));
		
		$permalink = array_pop($path);

		
		$content = $this->Content->find('first', array(
			'conditions' => array(
				'Content.permalink' => $permalink,
			),
		));

		return $content;
	}
	
	function getContentByPermalink($permalink) {
		return $this->_getContentFromPath(array($permalink));
	}
	
	function get_permalink_by_id($id = null)
	{
		$permalink = $this->Content->field('permalink', array('id' => $id));
		$this->set('permalink', $permalink);
		return $permalink;
	}
	
	function id_has_children($id = null)
	{
		if ($this->Content->childcount($id))
			return true;
		else
			return false;
	}
	
	function display() {
		$this->layout = 'sub';
		$content = $this->_getContentFromPath(func_get_args());
		//if (empty($content['Content']['title'])) $content['Content']['title'] = Inflector::humanize($content['Content']['section']);
		// $this->set('section', $content['Content']['section']);
		// $this->set('header', $content['Content']['section']);
		$this->set('title', $content['Content']['title']);
		$this->set('title_for_view', $content['Content']['title']);
		$this->set('content', $content['Content']['content']);
		$this->set('slug', $content['Content']['permalink']);
		$this->set('id', $content['Content']['id']);
		
		if ($content['Content']['parent_id'] == 0)
		{
			$tabs = $this->Content->children($content['Content']['id'], true);
			array_unshift($tabs, $content);
		}
		else
		{
			$tabs = $this->Content->children($content['Content']['parent_id'], true);
			$parent = $this->Content->getparentnode($content['Content']['id']);
			array_unshift($tabs, $parent);
		}
		$this->set('tabs', $tabs);
		$this->set('nav_path', $this->__getPath($content['Content']['id']));
		
		// contact form processing
		if ( isset($this->data['Contact']) )
		{
			$this->Contact->set($this->data);
			if ($this->Contact->validates())
			{
				$this->Email->to = $this->admin_email;
			    $this->Email->subject = "TshirtAds Contact Us Form";
			    $this->Email->from = $this->data['Contact']['name'] . "<" . $this->data['Contact']['email'] . ">";
			    $this->Email->template = 'contact'; // note no '.ctp'
			    // Send as 'html', 'text' or 'both' (default is 'text')
			    $this->Email->sendAs = 'text'; // because we like to send pretty mail
			    // Set view variables as normal
				$this->set('message', $this->data['Contact']['message']);
			    // Do not pass any args to send()
			    $this->Email->send();

				$this->Session->setFlash('Your message has been sent! Thank you!', 'thrill');
				$this->data = array();
				
			}
			else
			{
				$this->Session->setFlash('Please make sure all fields are correctly filled out.', 'agony');
			}
			
		}
		else if (isset($this->data['Contact']))
		{
			$this->Session->setFlash('Captcha verification failed.', 'agony');
		}

	}


	function index() {
		// $this->Content->recursive = 0;
		// $this->set('contents', $this->paginate());
		$this->redirect('/');
	}

	function admin_index() {
		// $this->set('admin_css',true);
		// $this->index();
		$this->redirect(array('action'=>'add'));
	}

	function admin_add() {

		// $this->requireAdmin();
		if (!empty($this->data)) {
			$this->Content->create();
			if ($this->Content->save($this->data)) {
				$this->Session->setFlash(__('The Content has been saved', true), 'thrill');
				$this->redirect(array('plugin' => 'cms', 'controller' => 'contents', 'action' => 'edit', $this->Content->getLastInsertId()));
			} else {
				$this->Session->setFlash(__('The Content could not be saved. Please, try again.', true), 'agony');
			}
		}
		
		if (isset($this->passedArgs['parentid']))
		{
			// then generate nav_path for this parent_id, etc.
			$nav_path = $this->__getPath($this->passedArgs['parentid'], true);
			$this->set('nav_path', $nav_path);
			$this->set('nav_id', $this->passedArgs['parentid']);
			$this->data['Content']['parent_id'] = $this->passedArgs['parentid'];
			$this->set('crumbs', Set::extract('/Content/title', $nav_path));
		}
		else
		{
			$this->set('nav_path', $this->__getPath(0, true));
			$this->data['Content']['parent_id'] = 0;
		}
		
	}

	function admin_edit($id = null) {
		// $this->requireAdmin();
		
		// get the nav path
		$this->set('nav_path', $this->__getPath($id, true));
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Content', true), 'agony');
			$this->redirect(array('action'=>'index'));
		}
		else
		{
			$this->set('nav_id', $id);
		}
		
		if (!empty($this->data)) {
			if ($this->Content->save($this->data)) {
				$this->Session->setFlash(__('The Content has been saved', true), 'thrill');
				$this->redirect(array('plugin' => 'cms', 'controller' => 'contents', 'action' => 'edit', $this->data['Content']['id']));
			} else {
				$this->Session->setFlash(__('The Content could not be saved. Please, try again.', true), 'agony');
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->Content->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		// $this->requireAdmin();
		$this->set('admin_css',true);
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Content', true), 'agony');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Content->delete($id)) {
			$this->Session->setFlash(__('Content deleted', true), 'thrill');
			$this->redirect(array('action'=>'index'));
		}
	}
	
	function __getPath($id = null, $get_hidden = false) {

		$nav_path = $this->Content->getpath($id, array('id','parent_id','title','permalink'));

		if (is_array($nav_path)): foreach ($nav_path as $index => $nav) // Listen, if $nav_path isn't an array, I don't want to hear it. I'll handle that at the end.
		{
			if ($nav['Content']['parent_id'] == '0')
			{
				$conditions = array('parent_id' => 0);
				if (!$get_hidden) $conditions['hidden'] = 0;
				$nav_path[$index]['siblings'] = $this->Content->find('list', array('conditions' => $conditions, 'fields' => array('Content.id', 'Content.title')));			}
			else
			{
				$siblings = $this->Content->children($nav['Content']['parent_id'], true, array('Content.id', 'Content.title'));
				$keys = Set::extract('/Content/id', $siblings);
				$values = Set::extract('/Content/title', $siblings);
				$nav_path[$index]['siblings'] = array_combine($keys, $values);
			}
		} endif;

		// check if this element has children and set that up
		if ($this->Content->childcount($id) > 0 && $id != 0)
		{
			$siblings = $this->Content->children($id, true, array('Content.id', 'Content.title'));
			$keys = Set::extract('/Content/id', $siblings);
			$values = Set::extract('/Content/title', $siblings);
			$nav_path[] = array('Content' => array('parent_id' => $id), 'siblings' => array_combine($keys, $values));
		}
		else if ($id === 0)
		{
			if ($get_hidden)
				$conditions = array('parent_id' => '0');
			else
				$conditions = array('parent_id' => '0', 'hidden' => 0);
			$siblings = $this->Content->find('list', array('fields' => array('Content.id', 'Content.title'), 'conditions' => $conditions));
			$nav_path[] = array('Content' => array('parent_id' => $id), 'siblings' => $siblings);
		
		}

		return $nav_path;
	}
	
	function get_path($id = null)
	{
		$this->set('nav_path', $this->__getPath($id));
	}
	
}
?>