<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global \CMain $APPLICATION */
/** @global \CUser $USER */
/** @global \CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
if (!empty($arResult['ITEMS'])) {
    foreach ($arResult['ITEMS'] as &$arItem) {
        if (!empty($arItem['PROPERTIES']['DATE']['VALUE'])) {
            $obDate = new \Bitrix\Main\Type\DateTime($arItem['PROPERTIES']['DATE']['VALUE']);
            $arItem['FORMAT_DATE'] = $obDate->format($arParams['ACTIVE_DATE_FORMAT']);
            $arItem['FORMAT_DAY'] = $obDate->format('d');
            $arItem['FORMAT_MONTH'] = $obDate->format('m');
            $arItem['FORMAT_TIME'] = $obDate->format('H:i');
        }

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

    }
}

$cp = $this->__component;
if (is_object($cp)) {
    $cp->arResult["NAV_NUM"] = $arResult["NAV_RESULT"]->NavNum;
    $cp->setResultCacheKeys(["NAV_NUM"]);
}