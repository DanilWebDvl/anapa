<?php
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Error;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

/**
 * @var $APPLICATION CMain
 */

Loc::loadMessages(__FILE__);

class MediaMain extends \CBitrixComponent
{
    public $section_id;
    public $errors;

    public function onPrepareComponentParams($arParams)
    {
        $this->arParams = $arParams;

        $this->errors = new \Bitrix\Main\ErrorCollection();
        if (empty($this->arParams["IBLOCK_ID_PHOTO"]) || (int)$this->arParams["IBLOCK_ID_PHOTO"] <= 0)
            $this->errors->setError(new Error('Need iblock id photo'));
        if (empty($this->arParams["IBLOCK_ID_VIDEO"]) || (int)$this->arParams["IBLOCK_ID_VIDEO"] <= 0)
            $this->errors->setError(new Error('Need iblock id video'));

        return $arParams;
    }

    public function process()
    {
        $obSection = CIBlockSection::GetList(
            ['UF_DATE' => 'DESC'],
            ['ACTIVE' => 'Y', 'IBLOCK_ID' => $this->arParams["IBLOCK_ID_PHOTO"]],
            true,
            ['*', 'UF_*'],
            ['nTopCount' => 12]
        );
        while ($arSection = $obSection->GetNext()) {
            if (!empty($arSection['PICTURE'])) {
                $arSection['PICTURE'] = CFile::GetPath($arSection['PICTURE']);
            }
            $this->arResult['PHOTO'][] = $arSection;
        }

        $obElements = CIBlockElement::GetList(
            ['UF_DATE' => 'DESC'],
            ['ACTIVE' => 'Y', 'IBLOCK_ID' => $this->arParams["IBLOCK_ID_VIDEO"]],
            false,
            ['nTopCount' => 3],
            []
        );
        while ($obElement = $obElements->GetNextElement()) {
            $arEl = $obElement->GetFields();
            if (!empty($arEl['PREVIEW_PICTURE'])) {
                $arEl['PREVIEW_PICTURE'] = CFile::GetPath($arEl['PREVIEW_PICTURE']);
            }
            $arEl['PROPERTIES'] = $obElement->GetProperties();
            $this->arResult['VIDEO'][] = $arEl;
        }
    }

    public function format() {
        if (!empty($this->arResult['PHOTO'])) {
            for ($i = 0; $i < 3; $i++) {
                for ($y = 0; $y < 4; $y++) {
                    $index = $count + $y;

                    if (!empty($this->arResult['PHOTO'][$index])) {
                        $this->arResult['SLIDE'][$i]['PHOTO'][] = $this->arResult['PHOTO'][$index];
                    }

                }
                $count += count($this->arResult['SLIDE'][$i]['PHOTO']);
            }
        }

        if (!empty($this->arResult['VIDEO'])) {
            for ($i = 0; $i < 3; $i++) {
                if (!empty($this->arResult['VIDEO'][$i])) {
                    $this->arResult['SLIDE'][$i]['VIDEO'][] = $this->arResult['VIDEO'][$i];
                }
            }
        }

    }

    public function executeComponent()
    {
        if (!$this->errors->isEmpty()) {
            foreach ($this->errors as $error)
            {
                ShowError($error);
            }
            return false;
        }

        $this->process();
        $this->format();

        $this->includeComponentTemplate();
    }
}