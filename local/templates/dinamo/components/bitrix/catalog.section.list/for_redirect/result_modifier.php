<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global \CMain $APPLICATION */
/** @global \CUser $USER */
/** @global \CDatabase $DB */
/** @var CBitrixComponentTemplate $this */

global $APPLICATION;

$cp = $this->__component; // объект компонента

if (is_object($cp))
    $cp->SetResultCacheKeys(array('SECTIONS'));