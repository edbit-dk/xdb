<?php

class Team
{
	
	protected static $table = "teams";

    protected static $fields = [
       'id',
       'name'
    ];

    public static function fields()
    {
        return self::$fields;
    }

    public static function list()
    {
        global $db;
        return $db->get(self::$table)->results();
    }
}