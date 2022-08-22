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
\_::dJS($arResult);
?>
<? if (!empty($arResult['ITEMS'])): ?>
    <section class="page_contacts_place def_pt_page">
        <div class="parts_contact_place">
            <? foreach ($arResult['ITEMS'] as $arItem): ?>
                <div class="part_contact">
                    <span class="name_part"><?=$arItem['NAME'] ?>: </span>
                    <span class="value_part">
                        <? if ($arItem['PROPERTIES']['IS_PHONE']['VALUE'] == 'Y'): ?>
                            <a href="tel:<?=$arItem['~PREVIEW_TEXT'] ?>"><?=$arItem['~PREVIEW_TEXT'] ?></a>
                        <? elseif ($arItem['PROPERTIES']['IS_EMAIL']['VALUE'] == 'Y'): ?>
                            <a href="mailto:<?=$arItem['~PREVIEW_TEXT'] ?>"><?=$arItem['~PREVIEW_TEXT'] ?></a>
                        <? else: ?>
                            <?=$arItem['~PREVIEW_TEXT'] ?>
                        <? endif; ?>
                    </span>
                </div>
            <? endforeach; ?>
        </div>
    </section>
<? endif ?>
<? if (!empty($arResult['MAP'])): ?>
    <section class="map_place">
        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A48c0e58d233f4e94f7923efcbdb048fadbebd96f87b60699e1f60b44e70d914b&amp;height=455&amp;lang=ru_RU&amp;scroll=true"></script>
    </section>
<? endif ?>