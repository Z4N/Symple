<?php

namespace Symple\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SympleUserBundle extends Bundle
{
    public function getParent() {
        return "FOSUserBundle";
    }
}
