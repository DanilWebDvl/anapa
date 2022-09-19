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
<? if (!empty($arResult['ITEMS'])): ?>
    <section class="news_slider_place">
        <div class="container_ui">
            <h2 class="title_block mb60"><?=$arParams['TITLE_BLOCK'] ?></h2>
        </div>
        <div class="slider_multiple_2 owl-carousel">
            <? foreach ($arResult['ITEMS'] as $arItem): ?>
                <a class="news" href="<?=$arItem['DETAIL_PAGE_URL'] ?>">
                    <picture class="sb_pic"> <!--style="background-image: url(<?//=$arItem['PREVIEW_PICTURE']['RESIZE'] ?>)" -->
                        <img src="<?=$arItem['PREVIEW_PICTURE']['RESIZE'] ?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT'] ?>">
                    </picture>
                    <span class="text-place flex flex-bottom smooth_back">
                    <span class="content-slide">
                        <p class="part"><?=$arItem['FORMAT_PREVIEW_TEXT'] ?></p>
                        <p class="data"><?=$arItem['FORMAT_DATE'] ?></p>
                    </span>
                </span>
                </a>
            <? endforeach; ?>
        </div>
        <div class="container_ui container_without_p">
            <div class="nav_by_slider nav_by_slider_2"></div>
            <? if ($arParams['PAGER_SHOW_ALL'] == 'Y'): ?>
                <div class="right-btn btn_with_arrows">
                    <a href="<?=$arParams['PAGER_LINK'] ?>" class="btn_link"><?=$arParams['PAGER_TITLE'] ?></a>
                </div>
            <? endif ?>
        </div>
    </section>
<? endif; ?>