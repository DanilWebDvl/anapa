<?
namespace Module\Project\Parser;

use Bitrix\Main\Config\Option;
use \Bitrix\Main\Web\DOM\Document;

class Volley {
    protected $module_id = 'module.project';
    protected $options;
    /**
     * @var Document
     */
    protected $page;
    protected $errors;
    protected $calendar;
    protected $score;

    protected function getOptions() {
        $this->options = [
            'ON_OFF' => Option::get($this->module_id, 'ON_OFF_PARSER', 'Y'),
            'LINK' => Option::get($this->module_id, 'LINK_PARSER'),
            'TEAM' => Option::get($this->module_id, 'TEAM_FOR_PARSER'),
            'SECTION_CALENDAR' => Option::get($this->module_id, 'SECTION_PARSER_CALENDAR'),
            'SECTION_TOURNAMENT' => Option::get($this->module_id, 'SECTION_PARSER_TOURNAMENT'),
        ];
        if (empty($this->options['LINK']))
            $this->addError("Parser link is empty");

    }

    protected function addError($string) {
        $this->errors[] = $string;
    }

    protected function showErrors() {
        if (!empty($this->errors)) {
            $errosStr = '';
            foreach ($this->errors as $error) {
                $errosStr .= $error."; \n ";
            }
            $this->submitAlert($errosStr);
            throw new \Exception($errosStr);
        }
    }

    protected function submitAlert($string) {

    }

    /**
     * @return bool
     */
    protected function hasError() {
        return !empty($this->errors);
    }

    public function getPage() {
        $http = new \Bitrix\Main\Web\HttpClient();
        $html = $http->get($this->options['LINK']);
        $status = $http->getStatus();
        $html = mb_convert_encoding($html, "UTF-8", "windows-1251");

        if ($html == null || $status != 200 || empty($html)) {
            $this->addError("Site is not available");
            $this->showErrors();
        } else {
            $this->page = new Document;
            $this->page->loadHTML($html);
        }
    }

    public function parsePage() {
        $this->parseResults();
        $this->parseCalendar();
    }

    public function parseResults() {
        $selector = 'table.result_table tr';
        $arCalendarTr = $this->page->querySelectorAll($selector);
        if (empty($arCalendarTr)) {
            $this->addError("table tournament is empty");
            $this->showErrors();
        }

        $count_teams = count($arCalendarTr) - 1;
        foreach($arCalendarTr as $nodeTr) { // Каждая tr это отдельная команда
            $arNodeTd = $nodeTr->querySelectorAll('td');
            $arNodeText = $nodeTr->querySelectorAll('.text');
            $colResFrom = 1 + $count_teams;
            if (empty($arNodeText)) continue;

            foreach ($arNodeTd as $key => $nodeTd) {
                $text = $nodeTd->getInnerHTML();

                switch ($key) {
                    case 0: // Даты игр
                        $text = str_replace('<span>', '<span> ', $text);
                        $arTournament['NAME'] = strip_tags($text);
                        break;
                    case 1: // Даты игр
                        $arTournament['NUM'] = strip_tags($text);
                        break;
                    case $colResFrom + 1: // Код игр (12 ключ)
                        $arTournament['GAME'] = strip_tags($text);
                        break;
                    case $colResFrom + 2: // Код игр (12 ключ)
                        $arTournament['WIN'] = strip_tags($text);
                        break;
                    case $colResFrom + 3: // Код игр (12 ключ)
                        $arTournament['LOSE'] = strip_tags($text);
                        break;
                    case $colResFrom + 4: // Код игр (12 ключ)
                        $arTournament['SCORE'] = strip_tags($text);
                        break;
                    case $colResFrom + 5: // Код игр (12 ключ)
                        $arTournament['TWO'] = strip_tags($text);
                        break;
                }
            }
            $arTournaments[$arTournament['NUM']] = $arTournament;
        }

        $this->score = $arTournaments;
    }

    public function parseCalendar() {
        $selector = 'table.calend_table tr';
        $arCalendarTr = $this->page->querySelectorAll($selector);
        if (empty($arCalendarTr)) {
            $this->addError("table calendar is empty");
            $this->showErrors();
        }

        foreach($arCalendarTr as $nodeTr) { // Каждая tr это отдельный тур
            $arNodeTd = $nodeTr->querySelectorAll('td');
            $arNodeText = $nodeTr->querySelectorAll('.text');
            unset($arTour);
            unset($need_team);
            if (empty($arNodeText)) continue;

            foreach ($arNodeTd as $key => $nodeTd) {

                $text = $nodeTd->getInnerHTML();
                switch ($key) {
                    case 0: // Даты игр
                        $arContent = $this->explodeColumn($text);
                        $arTour['DATES'] = $arContent;
                        break;
                    case 2: // Название тура
                        $arTour['NAME'] = trim(strip_tags($text));
                        break;
                    case 4: // Команды лево
                        $arContent = $this->explodeColumn($text);
                        $arTour['TEAMS_LEFT'] = $arContent;
                        break;
                    case 6: // Команды права
                        $arContent = $this->explodeColumn($text);
                        $arTour['TEAMS_RIGHT'] = $arContent;
                        break;
                    case 10: // Команды права
                        $arContent = $this->explodeColumn($text, false);
                        $arTour['RESULTS'] = $arContent;
                        break;
                }

            }
            if (!empty($arTour['RESULTS']))
                $arTours[$arTour['NAME']] = $arTour;
        }

        $this->calendar = $arTours;
    }

    /**
     * @param $string
     * @param true $strip_tag
     * @return array
     */
    protected function explodeColumn($string, $strip_tag = true) {
        $arDatas = explode("<br />", $string);
        $arContent = [];
        foreach ($arDatas as $arData) {
            if (empty($arData)) continue;
            if ($strip_tag)
                $arContent[] = trim(strip_tags($arData));
            else
                $arContent[] = $arData;
        }
        return $arContent;
    }

    public function __construct() {
        $this->getOptions();
        if ($this->options['ON_OFF'] != 'Y')
            return;

        $this->showErrors();
        $this->getPage();
        $this->parsePage();
    }

    public function getCalendar() {
        return $this->calendar;
    }

    public function getScore() {
        return $this->score;
    }
}
?>