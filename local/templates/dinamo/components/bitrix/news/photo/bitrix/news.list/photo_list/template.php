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
<? if (!empty($arResult['ITEMS'])): ?>
    <div class="pager_cards_list flex items<?= $arResult['NAV_NUM'] . $arResult['ID'] ?>">
        <!--items-<?= $arResult['NAV_NUM'] . $arResult['ID'] ?>-->
        <? foreach ($arResult['ITEMS'] as $arItem): ?>
            <? if (!empty($arItem['PROPERTIES']['MORE_PHOTO']['VALUE'])) {
                foreach ($arItem['PROPERTIES']['MORE_PHOTO']['VALUE'] as $keyIndex=>$PROPERTY_PHOTO) {
                    $link = CFile::GetPath($PROPERTY_PHOTO);
                    $RESIZE = $link;
                    ?>
                    <div class="js_pager_card pager_card pos-rel" href="<?= $link ?>"
                         data-fancybox="gallery">
                        <picture><img src="<?= $RESIZE ?>" alt=""></picture>
                        <div class="text-place flex flex-bottom smooth_back color_line sky">
                    <span class="content-slide">
                        <div class="flex flex-between flex-a-center">
                            <p class="data"><?= $arItem['PROPERTIES']['DATE']['VALUE'] ?></p>
                        </div>
                        <p><?= $arItem['PROPERTIES']['MORE_PHOTO']['DESCRIPTION'][$keyIndex] ? : $arItem['NAME'] ?></p>
                    </span>
                        </div>
                    </div>
                    <?
                }
            } else { ?>
            <div class="js_pager_card pager_card pos-rel" href="<?= $arItem['DETAIL_PICTURE']['SRC'] ?>"
                 data-fancybox="gallery">
                <picture><img src="<?= $arItem['PREVIEW_PICTURE']['RESIZE'] ?>" alt=""></picture>
                <div class="text-place flex flex-bottom smooth_back color_line sky">
                    <span class="content-slide">
                        <div class="flex flex-between flex-a-center">
                            <p class="data"><?= $arItem['PROPERTIES']['DATE']['VALUE'] ?></p>
                        </div>
                        <p><?= $arItem['NAME'] ?></p>
                    </span>
                </div>
                </div><? } ?>

        <? endforeach; ?>
        <!--items-<?= $arResult['NAV_NUM'] . $arResult['ID'] ?>-->
    </div>
    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
        <div class="text_center pagen<?= $arResult['NAV_NUM'] . $arResult['ID'] ?>">
            <!--pagen-<?= $arResult['NAV_NUM'] . $arResult['ID'] ?>-->
            <?= $arResult["NAV_STRING"] ?>
            <!--pagen-<?= $arResult['NAV_NUM'] . $arResult['ID'] ?>-->
        </div>
    <? endif; ?>
<? endif; ?>