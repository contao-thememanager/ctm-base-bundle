<?php

namespace ContaoThemeManager\BaseBundle\Import\Validator\Hook;

use Contao\FilesModel;

class FileCreatedValidatorHook
{
    /**
     * Update the file to include core fields while importing via Product-Installer.
     */
    public function onFileCreated(array $row, FilesModel $model): void
    {
        if(!\array_key_exists('ctmBackgroundImage', $row))
        {
            return;
        }

        $model->ctmBackgroundImage = $row['ctmBackgroundImage'];
        $model->save();
    }
}
