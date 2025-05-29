<?php

namespace Abdur\RStream\Class;

class Assets
{

    public function __construct()
    {
        $this->rstreamAssets();
        add_action('admin_init',[$this,'rstreamAdminAssets']);
    }

    public function rstreamAssets()
    {
        wp_localize_script('rstream_table_script', 'ajaxurl', array('ajaxurl' => admin_url('admin-ajax.php')));
        add_action('wp_enqueue_scripts', function () {
            wp_enqueue_style(
                'rstream_table_boot_tailwindcss',
                RSTREAM_PLUGIN_URL . "/assets/css/output.css",
                [],
                RSTREAM_PLUGIN_VERSION
            );
        });
        
    }

    public function rstreamAdminAssets()
    {
        wp_enqueue_script('rstream_table_jquery_js', RSTREAM_PLUGIN_URL . "/assets/js/jquery.min.js", [], RSTREAM_PLUGIN_VERSION);
        wp_enqueue_script('rstream_validate_js', RSTREAM_PLUGIN_URL . "/assets/js/validate.js", [], RSTREAM_PLUGIN_VERSION);
        wp_enqueue_script('rstream_table_bootstrap_js', RSTREAM_PLUGIN_URL . "/assets/js/bootstrap.js", [], RSTREAM_PLUGIN_VERSION);
        wp_localize_script('rstream_table_script', 'ajaxurl', array('/ajaxurl' => admin_url('admin-ajax.php')));
        wp_enqueue_style('rstream_table_boot', RSTREAM_PLUGIN_URL . "/assets/css/abs_gallery.css", [], RSTREAM_PLUGIN_VERSION);
        wp_enqueue_style('fontAwesome', RSTREAM_PLUGIN_URL . "/assets/css/fws.css", [], RSTREAM_PLUGIN_VERSION);

        $this->rstreamTables();
    }

    public function rstreamTables()
    {
        wp_enqueue_script('rstream_table_jquery_js', RSTREAM_PLUGIN_URL . "/assets/js/jquery.min.js", RSTREAM_PLUGIN_VERSION);
        wp_enqueue_script('RSTREAM_table_data_table_js', RSTREAM_PLUGIN_URL . "/assets/js/data_table.js", [], RSTREAM_PLUGIN_VERSION);
        wp_enqueue_style('rstream_table_data_table_css', RSTREAM_PLUGIN_URL . "/assets/css/data_table.css", [], RSTREAM_PLUGIN_VERSION);
    }

    public function playerCSS()
    {
        ob_start();
?>

        <style>
            .pr-row {
                width: 100%;
                padding: 0;
                margin: 0;
                display: flex;
                justify-content: space-between;
                flex-direction: row;
            }

            .pr-col-8 {
                width: 66.56%;
                margin: 0;
            }

            .pr-col-7 {
                width: 58.26%;
                margin: 0;
            }

            .pr-col-5 {
                width: 41.16%;
                margin: 0;
            }

            .pr-col-4 {
                width: 33.3%;
                margin: 0;
            }

            .pr-video-buttons {
                width: 100%;
                min-height: 430px;
                border: 1px solid #ddd;
                border-radius: 14px;
                display: flex;
                padding: 0px 5px;
                justify-content: center;
                flex-direction: column;
            }

            .pr-video-buttons .rstream_table_button {
                min-width: 60%;
                width: auto;
                height: 60px;
                background: #fff;
                color: #333;
                font-size: 17px;
                font-family: inherit;
                cursor: pointer;
                border: 1px solid #ddd;
                outline: none;
                padding: 10px 15px;
                border-radius: 14px;
                display: flex;
                align-items: center;
                text-align: left;
                margin: 5px 20px;
            }

            .pr-video-buttons .rstream_table_button img {
                margin-right: 10px;
            }

            .pr-video-buttons .embedded_active_video_frame_button {
                background: #0000B0 !important;
                color: #fff;
            }

            .pr-video-buttons .embedded_active_video_button {
                background: #0000B0 !important;
                color: #fff;
            }

            .rstream_table_group_title {
                display: none;
            }

            .rstream_table_gorup_small_title {
                display: block;
                text-align: center;
            }

            .pr-row {
                min-height: 100px;
                display: flex;
                flex-wrap: wrap;
            }

            .embedded_radio_box,
            .embedded_radio {
                min-height: 130px;
                width: 100%;
            }

            .embedded_radio {
                width: 100%;
            }

            .pr-col-12 {
                width: 100%;
            }

            .embedded_event_banner_href {
                width: 100%;
                height: 80px;
                text-decoration: none;
                position: relative;
            }

            @media (max-width:767px) {
                .pr-row {
                    flex-direction: column;
                    padding: 0px 10px;
                }

                .pr-col-8 {
                    width: 100%;
                    margin: 0;
                }

                .pr-col-7 {
                    width: 100%;
                    margin: 0;
                }

                .pr-col-5 {
                    width: 100%;
                    margin: 0;
                }

                .pr-col-4 {
                    width: 100%;
                    margin: 10px 0px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    flex-direction: column;
                }

                .rstream_table_group_title {
                    display: block;
                    text-align: center;
                }

                .rstream_table_gorup_small_title {
                    display: none;
                }

                .pr-video-buttons {
                    min-height: 130px;
                }

                .pr-video-buttons .rstream_table_button {
                    min-width: 60%;
                    width: auto;
                    height: 40px;
                    font-size: 17px;
                    padding: 5px 8px;
                    border-radius: 14px;
                    display: flex;
                    align-items: center;
                    text-align: left;
                    margin: 5px 5px;
                }
            }
        </style>
<?php
        $css = ob_get_clean();
        echo $css;
    }
}
