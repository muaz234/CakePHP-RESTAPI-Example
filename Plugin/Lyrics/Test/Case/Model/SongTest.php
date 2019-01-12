<?php
App::uses('Song', 'Lyrics.Model');

/**
 * Song Test Case
 */
class SongTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.lyrics.song'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Song = ClassRegistry::init('Lyrics.Song');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Song);

		parent::tearDown();
	}

}
