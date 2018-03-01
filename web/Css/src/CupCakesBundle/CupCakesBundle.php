<?php

namespace CupCakesBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CupCakesBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
