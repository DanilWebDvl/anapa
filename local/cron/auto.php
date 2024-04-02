<?php
// подключение служебной части пролога
use Module\Project\Controller\Api;
$_SERVER["DOCUMENT_ROOT"] = '/home/bitrix/www';
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
global $DB;
//Получаем uid команды Динамо Анапы
$arTeamDinamoAnapa = Module\Project\Helpers\Utils::getTeamByCode('vk-dinamo-anapa-anapa');
$uidTeamDinamoAnapa = $arTeamDinamoAnapa['XML_ID'];

$arCalendar = Api::competitionAction();
foreach ($arCalendar as $item) {
    if ($item->sex == 0) {//Если игра Женская
        $obGames = Api::gameAction($item->ulid,
            $uidTeamDinamoAnapa);//Получаем информацию детально о Игре в которых участвует только команда Динамо-Анапы
        $isCreatEvent = count($obGames) > 0;//флаг создания события в Инфоблоке календаря
        if ($isCreatEvent) { // Если флаг == True

            $arFieldsEvent = [];

            //Пытаемся найти данное событие по ulid в инфоблоке Календарь по его xml_id
            $arInfoEvent = Module\Project\Helpers\Utils::getEventToXml_id($item->ulid);
            if ($arInfoEvent) {
                //Если нашел пропускаем шаг создания и переходим к шагу создания игр по командам
                //todo: Обновлем текущее событие???
                $idEvent = $arInfoEvent['ID'];

            } else {
                //иначе Создаем Раздел в Инфоблоке Календаря с Названием $item->title XML_ID Ставим $item->uid
                $arFieldsEvent['NAME'] = $item->title;
                $arFieldsEvent['XML_ID'] = $arFieldsEvent['CODE'] = $item->ulid;
                $newDate = date('d.m.Y', strtotime($item->endDate));
                $arFieldsEvent['UF_FINAL_DATE_SEASON'] = $newDate;
                $idEvent = Module\Project\Helpers\Utils::setEvent($arFieldsEvent);
            }

            if ($idEvent) {
                //Если есть Ид события обновим список игр
                foreach ($obGames as $itemGame) {

                    //Создаем игру
                    $arFieldsGame = [];
                    $arFieldsGame['NAME'] = $itemGame->TeamA_longtitle . '-' . $itemGame->TeamB_longtitle;
                    $arFieldsGame['XML_ID'] = $arFieldsGame['CODE'] = $itemGame->ulid;
                    $arFieldsGame['IBLOCK_SECTION_ID'] = $idEvent;
                    $arPropGame = [];
                    $arInfoTeamA = Module\Project\Helpers\Utils::getTeamByXmlId($itemGame->TeamA_ulid,$itemGame->TeamA_title?:0);
                    $arInfoTeamB = Module\Project\Helpers\Utils::getTeamByXmlId($itemGame->TeamB_ulid,$itemGame->TeamB_title?:0);
                    $arPropGame['TEAM_H'] = $arInfoTeamA['ID'];//*обезательное поле
                    $arPropGame['TEAM_H_SERVICE'] = $itemGame->TeamA_title?:0 . ' | ' . $itemGame->TeamA_ulid?:0;
                    $arPropGame['TEAM_G'] = $arInfoTeamB['ID'];//*обезательное поле
                    $arPropGame['TEAM_G_SERVICE'] = $itemGame->TeamB_title?:0 . ' | ' . $itemGame->TeamB_ulid?:0;

                    if($itemGame->gameDate_msk){
                        $newDateGame = date('d.m.Y H:i:s', strtotime($itemGame->gameDate_msk));
                    }else{
                        $newDateGame = date('d.m.Y H:i:s', strtotime($itemGame->gameDate_str));
                    }
                    $arPropGame['DATE'] = $newDateGame;//*обезательное поле

                    $arPropGame['PLACE'] = trim('г. ' . $itemGame->City_title . ' ' . $itemGame->arena_id); // ??? нужно понять что сюда записывать

                    $arPropGame['BATTLE'] = $item->title;
//\_::d($item->rounds[0]->title);
                    //Роунды == Партии
                    $strRound = '';
                    foreach ($itemGame->rounds as $arInfoRound) {
                        if ($strRound != '') {
                            $strRound .= '|';
                        }
                        $strRound .= $arInfoRound->teamAScore . ':' . $arInfoRound->teamBScore;
                    }
                    if ($strRound != '') {
                        $arPropGame['SET'] = $strRound;
                    }

                    $arPropGame['SCORE'] = $itemGame->teamAScore . ':' . $itemGame->teamBScore;

                    if($arPropGame['SCORE'] == '0:0' && $arPropGame['SET']==''){
                        $arPropGame['SCORE']='';
                    }
                    $arFieldsGame['PROPERTY_VALUES'] = $arPropGame;

                    //Проверяем есть ли такая игра в Данном Событие
                    if ($arInfoGame = Module\Project\Helpers\Utils::getGameToXml_id($itemGame->ulid)) {
                        //Есть, обновляем игру
                        Module\Project\Helpers\Utils::updateGame($arInfoGame['ID'], $arFieldsGame);
                    } else {
                        Module\Project\Helpers\Utils::setGame($arFieldsGame);
                    }
                }
            }


            //Работаем с турнирной таблицей
            //01H7W0X1HT6BV10RKHMKXE0SZX
            if ($arInfoTournament = Api::competitionresultsAction($item->ulid)) {
                $arKeyTournament = $arIdGroup = [];

                if ($arInfoEventTournament = Module\Project\Helpers\Utils::getEventToXml_id($item->ulid,
                    Module\Project\Helpers\Utils::getIdByCode('tournament'))) {
                    //$EnumUF_LIST_GROUP=Module\Project\Helpers\Utils::getEnumListProp2Section('GROUP',Module\Project\Helpers\Utils::getIdByCode('tournament'));
                } else {
                    //создаем его
                    $arFieldsEvent['NAME'] = $item->title;
                    $arFieldsEvent['XML_ID'] = $arFieldsEvent['CODE'] = $item->ulid;
                    $newDate = date('d.m.Y', strtotime($item->endDate));
                    $arFieldsEvent['UF_FINAL_DATE_SEASON'] = $newDate;
                    $arInfoEventTournament['ID'] = Module\Project\Helpers\Utils::setEvent($arFieldsEvent,
                        Module\Project\Helpers\Utils::getIdByCode('tournament'));
                }


                foreach ($arInfoTournament as $keyInfoTournament => $InfoTournament) {
                    foreach ($InfoTournament->grid as $keyGroup => $itemTournament) {//Группы
                        foreach ($itemTournament as $arTeam) {
                            if ($arTeam->team_title == 'Динамо-Анапа') {
                                $arKeyTournament[] = $keyInfoTournament;
                                $arIdGroup[$keyInfoTournament][] = $keyGroup;
                            }
                        }
                    }
                }

                foreach ($arKeyTournament as $idKeyTournament) {
                    foreach ($arIdGroup[$idKeyTournament] as $idKeyGroup) {
                        $itemTournament = $arInfoTournament->$idKeyTournament->grid[$idKeyGroup];
                        foreach ($itemTournament as $arTeam) {
                            $arNewFields = [];
                            $arNewFields['XML_ID'] = md5($arTeam->tid . $idKeyTournament);
                            $arNewFields['IBLOCK_SECTION_ID'] = $arInfoEventTournament['ID'];

                            $arNewFields['NAME'] = $arTeam->team_title;
                            $arPropTeam = [];
                            $arPropTeam['I'] = $arTeam->games_count;
                            $arPropTeam['B'] = $arTeam->wins_count;
                            $arPropTeam['P'] = $arTeam->loss_count;
                            $arPropTeam['O'] = $arTeam->games_scores;
                            $arPropTeam['SET'] = $arTeam->scores;
                            $arPropTeam['PLACE'] = $arTeam->num;
                            $arInfoTeam = Module\Project\Helpers\Utils::getTeamByXmlId($arTeam->tid,
                                $arTeam->team_title);
                            $arPropTeam['TEAM'] = $arInfoTeam['ID'];
                            $arNewFields['PROPERTY_VALUES'] = $arPropTeam;

                            //Пока просто создаемно
                            if ($arTmpInfoTournament = Module\Project\Helpers\Utils::getTournamentToXml_id($arNewFields['XML_ID'])) {
                                //Есть, обновляем игру
                                //TODO: нужно  ли это??? Скорее всего да, для обновления Этапов
                                Module\Project\Helpers\Utils::updateTournament($arTmpInfoTournament['ID'], $arNewFields);
                            } else {
                                Module\Project\Helpers\Utils::setTournament($arNewFields);
                            }
                        }
                    }
                }

            } else {

            }

        }
    }
}