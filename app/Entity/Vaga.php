<?php

namespace App\Entity;

use App\Db\Database;
use \PDO;

class Vaga
{

  /**
   * Identificador único da vaga
   *
   * @var integer
   */
  public $id;

  /**
   * Título da Vaga
   *
   * @var string
   */
  public $titulo;

  /**
   * Descrição da vaga [pode conter html]
   *
   * @var string
   */
  public $descricao;

  /**
   * Define se a vaga ativa
   *
   * @var string [s/n]
   */
  public $ativo;

  /**
   * Data de publicação da vaga
   *
   * @var string
   */
  public $data;


  /**
   * Método responsável por cadastrar nova Vaga
   *
   * @return boolean
   */
  public function cadastrar()
  {
    // Definir a Data
    $this->data = date('Y-m-d H:i:s');

    // Inserir a Vaga no Banco de Dados
    $obDatabase = new Database('vagas');
    $this->id = $obDatabase->insert([
      'titulo' => $this->titulo,
      'descricao' => $this->descricao,
      'ativo' => $this->ativo,
      'data' => $this->data
    ]);

    // Retornar Sucesso

    return true;
  }

  /**
   * Método responsável por atualizar a vaga no Bando de Dados
   *
   * @return boolean
   */
  public function atualizar()
  {
    return (new Database('vagas'))->update('id = ' . $this->id, [
      'titulo'    => $this->titulo,
      'descricao' => $this->descricao,
      'ativo'     => $this->ativo,
      'data'      => $this->data
    ]);
  }

  /**
   * Método responsável por excluir a vaga do abnco
   *
   * @return boolean
   */
  public function excluir()
  {
    return (new Database('vagas'))->delete('id = '.$this->id);
  }

  /**
   * Método responsável por obter as vagas no banco de Dados
   *
   * @param string $where
   * @param string $order
   * @param string $limit
   * @return array
   */
  public static function getVagas($where = null, $order = null, $limit = null)
  {
    return (new Database('vagas'))->select($where, $order, $limit)
      ->fetchAll(PDO::FETCH_CLASS, self::class);
  }

  /**
   * Método Responsável por buscar uma vaga com base em seu ID
   *
   * @param interger $id
   * @return Vaga
   */
  public static function getVaga($id)
  {
    return (new Database('vagas'))->select('id = ' . $id)
      ->fetchObject(self::class);
  }
}
