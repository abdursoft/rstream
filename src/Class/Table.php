<?php

namespace Abdur\RStream\Class;

class Table extends Database
{
    protected $db;
    protected $event;
    public function __construct()
    {
        parent::__construct();
    }

    // rstream videos table 
    public function rstreamItemsTable(){
        global $wpdb;
        $results = $wpdb->get_results("SELECT * FROM $this->table ORDER BY id DESC");
        if (!empty($results)) {
            ob_start();
            foreach ($results as $item) {
            ?>
                <tr class="abs_video_item" id="rstream_video_<?= $item->id ?>">
                    <td><?= $item->id ?></td>
                    <td><?= $item->title ?></td>
                    <td><img src="<?= $item->thumbnail ?>" width="80" height="75" alt=""></td>
                    <td>[rstream_player video_id="<?= $item->id ?>"]</td>
                    <td>
                        <a href="?page=rstream&rstream_edit=<?= $item->id ?>" ><span class="fa fa-edit"></span></a>
                        <a href="javascript:void();" onclick="deleteRStreamVideo('<?= $item->id ?>')" style="margin-left:15px;" class="abs_delete_handle"><span class="fa fa-trash"></span></a>
                    </td>
                </tr>
            <?php
            }
            $abs_all = ob_get_clean();
            return $abs_all;
        }
    } 
}