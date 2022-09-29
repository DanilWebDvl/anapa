<?
namespace Module\Project\Handlers;

use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Type\Date;
use Bitrix\Main\Type\DateTime;

class Iblock
{
    public static function beforeSaveElement(&$arFields)
    {
        $obProp = \CIBlockProperty::GetList([], ['IBLOCK_ID' => $arFields['IBLOCK_ID']]);
        while ($arProp = $obProp->GetNext()) {
            switch ($arProp['CODE']) {
                case 'DATE':
                    $arProps['DATE'] = $arProp;
                    break;
                case 'SYS_YEAR':
                    $arProps['SYS_YEAR'] = $arProp;
                    break;
                case 'SYS_MONTH':
                    $arProps['SYS_MONTH'] = $arProp;
                    break;
            }
        }

        unset($arProp);
        if (empty($arProps['SYS_YEAR']) || empty($arProps['SYS_MONTH'])) return;

        if (!empty($arFields['PROPERTY_VALUES'][$arProps['DATE']['ID']])) {
            $value = end($arFields['PROPERTY_VALUES'][$arProps['DATE']['ID']])['VALUE'];
            $obDate = new DateTime($value);
            if ( !empty($arFields['ID'])) {
                $id_y = $arFields['ID'].':'.$arProps['SYS_YEAR']['ID'];
                $id_m = $arFields['ID'].':'.$arProps['SYS_MONTH']['ID'];
            } else {
                $id_m = $id_y = 'n0';
            }
            $arFields['PROPERTY_VALUES'][$arProps['SYS_YEAR']['ID']][$id_y]['VALUE'] = $obDate->format('Y');
            $arFields['PROPERTY_VALUES'][$arProps['SYS_MONTH']['ID']][$id_m]['VALUE'] = $obDate->format('m');
        }
    }

    public static function beforeSaveSection(&$arFields)
    {
        if (!empty($arFields['UF_DATE']) && isset($arFields['UF_SYS_YEAR'])) {
            $obDate = new Date($arFields['UF_DATE']);
            $arFields['UF_SYS_YEAR'] = $obDate->format('Y');
            $arFields['UF_SYS_MONTH'] = $obDate->format('m');
        }
    }
}
?>