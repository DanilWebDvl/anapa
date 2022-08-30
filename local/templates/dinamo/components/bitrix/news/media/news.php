<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
include 'filter.php';
?>
<section class="page_interviews_place def_pt_page">
    <div class="container_ui">
        <div class="flex flex-between">
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "like_filter",
                Array(
                    "ROOT_MENU_TYPE" => "left",
                    "MAX_LEVEL" => "1",
                    "CHILD_MENU_TYPE" => "",
                    "USE_EXT" => "Y"
                )
            );
            ?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:catalog.section.list",
                "filter_date",
                Array(
                    "ADD_SECTIONS_CHAIN" => "N",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "COUNT_ELEMENTS" => "N",
                    "COUNT_ELEMENTS_FILTER" => "",
                    "FILTER_NAME" => '',
                    "IBLOCK_ID" => $arParams['IBLOCK_ID'],
                    "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
                    "SECTION_CODE" => "",
                    "SECTION_FIELDS" => array("", ""),
                    "SECTION_ID" => "",
                    "SECTION_URL" => "",
                    "SECTION_USER_FIELDS" => array("", "UF_DATE"),
                    "SHOW_PARENT_NAME" => "Y",
                    "TOP_DEPTH" => "1",
                    "VIEW_MODE" => "LINE"
                )
            );?>
        </div>
        <?$APPLICATION->IncludeComponent(
            "bitrix:catalog.section.list",
            "list_album",
            Array(
                "ADD_SECTIONS_CHAIN" => "N",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "COUNT_ELEMENTS" => "Y",
                "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
                "FILTER_NAME" => $arParams['FILTER_NAME'],
                "IBLOCK_ID" => $arParams['IBLOCK_ID'],
                "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
                "SECTION_CODE" => "",
                "SECTION_FIELDS" => array("", ""),
                "SECTION_ID" => "",
                "SECTION_URL" => "",
                "SECTION_USER_FIELDS" => array("", "UF_DATE"),
                "SHOW_PARENT_NAME" => "Y",
                "TOP_DEPTH" => "1",
                "VIEW_MODE" => "LINE"
            )
        );?>
    </div>
</section>