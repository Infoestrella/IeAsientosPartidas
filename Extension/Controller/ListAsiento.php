<?php

namespace FacturaScripts\Plugins\IeAsientosPartidas\Extension\Controller;

use Closure;

class ListAsiento
{
    public function createViews(): Closure
    {
        return function (string $viewName = 'ListEntry') {
            $this->addView($viewName, 'Join\Entries', 'Partidas', 'fas fa-balance-scale');

            $this->addOrderBy($viewName, ['fecha'], 'date', 2);
            $this->addOrderBy($viewName, ['numero'], 'accounting-entry');

            $this->addSearchFields($viewName, ['partidas.concepto', 'asientos.numero']);

            $this->addFilterAutocomplete($viewName, 'codejercicio', 'exercise', 'asientos.codejercicio', 'ejercicios', 'codejercicio', 'nombre');
            $this->addFilterPeriod($viewName, 'fecha', 'date', 'asientos.fecha');
            $this->addFilterAutocomplete($viewName, 'codsubcuenta', 'subaccount', 'partidas.codsubcuenta', 'subcuentas', 'codsubcuenta', 'descripcion');

            $this->addFilterNumber($viewName, 'min-total', 'amount', 'partidas.debe', '>=');
            $this->addFilterNumber($viewName, 'max-total', 'amount', 'partidas.debe', '<=');
            $this->addFilterNumber($viewName, 'min-total', 'amount', 'partidas.haber', '>=');
            $this->addFilterNumber($viewName, 'max-total', 'amount', 'partidas.haber', '<=');
        };
    }
}