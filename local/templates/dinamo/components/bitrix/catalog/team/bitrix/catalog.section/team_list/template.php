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
    <div class="list_team flex">
        <? foreach ($arResult['ITEMS'] as $arItem): $arProp = $arItem['PROPERTIES']; ?>
            <a class="player" data-fancybox data-src="#hidden-content-<?=$arItem['ID'] ?>" href="javascript:;">
                <div class="card_sport">
                    <div class="img_with_wave">
                        <? if (!empty($arProp['NUM']['VALUE'])): ?>
                            <p class="num"><?=$arProp['NUM']['VALUE'] ?></p>
                        <? endif ?>
                        <? if (!empty($arItem['PREVIEW_PICTURE']['SRC'])): ?>
                            <img src="<?=$arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT'] ?>">
                        <? endif; ?>
                        <div class="b-wave"></div>
                    </div>
                </div>
                <div class="data_player">
                    <p class="name"><?=$arItem['NAME'] ?></p>
                    <? if (!empty($arProp['POSITION']['VALUE'])): ?>
                        <p class="role"><?=$arProp['POSITION']['VALUE'] ?></p>
                    <? endif; ?>
                </div>
                <div style="display: none;" id="hidden-content-<?=$arItem['ID'] ?>" class="hide_card_sport">
                    <div class="inner_hide_card flex flex-between">
                        <p class="title mob_show"><?=$arItem['NAME'] ?></p>
                        <div class="flex card_sport_place">
                            <div class="card_sport">
                                <div class="img_with_wave only_bot_wave">
                                    <? if (!empty($arItem['PREVIEW_PICTURE']['SRC'])): ?>
                                        <div class="block"></div>
                                        <img src="<?=$arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT'] ?>">
                                    <? endif ?>
                                    <div class="b-wave"></div>
                                </div>
                            </div>
                            <div class="data_player_place">
                                <div class="data_player">
                                    <? if (!empty($arProp['POSITION']['VALUE'])): ?>
                                        <p class="role"><?=$arProp['POSITION']['VALUE'] ?></p>
                                    <? endif; ?>
                                    <? if (!empty($arProp['NUM']['VALUE'])): ?>
                                        <p class="num">№ <?=$arProp['NUM']['VALUE'] ?></p>
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="more_data_card">
                            <p class="title mob_hide"><?=$arItem['NAME'] ?></p>
                            <div class="back_board">
                                <? if (!empty($arProp['RANK']['VALUE'])): ?>
                                    <div class="part_board flex">
                                        <p class="left"><?=$arProp['RANK']['NAME'] ?></p>
                                        <p class="right"><?=$arProp['RANK']['VALUE'] ?></p>
                                    </div>
                                <? endif ?>
                                <? if (!empty($arProp['DATE']['VALUE'])): ?>
                                    <div class="part_board flex">
                                        <p class="left"><?=$arProp['DATE']['NAME'] ?></p>
                                        <p class="right"><?=$arProp['DATE']['VALUE'] ?></p>
                                    </div>
                                <? endif ?>
                                <? if (!empty($arProp['HEIGHT']['VALUE'])): ?>
                                    <div class="part_board flex">
                                        <p class="left"><?=$arProp['HEIGHT']['NAME'] ?></p>
                                        <p class="right"><?=$arProp['HEIGHT']['VALUE'] ?> см</p>
                                    </div>
                                <? endif ?>
                                <? if (!empty($arProp['HOBBY']['VALUE'])): ?>
                                    <div class="part_board flex">
                                        <p class="left"><?=$arProp['HOBBY']['NAME'] ?></p>
                                        <p class="right"><?=$arProp['HOBBY']['VALUE'] ?></p>
                                    </div>
                                <? endif ?>
                                <? if (!empty($arProp['BORN_PLACE']['VALUE'])): ?>
                                    <div class="part_board flex">
                                        <p class="left"><?=$arProp['BORN_PLACE']['NAME'] ?></p>
                                        <p class="right"><?=$arProp['BORN_PLACE']['VALUE'] ?></p>
                                    </div>
                                <? endif ?>
                                <? if (!empty($arProp['IN_CLUB_FROM']['VALUE'])): ?>
                                    <div class="part_board flex">
                                        <p class="left"><?=$arProp['IN_CLUB_FROM']['NAME'] ?></p>
                                        <p class="right"><?=$arProp['IN_CLUB_FROM']['VALUE'] ?></p>
                                    </div>
                                <? endif ?>
                            </div>
                            <? if (!empty($arProp['ACHIEV']['VALUE'])): ?>
                                <div class="achievements">
                                    <p class="type"><?=$arProp['ACHIEV']['NAME'] ?></p>
                                    <ul>
                                        <? foreach ($arProp['ACHIEV']['VALUE'] as $achiev): ?>
                                            <li><?=$achiev ?></li>
                                        <? endforeach; ?>
                                    </ul>
                                </div>
                            <? endif ?>
                        </div>
                    </div>
                </div>
            </a>
        <? endforeach; ?>
    </div>
<? endif ?>