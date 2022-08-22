<?php

namespace Module\Project\Helpers;

use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Loader;


class Utils
{
    const MODULE_ID = 'module.project';

    public static function filesize_format($filesize)
    {
        $formats = array(" байт", " Кб", " Мб", " Гб", " Tб");
        $format = 0;
        while ($filesize > 1024 && count($formats) != ++$format) {
            $filesize = round($filesize / 1024, 1);
        }
        $formats[] = " Tб";
        return $filesize . ' ' . $formats[$format];
    }

    public static function getIdByCode($iblockCode)
    {
        Loader::includeModule('iblock');
        $arIblock = IblockTable::getList([
            'filter' => ['CODE' => $iblockCode],
            'select' => ['ID']
        ])->fetch();

        return !empty($arIblock)? $arIblock['ID'] : false;
    }

}