<style>
    .main_banner {

        /*min-height: 600px;*/

        /*background-image: url(*/<?php //=$arResult['DETAIL_PICTURE']['SRC'] ?>/*);*/
        /*background-image: url('/images/banner_static.png');*/
    }
    @media (min-width: 1200px)
    {
        .main_banner img {
            /*opacity: 0;*/
            position: relative;
            top: -50px;
        }
    }
    .page_title{
        /*color: #ffffff;*/
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
                "USE_EXT" => "Y",
                "MENU_CACHE_TYPE" => "N",
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
                <blockquote><?= $arResult['PROPERTIES']['QUOTE_1']['~VALUE']['TEXT'] ?></blockquote>
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
            <? if (!empty($arResult['PROPERTIES']['SLIDER_3']['VALUE'])): ?>
                <div class="slider_multiple_3 owl-carousel">
                    <? foreach ($arResult['PROPERTIES']['SLIDER_3']['VALUE'] as $key => $value): ?>
                        <div>
                            <img src="<?= CFile::GetPath($value) ?>"/>
                        </div>
                    <? endforeach; ?>
                </div>
                <div class="nav_by_slider nav_by_slider_multiple_3"></div>
            <? endif ?>
        </div>
    </div>
</section>