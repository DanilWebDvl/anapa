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
<?php if (!empty($arResult)): ?>
    <nav>
        <ul class="flex flex-center menu">
            <?php $previousLevel = 0; ?>
            <?php foreach ($arResult as $arItem): if ($arItem['TEXT'] == '' || $arItem['PARAMS']['HIDE_IN_MEGA'] == 'Y' || $arItem['PARAMS']['UF_HIDE_IN_MEGA']) continue; ?>
                <?php if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
                    <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
                <?php endif?>

                <?php if ($arItem["IS_PARENT"]):?>

                    <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                        <li class="part<?=($arItem['SELECTED'] == true) ? ' active' : '' ?><?=$arItem['PARAMS']['HIGHLIGHT'] ? ' highlight' : '' ?>">
                            <a href="<?=$arItem['LINK'] ?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem['TEXT'] ?></a>
                            <ul class="child_list">
                    <?php else:?>
                        <li<?if ($arItem["SELECTED"]):?> class="selected"<?endif?>>
                            <a href="<?=$arItem["LINK"]?>" class="parent"><?=$arItem["TEXT"]?></a>
                            <ul class="child_list">
                    <?php endif?>

                <?php else:?>
                    <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                        <li class="part<?=($arItem['SELECTED'] == true) ? ' active' : '' ?><?=$arItem['PARAMS']['HIGHLIGHT'] ? ' highlight' : '' ?>">
                            <a href="<?=$arItem['LINK'] ?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem['TEXT'] ?></a>
                        </li>
                    <?else:?>
                        <li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>>
                            <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                        </li>
                    <?endif?>
                <?php endif?>


                <?php $previousLevel = $arItem["DEPTH_LEVEL"];?>
            <?php endforeach; ?>

            <?php if ($previousLevel > 1)://close last item tags?>
                <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
            <?php endif ?>
        </ul>
    </nav>
<?php endif ?>