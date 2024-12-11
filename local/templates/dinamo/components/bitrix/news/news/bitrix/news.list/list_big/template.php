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

    <div class="js_page_filtrable">
        <div class="pager_cards_list grid mt60 items<?= $arResult['NAV_NUM'] . $arResult['ID'] ?>">
            <!--items-<?= $arResult['NAV_NUM'] . $arResult['ID'] ?>-->
            <? foreach ($arResult['ITEMS'] as $arItem): ?>
                <div class="js_pager_card pager_card pos-rel 88">
                    <picture>
                        <? if (!empty($arItem['PREVIEW_PICTURE']['RESIZE'])): ?>
                            <img src="<?=$arItem['PREVIEW_PICTURE']['RESIZE'] ?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT'] ?>">
                        <? else: ?>
                        <? endif ?>
                    </picture>
                    <div class="text-place flex flex-bottom smooth_back color_line sky">
                    <span class="content-slide">
                        <p class="link"><a href="<?=$arItem['DETAIL_PAGE_URL'] ?>"><?=$arItem['FORMAT_PREVIEW_TEXT'] ?></a></p>
                        <? if (!empty($arItem['FORMAT_DATE'])): ?>
                            <div class="flex flex-between flex-a-center">
                                <p class="data"><?=$arItem['FORMAT_DATE'] ?></p>
                            </div>
                        <? endif ?>
                        <? if (!empty($arItem['PROPERTIES']['SORT']['VALUE'])): ?>
                            <p><?=$arItem['PROPERTIES']['SORT']['VALUE'] ?></p>
                        <? endif; ?>
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
    </div>

<? endif ?>