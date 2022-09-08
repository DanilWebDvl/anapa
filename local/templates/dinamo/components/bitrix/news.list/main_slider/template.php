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
    <section class="main_slider_place">
        <div class="slider_init white-btns">
            <? foreach ($arResult['ITEMS'] as $arItem): ?>
                <div class="slide">
                    <? if (!empty($arItem['PROPERTIES']['VIDEO']['VALUE']['path'])): ?>
                        <video playsinline loop="" muted="" autoplay="" class="fullscreen-bg__video">
                            <source src="<?=$arItem['PROPERTIES']['VIDEO']['VALUE']['path'] ?>">
                        </video>
                    <? else: ?>
                        <picture>
                            <img src="<?=$arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT'] ?>">
                        </picture>
                    <? endif; ?>
                    <? if (!empty($arItem['PROPERTIES']['VIDEO']['VALUE']['path'])): ?>
                        <? if (!empty($arItem['PROPERTIES']['VIDEO']['VALUE']['title']) && $arItem['PROPERTIES']['HIDE_TEXT']['VALUE_XML_ID'] != 'Y'): ?>
                            <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE'] ?>" class="text-place flex flex-bottom smooth_back">
                                <div class="content-slide">
                                    <p class="part"><?=$arItem['PROPERTIES']['VIDEO']['VALUE']['title'] ?></p>
                                </div>
                            </a>
                        <? endif; ?>
                    <? elseif ($arItem['PROPERTIES']['HIDE_TEXT']['VALUE_XML_ID'] != 'Y'): ?>
                        <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE'] ?>" class="text-place flex flex-bottom smooth_back">
                            <div class="content-slide">
                                <p class="part"><?=$arItem['NAME'] ?></p>
                            </div>
                        </a>
                    <? endif; ?>
                </div>
            <? endforeach; ?>
        </div>
        <div class="bot_arrows"></div>
</section>
<? endif; ?>