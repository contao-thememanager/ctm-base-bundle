<?php

namespace ContaoThemeManager\BaseBundle\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;
use Contao\StringUtil;

class ThemeManagerListener
{
    #[AsCallback(table: 'tl_module', target: 'fields.ctm_id.save', priority: 100)]
    public function generateCtmId($value, DataContainer $dc): string
    {
        if(!$value)
            $value = StringUtil::generateAlias($dc->activeRecord->name);

        return $value;
    }
}
