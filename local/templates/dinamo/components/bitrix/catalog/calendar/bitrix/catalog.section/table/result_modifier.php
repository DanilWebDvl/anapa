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
        $dateString = $arItem['PROPERTIES']['DATE']['VALUE'];
        list($day, $month, $year) = explode('.', $dateString);
        preg_match_all('/[0-32]./', $arItem['PROPERTIES']['DATE']['VALUE'], $month);


// Преобразуем значения в числа (если это необходимо)
        $arItem['day'] = (int)$day;
        $arItem['month'] = (int)$month;
        $arItem['year'] = (int)$year;



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
            $arResult['MONTHS'][(int)$month[0][1].'_' . $arItem['year']][] = $arItem;
            //$arResult['YEAR'][$arItem['YEAR']][] = $arItem;

        }
    }
}
ksort($arResult['MONTHS']);