<?php namespace WPDC_Learndash\Admin\Metabox;

/**
 * Program ID Metabox
 *
 * @package     WPDC_Learndash\Admin\Metabox
 * @since       2.0.0
 * @author      WPDevelopersClub and hellofromTonya
 * @link        https://wpdevelopersclub.com/
 * @license     GNU General Public License 2.0+
 */

return array(
    'view' => WPDC_LEARNDASH_PLUGIN_DIR . 'src/views/admin/metabox-program-id.php',
    'program_id_meta_key' => '_wpdc_program_id',
    'save_post_priority' => '99',
    /****************************
     * Meta config parameters
     ****************************/
    'meta_name' => 'devschool_program_id',
    'meta_single' => array(
        '_wpdc_program_id' => array(
            'default' => '',
            'sanitize' => 'strip_tags',
        ),
    ),
    'meta_array' => array(),
    /****************************
     * Metabox config parameters
     ****************************/

    'nonce_action' => 'devschool_program_id_save',
    'nonce_name' => 'devschool_program_id_nonce',
    'id' => 'inpost_devschool_program_id_metabox',
    'title' => __('Program', 'wpdc'),
    'screen' => array('sfwd-courses'),
    'context' => 'side',
    'priority' => 'high',
    /***************
     * Extras
     **************/

    'options_query_args' => array(
        'posts_per_page' => -1,
        'post_type' => array('wpdc_program'),
        'order' => 'ASC',
        'orderby' => 'meta_value',
        'meta_key' => '_wpdc_program_code',
    ),
    'options_html_pattern' => '<option value="%d"%s>%s</option>',
    'program_code_meta_key' => '_wpdc_program_code',
);