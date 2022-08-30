<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global \CMain $APPLICATION */
/** @global \CUser $USER */
/** @global \CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
if (!empty($arResult['SECTIONS'])) {
    foreach ($arResult['SECTIONS'] as $arItem) {
        unset($obDate);
        if (!empty($arItem['UF_DATE'])) {
            $obDate = new \Bitrix\Main\Type\DateTime($arItem['UF_DATE']);
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