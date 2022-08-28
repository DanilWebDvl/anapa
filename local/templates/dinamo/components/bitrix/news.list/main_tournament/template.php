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
<? if (!empty($arResult['ITEMS']) || !empty($arResult['PLAYER'])): ?>
    <section class="tournament_place def_mt pos-rel">
        <div class="b_waves near_both mob_show"></div>
        <div class="container_ui">
            <div class="flex flex-between flex-tournament">
                <? if (!empty($arResult['ITEMS'])): ?>
                    <div class="table_place">
                        <h2 class="title_block"><?=$arParams['TITLE_BLOCK'] ?></h2>
                        <div class="table_scroll">
                            <div class="table">
                                <div class="header_table">
                                    <div class="part">Место</div>
                                    <div class="part"></div>
                                    <div class="part_full">Команда</div>
                                    <div class="part">И</div>
                                    <div class="part">В</div>
                                    <div class="part">О</div>
                                    <div class="part">П</div>
                                    <div class="part">Сеты</div>
                                </div>
                                <div class="body_table">
                                    <? foreach ($arResult['ITEMS'] as $arItem): ?>
                                        <div class="row_table">
                                            <div class="part black"><?=$arItem['PROPERTIES']['PLACE']['VALUE'] ?></div>
                                            <div class="part with_img">
                                                <img src="<?=$arItem['TEAM']['ICO'] ?>" alt="<?=$arItem['TEAM']['NAME'] ?>">
                                            </div>
                                            <div class="part_full">
                                                <span><?=$arItem['TEAM']['NAME'] ?></span>
                                            </div>
                                            <div class="part"><?=$arItem['PROPERTIES']['I']['VALUE'] ?></div>
                                            <div class="part"><?=$arItem['PROPERTIES']['B']['VALUE'] ?></div>
                                            <div class="part"><?=$arItem['PROPERTIES']['O']['VALUE'] ?></div>
                                            <div class="part"><?=$arItem['PROPERTIES']['P']['VALUE'] ?></div>
                                            <div class="part"><?=$arItem['PROPERTIES']['SET']['VALUE'] ?></div>
                                        </div>
                                    <? endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <? if ($arParams['PAGER_SHOW_ALL'] == 'Y'): ?>
                            <div class="full-btn">
                                <a href="<?=$arParams['PAGER_LINK'] ?>" class="btn_link"><?=$arParams['PAGER_TITLE'] ?></a>
                            </div>
                        <? endif ?>
                    </div>
                <? endif ?>
                <? if (!empty($arResult['PLAYER'])): ?>
                    <div class="leader_place">
                        <h2 class="title_block"><?=$arParams['TITLE_BLOCK_2'] ?></h2>
                        <div class="big_card card_sport">
                            <div class="img_with_wave">
                                <img src="<?=$arResult['PLAYER']['PICTURE'] ?>" alt="<?=$arResult['PLAYER']['NAME'] ?>">
                            </div>
                            <div class="info_card">
                                <div class="num">
                                    <?=$arResult['PLAYER']['PROP']['NUM']['VALUE'] ?>
                                </div>
                                <div class="more_info">
                                    <p class="name"><?=$arResult['PLAYER']['NAME'] ?></p>
                                    <p class="role"><?=$arResult['PLAYER']['PROP']['POSITION']['VALUE'] ?></p>
                                    <p class="birth_title">Дата рождения</p>
                                    <p class="birth"><?=$arResult['PLAYER']['PROP']['DATE']['VALUE'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <? endif ?>
            </div>
        </div>
    </section>
<? endif ?>