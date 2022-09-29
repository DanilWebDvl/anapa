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
<div class="js_page_filtrable">
    <? if (!empty($arResult['ITEMS'])): ?>
        <div class="pager_cards_list grid items<?= $arResult['NAV_NUM'] . $arResult['ID'] ?>">
            <!--items-<?= $arResult['NAV_NUM'] . $arResult['ID'] ?>-->
            <? foreach ($arResult['ITEMS'] as $arItem): ?>
                <div class="js_pager_card pager_card pos-rel" href="<?=$arItem['PROPERTIES']['VIDEO']['VALUE']['path'] ?: $arItem['PROPERTIES']['YOUTUBE']['VALUE'] ?>" data-fancybox="gallery">
                    <picture class="video_ico"><img src="<?=$arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT'] ?>"></picture>
                    <div class="text-place flex flex-bottom smooth_back color_line sky">
                        <span class="content-slide">
                            <p class="link"><a><?=$arItem['NAME'] ?></a></p>
                            <div class="flex flex-between flex-a-center pos-rel">
                                <p class="data"><?=$arItem['PROPERTIES']['DATE']['VALUE'] ?></p>
                                <span class="video_ico_mini"></span>
                            </div>
                            <p><?=$arItem['PREVIEW_TEXT'] ?></p>
                        </span>
                    </div>
                </div>
            <? endforeach; ?>
            <!--items-<?= $arResult['NAV_NUM'] . $arResult['ID'] ?>-->
        </div>
        <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
            <div class="text_center pagen<?= $arResult['NAV_NUM'] . $arResult['ID'] ?>">
                <!--pagen-<?= $arResult['NAV_NUM'] . $arResult['ID'] ?>-->
                <?=$arResult["NAV_STRING"]?>
                <!--pagen-<?= $arResult['NAV_NUM'] . $arResult['ID'] ?>-->
            </div>
        <?endif;?>
    <? endif; ?>
</div>
