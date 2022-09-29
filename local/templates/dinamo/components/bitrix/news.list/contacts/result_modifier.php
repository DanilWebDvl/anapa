<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global \CMain $APPLICATION */
/** @global \CUser $USER */
/** @global \CDatabase $DB */
/** @var CBitrixComponentTemplate $this */

if (!empty($arResult['ITEMS'])) {
    foreach ($arResult['ITEMS'] as $key => $arItem) {

        if (!empty($arItem['PROPERTIES']['MAP']['VALUE'])) {
            $arResult['MAP'] = $arItem;
            unset($arResult['ITEMS'][$key]);
        }

    }
}