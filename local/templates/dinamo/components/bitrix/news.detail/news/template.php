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
<? if (!empty($arResult['DETAIL_PICTURE'])): ?>
    <style>
        .main_banner {
            /*background-image: url(*/<?php //=$arResult['DETAIL_PICTURE']['SRC'] ?>/*);*/
            background-image: url('/images/banner_static.png');
            min-height: 600px;

        }
        .main_banner img {
            opacity: 0;
        }
    </style>
<? endif ?>
<script>
    $('.page_title').remove();
</script>
<div>
    <div class="special_date_title">
        <h1><?=$arResult['META_TAGS']['TITLE'] ?></h1>
        <div class="right_date">
            <p><?=$arResult['DATE'] ?></p>
            <p><?=$arResult['TIME'] ?></p>
        </div>
    </div>
    <?=$arResult['~DETAIL_TEXT'] ?>
</div>
