<?php

namespace FacturaScripts\Plugins\IeAsientosPartidas\Extension\Controller;

use Closure;

class ListAsiento
{
    public function createViews(): Closure
    {
        return function () {
            $this->addView('ListPartida', 'Partida', 'Partidas', 'fas fa-balance-scale');
        };
    }
}