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
                if (empty($arResult['TEAMS'][$arItem['PROPERTIES']['TEAM_H']['VALUE']]))
                    $arResult['TEAMS'][$arItem['PROPERTIES']['TEAM_H']['VALUE']] = \Module\Project\Helpers\Utils::getTeamByProp($arParams['IBLOCK_ID'], $arItem['PROPERTIES']['TEAM_H']['ID'], $arItem['PROPERTIES']['TEAM_H']['VALUE']);

                $arItem['TEAM_H'] = $arResult['TEAMS'][$arItem['PROPERTIES']['TEAM_H']['VALUE']];
            }
            if (!empty($arItem['PROPERTIES']['TEAM_G']['VALUE'])) {

                if (empty($arResult['TEAMS'][$arItem['PROPERTIES']['TEAM_G']['VALUE']]))
                    $arResult['TEAMS'][$arItem['PROPERTIES']['TEAM_G']['VALUE']] = \Module\Project\Helpers\Utils::getTeamByProp($arParams['IBLOCK_ID'], $arItem['PROPERTIES']['TEAM_G']['ID'], $arItem['PROPERTIES']['TEAM_G']['VALUE']);

                $arItem['TEAM_G'] = $arResult['TEAMS'][$arItem['PROPERTIES']['TEAM_G']['VALUE']];
            }

            $arItem['PROPERTIES']['DATE']['DAY'] = $month[0][0];
            $arResult['MONTHS'][(int)$month[0][1]][] = $arItem;
        }
    }
}
ksort($arResult['MONTHS']);