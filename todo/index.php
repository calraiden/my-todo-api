<?php
require_once ('model/TodoTable.php');
/**
 * Pegando o tipo do metodo
 *
 * @var unknown
 */
$method = $_SERVER ['REQUEST_METHOD'];
$request = explode ( '/', trim ( isset ( $_SERVER ['PATH_INFO'] ) ? $_SERVER ['PATH_INFO'] : $_SERVER ['HTTP_HOST'] . $_SERVER ['REQUEST_URI'], '/' ) );
$input = json_decode ( file_get_contents ( 'php://input' ), true );
/**
 * Obtendo o uuid se for passado na URL
 *
 * @var unknown
 */
$uuid = is_array ( $request ) && count ( $request ) > 0 ? end ( $request ) : 0;
if (! ctype_digit ( $uuid )) {
	$uuid = 0;
}
/**
 * Obtendo os campos e chegando se foram preenchidos
 */
$type = isset ( $input ['type'] ) ? strtolower ( addslashes ( $input ['type'] ) ) : null;
$content = isset ( $input ['content'] ) ? addslashes ( $input ['content'] ) : null;
$sort_order = isset ( $input ['sort_order'] ) ? $input ['sort_order'] : 0;
$done = isset ( $input ['done'] ) ? ( int ) $input ['done'] : 0;
/**
 * Validando entradas
 */
$allow_types = array (
		'shopping',
		'work' 
);

try {
	if (! is_empty ( $type ) && ! in_array ( $type, $allow_types )) {
		throw new Exception ( "The task type you provided is not supported. You can only use shopping or work." );
	} elseif (! ctype_digit ( $sort_order ) && $sort_order != 0) {
		throw new Exception ( "The short order you provided is not supported. You can only use number." );
	} elseif ($done != 0 && $done != 1) {
		throw new Exception ( "The done you provided is not supported. You can only use true or false." );
	} else { // Chegou aqui? Entao, passou na validacao inicial
		$TodoTable = new TodoTable ();
		// Default resposta
		$data = null;
		// Executando o SQL baseado no http metodo
		// var_dump($method);
		switch ($method) {
			case 'GET' :
				if ($uuid > 0) {
					$data = $TodoTable->find ( $uuid );
				} else {
					$data = $TodoTable->fetchAll ();
				}
				
				if (count ( $data ) == 0) {
					show_response_code ( "OK", "Wow. You have nothing else to do. Enjoy the rest of your day!" );
				}
				break;
			case 'PUT' :
				if ($uuid > 0) {
					$old_data = $TodoTable->find ( $uuid );
					if (count ( $old_data ) == 0) {
						throw new Exception ( "Are you a hacker or something? The task you were trying to edit doesn't exist." );
					}
					$new_data = $TodoTable->updated ( $uuid, $type, $content, $sort_order, $done );
					/**
					 * Se alterou a ordem, reordenar as tarefas
					 */
					if ($new_data && ctype_digit ( $sort_order ) && $old_data ['sort_order'] != $sort_order) {
						//Fix bug com dois mesma ordem
						$TodoTable->fixSortOrder ( $uuid, $sort_order );
						// Reoderna
						$data = $TodoTable->fetchAll ();
						foreach ( $data as $key => $value ) {
							$TodoTable->reSortOrder ( $value ['uuid'], $key );
						}
					}
					show_response_code ( "OK", "Good job! The task was updated." );
				} else {
					throw new Exception ( "Sorry, but it was not possible to validate your uuid." );
				}
				break;
			case 'POST' :
				// var_dump('POST');
				// The system must not allow empty tasks. If that happens, then the API must return the following message: "Bad move! Try removing the task instead of deleting its content."
				if (is_empty ( $type ) || is_empty ( $content )) {
					throw new Exception ( "Bad move! Try removing the task instead of deleting its content." );
				}
				$data = $TodoTable->save ( $type, $content, $sort_order );
				break;
			case 'DELETE' :
				if ($uuid > 0) {
					$data = $TodoTable->delete ( $uuid );
					show_response_code ( "OK", $data ? "Good job! The task was removed." : "Good news! The task you were trying to delete didn't even exis" );
				}
				
				throw new Exception ( "Sorry, but it was not possible to validate your uuid." );
				break;
			default :
				throw new Exception ( 'Method Not Allowed' );
				break;
		}
		// Encerrando a conexao
		$TodoTable->close ();
		// Retornado o resultado
		show_response_code ( 'OK', $data );
	}
} catch ( Exception $e ) {
	show_response_code ( 'ERROR', $e->getMessage () );
}
/**
 * Chegando se string eh vazia
 */
function is_empty($str) {
	return (empty ( $str ) || trim ( $str ) == "") ? true : false;
}
/**
 * Retorna a resposa da solicitacao
 *
 * @param unknown $status
 *        	, OK em caso de sucesso, ERROR em caso de falha
 * @param unknown $data        	
 */
function show_response_code($status, $data) {
	if ($status == 'ERROR') {
		http_response_code ( 500 );
	}
	header ( 'Content-Type: application/json' );
	echo json_encode ( array (
			'status' => $status,
			'data' => $data 
	) );
	
	die ();
}