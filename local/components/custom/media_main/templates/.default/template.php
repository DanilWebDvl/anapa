<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
<? if (!empty($arResult['SLIDE'])): ?>
    <section class="media_place def_mt">
        <div class="container_ui">
            <? if (!empty($arParams['TITLE_BLOCK'])): ?>
                <h2 class="title_block mb60"><?=$arParams['TITLE_BLOCK'] ?></h2>
            <? endif; ?>
            <div class="slide_media_place">
                <div class="single_slider_media owl-carousel mob_hide">
                    <? foreach ($arResult['SLIDE'] as $arSlide): ?>
                        <div class="news_part flex">
                            <? if (!empty($arSlide['PHOTO'][0])): ?>
                                <div class="side_2 part color_line pink pos-rel">
                                    <picture><img src="<?=$arSlide['PHOTO'][0]['PICTURE'] ?>" alt=""></picture>
                                    <div class="text-place flex flex-bottom smooth_back">
                                        <span class="content-slide">
                                            <p class="link"><a href="<?=$arSlide['PHOTO'][0]['SECTION_PAGE_URL'] ?>" ><?=$arSlide['PHOTO'][0]['NAME'] ?></a></p>
                                            <div class="flex flex-between flex-a-center">
                                                <p class="data"><?=$arSlide['PHOTO'][0]['UF_DATE'] ?></p>
                                                <p class="num with_bac"><?=$arSlide['PHOTO'][0]['ELEMENT_CNT'] ?></p>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            <? endif ?>
                            <? if (count($arSlide['PHOTO']) > 1): ?>
                                <div class="side_1 flex middle_part part">
                                    <? foreach ($arSlide['PHOTO'] as $key => $arPhoto): if ($key == 0) continue; ?>
                                        <div class="m_part color_line pink pos-rel">
                                            <picture><img src="<?=$arPhoto['PICTURE'] ?>" alt=""></picture>
                                            <div class="text-place flex flex-bottom smooth_back">
                                            <span class="content-slide">
                                                <p class="link"><a href="<?=$arPhoto['SECTION_PAGE_URL'] ?>"><?=$arPhoto['NAME'] ?></a></p>
                                                <div class="flex flex-between flex-a-center">
                                                    <p class="data"><?=$arPhoto['UF_DATE'] ?></p>
                                                </div>
                                            </span>
                                            </div>
                                        </div>
                                    <? endforeach; ?>
                                </div>
                            <? endif ?>
                            <? if (!empty($arSlide['VIDEO'][0])): ?>
                                <div class="side_3 part color_line blue pos-rel" href="<?=$arSlide['VIDEO'][0]['PROPERTIES']['VIDEO']['VALUE']['path'] ?>" data-fancybox>
                                    <picture class="video_ico"><img src="<?=$arSlide['VIDEO'][0]['PREVIEW_PICTURE'] ?>" alt=""></picture>
                                    <div class="text-place flex flex-bottom smooth_back">
                                        <span class="content-slide">
                                            <p class="link"><a><?=$arSlide['VIDEO'][0]['NAME'] ?></a></p>
                                            <div class="flex flex-between flex-a-center">
                                                <p class="data"><?=$arSlide['VIDEO'][0]['PROPERTIES']['DATE']['VALUE'] ?></p>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            <? endif ?>

                        </div>
                    <? endforeach; ?>
                </div>
                <div class="mob_show">
                    <div class="media_mob_list">
                        <? for ($i = 0; $i < 2; $i++): ?>
                            <? if (!empty($arResult['SLIDE'][0]['PHOTO'][$i])): $arPhoto = $arResult['SLIDE'][0]['PHOTO'][$i]; ?>
                                <div class="part color_line pink pos-rel news_part">
                                    <p class="num with_bac mob_show"><?=$arPhoto['ELEMENT_CNT'] ?></p>
                                    <picture><img src="<?=$arPhoto['PICTURE'] ?>" alt=""></picture>
                                    <div class="text-place flex flex-bottom smooth_back">
                                    <span class="content-slide">
                                        <p class="link"><a href="<?=$arPhoto['SECTION_PAGE_URL'] ?>"><?=$arPhoto['NAME'] ?></a></p>
                                        <div class="flex flex-between flex-a-center">
                                            <p class="data"><?=$arPhoto['UF_DATE'] ?></p>
                                            <p class="num mob_hide"><?=$arPhoto['ELEMENT_CNT'] ?></p>
                                        </div>
                                    </span>
                                    </div>
                                </div>
                            <? endif; ?>
                        <? endfor; ?>
                        <? if (!empty($arResult['SLIDE'][0]['VIDEO'][0])): $arVideo = $arResult['SLIDE'][0]['VIDEO'][0]; ?>
                            <div class="part color_line blue pos-rel news_part" href="<?=$arVideo['PROPERTIES']['VIDEO']['VALUE']['path'] ?>" data-fancybox>
                                <picture class="video_ico"><img src="<?=$arVideo['PREVIEW_PICTURE'] ?>" alt=""></picture>
                                <div class="text-place flex flex-bottom smooth_back">
                                    <span class="content-slide">
                                        <p class="link"><a><?=$arVideo['NAME'] ?></a></p>
                                        <div class="flex flex-between flex-a-center">
                                            <p class="data"><?=$arVideo['PROPERTIES']['DATE']['VALUE'] ?></p>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        <? endif; ?>

                    </div>
                </div>
                <div class="container_ui container_without_p">
                    <div class="nav_by_slider nav_by_slider_media"></div>
                    <? if (!empty($arParams['PAGER_TITLE'])): ?>
                        <div class="right-btn btn_with_arrows">
                            <a href="<?=$arParams['PAGER_LINK'] ?>" class="btn_link"><?=$arParams['PAGER_TITLE'] ?></a>
                        </div>
                    <? endif; ?>
                </div>
            </div>
        </div>
    </section>
<? endif ?>