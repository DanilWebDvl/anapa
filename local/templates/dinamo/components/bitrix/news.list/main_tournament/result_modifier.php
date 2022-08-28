<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global \CMain $APPLICATION */
/** @global \CUser $USER */
/** @global \CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
if (!empty($arResult['ITEMS'])) {
    foreach ($arResult['ITEMS'] as &$arItem) {

        if (!empty($arItem['PROPERTIES']['TEAM']['VALUE'])) {
            if (empty($arResult['TEAMS'][$arItem['PROPERTIES']['TEAM']['VALUE']]))
                $arResult['TEAMS'][$arItem['PROPERTIES']['TEAM']['VALUE']] = \Module\Project\Helpers\Utils::getTeamByProp($arParams['IBLOCK_ID'], $arItem['PROPERTIES']['TEAM']['ID'], $arItem['PROPERTIES']['TEAM']['VALUE']);

            $arItem['TEAM'] = $arResult['TEAMS'][$arItem['PROPERTIES']['TEAM']['VALUE']];
        }

    }

}
if (!empty($arParams['SECTION']['UF_PLAYER_MONTH'])) {
    $arResult['PLAYER'] = \Module\Project\Helpers\Utils::getPlayerByUF($arParams['IBLOCK_ID'], 'UF_PLAYER_MONTH', $arParams['SECTION']['UF_PLAYER_MONTH']);
    if (!empty($arResult['PLAYER']['PREVIEW_PICTURE']))
        $arResult['PLAYER']['PICTURE'] = CFile::GetPath($arResult['PLAYER']['PREVIEW_PICTURE']);
}