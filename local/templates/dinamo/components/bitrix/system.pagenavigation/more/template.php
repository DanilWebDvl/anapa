<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

use Bitrix\Main\Localization\Loc;

if (!$arResult["NavShowAlways"]) {
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
        return;
}

$title = $arResult["NavTitle"] ?: Loc::getMessage('IT_SHOW_MORE_BT_TITLE');
$iblockId = '';
if (is_object($arParams["NAV_RESULT"]) && is_subclass_of($arParams["NAV_RESULT"], "CAllDBResult")) {
    $dbresult = $arParams["NAV_RESULT"];
    $iblockId = $dbresult->_LAST_IBLOCK_ID ?: '';

}


$navNum = $arResult["NavNum"];
$firstPageUrl = $arResult["sUrlPathParams"];
$baseUrl = $arResult["sUrlPathParams"] . "PAGEN_$navNum=";
$currPage = $arResult["NavPageNomer"];
$pageCnt = $arResult["NavPageCount"];

?>

<? if ($currPage < $pageCnt): ?>
    <a href="<?= $baseUrl . ($currPage + 1) ?>"
       onclick="handlePager(this, <?= $navNum . $iblockId ?>, true); return false"
       class="btn_link"><?= $title ?></a>
<? endif ?>