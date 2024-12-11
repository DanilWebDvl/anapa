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
<? if (!empty($arResult['ITEMS_REFORMAT'])): ?>
    <div class="table_place">
        <div class="table_scroll">
            <div class="table">
                <div class="header_table">
                    <div class="part">Место</div>
                    <div class="part"></div>
                    <div class="part_full">Команда</div>
                    <div class="part">И</div>
                    <div class="part">В</div>
                    <div class="part">П</div>
                    <div class="part">О</div>
                    <div class="part">Сеты</div>
                </div>
                <div class="body_table">
                    <? foreach ($arResult['ITEMS_REFORMAT'] as $arItem): ?>
                        <div class="row_table">
                            <div class="part black"><?=$arItem['PROPERTIES']['PLACE']['VALUE'] ?></div>
                            <div class="part with_img">
                                <img src="<?=$arItem['TEAM']['ICO'] ?>" alt="">
                            </div>
                            <div class="part_full">
                                <span><?=$arItem['TEAM']['NAME'] ?></span>
                            </div>
                            <div class="part"><?=$arItem['PROPERTIES']['I']['VALUE'] ?></div>
                            <div class="part"><?=$arItem['PROPERTIES']['B']['VALUE'] ?></div>
                            <div class="part"><?=$arItem['PROPERTIES']['P']['VALUE'] ?></div>
                            <div class="part"><?=$arItem['PROPERTIES']['O']['VALUE'] ?></div>
                            <div class="part"><?=$arItem['PROPERTIES']['SET']['VALUE'] ?></div>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<? endif; ?>