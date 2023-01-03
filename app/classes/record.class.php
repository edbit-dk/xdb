<?php

class Record
{
	
	protected static $table = DB_PREFIX . "records";

    protected static $fields = [
       'id',
       'user_id',
       'admin_id',
       'subject_id',
       'team_id',
       'winter_grade',
       'winter_feedback',
       'summer_grade',
       'summer_feedback'
    ];

    public static function fields()
    {
        return self::$fields;
    }

    public static function list($user_id = 0)
    {
        global $db;

        if(empty($user_id)) {
            return $db->get(self::$table);
        } else {
            return $db->get(self::$table, [self::$fields[1], '=', $user_id]);
        }
        
    }

    public static function data($user_id = 0, $admin_id = 0, $subject_id = 0, $team_id = 0)
    {
        global $db;
        $table = self::$table;
        $user = self::$fields[1];
        $admin = self::$fields[2];
        $subject = self::$fields[3];
        $team = self::$fields[4];
        
        return $db->query("SELECT * FROM {$table} WHERE {$user} = ? OR {$admin} = ? AND ({$subject} = ? AND {$team} = ?)", [$user_id, $admin_id, $subject_id, $team_id]);
    }

    public static function team($team_id)
    {
        global $db;
        return $db->get(self::$table, [self::$fields[4], '=', $team_id])->results();
    }

    public static function subject($subject_id)
    {
        global $db;
        return $db->get(self::$table, [self::$fields[3], '=', $subject_id])->results();
    }

    public static function create(array $data)
    {
        global $db;
        return $db->insert(self::$table, $data);
    }

    public static function update(array $data, array $id)
    {
        global $db;
        return $db->update(self::$table, $data, $id);
    }

    public static function admin($user_id)
    {
        global $db;

        return $db->get(self::$table, [self::$fields[2], '=', $user_id])->results();
       
    }

    public static function count($user_id)
    {
        global $db;

        return $db->get(self::$table, [self::$fields[1], '=', $user_id])->row_count();
       
    }

    public static function user($user_id, $team_id = 0, $subject_id = 0)
    {
        global $db;
        $table = self::$table;
        $user = self::$fields[1];
        $subject = self::$fields[3];
        $team = self::$fields[4];
        
        return $db->query("SELECT * FROM {$table} WHERE {$user} = ? AND ({$team} = ? AND {$subject} = ?)", [$user_id, $team_id, $subject_id]);
       
    }
}