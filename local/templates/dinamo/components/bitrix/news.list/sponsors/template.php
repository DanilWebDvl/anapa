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
<section class="page_sponsors_place def_pt_page">
    <div class="container_ui">
        <? if (!empty($arResult['ITEMS'])): ?>
            <div class="flex sponsor_list">
                <? foreach ($arResult['ITEMS'] as $arItem): ?>
                        <div class="part flex flex-between">
                            <div class="logo_sponsor flex flex-a-center">
                                <? if (!empty($arItem['ICO'])): ?>
                                    <img src="<?=$arItem['ICO'] ?>" alt="<?=$arItem['NAME'] ?>">
                                <? endif ?>
                            </div>
                            <div class="data_sponsor">
                                <p class="title_sponsor"><?=$arItem['NAME'] ?></p>
                                <div class="content_sponsor">
                                    <?=$arItem['~PREVIEW_TEXT'] ?>
                                </div>
                            </div>
                        </div>
                <? endforeach; ?>
            </div>
        <? endif ?>
    </div>
</section>
