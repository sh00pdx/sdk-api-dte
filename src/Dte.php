<?php
namespace ToDoSoft;

use ToDoSoft\Url;
use ToDoSoft\Traits\Api;

/**
 * Clase que permite el manejo completo de un DTE
 * @author Marcos Pulgar Acevedo <marcos.pulgar.a@gmail.com>
 * @param string $token
 */
class Dte {
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
     * Rut empresa emisora
     *
     * @var string
     */
    public $rutEmis;

    /**
     * Codigo del tipo de documento, dado por el SII
     *
     * @var int
     */
    public $tipo_dte;

    /**
     * Rut empresa/persona Receptora
     *
     * @var string|null
     */
    public $rutRecep;

    /**
     * Razon Social/Nombre de empresa/persona receptora
     *
     * @var string|null
     */
    public $rznSocRecep;

    /**
     * Giro de empresa receptora
     *
     * @var string|null
     */
    public $giroRecep;

    /**
     * Direccion de Empresa/persona emisora
     *
     * @var string|null
     */
    public $dirRecep;

    /**
     * Comuna Empresa/persona emisora
     *
     * @var string|null
     */
    public $cmnaRecep;

    /**
     * Arreglo de items/productos
     *
     * @var Array
     */
    public $items;

    /**
     * Folio de documento, se utiliza para consultar estado y generar PDF
     *
     * @var int
     */
    public $folio;

    public function __construct( $token ) {
        $this->_TOKEN   = $token;
        $Url            = new Url();
        $this->BASE_URL = $Url->get( 'BASE_URL' );
    }

    /**
     * Emitir documento tributario
     *
     * @return json
     */
    public function emitir() {
        $data = compact(
            $this->rutEmis,
            $this->tipo_dte,
            $this->rutRecep,
            $this->rznSocRecep,
            $this->giroRecep,
            $this->dirRecep,
            $this->cmnaRecep,
            $this->items,
        );

        return $this->performRequest( 'POST', '/dtes/sent', $data );
    }

    /**
     * Permite consultar estado de documento tributario
     *
     * @return json
     */
    public function consultarEstado() {
        return $this->performRequest( 'GET', "/dtes/sent/track/{$this->rut}/{$this->tipo_dte}/{$this->folio}" );
    }

    /**
     * Obtiene PDF de documento tributario
     *
     * @return upstrem
     */
    public function generarPdf(){
        return $this->performRequest( 'GET', "/dtes/sent/pdf/{$this->rut}/{$this->tipo_dte}/{$this->folio}" );
    }
}
