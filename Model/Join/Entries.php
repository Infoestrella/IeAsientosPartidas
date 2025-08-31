<?php

namespace FacturaScripts\Plugins\IeAsientosPartidas\Model\Join;

class Entries extends \FacturaScripts\Core\Model\Base\JoinModel
{
    protected function getTables(): array
    {
        return ['partidas', 'asientos'];
    }

    protected function getFields(): array
    {
        return [
            'codejercicio' => 'asientos.codejercicio',
            'numero' => 'asientos.numero',
            'fecha' => 'asientos.fecha',
            'codsubcuenta' => 'partidas.codsubcuenta',
            'concepto' => 'partidas.concepto',
            'debe' => 'partidas.debe',
            'haber' => 'partidas.haber',
        ];
    }

    protected function getSQLFrom(): string
    {
        return 'partidas LEFT JOIN asientos ON partidas.idasiento = asientos.idasiento';
    }
}