<?php
require ('vendor/autoload.php');

/**
 * Unit Test TODO API
 * 
 * @author Claudio
 *        
 */
class TodoTest extends PHPUnit_Framework_TestCase {
	protected $client;
	protected $lipsum;
	
	protected function setUp() {
		$this->client = new GuzzleHttp\Client ( [ 
				'base_uri' => 'http://localhost/work/my-todo-api/todo/' 
		] );
		
		$this->lipsum = new joshtronic\LoremIpsum();
	}
	/**
	 * Remocao de um item aleatorio
	 */
	public function testDelete_Valid_TodoObject()
	{
		$response = $this->client->delete(rand(1,100));
	
		$this->assertEquals ( 200, $response->getStatusCode () );
		
		$response = $response->getBody ();
		$data = json_decode ( $response, true );
		$this->assertEquals ( 'OK', $data ['status'] );	
	}
	/**
	 * Atualizando um item aleatorio
	 */
	public function testPut_Invalid_TodoObject()
	{
		$types = array('work','shopping');
		
		$response = $this->client->put( 9999999999, [ 
				'json' => [ 
						'type' => $types[rand(0,1)],
						'content' =>  $this->lipsum->words(5),
						'sort_order'=> (string)rand(1,10)
				] 
		] );
		
		$response = $response->getBody ();
		$data = json_decode ( $response, true );
		$this->assertEquals ( 'OK', $data ['ERROR'] );
		
	}	
	/**
	 * Salvando um item
	 */
	public function testPost_ValidaPost_TodoObject() {
		$types = array('work','shopping');
		
		$response = $this->client->post ( '', [ 
				'json' => [ 
						'type' => $types[rand(0,1)],
						'content' =>  $this->lipsum->words(5),
				] 
		] );
		
		$this->assertEquals ( 200, $response->getStatusCode () );
		
		$response = $response->getBody ();
		$data = json_decode ( $response, true );
		$this->assertEquals ( 'OK', $data ['status'] );		
		$this->assertInternalType(PHPUnit_Framework_Constraint_IsType::TYPE_INT, $data ['data']);
		
		//echo $response;
	}
	/**
	 * Obtem um item
	 */
	public function testGet_Valid_TodoObject() {
		$response = $this->client->get ( '10' );
		
		$this->assertEquals ( 200, $response->getStatusCode () );
		
		$response = $response->getBody ();
		$data = json_decode ( $response, true );
		$this->assertEquals ( 'OK', $data ['status'] );
		
		// echo $response;
	}
	
	/**
	 * Obtem um item
	 */
	public function testGet_Invalid_TodoObject() {
		$response = $this->client->get ( 'a' );
		
		$response = $response->getBody ();
		$data = json_decode ( $response, true );
		$this->assertEquals ( 'OK', $data ['status'] );
		
		// echo $response;
	}
	
	/**
	 * Todos os itens
	 */
	public function testGet_ValidList_TodoObject() {
		$response = $this->client->get ( '' );
		
		$response = $response->getBody ();
		$data = json_decode ( $response, true );
		$this->assertEquals ( 'OK', $data ['status'] );
		
		// echo $response;
	}
}