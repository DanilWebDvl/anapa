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
    <? if (!empty($arResult['SECTIONS'])): ?>
        <div class="pager_cards_list grid">
            <? foreach ($arResult['SECTIONS'] as $arItem): ?>
                <div class="js_pager_card pager_card pos-rel">
                    <picture><img src="<?=$arItem['PICTURE']['SRC'] ?>" alt="<?=$arItem['PICTURE']['ALT'] ?>"></picture>
                    <div class="text-place flex flex-bottom smooth_back color_line sky">
                        <span class="content-slide">
                            <p class="link"><a href="<?=$arItem['SECTION_PAGE_URL'] ?>"><?=$arItem['NAME'] ?></a></p>
                            <div class="flex flex-between flex-a-center">
                                <p class="data"><?=$arItem['UF_DATE'] ?></p>
                                <p class="num with_bac"><?=$arItem['ELEMENT_CNT'] ?></p>
                            </div>
                            <p><?=$arItem['DESCRIPTION'] ?></p>
                        </span>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
    <? endif ?>
</div>