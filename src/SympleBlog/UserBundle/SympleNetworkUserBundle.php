<?php

namespace SympleBlog\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SympleBlogUserBundle extends Bundle
{
    public function getParent() {
        return "FOSUserBundle";
    }
}
