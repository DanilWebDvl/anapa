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
$ad_class = '';
if ($arParams['SHOW_PAGINATION'] == 'Y')
    $ad_class = " items" . $arResult['NAV_NUM'] . $arResult['ID'];
?>
<? if (!empty($arResult['ITEMS'])): ?>
    <div class="match_results_place calendar_slider_place mb100  <?=($arParams['SHOW_PAGINATION'] == 'Y') ? 'js_page_filtrable' : '' ?>">
        <div class="match_results_list flex<?=$ad_class ?>">
            <? if ($arParams['SHOW_PAGINATION'] == 'Y'): ?>
                <!--items-<?= $arResult['NAV_NUM'] . $arResult['ID'] ?>-->
            <? endif; ?>
            <? foreach ($arResult['ITEMS'] as $arItem): ?>
                <div class="card prev">
                    <div class="date_time flex flex-between">
                        <div class="data_place">
                            <p><?=$arItem['FORMAT_DAY'] ?>.<?=$arItem['FORMAT_MONTH'] ?></p>
                        </div>
                        <div class="stage">
                            <p><?=$arItem['PROPERTIES']['STAGE']['VALUE'] ?></p>
                        </div>
                        <div class="time_place">
                            <p><?=$arItem['FORMAT_TIME'] ?></p>
                        </div>
                    </div>
                    <div class="vs_place">
                        <div class="text_center">
                            <img src="<?=$arItem['TEAM_H']['ICO'] ?>">
                            <p class="desc"><?=$arItem['TEAM_H']['NAME'] ?></p>
                        </div>
                        <? if (!empty($arItem['PROPERTIES']['SCORE']['VALUE'])): ?>
                            <span class="text_center vs_text"><?=$arItem['PROPERTIES']['SCORE']['VALUE'] ?></span>
                        <? else: ?>
                            <span class="text_center vs_text">– : –</span>
                        <? endif ?>
                        <div class="text_center">
                            <img src="<?=$arItem['TEAM_G']['ICO'] ?>">
                            <p class="desc"><?=$arItem['TEAM_G']['NAME'] ?></p>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
            <? if ($arParams['SHOW_PAGINATION'] == 'Y'): ?>
                <!--items-<?= $arResult['NAV_NUM'] . $arResult['ID'] ?>-->
            <? endif; ?>
        </div>
        <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
            <div class="text_center pagen<?= $arResult['NAV_NUM'] . $arResult['ID'] ?>">
                <!--pagen-<?= $arResult['NAV_NUM'] . $arResult['ID'] ?>-->
                <?=$arResult["NAV_STRING"]?>
                <!--pagen-<?= $arResult['NAV_NUM'] . $arResult['ID'] ?>-->
            </div>
        <?endif;?>
    </div>
<? endif; ?>