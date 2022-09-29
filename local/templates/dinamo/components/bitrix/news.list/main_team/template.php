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
    <section class="team_place def_mt pos-rel">
        <? if (!empty($arParams['TITLE_BLOCK'])): ?>
            <div class="container_ui">
                <h2 class="title_block mb60"><?=$arParams['TITLE_BLOCK'] ?></h2>
            </div>
        <? endif ?>
        <div class="b_waves near_both"></div>
        <div class="slider_team_place">
            <div class="slider_multiple_team owl-carousel">
                <? foreach ($arResult['ITEMS'] as $arItem): ?>
                    <div class="player">
                        <div class="card_sport">
                            <div class="img_with_wave">
                                <p class="num"><?=$arItem['PROPERTIES']['NUM']['VALUE'] ?></p>
                                <div class="block"></div>
                                <img src="<?=$arItem['PREVIEW_PICTURE']['SRC'] ?>">
                                <div class="b-wave"></div>
                            </div>
                        </div>
                        <div class="data_player">
                            <p class="name"><?=$arItem['NAME'] ?></p>
                            <p class="role"><?=$arItem['PROPERTIES']['POSITION']['VALUE'] ?></p>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
        <div class="container_ui">
            <div class="nav_by_slider nav_by_slider_team"></div>
            <? if ($arParams['PAGER_SHOW_ALL'] == 'Y'): ?>
                <div class="right-btn btn_with_arrows">
                    <a href="<?=$arParams['PAGER_LINK'] ?>" class="btn_link"><?=$arParams['PAGER_TITLE'] ?></a>
                </div>
            <? endif ?>
        </div>
    </section>
<? endif; ?>