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
        unset($month);
        preg_match_all('/[0-32]./', $arItem['PROPERTIES']['DATE']['VALUE'], $month);
        if (!empty($month[0][1])) {

            if (!empty($arItem['PROPERTIES']['TEAM_H']['VALUE'])) {

                if (empty($arResult['TEAMS'][$arItem['PROPERTIES']['TEAM_H']['VALUE']])) {
                    if (empty($arTEAM_H_prop)) {
                        $obTEAM_H_prop = CIBlockProperty::GetByID($arItem['PROPERTIES']['TEAM_H']['ID'], $arParams['IBLOCK_ID']);
                        if($arTEAM_H_prop = $obTEAM_H_prop->GetNext()) {
                            $arTEAM_H_iblock = $arTEAM_H_prop['LINK_IBLOCK_ID'];
                        }
                    }

                    $obTEAM_H = CIBlockElement::GetList(
                        [],
                        ['IBLOCK_ID' => $arTEAM_H_iblock, 'ID' => $arItem['PROPERTIES']['TEAM_H']['VALUE']],
                        false,
                        false,
                        ['NAME', 'ID', 'PROPERTY_ICO']
                    );
                    while ($arTEAM_H = $obTEAM_H->GetNext()) {
                        if (!empty($arTEAM_H['PROPERTY_ICO_VALUE']))
                            $arTEAM_H['ICO'] = CFile::GetPath($arTEAM_H['PROPERTY_ICO_VALUE']);
                        $arResult['TEAMS'][$arTEAM_H['ID']] = $arTEAM_H;
                    }
                }

                $arItem['TEAM_H'] = $arResult['TEAMS'][$arItem['PROPERTIES']['TEAM_H']['VALUE']];

            }
            if (!empty($arItem['PROPERTIES']['TEAM_G']['VALUE'])) {

                if (empty($arResult['TEAMS'][$arItem['PROPERTIES']['TEAM_G']['VALUE']])) {

                    if (empty($arTEAM_G_prop)) {
                        $obTEAM_G_prop = CIBlockProperty::GetByID($arItem['PROPERTIES']['TEAM_G']['ID'], $arParams['IBLOCK_ID']);
                        if($arTEAM_G_prop = $obTEAM_G_prop->GetNext()) {
                            $arTEAM_G_iblock = $arTEAM_G_prop['LINK_IBLOCK_ID'];
                        }
                    }
                    $obTEAM_G = CIBlockElement::GetList(
                        [],
                        ['IBLOCK_ID' => $arTEAM_G_iblock, 'ID' => $arItem['PROPERTIES']['TEAM_G']['VALUE']],
                        false,
                        false,
                        ['NAME', 'ID', 'PROPERTY_ICO']
                    );
                    while ($arTEAM_G = $obTEAM_G->GetNext()) {
                        if (!empty($arTEAM_G['PROPERTY_ICO_VALUE']))
                            $arTEAM_G['ICO'] = CFile::GetPath($arTEAM_G['PROPERTY_ICO_VALUE']);
                        $arResult['TEAMS'][$arTEAM_G['ID']] = $arTEAM_G;
                    }

                }

                $arItem['TEAM_G'] = $arResult['TEAMS'][$arItem['PROPERTIES']['TEAM_G']['VALUE']];
            }

            $arItem['PROPERTIES']['DATE']['DAY'] = $month[0][0];
            $arResult['MONTHS'][$month[0][1]][] = $arItem;
        }
    }
}