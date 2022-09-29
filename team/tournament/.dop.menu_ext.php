<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksExt = $APPLICATION->IncludeComponent(
    "bitrix:menu.sections",
    "",
    Array(
        "ID" => '',
        "IBLOCK_TYPE" => "teams",
        "IBLOCK_ID" => Module\Project\Helpers\Utils::getIdByCode('tournament'),
        "SECTION_URL" => "/team/tournament/#SECTION_CODE_PATH#/",
        "CACHE_TIME" => "3600"
    )
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>