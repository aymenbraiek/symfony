<?php

namespace Esprit\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class EspritUserBundle extends Bundle
{
    public function getParent() {
        return 'FOSUserBundle';
    }
}
