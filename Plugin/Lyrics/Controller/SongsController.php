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
		$this->layout = false;
		if (!$this->Song->exists($id)) {
			$response = array('status' => 'Data not fetched');
		}
		$options = array('conditions' => array('Song.' . $this->Song->primaryKey => $id));
		$result = $this->Song->find('first', $options);
		$response = array('message' => 'Success', 'data' => $result);
		$this->set('song', $result);
		echo json_encode($response);
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
		echo json_encode($response);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->layout = false;
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Song->id = $id;
			if ($this->Song->save($this->request->data)) {
				$response = array('status' => 'Updated successful', 'message' => 'Value successfully added');
			} else {
				$response = array('status' => 'Failed', 'message' => 'Failed to update the data. Please retry');
			}
		} else {
			$options = array('conditions' => array('Song.' . $this->Song->primaryKey => $id));
			$this->request->data = $this->Song->find('first', $options);
		}

		echo json_encode($response);
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
		$this->layout = false;
		$this->Song->id = $id;
		if (!$this->Song->exists()) {
			$response = array('message' => 'Song does not exist');
		}
		if ($this->Song->delete()) {
		$response = array('status' => 'success', 'message' => 'Song successfully deleted');
		}else {
			$response = array('status' => 'failed', 'message' => 'Song failed to be deleted');
		}
		echo json_encode($response);
	}
}
