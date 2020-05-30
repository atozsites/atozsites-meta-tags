<?php
/**
 * Removes all plugin data from postmeta and options tables on uninstall.
 * 
 * 
 */ 


defined('WP_UNINSTALL_PLUGIN') || die();


global $wpdb;

$tables_to_clean = [
    $wpdb->prefix.'postmeta' => 'meta_key',
    $wpdb->prefix.'termmeta' => 'meta_key',
    $wpdb->prefix.'usermeta' => 'meta_key',
    $wpdb->prefix.'options' => 'option_name'
];

require_once dirname(__FILE__) . '/includes/atozsites-meta-tag-list.php';

if (!empty($ATOZSITES_meta_tag_list) && is_array($ATOZSITES_meta_tag_list)){

    foreach( $ATOZSITES_meta_tag_list as $k => $v ){

        foreach( $v['fields'] as $field ){

            foreach ( $tables_to_clean as $table => $key ){

                $wpdb->delete( $table, array( $key => $field['variable'] ) );
                $wpdb->delete( $table, array( $key => 'ATOZSITES_frontpage_' . $field['variable'] ) );

            }

        }    

    }

}

delete_option( 'ATOZSITES_plugin_version' );
