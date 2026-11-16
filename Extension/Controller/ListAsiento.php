<?php

namespace FacturaScripts\Plugins\IeAsientosPartidas\Extension\Controller;

use Closure;

class ListAsiento
{
    public function createViews(): Closure
    {
        return function (string $viewName = 'ListEntry') {
            $this->addView($viewName, 'Join\Entries', 'Partidas', 'fa-solid fa-balance-scale')
                ->addOrderBy(['fecha'], 'date', 2)
                ->addOrderBy(['numero'], 'accounting-entry')
                ->addSearchFields(['partidas.concepto', 'CAST(asientos.numero AS char(255))'])
                ->addFilterAutocomplete('codejercicio', 'exercise', 'asientos.codejercicio', 'ejercicios', 'codejercicio', 'nombre')
                ->addFilterPeriod('fecha', 'date', 'asientos.fecha')
                ->addFilterAutocomplete('codsubcuenta', 'subaccount', 'partidas.codsubcuenta', 'subcuentas', 'codsubcuenta', 'descripcion')
                ->addFilterNumber('min-debit', 'debit', 'partidas.debe', '>=')
                ->addFilterNumber('max-debit', 'debit', 'partidas.debe', '<=')
                ->addFilterNumber('min-credit', 'credit', 'partidas.haber', '>=')
                ->addFilterNumber('max-credit', 'credit', 'partidas.haber', '<=');
        };
    }
}