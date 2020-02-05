<?php
namespace PropelORMAPI\Services\VOS;

use \JsonSerializable;

class TareaVO implements JsonSerializable 
{

  private $idtarea;
  private $titulo;
  private $timestamp;
  private $valid;

  /**
   * Class Constructor
   */

  public function __construct()
  {

  }

  // Construir VO a partir de un Model
  public static function withTarea($tarea) {
    $instance = new self();
  	if($tarea){
	    $instance->setIdTarea($tarea->getIdTarea());
	    $instance->setTitulo($tarea->getTitulo());
	    $instance->setTimestamp($tarea->getTimestamp());
	    $instance->setValid($tarea->getValid());
  	}
    return $instance;
  }

  public function jsonSerialize() {
    return get_object_vars($this);
  }

  /**
   * @return mixed
   */
  public function getIdtarea()
  {
      return $this->idtarea;
  }

  /**
   * @param mixed $idtarea
   *
   * @return self
   */
  public function setIdtarea($idtarea)
  {
      $this->idtarea = $idtarea;

      return $this;
  }

  /**
   * @return mixed
   */
  public function getTitulo()
  {
      return $this->titulo;
  }

  /**
   * @param mixed $titulo
   *
   * @return self
   */
  public function setTitulo($titulo)
  {
      $this->titulo = $titulo;

      return $this;
  }

  /**
   * @return mixed
   */
  public function getTimestamp()
  {
      return $this->timestamp;
  }

  /**
   * @param mixed $timestamp
   *
   * @return self
   */
  public function setTimestamp($timestamp)
  {
      $this->timestamp = $timestamp;

      return $this;
  }

  /**
   * @return mixed
   */
  public function getValid()
  {
      return $this->valid;
  }

  /**
   * @param mixed $valid
   *
   * @return self
   */
  public function setValid($valid)
  {
      $this->valid = $valid;

      return $this;
  }
}
?>