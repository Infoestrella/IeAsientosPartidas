<?php

namespace FacturaScripts\Plugins\IeAsientosPartidas;

use FacturaScripts\Core\Template\InitClass;

final class Init extends InitClass
{
    public function init(): void
    {
        $this->loadExtension(new Extension\Controller\ListAsiento());
    }

    public function uninstall(): void
    {
    }

    public function update(): void
    {
    }
}
