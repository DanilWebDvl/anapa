<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global \CMain $APPLICATION */
/** @global \CUser $USER */
/** @global \CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
if (!empty($arResult['SECTIONS'])) {
    usort($arResult['SECTIONS'], "\Module\Project\Helpers\Utils::sortArByKeyDate");
}

foreach ($arResult['SECTIONS'] as $key => $arItem) {
    $obres = CIBlockElement::GetList([], ['IBLOCK_ID' => $arParams['IBLOCK_ID'], 'SECTION_ID' => $arItem['ID']], false,
        false, ['ID','PROPERTY_MORE_PHOTO']);
    $countFoto = 0;
    while ($obElement = $obres->GetNextElement()) {
        $arFields = $obElement->GetFields();

        if (!empty($arFields['PROPERTY_MORE_PHOTO_VALUE'])) {

            $countFoto = $countFoto + count($arFields['PROPERTY_MORE_PHOTO_VALUE']);
        } else {
            $countFoto++;
        }
    }
    $arResult['SECTIONS'][$key]['ELEMENT_CNT'] = $countFoto;
}