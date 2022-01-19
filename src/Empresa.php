<?php
namespace ToDoSoft;

use ToDoSoft\Url;
use GuzzleHttp\Psr7;
use ToDoSoft\Traits\Api;

/**
 * Clase que permite el manejo de una empresa
 * @author Marcos Pulgar Acevedo <marcos.pulgar.a@gmail.com>
 * @param string $token
 */
class Empresa {
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
     * Rut de empresa
     *
     * @var string
     */
    public $rut;

    /**
     * Razon social de la empresa
     *
     * @var string
     */
    public $razon_social;

    /**
     * Numero de resolución, dado por el SII
     *
     * @var int
     */
    public $nr_resolucion;

    /**
     * Fecha de resolución, dada por el SII
     *
     * @var string
     */
    public $fc_resolucion;

    /**
     * Dirección de la empresa
     *
     * @var string
     */
    public $direccion;

    /**
     * Comuna de la empresa
     *
     * @var string
     */
    public $comuna;

    /**
     * Telefono de la empresa
     *
     * @var string
     */
    public $telefono;

    /**
     * email de la empresa
     *
     * @var string
     */
    public $email;

    /**
     * Path del certificado personal del representante legal autorizado a facturar
     *
     * @var string
     */
    public $certificado;

    /**
     * password del certificado personal
     *
     * @var string
     */
    public $password_certificado;

    /**
     * Giro comercial de la empresa
     *
     * @var string
     */
    public $giro;

    /**
     * codigo de actividad comercial
     *
     * @var int
     */
    public $codigo_actividad;

    public function __construct( $token ) {
        $this->_TOKEN   = $token;
        $Url            = new Url();
        $this->BASE_URL = $Url->get( 'BASE_URL' );
        error_log('TOKEN: '.$token);
        error_log('BASE_URL: '.$Url->get( 'BASE_URL' ));
    }

    public function crear() {
        $data = [
            'rut'                  => $this->rut,
            'razon_social'         => $this->razon_social,
            'nr_resolucion'        => $this->nr_resolucion,
            'fc_resolucion'        => $this->fc_resolucion,
            'direccion'            => $this->direccion,
            'comuna'               => $this->comuna,
            'telefono'             => $this->telefono,
            'email'                => $this->email,
            'certificado'          => Psr7\Utils::tryFopen( $this->certificado, 'r' ),
            'password_certificado' => $this->password_certificado,
            'giro'                 => $this->giro,
            'codigo_actividad'     => $this->codigo_actividad,
        ];

        return $this->performRequestFile( 'POST', '/empresas', $data );
    }

    public function actualizar() {
        $data = [
            'rut'              => $this->rut,
            'razon_social'     => $this->razon_social,
            'nr_resolucion'    => $this->nr_resolucion,
            'fc_resolucion'    => $this->fc_resolucion,
            'direccion'        => $this->direccion,
            'comuna'           => $this->comuna,
            'telefono'         => $this->telefono,
            'email'            => $this->email,
            'giro'             => $this->giro,
            'codigo_actividad' => $this->codigo_actividad,
        ];

        return $this->performRequest( 'PUT', '/empresas', $data );
    }

    public function actualizarCertificado() {
        $data = [
            'rut'                  => $this->rut,
            'certificado'          => Psr7\Utils::tryFopen( $this->certificado, 'r' ),
            'password_certificado' => $this->password_certificado,
        ];

        return $this->performRequestFile( 'PUT', '/empresas/certificado', $data );
    }
}
