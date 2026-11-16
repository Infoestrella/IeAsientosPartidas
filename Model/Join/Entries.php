<?php

namespace FacturaScripts\Plugins\IeAsientosPartidas\Model\Join;

use FacturaScripts\Core\Template\JoinModel;
use FacturaScripts\Dinamic\Model\Asiento;

class Entries extends JoinModel
{
    /** El asiento es el modelo master: al hacer clic en una partida se abre su asiento. */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->setMasterModel(new Asiento());
    }

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
