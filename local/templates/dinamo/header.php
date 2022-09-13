<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
global $USER, $APPLICATION;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?= LANGUAGE_ID ?>" lang="<?= LANGUAGE_ID ?>">
<head>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<?
    $asset = Bitrix\Main\Page\Asset::getInstance();
    $asset->addCss(SITE_TEMPLATE_PATH . '/css/main.css');
    $asset->addCss(SITE_TEMPLATE_PATH . '/css/custom.css');
    $asset->addCss(SITE_TEMPLATE_PATH . '/css/media.css');
    $asset->addCss(SITE_TEMPLATE_PATH . '/vendor/slick/slick.css');
    $asset->addCss(SITE_TEMPLATE_PATH . '/vendor/owlcarousel/owl.carousel.min.css');
    $asset->addCss(SITE_TEMPLATE_PATH . '/vendor/fancybox/jquery.fancybox.min.css');

    $asset->addJs(SITE_TEMPLATE_PATH . '/vendor/jquery-2.1.3.min.js');
    $asset->addJs(SITE_TEMPLATE_PATH . '/js/main.js');
    $asset->addJs(SITE_TEMPLATE_PATH . '/js/custom.js');
    $asset->addJs(SITE_TEMPLATE_PATH . '/vendor/slick/slick.min.js');
    $asset->addJs(SITE_TEMPLATE_PATH . '/vendor/owlcarousel/owl.carousel.min.js');
    $asset->addJs(SITE_TEMPLATE_PATH . '/vendor/fancybox/jquery.fancybox.min.js');
    ?>
    <title><?$APPLICATION->ShowTitle()?></title>
    <?$APPLICATION->ShowHead();?>
</head>
<?
$is_main_page = ($APPLICATION->GetCurPage() == '/') ? true : false;
?>
<body class="<?=$is_main_page ?:'other_page' ?>">
<header>
    <div class="sb_share"></div>
    <div class="container_ui">
        <div class="flex flex-between">
            <div class="logo_place">
                <a href="/"><? include $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH. '/img/ico/Logo.svg'?></a>
            </div>
            <div class="soc_t flex flex-a-center mob_hide">
                <?
                $vk = \Bitrix\Main\Config\Option::get(MODULE_SITE, 'SOCIAL_VK');
                if (!empty($vk)):
                ?>
                    <a class="part" href="<?=$vk ?>" target="_blank">
                        <svg class="soc_ico" width="33" height="20" viewBox="0 0 33 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M28.1665 12.7169C29.2521 13.8615 30.3979 14.9383 31.3716 16.1983C31.8017 16.7583 32.2089 17.336 32.5204 17.9858C32.9618 18.9095 32.562 19.926 31.795 19.9812L27.0272 19.9789C25.7975 20.0891 24.8165 19.5545 23.9917 18.6465C23.3316 17.9205 22.7203 17.1477 22.0855 16.3971C21.8253 16.0903 21.553 15.8017 21.2276 15.5735C20.5767 15.1173 20.0118 15.257 19.6398 15.99C19.261 16.7356 19.1751 17.5612 19.1379 18.3921C19.0868 19.6045 18.7474 19.9233 17.6197 19.9788C15.2096 20.1015 12.9222 19.7077 10.7973 18.3948C8.92399 17.2373 7.47129 15.6034 6.20686 13.7535C3.745 10.1514 1.85971 6.19334 0.165284 2.12436C-0.216119 1.20762 0.0628095 0.715514 0.999488 0.698096C2.55488 0.665467 4.11006 0.66779 5.66729 0.695774C6.29944 0.70576 6.71794 1.09731 6.96203 1.74222C7.80355 3.97666 8.83324 6.10253 10.1257 8.07304C10.4699 8.59766 10.8209 9.12227 11.3207 9.49153C11.8736 9.90037 12.2946 9.76487 12.5547 9.09975C12.7197 8.67801 12.792 8.22376 12.8292 7.77206C12.9524 6.21807 12.9687 4.66675 12.7525 3.11821C12.6198 2.15177 12.1158 1.52613 11.2227 1.34324C10.767 1.25 10.8349 1.06688 11.0555 0.785997C11.4388 0.301557 11.7992 0 12.5177 0H17.906C18.7543 0.180794 18.9427 0.592313 19.0588 1.51405L19.0635 7.97748C19.0542 8.3343 19.2285 9.39317 19.8237 9.62936C20.3 9.79749 20.614 9.38598 20.8998 9.0598C22.19 7.58117 23.1107 5.83372 23.9333 4.02427C24.2984 3.22864 24.6122 2.40235 24.9164 1.57675C25.1418 0.964121 25.4955 0.66268 26.1345 0.676033L31.3205 0.681026C31.4743 0.681026 31.6299 0.683465 31.7788 0.710985C32.6527 0.871807 32.8921 1.27775 32.6222 2.19926C32.197 3.64503 31.3695 4.84986 30.5605 6.06027C29.6956 7.35253 28.7707 8.60056 27.913 9.90049C27.1251 11.0876 27.1877 11.6859 28.1665 12.7169Z" fill="#3066BF"/>
                        </svg>
                    </a>
                <? endif ?>
                <?
                $telega = \Bitrix\Main\Config\Option::get(MODULE_SITE, 'SOCIAL_TELEGA');
                if (!empty($telega)):
                ?>
                    <a class="part" href="<?=$telega ?>" target="_blank">
                        <svg class="soc_ico" width="26" height="22" viewBox="0 0 26 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.2022 14.2798L9.77209 20.3291C10.3874 20.3291 10.6539 20.0648 10.9735 19.7473L13.8585 16.9903L19.8365 21.368C20.9329 21.979 21.7053 21.6572 22.0011 20.3594L25.925 1.97318L25.9261 1.9721C26.2738 0.351437 25.34 -0.282309 24.2718 0.115272L1.20705 8.94548C-0.367066 9.55647 -0.343232 10.434 0.939465 10.8316L6.83619 12.6656L20.5331 4.09542C21.1777 3.66859 21.7638 3.90475 21.2817 4.33158L10.2022 14.2798Z" fill="#3066BF"/>
                        </svg>
                    </a>
                <? endif ?>
                <?
                $youtube = \Bitrix\Main\Config\Option::get(MODULE_SITE, 'SOCIAL_YOUTUBE');
                if (!empty($youtube)):
                ?>
                    <a class="part" href="<?=$youtube ?>" target="_blank">
                        <svg class="soc_ico" width="27" height="20" viewBox="0 0 27 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M26.1172 3.12952C25.8099 1.90578 24.9092 0.941123 23.767 0.611608C21.6802 0 13.333 0 13.333 0C13.333 0 4.98618 0 2.89942 0.58842C1.77914 0.917586 0.856447 1.90596 0.549155 3.12952C0 5.36465 0 10 0 10C0 10 0 14.6587 0.549155 16.8705C0.856772 18.094 1.75716 19.0587 2.89958 19.3882C5.00815 20 13.3334 20 13.3334 20C13.3334 20 21.6802 20 23.767 19.4116C24.9094 19.0822 25.8099 18.1176 26.1176 16.894C26.6666 14.6587 26.6666 10.0235 26.6666 10.0235C26.6666 10.0235 26.6885 5.36465 26.1172 3.12952ZM10.6755 14.2823V5.7177L17.6166 10L10.6755 14.2823Z" fill="#3066BF"/>
                        </svg>
                    </a>
                <? endif ?>
            </div>
            <div class="menu_t flex flex-a-center mob_hide">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "top_menu",
                    Array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "left",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => array(""),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "top",
                        "USE_EXT" => "N"
                    )
                );?>
            </div>

            <div class="js_menu burger_place flex flex-a-center">
                <div class="burger ">
                    <? include $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH. '/img/ico/burger.svg'?>
                    <? include $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH .'/img/ico/close.svg'?>
                </div>
            </div>
        </div>
    </div>
</header>
<?$APPLICATION->ShowPanel()?>
<div class="mega_menu">
    <div class="menu_place">
        <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "mega_menu",
            Array(
                "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "left",
                "DELAY" => "N",
                "MAX_LEVEL" => "2",
                "MENU_CACHE_GET_VARS" => array(""),
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_TYPE" => "A",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "ROOT_MENU_TYPE" => "top",
                "USE_EXT" => "Y"
            )
        );?>
    </div>
    <? if (false): ?>
        <div class="desc_place">
            <p>* – Записи матчей</p>
        </div>
    <? endif ?>
</div>
<? if (!$is_main_page): ?>
    <section class="main_banner">
        <div class="center_text"><img src="<?=SITE_TEMPLATE_PATH ?>/img/ico/logo_big.svg" alt=""></div>
        <div class="container_ui">
            <h1 class="page_title"><?=$APPLICATION->ShowTitle(false) ?></h1>
        </div>
    </section>
<? endif; ?>
<a class="but_to_top js_but_to_top"></a>
<main>
