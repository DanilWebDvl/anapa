<?php
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Error;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

/**
 * @var $APPLICATION CMain
 */

Loc::loadMessages(__FILE__);

class LastSeason extends \CBitrixComponent
{
    public $section_id;
    public $errors;

    public function onPrepareComponentParams($arParams)
    {
        $this->arParams = $arParams;

        $this->errors = new \Bitrix\Main\ErrorCollection();
        if (empty($this->arParams["IBLOCK_ID"]) || (int)$this->arParams["IBLOCK_ID"] <= 0)
            $this->errors->setError(new Error('Need iblock id'));
        if (empty($this->arParams["TEMPLATE_NAME"]))
            $this->errors->setError(new Error('Need template name'));

        if ($this->errors->isEmpty())
            $this->getLastSection();

        return $arParams;
    }

    public function getLastSection()
    {
        $obSection = CIBlockSection::GetList(
            ['UF_FINAL_DATE_SEASON' => 'DESC'],
            ['ACTIVE' => 'Y', 'IBLOCK_ID' => $this->arParams["IBLOCK_ID"]],
            false,
            ['*', 'UF_*'],
            ['nTopCount' => 1]
        );

        while ($arSection = $obSection->GetNext()) {
            $this->section_id = $arSection['ID'];
            $this->section = $arSection;
        }
        if (empty($this->section_id))
            $this->errors->setError(new Error('Section date is empty'));
    }

    protected function makeFilterItems() {
        /* Получаем последнюю сыгранную игру */
        $arFilter = [
            "IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
            "ACTIVE" => "Y",
            "!PROPERTY_SCORE" => false
        ];
        $obEl = CIblockElement::GetList(
            ["PROPERTY_DATE" => "DESC"],
            $arFilter,
            false,
            ['nTopCount' => 1],
            ['PROPERTY_DATE', 'ID']
        );
        while ($arEl = $obEl->GetNext()) {
            $date = $arEl['PROPERTY_DATE_VALUE'];
        }
            /* -Получаем последнюю сыгранную игру- */

        /* Забираем id игр ближайших к последней */
        $obDate = new DateTime($date);
        $arFilter = [
            "IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
            "ACTIVE" => "Y",
            "<=PROPERTY_DATE" => $obDate->format('Y-m-d H:i:s')
        ];
        $count = round($this->arParams["NEWS_COUNT"] / 2);
        $obEl = CIblockElement::GetList(
            ["PROPERTY_DATE" => "DESC"],
            $arFilter,
            false,
            ['nTopCount' => $count ?: 5],
            ['ID']
        );
        while ($arEl = $obEl->GetNext()) {
            $arId[] = $arEl['ID']; // Прошедшие игры
        }
        unset($arFilter['<=PROPERTY_DATE']);
        $arFilter['>PROPERTY_DATE'] = $obDate->format('Y-m-d H:i:s');
        $obEl = CIblockElement::GetList(
            ["PROPERTY_DATE" => "ASC"],
            $arFilter,
            false,
            ['nTopCount' => $count ? $count - 1 : 4],
            ['ID']
        );
        while ($arEl = $obEl->GetNext()) {
            $arId[] = $arEl['ID']; // Прошедшие игры
            $a[] = $arEl['ID'];
        }
        sort($arId);
        /* -Забираем id игр ближайших к последней- */

        if (!empty($arId))
            $GLOBALS['customFilter'] = ['ID' => $arId];
    }

    public function executeComponent()
    {
        if (!$this->errors->isEmpty()) {
            foreach ($this->errors as $error)
            {
                ShowError($error);
            }
            return false;
        }
        global $APPLICATION;

        if ($this->arParams['NEAR_CUR_DATE'] == 'Y') {
            $this->makeFilterItems();
        }

        $APPLICATION->IncludeComponent(
    "bitrix:news.list",
            $this->arParams["TEMPLATE_NAME"],
            Array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "ADD_SECTIONS_CHAIN" => "N",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "N",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "N",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => array("", ""),
                "FILTER_NAME" => $this->arParams['NEAR_CUR_DATE'] == 'Y' ? "customFilter" : "",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
                "IBLOCK_TYPE" => $this->arParams["IBLOCK_TYPE"],
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "Y",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => $this->arParams["NEWS_COUNT"] ?: "20",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => $this->arParams["PAGER_SHOW_ALL"] ?: "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => $this->arParams["PAGER_TITLE"] ?: "",
                "PARENT_SECTION" => $this->section_id,
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array("*"),
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => $this->arParams["SORT_BY"] ?: "SORT",
                "SORT_BY2" => "ID",
                "SORT_ORDER1" => $this->arParams["SORT_ORDER"] ?: "DESC",
                "SORT_ORDER2" => "ASC",
                "STRICT_SECTION_CHECK" => "N",
                "PAGER_LINK" => $this->arParams["PAGER_LINK"] ?: "",
                "TITLE_BLOCK" => $this->arParams["TITLE_BLOCK"] ?: "",
                "TITLE_BLOCK_2" => $this->arParams["TITLE_BLOCK_2"] ?: "",
                "SECTION" => $this->section
            )
        );
    }
}