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
                    <?
                    if (!empty($arItem['PROPERTIES']['LINK']['VALUE']))
                        $link = $arItem['PROPERTIES']['LINK']['VALUE'];
                    ?>
                    <div class="part flex flex-between">
                        <a class="logo_sponsor flex flex-a-center"<?=!empty($link) ? ' href="'.$link.'"' : '' ?> target="_blank">
                            <? if (!empty($arItem['ICO'])): ?>
                                <img src="<?=$arItem['ICO'] ?>" alt="<?=$arItem['NAME'] ?>">
                            <? endif ?>
                        </a>
                        <div class="data_sponsor">
                            <a class="title_sponsor"<?=!empty($link) ? ' href="'.$link.'"' : '' ?>><?=$arItem['NAME'] ?></a>
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
