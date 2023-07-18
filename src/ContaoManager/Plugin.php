<?php

declare(strict_types=1);

namespace ContaoThemeManager\BaseBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use ContaoThemeManager\BaseBundle\ContaoThemeManagerBaseBundle;
use ContaoThemeManager\Core\ContaoThemeManagerCore;
use Oveleon\ContaoThemeCompilerBundle\ContaoThemeCompilerBundle;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(ContaoThemeManagerBaseBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class, ContaoThemeCompilerBundle::class, ContaoThemeManagerCore::class])
                ->setReplace(['ctm-base-bundle']),
        ];
    }
}
