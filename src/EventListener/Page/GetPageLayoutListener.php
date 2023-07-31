<?php

namespace ContaoThemeManager\BaseBundle\EventListener\Page;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\PageRegular;
use Contao\LayoutModel;
use Contao\PageModel;

#[AsHook('getPageLayout')]
class GetPageLayoutListener
{
    const PREVIEW_INDICATOR = 'Templates';
    const PREVIEW_STYLES = 'https://contao-thememanager.com/files/preview/css/preview-styles.css';

    public function __invoke(PageModel $pageModel, LayoutModel $layout, PageRegular $pageRegular): void
    {
        if (self::PREVIEW_INDICATOR === $pageModel->rootTitle)
        {
            $layout->head = '<link rel="stylesheet" href="'.self::PREVIEW_STYLES.'">' . $layout->head;
        }
    }
}
