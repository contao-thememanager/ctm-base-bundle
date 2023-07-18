<?php

use ContaoThemeManager\BaseBundle\EventListener\Compiler\BeforeCompileListener;

// Add Hooks
$GLOBALS['TC_HOOKS']['beforeCompile'][] = [BeforeCompileListener::class, 'onBeforeCompile'];
