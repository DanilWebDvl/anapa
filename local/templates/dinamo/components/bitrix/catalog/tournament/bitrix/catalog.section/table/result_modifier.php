<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global \CMain $APPLICATION */
/** @global \CUser $USER */
/** @global \CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
if (!empty($arResult['ITEMS'])) {
    foreach ($arResult['ITEMS'] as $arItem) {

        if (!empty($arItem['PROPERTIES']['TEAM']['VALUE'])) {
            if (empty($arResult['TEAMS'][$arItem['PROPERTIES']['TEAM']['VALUE']])) {
                if (empty($arTEAM_prop)) {
                    $obTEAM_prop = CIBlockProperty::GetByID($arItem['PROPERTIES']['TEAM']['ID'], $arParams['IBLOCK_ID']);
                    if($arTEAM_prop = $obTEAM_prop->GetNext()) {
                        $arTEAM_iblock = $arTEAM_prop['LINK_IBLOCK_ID'];
                    }
                }

                $obTEAM = CIBlockElement::GetList(
                    [],
                    ['IBLOCK_ID' => $arTEAM_iblock, 'ID' => $arItem['PROPERTIES']['TEAM']['VALUE']],
                    false,
                    false,
                    ['NAME', 'ID', 'PROPERTY_ICO']
                );
                while ($arTEAM = $obTEAM->GetNext()) {
                    if (!empty($arTEAM['PROPERTY_ICO_VALUE']))
                        $arTEAM['ICO'] = CFile::GetPath($arTEAM['PROPERTY_ICO_VALUE']);
                    $arResult['TEAMS'][$arTEAM['ID']] = $arTEAM;
                }
            }

            $arItem['TEAM'] = $arResult['TEAMS'][$arItem['PROPERTIES']['TEAM']['VALUE']];
        }

        $arResult['ITEMS_REFORMAT'][$arItem['PROPERTIES']['PLACE']['VALUE']] = $arItem;
    }
    ksort($arResult['ITEMS_REFORMAT']);
}