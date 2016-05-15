<?php
/**
 * Mapper para Tabelas do Banco de dados
 * @author Claudio
 *
 */
class TodoTable {
	// Nome da tabela no banco
	protected $table = 'bdr_todo';
	protected $adapter = false;
	/**
	 * Conexao com o banco de dados
	 */
	public function __construct() {
		// conexao com o banco de dados
		$link = mysqli_connect ( 'localhost', 'bdr_api', 'bdr_api', 'bdr_api' );
		mysqli_set_charset ( $link, 'utf8' );
		
		$this->adapter = $link;
	}
	/**
	 * Adiciona um novo item
	 * 
	 * @param unknown $type
	 * @param unknown $content
	 * @param unknown $sort_order
	 */
	public function save($type, $content, $sort_order) {
		// SQL
		$sql = "INSERT INTO `$this->table` (`type`, `content`, `sort_order`, `date_created`) VALUES ('{$type}', '{$content}', '{$sort_order}', NOW())";
		//echo $sql;
		// excecute SQL statement
		$result = mysqli_query ( $this->adapter, $sql );
		// die if SQL statement failed
		if (! $result) {
			return false;
		}
		
		return mysqli_insert_id ( $this->adapter );
	}
	/**
	 * Atualizando uma informatacao
	 * @param unknown $uuid
	 * @param unknown $type
	 * @param unknown $content
	 * @param unknown $sort_order
	 * @param unknown $done
	 */
	public function updated($uuid, $type, $content, $sort_order, $done){
		// SQL
		$sql = "UPDATE `$this->table` SET type='{$type}', content='{$content}', sort_order='{$sort_order}', done='{$done}'  WHERE uuid='{$uuid}'";
		// excecute SQL statement
		mysqli_query ( $this->adapter, $sql );
		
		return  $this->adapter->affected_rows;		
	}
	/**
	 * Altera somente a ordem
	 * @param unknown $uuid
	 * @param unknown $sort_order
	 */
	public function reSortOrder($uuid, $sort_order){
		return mysqli_query ( $this->adapter, "UPDATE `$this->table` SET sort_order='{$sort_order}' WHERE uuid='{$uuid}'" );
	}
	/**
	 * Fix bug com dois com a mesma ordem, joga os demais para uma ordem acima
	 * @param unknown $uuid
	 * @param unknown $sort_order
	 */
	public function fixSortOrder($uuid, $sort_order){
		$nex_sort_order = $sort_order +1;
		return mysqli_query ( $this->adapter, "UPDATE `$this->table` SET sort_order='{$nex_sort_order}' WHERE uuid != '{$uuid}' AND sort_order='{$sort_order}'" );
	}
	/**
	 * Retorna todos os itens
	 */
	public function fetchAll() {
		$rows = array();//Default
		//SQL
		$sql = "SELECT * FROM `$this->table` WHERE 1 ORDER BY sort_order, uuid ASC";
		// excecute SQL statement
		$result = mysqli_query ( $this->adapter, $sql );
		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)){
				$row['done'] = $row['done'] == 0 ? false : true;
				$rows[] = $row;
			}
		}
		
		return $rows;		
	}
	/**
	 * Seleciona somente um item
	 * @param unknown $uuid
	 */
	public function find($uuid) {
		$rows = array();//Default
		//SQL		
		$sql = "SELECT * FROM `$this->table` WHERE uuid='{$uuid}' LIMIT 1";
		// excecute SQL statement
		$result = mysqli_query ( $this->adapter, $sql );
		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)){
				$row['done'] = $row['done'] == 0 ? false : true;
				$rows = $row;
			}
		} 
		
		return $rows;
	}
	/**
	 * Remove um item
	 * @param unknown $uuid
	 */
	public function delete($uuid) {
		// sql to delete a record
		$sql = "DELETE FROM `$this->table` WHERE uuid='{$uuid}'";
		// excecute SQL statement
		mysqli_query ( $this->adapter, $sql );
		
		return  $this->adapter->affected_rows;
	}
	/**
	 * Encerrando conexao com o banco de dados
	 */
	public function close(){
		// close mysql connection
		mysqli_close ( $this->adapter);
	}
}