<?php

namespace FacturaScripts\Plugins\IeAsientosPartidas\Extension\Controller;

use Closure;
use FacturaScripts\Core\DataSrc\Ejercicios;
use FacturaScripts\Core\Where;
use FacturaScripts\Plugins\IeAsientosPartidas\Model\Join\SubaccountsWithThirdParty;

class ListCuenta
{
    public function createViews(): Closure
    {
        return function (string $viewName = 'ListSubaccountsWithThirdParty') {
            $thirdPartyField = SubaccountsWithThirdParty::THIRD_PARTY_CODE_FIELD;

            $this->addView($viewName, 'Join\SubaccountsWithThirdParty', 'subaccounts-third-party', 'fa-solid fa-address-book')
                ->addSearchFields([
                    'subcuentas.codsubcuenta',
                    'subcuentas.descripcion',
                    'COALESCE(clientes.cifnif, proveedores.cifnif)',
                ])
                ->addOrderBy(['subcuentas.codejercicio desc, subcuentas.codsubcuenta'], 'code', 1)
                ->addOrderBy(['subcuentas.codejercicio desc, subcuentas.descripcion'], 'description')
                ->addFilterSelect('codejercicio', 'exercise', 'subcuentas.codejercicio', Ejercicios::codeModel())
                // sin marcar: solo subcuentas con tercero; marcado: todas (la condición marcada siempre se cumple)
                ->addFilterCheckbox('all-subaccounts', 'all-subaccounts', 'subcuentas.idsubcuenta', '!=', null, [
                    Where::isNotNull($thirdPartyField),
                ]);

            // listado de solo consulta
            $this->tab($viewName)
                ->setSettings('btnDelete', false)
                ->setSettings('btnNew', false)
                ->setSettings('checkBoxes', false);
        };
    }
}
