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
        }
        if (!empty($arItem['PREVIEW_PICTURE'])) {
            $arItem['PREVIEW_PICTURE']['RESIZE'] = $arItem['PREVIEW_PICTURE']['SRC'];
        }
        if (!empty($arItem['PREVIEW_TEXT']))
            $arItem['FORMAT_PREVIEW_TEXT'] = TruncateText($arItem['PREVIEW_TEXT'], 49);
    }
}
$cp = $this->__component;
if (is_object($cp)) {
    $cp->arResult["NAV_NUM"] = $arResult["NAV_RESULT"]->NavNum;
    $cp->setResultCacheKeys(["NAV_NUM"]);
}