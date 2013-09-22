<?php

namespace Walva\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class WalvaUserBundle extends Bundle {

    public function getParent() {
        return 'FOSUserBundle';
    }

}
