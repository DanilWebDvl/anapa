<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<? global $APPLICATION; ?>
</main>
<?
global $arrFilterSponsors;
$arrFilterSponsors['PROPERTY_SHOW_BOT_VALUE'] = 'Да';
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "sponsors_bot",
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
        "FILTER_NAME" => "arrFilterSponsors",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => Module\Project\Helpers\Utils::getIdByCode('sponsors'),
        "IBLOCK_TYPE" => "public",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "Y",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "20",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => ".default",
        "PAGER_TITLE" => "",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array("ICO", "*"),
        "SET_BROWSER_TITLE" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "N",
        "SHOW_404" => "N",
        "SORT_BY1" => "SORT",
        "SORT_BY2" => "ID",
        "SORT_ORDER1" => "ASC",
        "SORT_ORDER2" => "ASC",
        "STRICT_SECTION_CHECK" => "N"
    )
);?>
<footer>
    <div class="menu_b def_pb_b">
        <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "bot_menu",
            Array(
                "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "left",
                "DELAY" => "N",
                "MAX_LEVEL" => "1",
                "MENU_CACHE_GET_VARS" => array(""),
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_TYPE" => "A",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "ROOT_MENU_TYPE" => "bottom",
                "USE_EXT" => "N"
            )
        );?>
    </div>
    <div class="flex flex-center flex-a-center soc_b def_pb_b">
        <?
        $vk = \Bitrix\Main\Config\Option::get(MODULE_SITE, 'SOCIAL_VK');
        if (!empty($vk)):
        ?>
            <div class="part">
                <a href="<?=$vk ?>" target="_blank"><img src="<?=SITE_TEMPLATE_PATH ?>/img/ico/vk.svg" alt=""></a>
            </div>
        <? endif ?>
        <?
        $telega = \Bitrix\Main\Config\Option::get(MODULE_SITE, 'SOCIAL_TELEGA');
        if (!empty($telega)):
        ?>
            <div class="part">
                <a href="<?=$telega ?>" target="_blank"><img src="<?=SITE_TEMPLATE_PATH ?>/img/ico/teleg.svg" alt=""></a>
            </div>
        <? endif ?>
        <?
        $youtube = \Bitrix\Main\Config\Option::get(MODULE_SITE, 'SOCIAL_YOUTUBE');
        if (!empty($youtube)):
        ?>
            <div class="part">
                <a href="<?=$youtube ?>" target="_blank"><img src="<?=SITE_TEMPLATE_PATH ?>/img/ico/insta.svg" alt=""></a>
            </div>
        <? endif ?>
    </div>
    <div class="flex desc_b">
        <div class="part">
            <?
            $FOOTER_1 = \Bitrix\Main\Config\Option::get(MODULE_SITE, 'FOOTER_1');
            if (!empty($FOOTER_1)): ?>
                <p><?=$FOOTER_1 ?></p>
            <? endif ?>
        </div>
        <div class="part">
            <?
            $FOOTER_2 = \Bitrix\Main\Config\Option::get(MODULE_SITE, 'FOOTER_2');
            if (!empty($FOOTER_2)): ?>
                <p><?=$FOOTER_2 ?><?=date('Y') ?></p>
            <? endif ?>
        </div>
        <div class="part">
            <p>
                <?
                $phone = \Bitrix\Main\Config\Option::get(MODULE_SITE, 'FOOTER_PHONE');
                if (!empty($phone)): ?>
                    <a href="tel:<?=$phone ?>"><?=$phone ?></a>
                <? endif ?>
                <?
                $email = \Bitrix\Main\Config\Option::get(MODULE_SITE, 'FOOTER_EMAIL');
                if (!empty($email)): ?>
                    | <a href="mailto:<?=$email ?>"><?=$email ?></a>
                <? endif ?>


            </p>
        </div>
    </div>
</footer>
</body>
</html>