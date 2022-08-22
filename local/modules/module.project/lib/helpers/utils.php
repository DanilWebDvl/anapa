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

    public static function getNameMothByNum($num) {
        $array = [
            '01' => 'Январь',
            '02' => 'Февраль',
            '03' => 'Март',
            '04' => 'Апрель',
            '05' => 'Май',
            '06' => 'Июнь',
            '07' => 'Июль',
            '08' => 'Август',
            '09' => 'Сентябрь',
            '10' => 'Октябрь',
            '11' => 'Ноябрь',
            '12' => 'Декабрь'
        ];

        return $array[$num];
    }

}