<?php
namespace PropelORMAPI\Services\VOS;

use \JsonSerializable;

class UsuarioTareaVO implements JsonSerializable 
{
	private $idusuariotarea;
  private $idusuario;
  private $idtarea;
  private $timestamp;
  private $valid;

  /**
   * Class Constructor
   */

  public function __construct()
  {

  }

  // Construir VO a partir de un Model
  public static function withTarea($usuarioTarea) {
    $instance = new self();
  	if($usuarioTarea){
	    $instance->setIdUsuarioTarea($usuarioTarea->getIdTarea());
	    $instance->setIdTarea($usuarioTarea->getIdTarea());
	    $instance->setIdUsuario($usuarioTarea->getTitulo());
	    $instance->setTimeStamp($usuarioTarea->getTimeStamp());
	    $instance->setValid($usuarioTarea->getValid());
  	}
    return $instance;
  }

  public function jsonSerialize() {
    return get_object_vars($this);
  }

  /**
   * @return mixed
   */
  public function getIdusuariotarea()
  {
      return $this->idusuariotarea;
  }

  /**
   * @param mixed $idusuariotarea
   *
   * @return self
   */
  public function setIdusuariotarea($idusuariotarea)
  {
      $this->idusuariotarea = $idusuariotarea;

      return $this;
  }

  /**
   * @return mixed
   */
  public function getIdusuario()
  {
      return $this->idusuario;
  }

  /**
   * @param mixed $idusuario
   *
   * @return self
   */
  public function setIdusuario($idusuario)
  {
      $this->idusuario = $idusuario;

      return $this;
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