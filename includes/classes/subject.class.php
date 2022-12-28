<?php

class Subject
{
	
	protected static $table = DB_PREFIX . "subjects";

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