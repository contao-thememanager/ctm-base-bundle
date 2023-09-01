<?php

use ContaoThemeManager\BaseBundle\EventListener\Compiler\BeforeCompileListener;
use ContaoThemeManager\BaseBundle\Import\Validator\Hook\FileCreatedValidatorHook;

// Add Hooks
$GLOBALS['TC_HOOKS']['beforeCompile'][] = [BeforeCompileListener::class, 'onBeforeCompile'];
$GLOBALS['PI_HOOKS']['onFileCreatedValidator'][] = [FileCreatedValidatorHook::class, 'onFileCreated'];
