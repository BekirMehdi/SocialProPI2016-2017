<?php

namespace SocialPro\NetworkBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SocialProNetworkBundle extends Bundle
{
    public function getParent(){
        return 'FOSUserBundle';
    }
}
