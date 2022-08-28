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
    <section class="partners_place def_pt b_waves">
        <div class="container_ui">
            <h2 class="title_block mb100">Наши партнеры и спонсоры</h2>
            <div class="flex partners_list">
                <? foreach ($arResult['ITEMS'] as $arItem): if (empty($arItem['ICO'])) continue; ?>
                    <div class="part">
                        <img src="<?=$arItem['ICO'] ?>" alt="<?=$arItem['NAME'] ?>">
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </section>
<? endif ?>