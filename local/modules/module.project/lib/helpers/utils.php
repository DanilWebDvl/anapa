<?php

namespace Module\Project\Helpers;

use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Loader;
use CIBlockPropertyEnum;


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

        return !empty($arIblock) ? $arIblock['ID'] : false;
    }

    public static function getNameMothByNum($num)
    {
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

    public static function getTeamById($id)
    {
        $iblock = self::getIdByCode('teamlist');
        if (empty($iblock)) {
            return false;
        }

        $obEl = \CIBlockElement::GetList(
            [],
            ['ACTIVE' => 'Y', 'IBLOCK_ID' => $iblock, 'ID' => $id],
            false,
            false,
            ['PROPERTY_NAME_VOLLEY', 'ID', 'IBLOCK_ID', 'NAME']
        );
        while ($arEls = $obEl->GetNext()) {
            $arEl = $arEls;
        }

        if (!empty($arEl)) {
            return $arEl;
        } else {
            return false;
        }
    }

    public static function getTeamByCode($code)
    {
        $iblock = self::getIdByCode('teamlist');
        if (empty($iblock)) {
            return false;
        }

        $obEl = \CIBlockElement::GetList(
            [],
            ['ACTIVE' => 'Y', 'IBLOCK_ID' => $iblock, 'CODE' => $code],
            false,
            false,
            ['PROPERTY_NAME_VOLLEY', 'ID', 'IBLOCK_ID', 'NAME', 'XML_ID']
        );
        while ($arEls = $obEl->GetNext()) {
            $arEl = $arEls;
        }

        if (!empty($arEl)) {
            return $arEl;
        } else {
            return false;
        }
    }

    /**
     * @param $xml_id - ulid обязателен
     * @param $name - если не нашли по ulid ищем по названию
     * @return array|false
     */
    public static function getTeamByXmlId($xml_id, $name = '')
    {
        $iblock = self::getIdByCode('teamlist');
        if (empty($iblock)) {
            return false;
        }
        $arFilter = [
            'ACTIVE' => 'Y',
            'IBLOCK_ID' => $iblock,
        ];
        if ($name) {
            $arFilter[] =[
                'LOGIC'=>'OR',
                'XML_ID'=>$xml_id,
                '%NAME'=>$name
            ];

        } else {
            $arFilter['XML_ID'] = $xml_id;

        }
        $obEl = \CIBlockElement::GetList(
            [],
            $arFilter,
            false,
            false,
            ['PROPERTY_NAME_VOLLEY', 'ID', 'IBLOCK_ID', 'NAME', 'XML_ID']
        );
        while ($arEls = $obEl->GetNext()) {
            $arEl = $arEls;
        }

        if (!empty($arEl)) {
            return $arEl;
        } else {
            //Создать эту команду и вернуть данные
            return self::setTeam(['IBLOCK_ID'=>$iblock,'NAME'=>$name,'XML_ID'=>$xml_id]);;
        }
    }

    public static function getTeamByProp($iblock, $prop_id, $item_id)
    {
        $obTEAM_prop = \CIBlockProperty::GetByID($prop_id, $iblock);
        if ($arTEAM_prop = $obTEAM_prop->GetNext()) {
            $arTEAM_iblock = $arTEAM_prop['LINK_IBLOCK_ID'];
        }

        $obTEAM = \CIBlockElement::GetList(
            [],
            ['IBLOCK_ID' => $arTEAM_iblock, 'ID' => $item_id],
            false,
            false,
            ['NAME', 'ID', 'PROPERTY_ICO']
        );
        while ($arTEAM = $obTEAM->GetNext()) {
            if (!empty($arTEAM['PROPERTY_ICO_VALUE'])) {
                $arTEAM['ICO'] = \CFile::GetPath($arTEAM['PROPERTY_ICO_VALUE']);
            } else {
                $arTEAM['ICO'] = SITE_TEMPLATE_PATH . '/img/ico/team_empty.svg';
            }
            $arItem = $arTEAM;
        }

        return $arItem;
    }

    public static function getPlayerByUF($iblock, $prop_code, $item_id)
    {
        $obField = \CUserTypeEntity::GetList([],
            ['FIELD_NAME' => $prop_code, 'ENTITY_ID' => 'IBLOCK_' . $iblock . '_SECTION']);
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
            if (!empty($arTEAM['PROP']['ICO']['VALUE'])) {
                $arTEAM['ICO'] = \CFile::GetPath($arTEAM['PROP']['ICO']['VALUE']);
            }
            $arItem = $arTEAM;
        }

        return $arItem;
    }

    public static function sortArByKeyDate($a, $b)
    {
        if ($a["UF_DATE"] == $b["UF_DATE"]) {
            return 0;
        }
        return (strtotime($a["UF_DATE"]) > strtotime($b["UF_DATE"])) ? -1 : 1;
    }

    /**
     * Вернет найденый элемент события по уникальному коду XML
     * @param $XML_ID - Это ulid
     * @return void
     */
    public static function getEventToXml_id($XML_ID,$iblock = false)
    {
        if($iblock == false)
            $iblock = self::getIdByCode('calendar');
        if (empty($iblock)) {
            return false;
        }

        $obEl = \CIBlockSection::GetList(
            [],
            [ 'IBLOCK_ID' => $iblock, 'XML_ID' => $XML_ID],
            false,
            ['ID','NAME','XML_ID', 'UF_*']
        );
        while ($arEls = $obEl->GetNext()) {
            $arEl = $arEls;
        }

        if (!empty($arEl)) {
            return $arEl;
        } else {
            return false;
        }
    }

    /**
     * Создание события в календаре
     * @param array $arFieldsEvent
     * @return void
     */
    public static function setEvent(array $arFieldsEvent,$iblock = false)
    {
        if($iblock == false)
            $iblock = self::getIdByCode('calendar');
        $arFieldsEvent['IBLOCK_ID'] = $iblock;
        if (empty($arFieldsEvent['IBLOCK_ID'])) {
            return false;
        }

        $obSection = new \CIBlockSection();
        if ($SECTION_ID = $obSection->Add($arFieldsEvent)) {
            return $SECTION_ID;
        } else {
            \_::d($obSection->LAST_ERROR);
        }
    }

    /**
     * Вернет массив данных о Игре
     * @param $xml_id - ulid
     * @return void
     */
    public static function getGameToXml_id($xml_id)
    {

        $iblock = self::getIdByCode('calendar');
        if (empty($iblock)) {
            return false;
        }

        $obEl = \CIBlockElement::GetList(
            [],
            ['ACTIVE' => 'Y', 'IBLOCK_ID' => $iblock, 'XML_ID' => $xml_id],
            false,
            false,
            ['ID']
        );
        while ($arEls = $obEl->GetNext()) {
            $arEl = $arEls;
        }

        if (!empty($arEl)) {
            return $arEl;
        } else {
            return false;
        }
    }

    /**
     * Создаст Игру
     * @param array $arFieldsGame
     * @return void
     */
    public static function setGame(array $arFieldsGame)
    {
        $arFieldsGame['IBLOCK_ID'] = self::getIdByCode('calendar');
        if (empty($arFieldsGame['IBLOCK_ID'])) {
            return false;
        }

        $obEle = new \CIBlockElement();
        if ($elId = $obEle->Add($arFieldsGame)) {
            return $elId;
        } else {
            \_::d($arFieldsGame);
            \_::d($obEle->LAST_ERROR);
        }
    }

    /**
     * Обновим информацию по игре
     * @param $ID
     * @param array $arFieldsGame
     * @return void
     */
    public static function updateGame($ID, array $arFieldsGame)
    {
        $obEle = new \CIBlockElement();
//        if(!empty($arWhatUpdate) && count($arWhatUpdate)>0){
//            $arTmpUpdate = [];
//            foreach ($arWhatUpdate as $strKey) {
//                $arTmpUpdate[$strKey] = $arFieldsGame[$strKey];
//            }
//            $obEle->Update($ID,$arFieldsGame);
//        }else{
            $obEle->Update($ID,$arFieldsGame);
//        }
    }

    /**
     * СОздаст команду
     * @param array $arFields
     * @return void
     */
    public static function setTeam(array $arFields)
    {
        $obEle = new \CIBlockElement();
        if($id = $obEle->Add($arFields)){
            $arFields['ID'] = $id;
            return $arFields;

        }else{
            \_::d($obEle->LAST_ERROR);
            return false;

        }

    }

    public static function getTournamentToXml_id($xml_id)
    {
        $iblock = self::getIdByCode('tournament');
        if (empty($iblock)) {
            return false;
        }

        $obEl = \CIBlockElement::GetList(
            [],
            ['ACTIVE' => 'Y', 'IBLOCK_ID' => $iblock, 'XML_ID' => $xml_id],
            false,
            false,
            ['ID']
        );
        while ($arEls = $obEl->GetNext()) {
            $arEl = $arEls;
        }

        if (!empty($arEl)) {
            return $arEl;
        } else {
            return false;
        }
    }

    public static function setTournament(array $arFieldsGame)
    {
        $arFieldsGame['IBLOCK_ID'] = self::getIdByCode('tournament');
        if (empty($arFieldsGame['IBLOCK_ID'])) {
            return false;
        }

        $obEle = new \CIBlockElement();
        if ($elId = $obEle->Add($arFieldsGame)) {
            return $elId;
        } else {
            \_::d($arFieldsGame);
            \_::d($obEle->LAST_ERROR);
        }
    }
    public static function updateTournament($ID, array $arFields)
    {
        $obEle = new \CIBlockElement();
        $obEle->Update($ID,$arFields);

    }

    /**
     * Вернет ИД значения свойства
     *
     * @param $CODE_PROP
     * @param $XML_ID
     *
     * @return mixed
     */
    public static function getIdEnumListProp($CODE_PROP, $XML_ID, $IBLOCK_ID)
    {

        $property_enums = CIBlockPropertyEnum::GetList(Array("ID" => "ASC", "SORT" => "ASC"),
            Array(
                "IBLOCK_ID" => $IBLOCK_ID,
                "CODE" => $CODE_PROP
            ));
        while ($enum_fields = $property_enums->GetNext()) {
            if ($enum_fields["XML_ID"] == $XML_ID) {
                return $enum_fields["ID"];
            }
        }
    }
    /**
     * Вернет значения свойства Список
     *
     * @param $CODE_PROP
     * @param $XML_ID
     *
     * @return mixed
     */
    public static function getEnumListProp($CODE_PROP, $IBLOCK_ID)
    {

        $property_enums = CIBlockPropertyEnum::GetList(Array("ID" => "ASC", "SORT" => "ASC"),
            Array(
                "IBLOCK_ID" => $IBLOCK_ID,
                "CODE" => $CODE_PROP
            ));
        $arRes = [];
        while ($enum_fields = $property_enums->GetNext()) {
            $arRes[$enum_fields['ID']] = $enum_fields;

        }
        return  $arRes;
    }
    public static function getEnumListProp2Section($CODE_PROP, $IBLOCK_ID)
    {
        global $DB;
        $ob = $DB->Query("SELECT * FROM b_user_field_enum  WHERE USER_FIELD_ID =33 ", false, "FILE: ".__FILE__."<br>LINE: ".__LINE__);
        $arRes = [];
        while ($arTmp = $ob->Fetch()){
            $arRes[$arTmp['XML_ID']] = $arTmp;
        }
        return $arRes;

    }
}