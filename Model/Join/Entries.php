<?php

namespace FacturaScripts\Plugins\IeAsientosPartidas\Model\Join;

class Entries extends \FacturaScripts\Core\Model\Base\JoinModel
{
    protected function getTables(): array
    {
        return ['partidas', 'asientos', 'subcuentas'];
    }

    protected function getFields(): array
    {
        return [
            'codejercicio' => 'asientos.codejercicio',
            'idasiento' => 'partidas.idasiento',
            'numero' => 'asientos.numero',
            'fecha' => 'asientos.fecha',
            'idsubcuenta' => 'partidas.idsubcuenta',
            'codsubcuenta' => 'partidas.codsubcuenta',
            'descripcion' => 'subcuentas.descripcion',
            'concepto' => 'partidas.concepto',
            'debe' => 'partidas.debe',
            'haber' => 'partidas.haber',
        ];
    }

    protected function getSQLFrom(): string
    {
        return 'partidas
            LEFT JOIN asientos ON partidas.idasiento = asientos.idasiento
            LEFT JOIN subcuentas ON partidas.idsubcuenta = subcuentas.idsubcuenta';
    }
}
