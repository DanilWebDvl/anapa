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
    <section class="calendar_slider_place">
        <div class="slider_multiple owl-carousel">
            <? foreach ($arResult['ITEMS'] as $arItem): ?>
                <div class="slide">

                    <div class="card <?=($arItem['PREV'] == 'Y') ? 'prev' : '' ?>">
                        <div class="date_time">
                            <div class="data_place">
                                <p><?=$arItem['DAY'] ?> <?=$arItem['MONTH'] ?></p>
                            </div>
                            <div class="time_place">
                                <p><?=$arItem['TIME'] ?></p>
                            </div>
                        </div>
                        <div class="vs_place">
                            <div class="text_center">
                                <img src="<?=$arItem['TEAM_H']['ICO'] ?>" alt="">
                                <p class="desc"><?=$arItem['TEAM_H']['NAME'] ?></p>
                            </div>
                            <p class="vs_text text_center"><?=$arItem['PROPERTIES']['SCORE']['VALUE'] ?: 'vs' ?></p>
                            <div class="text_center">
                                <img src="<?=$arItem['TEAM_G']['ICO'] ?>" alt="">
                                <p class="desc"><?=$arItem['TEAM_G']['NAME'] ?></p>
                            </div>
                        </div>
                        <div class="desc_place">
                            <p><?=$arItem['PROPERTIES']['PLACE']['VALUE'] ?: '' ?></p>
                        </div>
                    </div>

                </div>
            <? endforeach; ?>
        </div>
    </section>
<? endif; ?>