<?
namespace Module\Project\Parser;

class SaveVolley {
    protected $arCalendar;
    protected $arTournament;

    public function __construct() {
        $obVolley = new Volley();
        $this->arCalendar = $obVolley->getCalendar();
        $this->arTournament = $obVolley->getScore();
    }
}
?>