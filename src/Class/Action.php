<?php

namespace Abdur\RStream\Class;

class Action extends Assets
{
    public $rstream;
    public $shortcode;

    public function __construct()
    {
        parent::__construct();

        // class declaration 
        $this->rstream = new Rstream();
        $this->shortcode = new Shortcode();

        // take action for admin menu
        add_action('admin_menu', 'add_rstream_menu_in_admin');     

        // add player shortcode 
        add_shortcode('rstream_player','rstream_player');

        // load all request action
        $this->requestAction();
    }

    // request handler
    public function requestAction()
    {
        //action to customize the premium radio options
        if (isset($_REQUEST['action'])) {
            switch ($_REQUEST['action']) {
                case 'rstream_add_data':
                    add_action('admin_init', 'addVideos');
                    break;
                case 'rstream_edit':
                    add_action('admin_init', 'editVideo');
                    break;
                case 'rstream_table':
                    add_action('admin_init', 'videoTable');
                    break;
                case 'rstream_delete':
                    add_action('admin_init', 'deleteVideo');
                    break;
                default:
                    return true;
            }
        }
    }

    // page handler 
    public function pageHandler(){
        
    }

    
}