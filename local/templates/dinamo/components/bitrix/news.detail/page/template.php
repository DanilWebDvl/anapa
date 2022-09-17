<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global \CMain $APPLICATION */
/** @global \CUser $USER */
/** @global \CDatabase $DB */
/** @var \CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var array $templateData */
/** @var \CBitrixComponent $component */
$this->setFrameMode(true);
?>
<style>
    .main_banner {
        background-image: url(<?=$arResult['DETAIL_PICTURE']['SRC'] ?>);
    }
    .main_banner img {
        opacity: 0;
    }
    .page_title{
        color: #ffffff;
    }
</style>
<section class="page_about_place def_pt_page">
    <div class="container_ui parent">
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:menu",
            "voleigrad",
            Array(
                "ROOT_MENU_TYPE" => "left",
                "MAX_LEVEL" => "1",
                "CHILD_MENU_TYPE" => "",
                "USE_EXT" => "Y"
            )
        );
        ?>

    </div>
    <div class="container_content">
        <div class="js_slide_for_top">
            <div id="NAV_1"></div>
            <? if (!empty($arResult['PROPERTIES']['TITLE_1']['VALUE'])): ?>
                <h1><?= $arResult['PROPERTIES']['TITLE_1']['VALUE'] ?></h1>
            <? endif ?>
            <div id="NAV_2"></div>
            <? if (!empty($arResult['PROPERTIES']['TEXT_1']['~VALUE']['TEXT'])): ?>
                <?= $arResult['PROPERTIES']['TEXT_1']['~VALUE']['TEXT'] ?>
            <? endif ?>
            <div id="NAV_3"></div>
            <? if (!empty($arResult['PROPERTIES']['VIDEO']['VALUE']['path'])): ?>
                <div class="video full_screen">
                    <video controls>
                        <source src="<?= $arResult['PROPERTIES']['VIDEO']['VALUE']['path'] ?>" type="video/mp4">
                    </video>
                </div>
            <? endif ?>
            <div id="NAV_4"></div>
            <? if (!empty($arResult['PROPERTIES']['TITLE_2']['VALUE'])): ?>
                <h2><?= $arResult['PROPERTIES']['TITLE_2']['VALUE'] ?></h2>
            <? endif ?>
            <div id="NAV_5"></div>
            <? if (!empty($arResult['PROPERTIES']['TEXT_2']['~VALUE']['TEXT'])): ?>
                <?= $arResult['PROPERTIES']['TEXT_2']['~VALUE']['TEXT'] ?>
            <? endif ?>
            <div id="NAV_6"></div>
            <? if (!empty($arResult['PROPERTIES']['QUOTE_1']['VALUE'])): ?>
                <blockquote><?= $arResult['PROPERTIES']['QUOTE_1']['VALUE'] ?></blockquote>
            <? endif ?>
            <div id="NAV_7"></div>
            <? if (!empty($arResult['PROPERTIES']['SLIDER_1']['VALUE'])): ?>
                <div class="single_slider owl-carousel">
                    <? foreach ($arResult['PROPERTIES']['SLIDER_1']['VALUE'] as $key => $value): ?>
                        <div>
                            <img src="<?= CFile::GetPath($value) ?>"/>
                            <? if (!empty($arResult['PROPERTIES']['SLIDER_1']['DESCRIPTION'][$key])) ?>
                            <div class="slide_for_content">
                                <div class="right-btn desc_photo">
                                    <p><?= $arResult['PROPERTIES']['SLIDER_1']['DESCRIPTION'][$key] ?></p>
                                </div>
                            </div>
                        </div>
                    <? endforeach; ?>
                </div>
                <div class="mb100 slide_for_content">
                    <div class="nav_by_slider nav_by_slider_single"></div>
                </div>
            <? endif ?>
            <div id="NAV_8"></div>
            <? if (!empty($arResult['PROPERTIES']['TEXT_3']['~VALUE']['TEXT'])): ?>
                <?= $arResult['PROPERTIES']['TEXT_3']['~VALUE']['TEXT'] ?>
            <? endif ?>
            <div id="NAV_9"></div>
            <? if (!empty($arResult['PROPERTIES']['QUOTE_2']['VALUE'])): ?>
                <blockquote><?= $arResult['PROPERTIES']['QUOTE_2']['VALUE'] ?></blockquote>
            <? endif ?>
            <div id="NAV_10"></div>
            <? if (!empty($arResult['PROPERTIES']['TITLE_3']['VALUE'])): ?>
                <h2><?= $arResult['PROPERTIES']['TITLE_3']['VALUE'] ?></h2>
            <? endif ?>
            <div id="NAV_11"></div>
            <? if (!empty($arResult['PROPERTIES']['TEXT_4']['~VALUE']['TEXT'])): ?>
                <?= $arResult['PROPERTIES']['TEXT_4']['~VALUE']['TEXT'] ?>
            <? endif ?>
            <div id="NAV_12"></div>
            <? if (!empty($arResult['PROPERTIES']['SLIDER_2']['VALUE'])): ?>
                <div class="single_slider_2 owl-carousel">
                    <? foreach ($arResult['PROPERTIES']['SLIDER_2']['VALUE'] as $key => $value): ?>
                        <div>
                            <img src="<?= CFile::GetPath($value) ?>"/>
                            <? if (!empty($arResult['PROPERTIES']['SLIDER_2']['DESCRIPTION'][$key])) ?>
                            <div class="slide_for_content">
                                <div class="right-btn desc_photo">
                                    <p><?= $arResult['PROPERTIES']['SLIDER_2']['DESCRIPTION'][$key] ?></p>
                                </div>
                            </div>
                        </div>
                    <? endforeach; ?>
                </div>
                <div class="nav_by_slider nav_by_slider_single_2"></div>
            <? endif ?>
        </div>
    </div>
</section>
