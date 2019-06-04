<?php

defined('ABSPATH') or die('Access denied.');

/**
 * Class WpDataTablesGutenbergBlock
 *
 */
class WpDataTablesGutenbergBlock
{
    public static function registerBlockType()
    {

        wp_enqueue_script(
            'wpdatatables-gutenberg-block',
            WDT_ROOT_URL . 'assets/js/gutenberg/wpdatatables-gutenberg-block.js',
            array( 'wp-blocks', 'wp-components', 'wp-element', 'wp-editor')
        );

        wp_localize_script(
            'wpdatatables-gutenberg-block',
            'wpdatatables',
            array(
                'title' => 'wpDataTables Lite',
                'description' => __('Choose the table that you’ve just created in the dropdown below, and the shortcode will be inserted automatically. You are able to provide Export file name as well.','wpdatatables'),
                'data' => self::wdtGetAllTablesForGutenberg()
            )
        );

        register_block_type(
            'wpdatatables/wpdatatables-gutenberg-block',
            array('editor_script' => 'wpdatatables_gutenberg_block')
        );

    }

    public static function wdtGetAllTablesForGutenberg() {

        global $wpdb;
        $query = "SELECT id, title FROM {$wpdb->prefix}wpdatatables ORDER BY id";

        $allTables = $wpdb->get_results($query, ARRAY_A);

        foreach ($allTables as $table) {
            $returnTables[] = [
                'name' => $table['title'],
                'id' => $table['id'],
            ];

        }

        return $returnTables;
    }

    /**
     * Register WP Ajax actions.
     */
    public static function init()
    {
        if (is_admin() && function_exists('register_block_type')) {
            if (substr($_SERVER['PHP_SELF'], '-8') == 'post.php' ||
                substr($_SERVER['PHP_SELF'], '-12') == 'post-new.php'
            ) {

                if (self::isGutenbergActive()) {
                    add_action('init', array('WpDataTablesGutenbergBlock','registerBlockType'));
                }

            }
        }
    }

    /**
     * Check if Block Editor is active.
     *
     * @return bool
     */
    public static function isGutenbergActive()
    {
        // Gutenberg plugin is installed and activated.
        $gutenberg = !(false === has_filter('replace_editor', 'gutenberg_init'));

        // Block editor since 5.0.
        $block_editor = version_compare($GLOBALS['wp_version'], '5.0-beta', '>');

        if (!$gutenberg && !$block_editor) {
            return false;
        }

        if (self::isClassicEditorPluginActive()) {
            $editor_option = get_option('classic-editor-replace');
            $block_editor_active = array('no-replace', 'block');

            return in_array($editor_option, $block_editor_active, true);
        }

        return true;
    }

    /**
     * Check if Classic Editor plugin is active
     *
     * @return bool
     */
    public static function isClassicEditorPluginActive()
    {

        if (!function_exists('is_plugin_active')) {

            include_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        if (is_plugin_active('classic-editor/classic-editor.php')) {

            return true;
        }

        return false;
    }

}