<?

namespace Module\Project\Parser;


class Api
{
    public static $baseUrl = 'https://volley.ru/api';
    public static $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IjEwMHZvbGxleXJ1IiwiaWF0IjoxNTE2MjM5MDIyfQ.8UN1YDUfohoTvTaKVxnn9OvIKd1CHH5iUfxtoedviXc';

    public static function sendRequest($url, $token, $queryParams = [])
    {
        $ch = curl_init();

        if (!empty($queryParams)) {
            $url .= '?' . http_build_query($queryParams);
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    //Получение списка соревнований
    public static function getCompetition($arParams)
    {
        return self::sendRequest(self::$baseUrl . '/competition', self::$token, $arParams);
    }

    //Получение результатов соревнований
    public static function getCompetitionResult($competition_id)
    {
        return self::sendRequest(self::$baseUrl . '/competitionResult', self::$token, ['competition_id' => $competition_id]);
    }

    //Получение списка игр Команды
    public static function getGame($team_id)
    {
        return self::sendRequest(self::$baseUrl . '/game', self::$token, ['team_id' => $team_id]);
    }

    //Получение информации об определенной игре по её ID
    public static function getGameId($gameId)
    {
        return self::sendRequest(self::$baseUrl . '/game/' . $gameId, self::$token);
    }

    //Получение информации о игроке по ID игрока
    public static function getPlayerId($playerId)
    {
        return self::sendRequest(self::$baseUrl . '/player/' . $playerId, self::$token);
    }
}
