<?php

namespace ContaoThemeManager\BaseBundle\EventListener\Compiler;

use Contao\File;
use Contao\System;
use Oveleon\ContaoThemeCompilerBundle\Compiler\FileCompiler;
use Symfony\Component\Filesystem\Path;
use Symfony\Component\Finder\Finder;

class BeforeCompileListener
{
    private const PACKAGE_DIR  = 'files/theme';
    private const PACKAGE_NAME = '_packages.scss';

    private FileCompiler $compiler;
    private string $rootDir;

    private ?array $files;

    public function __construct()
    {
        $container     = System::getContainer();
        $this->rootDir = $container->getParameter('kernel.project_dir');
        $this->files   = [];
    }

    /**
     * @throws \Exception
     */
    public function onBeforeCompile(FileCompiler $compiler): void
    {
        $this->compiler = $compiler;

        if (!!$directory = $this->dirExists())
        {
            $finder = new Finder();
            $finder->in($directory)->depth('> 0')->name(['*.css', '*.scss', '*.less']);

            $this->files = iterator_to_array($finder);
            $this->createPackagesFile($this->files);
        }
    }

    private function createPackagesSCSS(): string
    {
        $scss = '';

        if (!empty($this->files))
        {
            $scss = '@import "ctm_utils";' . PHP_EOL;

            foreach ($this->files as $file)
            {
                $scss .= '@import "packages/' . Path::normalize($file->getRelativePathname()) . '";' . PHP_EOL;
            }
        }

        return $scss;
    }

    /**
     * @throws \Exception
     */
    private function createPackagesFile(array $files): void
    {
        if ($this->compiler->fileExists(self::PACKAGE_DIR . '/packages/' . self::PACKAGE_NAME))
        {
            unlink(self::PACKAGE_DIR . '/packages/' . self::PACKAGE_NAME);
        }

        $objFile = new File(self::PACKAGE_DIR . '/' . self::PACKAGE_NAME);
        $blnSuccess = $objFile->write($this->createPackagesSCSS());
        $objFile->close();

        if ($blnSuccess && !empty($files))
        {
            $this->compiler->msg('Packages', FileCompiler::MSG_HEAD);
            $this->compiler->msg('Found ' . count($this->files) . ' package skin file(s)', FileCompiler::MSG_SUCCESS);
            $this->compiler->msg('File saved: ' .self::PACKAGE_DIR . '/' . self::PACKAGE_NAME, FileCompiler::MSG_SUCCESS);

            if (null !== ($uuid = $objFile->getModel()->uuid))
            {
                $this->compiler->customSkinFiles[] = $uuid;
            }
        }
    }

    private function dirExists(): bool|string
    {
        $strDirPath = self::PACKAGE_DIR . '/packages';

        // Check the source file
        if (!is_dir($this->rootDir . '/' . $strDirPath))
        {
            return false;
        }

        return $this->rootDir . '/' . $strDirPath;
    }
}
