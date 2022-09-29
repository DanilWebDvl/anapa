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
        unset($obDate);
        if (!empty($arItem['PROPERTIES']['DATE']['VALUE'])) {
            $obDate = new \Bitrix\Main\Type\DateTime($arItem['PROPERTIES']['DATE']['VALUE']);
            $arResult['FILTER']['YEAR'][$obDate->format('Y')] = $obDate->format('Y');
            $arResult['FILTER']['MONTH'][$obDate->format('m')] = \Module\Project\Helpers\Utils::getNameMothByNum($obDate->format('m'));
        }
    }
}
if (!empty($arResult['FILTER']['YEAR'])) {
    krsort($arResult['FILTER']['YEAR']);
}
if (!empty($arResult['FILTER']['MONTH'])) {
    ksort($arResult['FILTER']['MONTH']);
}