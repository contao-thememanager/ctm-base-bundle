<?php

declare(strict_types=1);

namespace ContaoThemeManager\BaseBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ContaoThemeManagerBaseBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
