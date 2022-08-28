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

    public static function getTeamByProp($iblock, $prop_id, $item_id) {
        $obTEAM_prop = \CIBlockProperty::GetByID($prop_id, $iblock);
        if($arTEAM_prop = $obTEAM_prop->GetNext())
            $arTEAM_iblock = $arTEAM_prop['LINK_IBLOCK_ID'];

        $obTEAM = \CIBlockElement::GetList(
            [],
            ['IBLOCK_ID' => $arTEAM_iblock, 'ID' => $item_id],
            false,
            false,
            ['NAME', 'ID', 'PROPERTY_ICO']
        );
        while ($arTEAM = $obTEAM->GetNext()) {
            if (!empty($arTEAM['PROPERTY_ICO_VALUE']))
                $arTEAM['ICO'] = \CFile::GetPath($arTEAM['PROPERTY_ICO_VALUE']);
            $arItem = $arTEAM;
        }

        return $arItem;
    }

    public static function getPlayerByUF($iblock, $prop_code, $item_id) {
        $obField = \CUserTypeEntity::GetList([], ['FIELD_NAME' => $prop_code, 'ENTITY_ID' => 'IBLOCK_'. $iblock .'_SECTION']);
        while ($arField = $obField->GetNext()) {
            $team_iblock = $arField['SETTINGS']['IBLOCK_ID'];
        }

        $obTEAMs = \CIBlockElement::GetList(
            [],
            ['IBLOCK_ID' => $team_iblock, 'ID' => $item_id],
            false,
            false,
            []
        );
        while ($obTEAM = $obTEAMs->GetNextElement()) {
            $arTEAM = $obTEAM->GetFields();
            $arTEAM['PROP'] = $obTEAM->GetProperties();
            if (!empty($arTEAM['PROP']['ICO']['VALUE']))
                $arTEAM['ICO'] = \CFile::GetPath($arTEAM['PROP']['ICO']['VALUE']);
            $arItem = $arTEAM;
        }

        return $arItem;
    }

}