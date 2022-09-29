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
<? if (!empty($arResult)): ?>
    <div class="filter_top flex">
        <? foreach ($arResult as $arItem): if ($arItem['PARAMS']['HIDE_IN_LEFT'] == 'Y') continue; ?>
            <div class="filter_part<?=$arItem['SELECTED'] ? ' active' : '' ?>">
                <span><a href="<?=$arItem['LINK'] ?>"><?=$arItem['TEXT'] ?></a></span>
            </div>
        <? endforeach; ?>
    </div>
<? endif ?>