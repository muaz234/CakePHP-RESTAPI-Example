<?php
App::uses('LyricsAppController', 'Lyrics.Controller');
/**
 * Songs Controller
 *
 * @property Song $Song
 * @property PaginatorComponent $Paginator
 */
class SongsController extends LyricsAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Song->recursive = 0;
		$this->set('songs', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Song->exists($id)) {
			throw new NotFoundException(__d('croogo', 'Invalid %s', __d('lyrics', 'song')));
		}
		$options = array('conditions' => array('Song.' . $this->Song->primaryKey => $id));
		$this->set('song', $this->Song->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {

		$this->layout = false;
		$response = array('status' => 'failed');
		if ($this->request->is('post')) {
			if(empty($this->request->data)){	
			$response = array('status' => 'No data is passed');
			}else{
				$data = array();
				$data = $this->request->data;
				$this->log('Log for data value' .$data);

				// $data = json_decode($user_input, true);
			}
			$this->Song->create();
			if ($this->Song->save($data) ) {
			$response = array('status' => 'success', 'message' => 'Songs successfully created');
			} else {
			$response = array('status' => 'failed' , 'message' => 'Sorry, pls try again');
			}
		}
		$this->set('response', $response);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Song->exists($id)) {
			throw new NotFoundException(__d('croogo', 'Invalid %s', __d('lyrics', 'song')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Song->saveAssociated($this->request->data)) {
				$this->flash(__d('croogo', '%s has been saved', __d('lyrics', 'song')), array('action' => 'index'));
			} else {
			}
		} else {
			$options = array('conditions' => array('Song.' . $this->Song->primaryKey => $id));
			$this->request->data = $this->Song->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Song->id = $id;
		if (!$this->Song->exists()) {
			throw new NotFoundException(__d('croogo', 'Invalid %s', __d('lyrics', 'song')));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Song->delete()) {
			// $this->flash((__d('croogo', '%s deleted', __d('lyrics', 'Song')), array('action' => 'index'));
		}
		$this->flash(__d('croogo', '%s was not deleted', __d('lyrics', 'Song')), array('action' => 'index'));
		return $this->redirect(array('action' => 'index'));
	}
}
