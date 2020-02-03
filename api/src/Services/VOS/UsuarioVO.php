<?php
namespace PropelORMAPI\Services\VOS;

use \JsonSerializable;

class UsuarioVO implements JsonSerializable 
{

  private $idusuario;
  private $nombre;
  private $apellido;
  private $valid;

  private $tareasVO;
  /**
   * Class Constructor
   */

  public function __construct()
  {

  }

  public function agregarTarea($tareaVO){
  	if($this->tareasVO==null){
  		$this->tareasVO = array();
  	}
  	array_push($this->tareasVO, $tareaVO);
  }


  // Construir VO a partir de un Model
  public static function withUsuario($usuario) {
    $instance = new self();
  	if($usuario){
	    $instance->setIdUsuario($usuario->getIdUsuario());
	    $instance->setNombre($usuario->getNombre());
	    $instance->setApellido($usuario->getApellido());
	    $instance->setValid($usuario->getValid());
  	}
    return $instance;
  }

  public function jsonSerialize() {
    return get_object_vars($this);
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
  public function getNombre()
  {
      return $this->nombre;
  }

  /**
   * @param mixed $nombre
   *
   * @return self
   */
  public function setNombre($nombre)
  {
      $this->nombre = $nombre;

      return $this;
  }

  /**
   * @return mixed
   */
  public function getApellido()
  {
      return $this->apellido;
  }

  /**
   * @param mixed $apellido
   *
   * @return self
   */
  public function setApellido($apellido)
  {
      $this->apellido = $apellido;

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

  /**
   * @return mixed
   */
  public function getTareasVO()
  {
      return $this->tareasVO;
  }

  /**
   * @param mixed $tareasVO
   *
   * @return self
   */
  public function setTareasVO($tareasVO)
  {
      $this->tareasVO = $tareasVO;

      return $this;
  }
}
?>