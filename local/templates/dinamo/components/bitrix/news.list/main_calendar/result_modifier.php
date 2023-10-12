<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global \CMain $APPLICATION */
/** @global \CUser $USER */
/** @global \CDatabase $DB */
/** @var CBitrixComponentTemplate $this */

if (!empty($arResult['ITEMS'])) {

    $obDateNow = new \Bitrix\Main\Type\DateTime();

    foreach ($arResult['ITEMS'] as &$arItem) {

        if (!empty($arItem['PROPERTIES']['DATE']['VALUE'])) {
            $obDate = new \Bitrix\Main\Type\DateTime($arItem['PROPERTIES']['DATE']['VALUE']);

            if ($obDate->getTimestamp() < $obDateNow->getTimestamp()) {
                $arItem['PREV'] = 'Y';
            }
//            $arItem['MONTH'] = Module\Project\Helpers\Utils::getNameMothByNum($obDate->format('m'));
            $arItem['TIME'] = $obDate->format('H:i');
//            $arItem['DAY'] = $obDate->format('d');
            $arItem['DATE'] = $obDate->format('d.m');
        }

        if (!empty($arItem['PROPERTIES']['PLACE']['VALUE'])) {
            $arPlace = explode('тур ', $arItem['PROPERTIES']['PLACE']['VALUE']);
			$arItem['CITY'] ??= $arPlace[1] ?? '';
			$arItem['TOUR'] ??= $arPlace[0] ?? '';

			$arItem['CITY'] = $arItem['CITY'] ?: $arItem['PROPERTIES']['PLACE']['VALUE'];
			$arItem['TOUR'] = $arItem['TOUR'] ?: $arItem['PROPERTIES']['STAGE']['VALUE'];
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