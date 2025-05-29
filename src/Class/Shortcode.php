<?php

namespace Abdur\RStream\Class;

class Shortcode
{
    public $rstream;

    public function __construct()
    {
        $this->rstream = new Rstream();
    }


    // global player setup
    public function globalPlayer($id)
    {
        ob_start();
        echo $this->player($id);
        return ob_get_clean();
    }

    // rstream player
    public function player($id)
    {
        $stream = (new Rstream)->getRStream($id);
        ob_start();
        ?>
            <div id="player_<?= $id ?? '' ?>"></div>
            <h3><?= $stream->title ?? ''; ?></h3>
            <script src="<?= RSTREAM_PLUGIN_URL ?>/assets/js/player.js"></script>
            <script>
                new abdurSoft({
                    id: "player_<?= $id ?? '' ?>",
                    poster: "<?= $stream->thumbnail ?? '' ?>",
                    file: "<?= $stream->video ?? '' ?>"
                });
            </script>
        <?php
        return ob_get_clean();
    }
}
