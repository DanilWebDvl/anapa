<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksExt = $APPLICATION->IncludeComponent(
    "bitrix:menu.sections",
    "",
    Array(
        "ID" => '',
        "IBLOCK_TYPE" => "news",
        "IBLOCK_ID" => Module\Project\Helpers\Utils::getIdByCode('articles'),
        "SECTION_URL" => "/news/#SECTION_CODE_PATH#/",
        "CACHE_TIME" => "3600"
    )
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>