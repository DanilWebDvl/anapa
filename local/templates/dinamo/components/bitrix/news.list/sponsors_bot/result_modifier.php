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
        if (!empty($arItem['PROPERTIES']['ICO_BOT']['VALUE'])) {
            $arItem['ICO'] = CFile::GetPath($arItem['PROPERTIES']['ICO_BOT']['VALUE']);
        } elseif (!empty($arItem['PROPERTIES']['ICO']['VALUE'])) {
            $arItem['ICO'] = CFile::GetPath($arItem['PROPERTIES']['ICO']['VALUE']);
        }
    }
}