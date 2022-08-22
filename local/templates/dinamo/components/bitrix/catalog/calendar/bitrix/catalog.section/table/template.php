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
<? if (!empty($arResult['MONTHS'])): ?>
    <? foreach ($arResult['MONTHS'] as $key => $arMoth): ?>
        <div class="table_place calendar_table">
            <div class="table_scroll">
                <div class="table">
                    <div class="header_table">
                        <div class="part"><?=Module\Project\Helpers\Utils::getNameMothByNum($key); ?></div>
                    </div>
                    <div class="body_table">
                        <? foreach($arMoth as $arItem): ?>
                            <div class="row_table">
                                <div class="part_small text_center black"><?=$arItem['PROPERTIES']['DATE']['DAY'] ?></div>
                                <div class="part_full with_img">
                                    <span class="text_right"><?=$arItem['TEAM_H']['NAME'] ?></span>
                                    <span><img src="<?=$arItem['TEAM_H']['ICO'] ?>" alt=""></span>
                                    <? if (!empty($arItem['PROPERTIES']['SCORE']['VALUE'])): ?>
                                        <span class="text_center"><?=$arItem['PROPERTIES']['SCORE']['VALUE'] ?></span>
                                    <? else: ?>
                                        <span class="text_center">– : –</span>
                                    <? endif ?>
                                    <span><img src="<?=$arItem['TEAM_G']['ICO'] ?>" alt=""></span>
                                    <span><?=$arItem['TEAM_G']['NAME'] ?></span>
                                </div>
                                <div class="part"><?=$arItem['PROPERTIES']['BATTLE']['VALUE'] ?></div>
                                <div class="part"><?=$arItem['PROPERTIES']['PLACE']['VALUE'] ?></div>
                            </div>
                        <? endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    <? endforeach; ?>
<? endif; ?>