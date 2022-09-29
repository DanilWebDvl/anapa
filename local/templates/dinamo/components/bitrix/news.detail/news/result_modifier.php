<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global \CMain $APPLICATION */
/** @global \CUser $USER */
/** @global \CDatabase $DB */
/** @var CBitrixComponentTemplate $this */

if (!empty($arResult['PROPERTIES']['DATE']['VALUE'])) {
    $arResult['DATE'] = FormatDate($arParams['ACTIVE_DATE_FORMAT'], MakeTimeStamp($arResult['PROPERTIES']['DATE']['VALUE']));
    $arResult['TIME'] = FormatDate('D, H:i', MakeTimeStamp($arResult['PROPERTIES']['DATE']['VALUE']));
}