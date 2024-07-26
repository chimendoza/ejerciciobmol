<?php

namespace app\components;
use yii\db\Connection;
use yii\base\Event;


class AppConnection extends Connection
{

    const EVENT_BEFORE_QUERY='EVENT_BEFORE_QUERY';
    const EVENT_AFTER_QUERY='EVENT_AFTER_QUERY';

    public static $thesql;
    public static $theparams;

    public function createCommand($sql = null, $params = [])
    {

        $event = new Event();

        self::$thesql=$sql;
        self::$theparams=$params;

        /*
        $event->data=[
            'sql' => $sql,
            'params' => $params,
        ];*/

        $this->trigger(self::EVENT_BEFORE_QUERY, $event);

        $command = parent::createCommand($sql, $params);



        $this->trigger(self::EVENT_AFTER_QUERY, $event);

        return $command;
    }



}
