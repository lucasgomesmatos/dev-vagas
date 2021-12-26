<?php

namespace App\Db;

use \PDO;
use \PDOException;
use \App\Enviroment\Enviroment;

class Database
{

  /**
   * Host de conexão com o banco de dados
   * @var  string
   */
  const HOST = '';

  /**
   * Nome do banco de dados
   * @var  string
   */
  const NAME = '';

  /**
   * Usúario
   * @var  string
   */
  const USER = '';

  /**
   * Password
   * @var  string
   */
  const PASS = '';


  /**
   * Nome de da Tabela a ser manipulada
   *
   * @var string
   */
  private $table;

  /**
   * Instância de conexão com o banco de DaDos
   *
   * @var PDO
   */
  private $connection;

  /**
   * Define a tabela e instância a conexão
   *
   * @param string $table
   */
  public function __construct($table = null)
  {
    $this->table = $table;
    $this->setConnection();
  }

  /**
   * Médoto responsável por criar uma conexão com o bando de dados
   *
   */
  private function setConnection()
  {
    try {
      $this->connection = new PDO("mysql:host=" . self::HOST . ";dbname=" . self::NAME, self::USER, self::PASS);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die('Error:' . $e->getMessage());
    }
  }

  /**
   * Método responsável por executar queries dentro do banco de dados
   *
   * @param string $query
   * @param array $params
   * @return PDOStatement
   */
  public function execute($query, $params = [])
  {
    try {
      $statement = $this->connection->prepare($query);
      $statement->execute($params);
      return $statement;

    } catch (PDOException $e) {
      die('Error:' . $e->getMessage());
    }
  }

  /**
   * Método responsável por inserir dados no banco de dados
   *
   * @param array $values
   * @return interger ID Inserido
   */
  public function insert($values) 
  {
    // Dados da Query
    $fields = array_keys($values);
    $binds = array_pad([], count($fields), '?');

    // Monta a Query
    $query = 'INSERT INTO '. $this->table . '(' . implode(',', $fields) . ') VALUES ('. implode(',', $binds) .')';

    // Executa o Insert
    $this->execute($query, array_values($values));

    //retorna o ID
    return $this->connection->lastInsertId();

    exit();
  }

  /**
   * Método responsável por executar uma consulta no banco
   *
   * @param string $where
   * @param string $order
   * @param string $limit
   * @param string $fields
   * @return PDOStatement
   */
  public function select($where = null, $order = null, $limit = null, $fields = '*'){
    //Dados da query
    $where = strlen($where) ? 'WHERE '.$where : '';
    $order = strlen($order) ? 'ORDER BY '.$order : '';
    $limit = strlen($limit) ? 'LIMIT '.$limit : '';

    //Monta query
    $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

    //Executa a query
    return $this->execute($query);
  }

  /**
   * Método responsável por executar atualizações no banco de dados
   *
   * @param string $where
   * @param array $values
   * @return boolean
   */
  public function update($where, $values) 
  {
    // Dados da query
    $fields = array_keys($values);

    // Monta a query
    $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;

    // Executar a Query
    $this->execute($query, array_values($values));
    
    // retorna sucesso
    return true;
  }

  /**
   * Método Responsável por excluir dados do banco
   *
   * @param string $where
   * @return boolean
   */
  public function delete($where)
  {
    //Monta a query
    $query = 'DELETE FROM '.$this->table.' WHERE '.$where;

    // Executa a Query
    $this->execute($query);

    // retorna sucesso
    return true;
  }
}
