<?php
/**
 * Song Fixture
 */
class SongFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'artist' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'remarks' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'isFavourite' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'updated' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8mb4', 'collate' => 'utf8mb4_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'artist' => 'Lorem ipsum dolor sit amet',
			'remarks' => 'Lorem ipsum dolor sit amet',
			'isFavourite' => 1,
			'created' => '2019-01-12 08:57:52',
			'updated' => '2019-01-12 08:57:52'
		),
	);

}
