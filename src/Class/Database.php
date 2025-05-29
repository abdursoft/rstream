<?php

namespace Abdur\RStream\Class;

class Database
{
    protected $table;
    protected $db;
    public function __construct()
    {
        global $wpdb;
        $this->table   = $wpdb->prefix . 'rstream_videos';
    }

    //function for generate rss-podcast in database
    private function rstream_table_generator()
    {
        global $wpdb;
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        if ($wpdb->get_var("SHOW TABLES LIKE '$this->table'") != $this->table) {

            $sql = 'CREATE TABLE ' . $this->table . ' (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `title` text DEFAULT NULL,
                `video` text DEFAULT NULL,
                `thumbnail` text DEFAULT NULL,
                `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
                PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4';
            dbDelta($sql);
        }
    }

    // destroy operation for rss-podcast tables
    private function removeRStreamTables()
    {
        global $wpdb;
        $wpdb->query('DROP TABLE IF EXISTS ' . $this->table);
    }

    // render rss-podcast tables 
    public function render()
    {
        $this->rstream_table_generator();
    }

    // destroy podcast tables 
    public function destroy()
    {
        $this->removeRStreamTables();
    }

    // check table data exists or not 
    public function checkTable($table, $query)
    {
        global $wpdb;
        return $wpdb->get_results($wpdb->prepare("SELECT * FROM $table WHERE $query"));
    }
}
