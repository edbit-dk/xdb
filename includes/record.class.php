<?php

class Record
{
	
	protected static $table = "records";

    protected static $fields = [
       'id',
       'student_id',
       'teacher_id',
       'subject',
       'school_grade',
       'final_grade'
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

    public static function school($grade)
    {
        global $db;
        return $db->get(self::$table, [self::$fields[4], '=', $grade])->results();
    }

    public static function teacher($user_id)
    {
        global $db;

        return $db->get(self::$table, [self::$fields[2], '=', $user_id])->results();
       
    }

    public static function student($user_id)
    {
        global $db;

        return $db->get(self::$table, [self::$fields[1], '=', $user_id])->results();
       
    }
}