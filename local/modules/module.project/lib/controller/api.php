<?php


namespace Module\Project\Controller;

use Bitrix\Main\Engine\Controller,
    Module\Project\FavoriteTable,
    Bitrix\Main\Loader;

class Api extends Controller
{
    public static $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IjEwMHZvbGxleXJ1IiwiaWF0IjoxNTE2MjM5MDIyfQ.8UN1YDUfohoTvTaKVxnn9OvIKd1CHH5iUfxtoedviXc';

    /**
     * @return array
     */
    public function configureActions()
    {
        return [
            'competition' => ['prefilters' => []],
            'game' => ['prefilters' => []],
            'competitionresults' => ['prefilters' => []],
        ];
    }

    public static function competitionAction()
    {
        $link = 'https://volley.ru/api/';
        $link .= 'competition';
        $strJson = self::getQuery($link);
        if($strJson){
            return json_decode($strJson);
        }
        return [];
    }
    public static function gameAction($competition_id,$team_id='')
    {
        //https://volley.ru/api/game?competition_id=01H7W0X1HT6BV10RKHMKXE0SZX&limit=1000
        //https://volley.ru/api/game?competition_id=XXXX&team_id=YYYY&limit=1000
        $link = 'https://volley.ru/api/';
        $link .= 'game';
        if($competition_id){
            $link .= '?competition_id=' . $competition_id;
        }
        if($team_id){
            $link .= '&team_id=' . $team_id;
        }
        $strJson = self::getQuery($link);
        if($strJson){
            return json_decode($strJson);
        }
        return [];
    }
    public static function competitionresultsAction($competition_id)
    {
        $link = 'https://volley.ru/api/competitionresults';
        if($competition_id){
            $link .= '?competition_id=' . $competition_id;
        }

        $strJson = self::getQuery($link);
        if($strJson){
            return json_decode($strJson);
        }
        return [];
    }


//'https://volley.ru/api/competition'
    public static function getQuery($CURLOPT_URL)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $CURLOPT_URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . self::$token,
                'Cookie: PHPSESSID=gtog2jom8sribcfvpdrgfhea08'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}