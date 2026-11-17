<?php

namespace FacturaScripts\Plugins\IeAsientosPartidas\Model\Join;

use FacturaScripts\Core\Template\JoinModel;
use FacturaScripts\Dinamic\Model\Subcuenta;

/**
 * Subcuentas con los datos fiscales y de dirección del cliente o proveedor que las tiene asignadas.
 * Si una subcuenta la comparten varios terceros, aparece una fila por cada uno.
 */
class SubaccountsWithThirdParty extends JoinModel
{
    /** Expresión que indica si la subcuenta tiene un cliente o proveedor asociado. */
    public const THIRD_PARTY_CODE_FIELD = 'COALESCE(clientes.codcliente, proveedores.codproveedor)';

    /** La subcuenta es el modelo master: al hacer clic en una fila se abre la subcuenta. */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->setMasterModel(new Subcuenta());
    }

    protected function getTables(): array
    {
        return ['subcuentas', 'clientes', 'proveedores', 'contactos'];
    }

    protected function getFields(): array
    {
        return [
            'idsubcuenta' => 'subcuentas.idsubcuenta',
            'codejercicio' => 'subcuentas.codejercicio',
            'codsubcuenta' => 'subcuentas.codsubcuenta',
            'descripcion' => 'subcuentas.descripcion',
            'cifnif' => 'COALESCE(clientes.cifnif, proveedores.cifnif)',
            'direccion' => 'COALESCE(contactoscli.direccion, contactospro.direccion)',
            'codpostal' => 'COALESCE(contactoscli.codpostal, contactospro.codpostal)',
            'ciudad' => 'COALESCE(contactoscli.ciudad, contactospro.ciudad)',
            'provincia' => 'COALESCE(contactoscli.provincia, contactospro.provincia)',
        ];
    }

    protected function getSQLFrom(): string
    {
        return 'subcuentas
            LEFT JOIN clientes ON clientes.codsubcuenta = subcuentas.codsubcuenta
            LEFT JOIN contactos contactoscli ON contactoscli.idcontacto = clientes.idcontactofact
            LEFT JOIN proveedores ON proveedores.codsubcuenta = subcuentas.codsubcuenta
            LEFT JOIN contactos contactospro ON contactospro.idcontacto = proveedores.idcontacto';
    }
}
