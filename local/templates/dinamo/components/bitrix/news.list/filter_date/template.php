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
<? if (!empty($arResult['FILTER'])): ?>
    <div class="filter_burger js_filter_burger pos-rel">
        <span class="part flex">
            <span class="text">Даты</span>
            <svg width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M29.5 4H26.5V2H24.5V4H8.5V2H6.5V4H3.5L2.5 5V29L3.5 30H29.5L30.5 29V5L29.5 4ZM28.5 28H4.5V10H28.5V28ZM28.5 8H4.5V6H28.5V8ZM8.5 16H6.5V18H8.5V16ZM6.5 20H8.5V22H6.5V20ZM8.5 24H6.5V26H8.5V24ZM12.5 16H14.5V18H12.5V16ZM14.5 20H12.5V22H14.5V20ZM12.5 24H14.5V26H12.5V24ZM14.5 12H12.5V14H14.5V12ZM18.5 16H20.5V18H18.5V16ZM20.5 20H18.5V22H20.5V20ZM18.5 24H20.5V26H18.5V24ZM20.5 12H18.5V14H20.5V12ZM24.5 16H26.5V18H24.5V16ZM26.5 20H24.5V22H26.5V20ZM24.5 12H26.5V14H24.5V12Z" fill="#3066BF"/>
            </svg>
        </span>
        <div class="filter_hide js_filter_hide">
            <div>
                <? if (!empty($arResult['FILTER']['YEAR'])): ?>
                    <p class="title">Год</p>
                    <div class="list">
                        <? foreach ($arResult['FILTER']['YEAR'] as $year): ?>
                            <div>
                                <label class="checkbox">
                                    <input type="checkbox" name="year" value="<?=$year ?>">
                                    <span class="checkmark"></span>
                                    <span><?=$year ?></span>
                                </label>
                            </div>
                        <? endforeach; ?>
                </div>
                <? endif; ?>
                <? if (!empty($arResult['FILTER']['MONTH'])): ?>
                    <p class="title">Месяц</p>
                    <div class="list">
                        <? foreach ($arResult['FILTER']['MONTH'] as $key => $month): ?>
                            <div>
                                <label class="checkbox">
                                    <input type="checkbox" name="month" value="<?=$key ?>">
                                    <span class="checkmark"></span>
                                    <span><?=$month ?></span>
                                </label>
                            </div>
                        <? endforeach; ?>
                    </div>
                <? endif; ?>
            </div>
        </div>
    </div>
<? endif; ?>