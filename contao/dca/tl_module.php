<?php
foreach ($GLOBALS['TL_DCA']['tl_module']['palettes'] as $paletteName => $paletteFields)
{
    if($paletteName === '__selector__')
    {
        continue;
    }

    $GLOBALS['TL_DCA']['tl_module']['palettes'][$paletteName] .= ',ctm_id';
}

$GLOBALS['TL_DCA']['tl_module']['fields']['ctm_id'] = [
    'inputType' => 'text',
    'sql'       => "varchar(255) NOT NULL default ''",
    'eval'      => ['tl_class' => 'w100 clr invisible']
];
