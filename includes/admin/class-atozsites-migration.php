<?php
/**
 * Moves all filled meta tag values from older plugin.
 * 
 * 
 */


defined('ABSPATH') || die();


class ATOZSITES_Migration{
    
    /**
     * Previous plugin's keys and their equivalent new keys.
     * 
     * @var array
     */
    private $old_and_new_keys = [
        'dp-metatags-general-description' => 'ATOZSITES_general_description', 
        'dp-metatags-general-keywords' => 'ATOZSITES_general_keywords',
        'dp-metatags-og-title' => 'ATOZSITES_og_title',
        'dp-metatags-og-description' => 'ATOZSITES_og_description',
        'dp-metatags-og-type' => 'ATOZSITES_og_type',
        'dp-metatags-og-audio' => 'ATOZSITES_og_audio',
        'dp-metatags-og-image' => 'ATOZSITES_og_image',
        'dp-metatags-og-video' => 'ATOZSITES_og_video',
        'dp-metatags-og-url' => 'ATOZSITES_og_url',
        'dp-metatags-twitter-card' => 'ATOZSITES_twitter_card',
        'dp-metatags-twitter-title' => 'ATOZSITES_twitter_title',
        'dp-metatags-twitter-description' => 'ATOZSITES_twitter_description',
        'dp-metatags-twitter-image' => 'ATOZSITES_twitter_image',
        'dp-metatags-custom' => 'ATOZSITES_custom'
    ];

    /**
     * Database tables and the fields to update.
     * 
     * @var array
     */
    private $tables_to_update = [
        'postmeta' => 'meta_key',
        'options' => 'option_name'
    ];



    /*
     * Starts the migration.
     */
    public function __construct(){
        $this->run();
    }



    /**
     * Removes deprecated records and replaces old keys with new ones.
     * 
     * @return bool 
     */
    public function run(){

        global $wpdb;

        foreach ( $this->tables_to_update as $table => $key ){

            // remove all title tag settings because we don't handle them anymore
            $wpdb->delete( $wpdb->prefix . $table, array( $key => 'dp-metatags-general-title' ) );

            // rename old keys to new one
            $result = true;
            $key_prefix = ( $table == 'options' ? 'ATOZSITES_frontpage_' : '' );
            foreach ($this->old_and_new_keys as $old => $new){

                if ( ! $wpdb->update( $wpdb->prefix . $table, array( $key => $key_prefix . $new ), array( $key => $old ) ) ){
                    $result = false;
                }

            }

        }


        return $result;

    }

}