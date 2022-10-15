<?
namespace Module\Project\Parser;

use Bitrix\Main\Config\Option;
use Bitrix\Main\Type\DateTime;
use Module\Project\Basis;
use Module\Project\Helpers\Utils;

class SaveVolley extends Basis {
    protected $options;
    protected $arCalendar;
    protected $arTournament;

    public function __construct() {
        $this->getOptions();
        $this->showErrors();
    }

    public function parse() {
        $this->getArVolley();
        $this->updateTornament();
        $this->updateCalendar();

        \CIBlock::clearIBlockTagCache($this->options['IBLOCK_TOURNAMENT']);
        \CIBlock::clearIBlockTagCache($this->options['IBLOCK_CALENDAR']);
        $this->showErrors();
    }

    protected function getOptions() {
        $this->options = [
            'TEAM' => Option::get($this->module_id, 'TEAM_FOR_PARSER'),
            'SECTION_CALENDAR' => Option::get($this->module_id, 'SECTION_PARSER_CALENDAR'),
            'SECTION_TOURNAMENT' => Option::get($this->module_id, 'SECTION_PARSER_TOURNAMENT'),
            'IBLOCK_TEAMS' => Utils::getIdByCode('teamlist'),
            'IBLOCK_TOURNAMENT' => Utils::getIdByCode('tournament'),
            'IBLOCK_CALENDAR' => Utils::getIdByCode('calendar')
        ];

        if (empty($this->options['TEAM']))
            $this->addError("Need add team for parser from Volley.ru");
        if (empty($this->options['SECTION_CALENDAR']))
            $this->addError("Need add section calendar for parser from Volley.ru");
        if (empty($this->options['SECTION_TOURNAMENT']))
            $this->addError("Need add section tournament for parser from Volley.ru");

        $arTeam = \Module\Project\Helpers\Utils::getTeamById($this->options['TEAM']);
        if (empty($arTeam))
            $this->addError('Main team ID='. $this->options['TEAM'] .' is invalid');
        else
            $this->options['TEAM_NAME'] = $arTeam['PROPERTY_NAME_VOLLEY_VALUE'];
    }

    protected function getArVolley() {
        $obVolley = new Volley();
        if ($obVolley != false) {
            $obVolley->parse();
            $this->arCalendar = $obVolley->getCalendar();
            $this->arTournament = $obVolley->getScore();
        }
    }

    protected function updateTornament() {
        if (empty($this->arTournament)) {
            $this->addError("site volley.ru is empty");
            return 'site volley.ru is empty';
        }
        if (!$this->checkSection($this->options['IBLOCK_TOURNAMENT'], $this->options['SECTION_TOURNAMENT'])) {
            $this->addError("Parser: tournament section or iblock is invalid");
            $this->showErrors();
        }

        foreach ($this->arTournament as $arTour) { // Получить список всех команд для поиска в БД
            $arTeams[] = $arTour['NAME'];
        }

        if (!empty($arTeams)) {
            $arTeams = $this->getTeamsByName($arTeams);
            if (empty($arTeams)) {
                $this->addError("teams is empty");
                return "teams is empty";
            }

            $arTournaments = $this->getTournaments();
        }

        $obEl = new \CIBlockElement();

        foreach ($this->arTournament as $arTour) { // Захожу в каждую позицию с сайта Volley.ru
            unset($arProps);
            unset($arFields);
            $team_id = $arTeams[$arTour['NAME']]['ID'];

            $curTour = $arTournaments[$team_id];

            if (!empty($curTour)) {
                $arProps = [
                    'PLACE' => $arTour['NUM'],
                    'I' => $arTour['GAME'],
                    'B' => $arTour['WIN'],
                    'P' => $arTour['LOSE'],
                    'O' => $arTour['SCORE'],
                    'SET' => $arTour['TWO']
                ];
                \CIBlockElement::SetPropertyValuesEx($curTour['ID'], $curTour['IBLOCK_ID'], $arProps);

                $id_tours[] = $curTour['ID'];
            } else {
                $arFields = [
                    'NAME' => $arTour['NAME'],
                    'IBLOCK_SECTION_ID' => $this->options['SECTION_TOURNAMENT'],
                    'IBLOCK_ID' => $this->options['IBLOCK_TOURNAMENT'],
                    'PROPERTY_VALUES' => array(
                        'TEAM' => $team_id,
                        'PLACE' => $arTour['NUM'],
                        'I' => $arTour['GAME'],
                        'B' => $arTour['WIN'],
                        'P' => $arTour['LOSE'],
                        'O' => $arTour['SCORE'],
                        'SET' => $arTour['TWO']
                    ),
                    'ACTIVE' => 'Y',
                ];
                if ($id = $obEl->Add($arFields)) {
                    $id_tours[] = $id;
                } else {
                    $this->addError($obEl->LAST_ERROR);
                }
            }
        }

        if (!empty($id_tours)) { // deactivated all ID who is empty in volley.ru
            $obEls = \CIBlockElement::GetList(
                [],
                ['IBLOCK_ID' => $this->options['IBLOCK_TOURNAMENT'], 'IBLOCK_SECTION_ID' => $this->options['SECTION_TOURNAMENT'], 'ACTIVE' => 'Y', '!ID' => $id_tours],
                false,
                ['nTopCount' => 200],
                []
            );
            while ($arEl = $obEls->GetNext()) {
                $id_for_del[] = $arEl['ID'];
            }

            foreach ($id_for_del as $del) {
                $obEl->Update($del, ['ACTIVE' => 'N']);
            }
        }
    }

    protected function getTournaments() {

        $obEls = \CIBlockElement::GetList(
            [],
            ['IBLOCK_ID' => $this->options['IBLOCK_TOURNAMENT'], 'ACTIVE' => 'Y', 'SECTION_ID' => $this->options['SECTION_TOURNAMENT']],
            false,
            ['nTopCount' => 200],
            ['ID', 'NAME', 'PROPERTY_TEAM', 'IBLOCK_ID']
        );
        while ($arEl = $obEls->GetNext()) {
            $arEls[$arEl['PROPERTY_TEAM_VALUE']] = $arEl;
        }

        return $arEls;
    }

    protected function updateCalendar() {
        if (empty($this->arCalendar)) {
            $this->addError('site volley.ru is empty');
            return 'site volley.ru is empty';
        }
        if (!$this->checkSection($this->options['IBLOCK_CALENDAR'], $this->options['SECTION_CALENDAR'])) {
            $this->addError("Parser: calendar section or iblock is invalid");
            $this->showErrors();
        }

        $arCalendar = $this->formatCalendar();
        $arTeamNames = [];

        foreach ($arCalendar as $arTour) // Собрать все команды турнира и найти их аналоги в БД
            $arTeamNames = array_merge_recursive($arTour['TEAMS_LEFT'], $arTour['TEAMS_RIGHT'], $arTeamNames);
        $arTeamNames = array_unique($arTeamNames);
        $arTeams = $this->getTeamsByName($arTeamNames);
        $obEl = new \CIBlockElement();

        foreach ($arCalendar as $arTour) {
            // PLACE - Название тура
            // BATTLE - Лига

            foreach ($arTour['DATES'] as $key => $date) {
                unset($id);
                unset($time);
                unset($score);
                unset($other);
                $result = $arTour['RESULTS'][$key];
                $bool = preg_match('~\<b>([\s\S]+?)<\/b>~',$result, $arScore);

                if ($bool) {// Если есть счет, то достаем его и другие результаты
                    $score = str_replace(':', ' : ', $arScore[1]);
                    preg_match('~\\(([\s\S]+?)\)~',$result, $arOther);
                    $other = str_replace(', ', ' | ', $arOther[1]);
                    $other = str_replace(':', '-', $other);
                } else {
                    $time = $result;
                }

                $arTime = explode('.', $arTour['DATES'][$key]);
                $datetime  = $arTime[0].'.'.$arTime[1].'.20'.$arTime[2].' '.$time?:'00:00:00';
                $obDate = new DateTime($datetime);

                if (!empty($arTeams[$arTour['TEAMS_LEFT'][$key]]['ID']) && !empty($arTeams[$arTour['TEAMS_RIGHT'][$key]]['ID'])) {

                    $arFileds = [
                        'NAME' => $arTour['TEAMS_LEFT'][$key] . ' - ' . $arTour['TEAMS_RIGHT'][$key],
                        'IBLOCK_ID' => $this->options['IBLOCK_CALENDAR'],
                        'IBLOCK_SECTION_ID' => $this->options['SECTION_CALENDAR'],
                        'DATE' => $obDate->format('Y-m-d'),
                        'PROPERTY_VALUES' => array(
                            'PLACE' => $arTour['NAME'],
                            'BATTLE' => $arTour['LEAGUE'],
                            'DATE' => $obDate->format('d.m.Y H:i:s'),
                            'SYS_YEAR' => $obDate->format('Y'),
                            'SYS_MONTH' => $obDate->format('m'),
                            'SCORE' => $score,
                            'SET' => $other,
                            'TEAM_H' => $arTeams[$arTour['TEAMS_LEFT'][$key]]['ID'],
                            'TEAM_G' => $arTeams[$arTour['TEAMS_RIGHT'][$key]]['ID'],
                        )
                    ];

                    if ($arEl = $this->checkCalendarPart($arFileds)) { // Если такие данные уже есть
                        if (empty($time) || $time == null) {
                            $obCurDate = new DateTime($arEl['PROPERTY_DATE_VALUE']);
                            $arFileds['PROPERTY_VALUES']['DATE'] = $obCurDate->format('d.m.Y H:i:s');
                        }

                        \CIBlockElement::SetPropertyValuesEx($arEl['ID'], $arFileds['IBLOCK_ID'], $arFileds['PROPERTY_VALUES']);
                        $arIsset[] = $arEl['ID'];
                    } else {
                        if ($id = $obEl->Add($arFileds))
                            $arIsset[] = $id;
                        else
                            $this->addError($obEl->LAST_ERROR);
                    }

                } else {
                    $this->addError("Teams is empty: ".$arTour['TEAMS_LEFT'][$key].' and '.$arTour['TEAMS_RIGHT'][$key]);
                }

            }
        }

        if (!empty($arIsset)) { // deactivated all ID who is empty in volley.ru
            $obEls = \CIBlockElement::GetList(
                [],
                [
                    'IBLOCK_ID' => $this->options['IBLOCK_CALENDAR'],
                    'IBLOCK_SECTION_ID' => $this->options['SECTION_CALENDAR'],
                    'ACTIVE' => 'Y',
                    '!ID' => $arIsset,
                    '=PROPERTY_BATTLE' => htmlspecialchars($arTour['LEAGUE'])
                ],
                false,
                ['nTopCount' => 200],
                []
            );

            while ($arEl = $obEls->GetNext()) {
                $id_for_del[] = $arEl['ID'];
            }

            foreach ($id_for_del as $del)
                $obEl->Update($del, ['ACTIVE' => 'N']);
        }

    }

    /**
     * @param $arProps
     * @return array|false
     */
    protected function checkCalendarPart($arProps) {
        $obEl = \CIBlockElement::GetList(
            [],
            [
                'IBLOCK_ID' => $this->options['IBLOCK_CALENDAR'],
                'SECTION_ID' => $this->options['SECTION_CALENDAR'],
                'ACTIVE' => 'Y',
                '=PROPERTY_TEAM_H' => $arProps['PROPERTY_VALUES']['TEAM_H'],
                '=PROPERTY_TEAM_G' => $arProps['PROPERTY_VALUES']['TEAM_G'],
                array(
                    "LOGIC" => "AND",
                    '>=PROPERTY_DATE' => $arProps['DATE']." 00:00:00",
                    '<=PROPERTY_DATE' => $arProps['DATE']." 23:59:00"
                    )
            ],
            false,
            false,
            ['ID', 'IBLOCK_ID', 'PROPERTY_DATE']
        );
        while ($arEl = $obEl->GetNext()) {
            $arReturn = $arEl;
        }

        return $arReturn?:false;
    }

    /**
     * @return array
     */
    protected function formatCalendar() {
        $max_month = date('t.m.Y', strtotime('+1 month')).' 23:59:00';
        $maxDate = new DateTime($max_month);
        foreach ($this->arCalendar as $keyC => $arCalendar) { // Оставить в массиве только команду текущего сайта
            $arNeedTeamKey = [];

            $arTime = explode('.', $arCalendar['DATES'][0]);
            $datetime  = $arTime[0].'.'.$arTime[1].'.20'.$arTime[2].' 00:00:00';
            $obDate = new DateTime($datetime);

            if ($obDate->getTimestamp() >= $maxDate->getTimestamp()) continue;

            foreach ($arCalendar['TEAMS_LEFT'] as $key => $arTeamLeft)
                if ($arTeamLeft == $this->options['TEAM_NAME'])
                    $arNeedTeamKey[] = $key;
            foreach ($arCalendar['TEAMS_RIGHT'] as $key => $arTeamLeft)
                if ($arTeamLeft == $this->options['TEAM_NAME'])
                    $arNeedTeamKey[] = $key;
            $arNeedTeamKey = array_unique($arNeedTeamKey);

            $arFormatedCalendar = $this->delEmptyCalendar($arCalendar, ['TEAMS_LEFT', 'TEAMS_RIGHT', 'DATES', 'RESULTS'], $arNeedTeamKey);

            if ($arFormatedCalendar !== null) { // Удалены все игры где нет ключевой команды

                $arFormatedCalendar['NAME'] = $arCalendar['NAME'];
                $arFormatedCalendar['LEAGUE'] = $arCalendar['LEAGUE'];
                $arFinalCalendar[$keyC] = $arFormatedCalendar;
            }
        }

        return $arFinalCalendar;
    }

    /**
     * Удаление игр где нет ключевой команды
     * @param $arCalendar
     * @param $arKeys
     * @param $arNeedTeamKey
     * @return array
     */
    protected function delEmptyCalendar($arCalendar, $arKeys, $arNeedTeamKey) {
        $arFormatedCalendar = null;
        foreach ($arKeys as $keyCheck) {
            foreach ($arCalendar[$keyCheck] as $key => $val)
                if (in_array($key, $arNeedTeamKey))
                    $arFormatedCalendar[$keyCheck][] = $val;
        }

        return $arFormatedCalendar;
    }

    /**
     * @param $arName
     * @return array
     */
    protected function getTeamsByName($arName) {
        $obEls = \CIBlockElement::GetList(
            [],
            ['IBLOCK_ID' => $this->options['IBLOCK_TEAMS'], 'ACTIVE' => 'Y', '=PROPERTY_NAME_VOLLEY' => $arName],
            false,
            ['nTopCount' => 200],
            ['ID', 'NAME', 'PROPERTY_NAME_VOLLEY', 'IBLOCK_ID']
        );
        while ($arEl = $obEls->GetNext()) {
            $arEls[$arEl['PROPERTY_NAME_VOLLEY_VALUE']] = $arEl;
            $arFind[] = $arEl['PROPERTY_NAME_VOLLEY_VALUE'];
        }

        $arNewTeams = $this->createTeamByTeamsDifference($arName, $arFind);
        if ($arNewTeams != false)
            $arEls = array_merge($arNewTeams, $arEls);
        // Найти команды которых нет в БД но есть в удаленке и создать их в бд

        return $arEls;
    }

    /**
     * @param $arNedd
     * @param $arFind
     * @return array|false
     */
    protected function createTeamByTeamsDifference($arNedd, $arFind) {
        $arDiff = array_diff($arNedd, $arFind);
        $arNewEl = false;

        if (!empty($arDiff)) {
            $obEl = new \CIBlockElement();
            foreach ($arDiff as $diff) {
                $arFields = [
                    'NAME' => $diff,
                    'IBLOCK_ID' => $this->options['IBLOCK_TEAMS'],
                    'PROPERTY_VALUES' => [
                        'NAME_VOLLEY' => $diff
                    ],
                    'ACTIVE' => 'Y'
                ];
                if ($id = $obEl->Add($arFields)) {
                    $arFields['ID'] = $id;
                    $arFields['PROPERTY_NAME_VOLLEY_VALUE'] = $diff;
                    unset($arFields['PROPERTY_VALUES']);

                    $arNewEl[$diff] = $arFields;
                } else {
                    $this->addError('Error when created team '. $diff . '. Error: ' . $obEl->LAST_ERROR);
                }
            }
        }

        return $arNewEl;
    }

    /**
     * @param $iblock_id
     * @param $section_id
     * @return bool
     */
    protected function checkSection($iblock_id, $section_id) {
        $isset = false;
        $obSection = \CIBlockSection::GetList(
            [],
            ['IBLOCK_ID' => $iblock_id, 'ID' => $section_id],
            false,
            [],
            []
        );
        while ($arSection = $obSection->GetNext())
            $isset = true;

        return $isset;
    }
}
?>