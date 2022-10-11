<?php

use Bitrix\Main\Config\Option;
use Bitrix\Main\HttpApplication;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

global $APPLICATION, $USER;
if (!$USER->CanDoOperation('edit_other_settings')) {
    $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));
}

$module_id = 'module.project'; //обязательно, иначе права доступа не работают!

Loc::loadMessages($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/options.php");
Loc::loadMessages(__FILE__);

if ($APPLICATION->GetGroupRight($module_id) < "F") {
    $APPLICATION->AuthForm(Loc::getMessage("ACCESS_DENIED"));
}

Loader::includeModule($module_id);
Loader::includeModule('iblock');

$request = HttpApplication::getInstance()->getContext()->getRequest();
$iblock_calendar = Module\Project\Helpers\Utils::getIdByCode('calendar');
$iblock_tournament = Module\Project\Helpers\Utils::getIdByCode('tournament');
#Описание опций
$obCalendar = CIBlockSection::GetList(
    [],
    [
        'IBLOCK_ID' => $iblock_calendar,
        'ACTIVE' => 'Y',
    ],
    false,
    [],
    [],
);
while ($arCalendar = $obCalendar->GetNext())
    $arCalendars[$arCalendar['ID']] = $arCalendar['NAME'];

$obTournament = CIBlockSection::GetList(
    [],
    [
        'IBLOCK_ID' => $iblock_tournament,
        'ACTIVE' => 'Y',
    ],
    false,
    [],
    [],
);
while ($arTournament = $obTournament->GetNext())
    $arTournaments[$arTournament['ID']] = $arTournament['NAME'];

$obTeams = CIBlockElement::GetList(
    [],
    ['IBLOCK_ID' => Module\Project\Helpers\Utils::getIdByCode('teamlist'), 'ACTIVE' => 'Y'],
    false,
    false,
    []
);
while ($arTeam = $obTeams->GetNext()) {
    $arTeams[$arTeam['ID']] = $arTeam['NAME'];
}

$arIblockList = [];
$res = CIBlock::GetList(['SORT' => 'ASC'], ['ACTIVE' => 'Y']);
while ($item = $res->Fetch()) {
    $arIblockList[$item['ID']] = $item['NAME'];
}
$aTabs[] = array(
    'DIV' => 'edit1',
    'TAB' => Loc::getMessage('OPTIONS_TITLE_MAIN'),
    'ICON' => 'main_settings',
    'OPTIONS' => array(
        array(
            'SOCIAL_VK',
            Loc::getMessage('SOCIAL_VK'),
            '',
            array('text', 90),
        ),
        array(
            'SOCIAL_TELEGA',
            Loc::getMessage('SOCIAL_TELEGA'),
            '',
            array('text', 90),
        ),
        array(
            'SOCIAL_YOUTUBE',
            Loc::getMessage('SOCIAL_YOUTUBE'),
            '',
            array('text', 90),
        ),
        array(
            'FOOTER_1',
            Loc::getMessage('FOOTER_1'),
            '',
            array('text', 90),
        ),
        array(
            'FOOTER_2',
            Loc::getMessage('FOOTER_2'),
            '',
            array('text', 90),
        ),
        array(
            'FOOTER_PHONE',
            Loc::getMessage('FOOTER_PHONE'),
            '',
            array('text', 90),
        ),
        array(
            'FOOTER_EMAIL',
            Loc::getMessage('FOOTER_EMAIL'),
            '',
            array('text', 90),
        )
    ),
);
$aTabs[] = array(
    'DIV' => 'edit2',
    'TAB' => Loc::getMessage('PARSER_TITLE'),
    'TITLE' => Loc::getMessage('PARSER_TITLE'),
    "OPTIONS" => array(
        [
            'ON_OFF_PARSER',
            Loc::getMessage('ON_OFF_PARSER'),
            '',
            array('checkbox', 'Y')
        ],
        [
            'LINK_PARSER',
            Loc::getMessage('LINK_PARSER'),
            '',
            array('text')
        ],
        [
            'TEAM_FOR_PARSER',
            Loc::getMessage('TEAM_FOR_PARSER'),
            '',
            array('selectbox', $arTeams)
        ],
        [
            'SECTION_PARSER_CALENDAR',
            Loc::getMessage('SECTION_PARSER_CALENDAR'),
            '',
            array('selectbox', $arCalendars)
        ],
        [
            'SECTION_PARSER_TOURNAMENT',
            Loc::getMessage('SECTION_PARSER_TOURNAMENT'),
            '',
            array('selectbox', $arTournaments)
        ],
    ),
);
$aTabs[] = array(
    'DIV' => 'edit3',
    'TAB' => Loc::getMessage('MAIN_TAB_RIGHTS'),
    'TITLE' => Loc::getMessage('MAIN_TAB_TITLE_RIGHTS'),
);
#Сохранение
if ($request->isPost() && $request['Update'] && check_bitrix_sessid()) {

    foreach ($aTabs as $aTab) {
        //Или можно использовать __AdmSettingsSaveOptions($MODULE_ID, $arOptions);
        foreach ($aTab['OPTIONS'] as $arOption) {
            if (!is_array($arOption)) //Строка с подсветкой. Используется для разделения настроек в одной вкладке
            {
                continue;
            }

            if ($arOption['note']) //Уведомление с подсветкой
            {
                continue;
            }

            //Или __AdmSettingsSaveOption($MODULE_ID, $arOption);
            $optionName = $arOption[0];

            $optionValue = $request->getPost($optionName);

            if ($arOption[3][0] === 'checkbox' && $optionValue !== "Y") {
                $optionValue = 'N';
            }

            Option::set($module_id, $optionName, is_array($optionValue) ? implode(',', $optionValue) : $optionValue);

        }
    }
}


#Визуальный вывод

$tabControl = new CAdminTabControl('tabControl', $aTabs);

?>
<? $tabControl->Begin(); ?>
<form method='post'
      action='<?php echo $APPLICATION->GetCurPage() ?>?mid=<?= htmlspecialcharsbx($mid) ?>&lang=<?= LANG ?>'
      name='module_project_settings'>
    <?= bitrix_sessid_post() ?>

    <?php foreach ($aTabs as $aTab) {
        if ($aTab['OPTIONS']) {
            $tabControl->BeginNextTab();
            __AdmSettingsDrawList($module_id, $aTab['OPTIONS']);
        }
    } ?>

    <?php
    $tabControl->BeginNextTab();

    require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/admin/group_rights.php");

    $tabControl->Buttons(); ?>

    <input type="submit" name="Update" value="<?php echo GetMessage('MAIN_SAVE') ?>">
    <input type="reset" name="reset" value="<?php echo GetMessage('MAIN_RESET') ?>">
    <input type="hidden" name="Update" value="Y"/>

</form>
<?php $tabControl->End(); ?>

