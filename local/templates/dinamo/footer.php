<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<? global $APPLICATION; ?>
<section class="partners_place def_pt b_waves">
    <div class="container_ui">
        <h2 class="title_block mb100">Наши партнеры и спонсоры</h2>
        <div class="flex partners_list">
            <div class="part">
                <img src="<?=SITE_TEMPLATE_PATH ?>/img/vol1.svg" alt="">
            </div>
            <div class="part">
                <img src="<?=SITE_TEMPLATE_PATH ?>/img/vol2.svg" alt="">
            </div>
            <div class="part">
                <img src="<?=SITE_TEMPLATE_PATH ?>/img/vol3.svg" alt="">
            </div>
            <div class="part">
                <img src="<?=SITE_TEMPLATE_PATH ?>/img/vol4.svg" alt="">
            </div>
        </div>
    </div>
</section>
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
            <p>Краснодарский край, г. Анапа, просп. Южный, д. 5</p>
        </div>
        <div class="part">
            <p>© Женский волейбольный клуб «Динамо», Анапа, <?=date('Y') ?></p>
        </div>
        <div class="part">
            <p><a href="tel:+70000000000">+7 (000) 000-00-00</a> | <a href="mailto:mail@at.ru">mail@at.ru</a></p>
        </div>
    </div>
</footer>
</body>
</html>