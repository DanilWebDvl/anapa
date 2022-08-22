<?php


namespace Module\Project;

use Bitrix\Main\Entity;

class FavoriteTable extends Entity\DataManager
{
    const TYPES = array(
        "product" => "product",
    );
    const DEFAULT_TYPE = "product";

    public static function getTableName()
    {
        return "project_favorite";
    }

    public static function getConnectionName()
    {
        return "default";
    }

    /**
     * @return array|Entity\public
     * @throws \Exception
     */
    public static function getMap()
    {
        return array(
            new Entity\IntegerField("ID", array(
                "primary" => true,
                "autocomplete" => true,
            )),
            new Entity\IntegerField("ELEMENT_ID", array(
                "required" => true,
            )),
            new Entity\StringField("USER_IP", array(
                "required" => true,
            )),
        );
    }

    /**
     * @param bool $type
     * @param bool $userId
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     */
    public static function getByUser()
    {
        $UserIp = getIp();
        $arFavorite = array();
        if (!empty($UserIp)) {

            $arFilter = array(
                "=USER_IP" => $UserIp
            );

            $rsFavorite = self::getList(array(
                "select" => array("ELEMENT_ID"),
                "order" => array("ID" => "ASC"),
                "filter" => $arFilter
            ));
            while ($arRowFavorite = $rsFavorite->fetch()) {
                $arFavorite[] = $arRowFavorite["ELEMENT_ID"];

            }
        }
        return $arFavorite;
    }

    /**
     * @param $elementId
     * @param bool $userId
     * @return bool|string
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Exception
     */
    public static function toggleFavorite($elementId, $count)
    {
        \Bitrix\Main\Loader::includeModule('iblock');
        $UserIp = getIp();
        if ($UserIp) {
            $arRow = self::getList(array(
                "select" => array("ID"),
                "order" => array("ID" => "ASC"),
                "filter" => array(
                    "=USER_IP" => $UserIp,
                    "=ELEMENT_ID" => $elementId,
                )
            ))->fetch();
            if ($arRow["ID"]) {
                self::delete($arRow["ID"]);
                if($count<=0){
                    $count=0;
                    }else{
                    $count--;
                }
                \CIBlockElement::SetPropertyValuesEx($elementId, false, array("LIKE_COUNT" => array("VALUE"=>$count)));

                return "delete";
            } else {
                $count++;
                \CIBlockElement::SetPropertyValuesEx($elementId, false, array("LIKE_COUNT" => array("VALUE"=>$count)));
                self::add(array(
                    "USER_IP" => $UserIp,
                    "ELEMENT_ID" => $elementId,
                ));

                return "add";
            }
        } else {
            return false;
        }
    }
}