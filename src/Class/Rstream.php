<?php

namespace Abdur\RStream\Class;

date_default_timezone_set("CET");

class Rstream extends Database
{
    protected $db;
    protected $event;
    public function __construct()
    {
        parent::__construct();
    }

    // create new RStream item
    public function createVideo()
    {
        global $wpdb;

        $param = isset($_REQUEST['param']) ? $_REQUEST['param'] : '';
        if (! empty($param)) {
            if ($param == 'rstream_option') {
                echo json_encode([
                    "Name"   => "rstream Stream",
                    "Author" => "abdursoft",
                ]);
                die();
            }

            if ($param == 'post_rstream_data') {
                try {
                    $exists = null;
                    if (isset($_REQUEST['id'])) {
                        $existsID = $_REQUEST['id'];
                        $exists   = $wpdb->get_row($wpdb->prepare("SELECT * FROM $this->table WHERE id='$existsID' ORDER BY id DESC LIMIT 1"));
                    }

                    if (! empty($exists)) {
                        $wpdb->update(
                            $this->table,
                            [
                                "title"     => $_REQUEST['title'],
                                "thumbnail" => $_REQUEST['poster'],
                                "video"     => $_REQUEST['video_url'],
                            ],
                            [
                                "id" => $_REQUEST['id'],
                            ]
                        );
                    } else {
                        $wpdb->insert(
                            $this->table,
                            [
                                "title"     => $_REQUEST['title'],
                                "thumbnail" => $_REQUEST['poster'],
                                "video"     => $_REQUEST['video_url'],
                            ]
                        );
                    }
                    $msg = ['status' => 'success', 'message' => 'Video data updated'];
                    echo json_encode($msg);
                    die;
                } catch (\Throwable $th) {
                    $msg = ['status' => 'fail', 'message' => $th->getMessage()];
                    echo json_encode($msg);
                    die;
                }
            } else {
                $msg = ['status' => 'fail', 'message' => "Post data not matched!"];
                echo json_encode($msg);
                die;
            }
        }
    }

    // get RStream items
    public function getRStream($id)
    {
        global $wpdb;
        $select = $wpdb->get_results($wpdb->prepare("SELECT * FROM $this->table WHERE id='$id'"));
        if (! empty($select)) {
            return (object) $select[0];
        } else {
            return false;
        }
    }

    // get RStream item list
    public function getRStreamList()
    {
        global $wpdb;
        $select = $wpdb->get_results($wpdb->prepare("SELECT * FROM $this->table"));
        if (! empty($select)) {
            return (object) $select;
        } else {
            return false;
        }
    }

    // Delete RStream by id
    public function deleteRStream($id)
    {
        global $wpdb;
        $select = $wpdb->query($wpdb->prepare("DELETE FROM $this->table WHERE id='$id'"));
        if (! empty($select)) {
            echo json_encode(['status' => 'success', 'message' => 'Video deleted successfully', 'RStreams' => (new Table)->rstreamItemsTable()]);
            die;
        } else {
            $msg = ['status' => 'fail', 'message' => 'RStream couldn\'t delete'];
            echo json_encode($msg);
            die;
        }
    }
}
