<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $templateData */
/** @var @global CMain $APPLICATION */

/** @var array $arResult */

use \Bitrix\Main\Data\StaticHtmlCache;
use \Bitrix\Main\Localization\Loc;

Loc::loadLanguageFile(__FILE__);

global $APPLICATION;
$obComponent = $this->__component;
$navNum = $arResult['NAV_NUM'];
$iblockId = $arResult['ID'] ?: '0';
$strId = $navNum . $iblockId;
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

$bAjaxRequest = false;

if (!empty($_SERVER['HTTP_BX_AJAX']) || (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')) {
    $bAjaxRequest = true;
}

if ($bAjaxRequest && $request->get("navNum") == $strId) {
    /*Disable composite mode */
    StaticHtmlCache::getInstance()->markNonCacheable();
    $content = ob_get_contents();
    ob_end_clean();
    $APPLICATION->RestartBuffer();

    list(, $items) = explode("<!--items-$strId-->", $content);
    list(, $pagen) = explode("<!--pagen-$strId-->", $content);


    echo json_encode(array(
        "items" => $items,
        "pagen" => $pagen,
    ));
    die();
}