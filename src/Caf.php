<?php
namespace ToDoSoft;

use ToDoSoft\Url;
use ToDoSoft\Traits\Api;

/**
 * Clase que permite el manejo completo de los CAF/Folios
 * @author Marcos Pulgar Acevedo <marcos.pulgar.a@gmail.com>
 * @param string $token
 */
class Caf {
    use Api;

    /**
     * Token secreto para conexion con la api
     *
     * @var string
     */
    private $_TOKEN;

    /**
     * Objeto de la clase Url
     *
     * @var string
     */
    public $BASE_URL;

    /**
     * Path del archivo Caf (xml)
     *
     * @var string
     */
    public $caf;

    /**
     * Rut de la empresa dueña del caf
     *
     * @var string
     */
    public $rut;

    public function __construct( $token ) {
        $this->_TOKEN   = $token;
        $Url            = new Url();
        $this->BASE_URL = $Url->get( 'BASE_URL' );
    }

    /**
     * Obtener folios cargados para la empresa especificada
     *
     * @return json
     */
    public function getFolios(){
        return $this->performRequest('GET', '/empresas/cafs', compact($this->rut));
    }

    /**
     * Cargar folios (archivo caf) para empresa especificada
     *
     * @return json
     */
    public function setFolios(){
        return $this->performRequest('POST', '/empresas/cafs', compact($this->rut, $this->caf));
    }

}
