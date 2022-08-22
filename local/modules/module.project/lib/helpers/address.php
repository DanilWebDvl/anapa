<?

namespace Module\Project\Helpers;

use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Loader;

class Address
{


    public static function getSections($sectionId, $iblockID)
    {
        $arFields = array();
        $iblockID = 8;
        if (!empty($iblockID)) {
            $arSelect = array("ID", "NAME", "DATE_ACTIVE_FROM");
            $arFilter = array("IBLOCK_ID" => $iblockID, "SECTION_ID" => $sectionId, "ACTIVE" => "Y");
            $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 99), $arSelect);
            $z=1;
            while ($ob = $res->GetNextElement()) {
                $arFields[$z] = $ob->GetFields();
            $z++;
            }
            return (!empty($arFields)) ? $arFields : false;
        } else {
            return false;
        }
    }

    public static function getCoords($sectionId, $iblockID)
    {
        self::checkModules();
        $arGardens = array();


        if (!empty($sectionId)) {
            $arSelect = array("ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_COORDS");
            $arFilter = array("IBLOCK_ID" => $iblockID, "SECTION_ID" => $sectionId, "ACTIVE" => "Y");
            $res = \CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 99), $arSelect);
            $z=1;
            while ($ob = $res->GetNextElement()) {
                $arGarden = array();
                $arFields = $ob->GetFields();
                $arGarden["x"] = explode(",", $arFields["PROPERTY_COORDS_VALUE"])[0];
                $arGarden["y"] = explode(",", $arFields["PROPERTY_COORDS_VALUE"])[1];
                $arGarden["titleGarden"] = $arFields["NAME"];
                $arGarden["idGarden"] = $arFields["ID"];
                $popup=self::getPopupElements($arFields["ID"], $iblockID);
                    if(!empty($popup)){
                        $arGarden["popup"] = $popup;
                    }

                $arGardens[$z] = $arGarden;
                $z++;
            }
            return (!empty($arGardens)) ? $arGardens : false;
        } else {
            return false;
        }

    }

    public static function getPopupElements($elementID, $iblockID)
    {
        self::checkModules();
        $rez = array();
        $arSelect = array("ID", "NAME", "PREVIEW_PICTURE", "PROPERTY_ADRESS", "PROPERTY_PHONE", "PROPERTY_EMAIL", "DETAIL_PAGE_URL");
        $arFilter = array("IBLOCK_ID" => 5, "PROPERTY_COORDINATS" => $elementID, "ACTIVE" => "Y");
        $res = \CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 99), $arSelect);
        if ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            if ($arFields["PREVIEW_PICTURE"]) {
                $arFields["PREVIEW_PICTURE"] = \CFile::GetPath($arFields["PREVIEW_PICTURE"]);
            }
            $rez['id'] = $arFields["ID"];
            $rez['title'] = $arFields["NAME"];
            $rez['tel'] =  (array)$arFields["PROPERTY_PHONE_VALUE"];
            $rez['email'] = $arFields["PROPERTY_EMAIL_VALUE"];
            $rez['address'] = $arFields["PROPERTY_ADRESS_VALUE"]["TEXT"];
            $rez['img'] = 'https://dolinka.gornica.softmonster.ru/' . $arFields["PREVIEW_PICTURE"];
            $rez['link'] = $arFields["DETAIL_PAGE_URL"];
        }

        return $rez;


    }

    public static function getTree($iblockId)
    {

        self::checkModules();
        $arFilter = array(
            'ACTIVE' => 'Y',
            'IBLOCK_ID' => $iblockId,
            'GLOBAL_ACTIVE' => 'Y',
        );
        $arSelect = array('IBLOCK_ID', 'ID', 'NAME', 'DEPTH_LEVEL', 'IBLOCK_SECTION_ID', 'DEPTH_LEVEL', 'UF_INFO_TITLE_VALUE');
        $arOrder = array('DEPTH_LEVEL' => 'ASC', 'SORT' => 'ASC');
        $rsSections = \CIBlockSection::GetList($arOrder, $arFilter, true, $arSelect);
        $sectionLinc = array();
        $arResult = array();
        $sectionLinc[0] = &$arResult;
        while ($arSection = $rsSections->GetNext()) {
            $rez['id'] = $arSection["ID"];
            $rez['title'] = $arSection["NAME"];
            $rez['depthLvl'] = $arSection["DEPTH_LEVEL"];
            $rez['infoTitle'] = $arSection["UF_INFO_TITLE_VALUE"];
            $coords = self::getCoords($arSection["ID"], $iblockId);


            $sectionLinc[intval($arSection['IBLOCK_SECTION_ID'])]['data'][$arSection['ID']] = $rez;
            if (empty($sectionLinc[intval($arSection['IBLOCK_SECTION_ID'])]['data'][$arSection['ID']]['data'])) {
                if (!empty($coords)) {
                    $sectionLinc[intval($arSection['IBLOCK_SECTION_ID'])]['data'][$arSection['ID']]['data'] =  (array) $coords;
                }
            }
            $sectionLinc[$arSection['ID']] = &$sectionLinc[intval($arSection['IBLOCK_SECTION_ID'])]['data'][$arSection['ID']];

        }
        unset($sectionLinc);
        return $arResult['data'];
    }

    protected function checkModules()
    {
        if (!Loader::includeModule('highloadblock')) {
            throw new Main\LoaderException('not install module highloadblock');
        };
        if (!Loader::includeModule('iblock')) {
            throw new Main\LoaderException('not install module highloadblock');
        };
    }
}