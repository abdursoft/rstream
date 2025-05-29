<?php

use Abdur\RStream\Class\Database;
use Abdur\RStream\Class\Rstream;
use Abdur\RStream\Class\Shortcode;
use Abdur\RStream\Class\Table;

define('RSTREAM_METHOD', $_SERVER['REQUEST_METHOD']);

// add admin menues
if (! function_exists('add_rstream_menu_in_admin')) {
    function add_rstream_menu_in_admin()
    {
        // Add main menu page
        add_menu_page(
            'RStream Configuration', // Page Title
            'RStream',               // Menu Title
            'manage_options',               // Capability
            'rstream',               // Slug
            'rstream_list',                 // Function to display content
            'dashicons-format-video',       // Icon
            11                              // Position
        );

        // Add sub-menu pages
        add_submenu_page(
            'rstream',
            'All videos',
            'All videos',
            'manage_options',
            'rstream', // Use the same slug as the main menu to prevent duplication
            'rstream_list'
        );

        add_submenu_page(
            'rstream',
            'New ad',
            'New video',
            'manage_options',
            'add-video',
            'add_new_video'
        );
    }
}

// create new podcast view
if (! function_exists('add_new_video')) {
    function add_new_video()
    {
        include_once RSTREAM_PLUGIN_DIR_PATH . "/src/views/stream/add.php";
    }
}

// rstream index view
if (! function_exists('rstream_list')) {
    function rstream_list()
    {
        include_once RSTREAM_PLUGIN_DIR_PATH . "/src/views/stream/index.php";
    }
}

// add new video
if (! function_exists('addVideos')) {
    function addVideos()
    {
        (new RSTREAM())->createVideo();
    }
}

// edit new video
if (! function_exists('editVideo')) {
    function editVideo()
    {
        (new RSTREAM())->createVideo();
    }
}

// get single video
if (! function_exists('singleVideo')) {
    function singleVideo()
    {
        echo json_encode([
            'status' => 'ok',
            'data'   => (new Rstream())->getRStream($_REQUEST['id']),
        ]);
        die;
    }
}

// get video for data table
if (! function_exists('videoTable')) {
    function videoTable()
    {
        echo json_encode([
            'status' => 'ok',
            'data'   => (new Table())->rstreamItemsTable(),
        ]);
        die;
    }
}

// delete video from table
if (! function_exists('deleteVideo')) {
    function deleteVideo()
    {
        return (new Rstream())->deleteRStream($_REQUEST['id']);
    }
}

// render tables
if (! function_exists('render_table')) {
    function render_table()
    {
        $db = new Database();
        $db->render();
    }
}

// destroy tables
if (! function_exists('destroy_table')) {
    function destroy_table()
    {
        $db = new Database();
        $db->destroy();
    }
}

// rstream video player shortcode
if (! function_exists('rstream_player')) {
    function rstream_player($atts)
    {
        $atts = shortcode_atts([
            'video_id' => '1',
        ], $atts);

        return (new Shortcode())->globalPlayer($atts['video_id']);
    }
}

// plugin installation hook
if (! function_exists('rstream_install_hook')) {
    function rstream_install_hook()
    {
        render_table();
    }
}

// plugin uninstallation hook 
if (! function_exists('rstream_uninstall_hook')) {
    function rstream_uninstall_hook()
    {
        destroy_table();
    }
}
