<?php
/**
 * Customizer Import Export settings control
 *
 * @package Pofo-addons
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }  

if( class_exists('WP_Customize_Control') ) {

    if( ! class_exists( 'Pofo_Customize_Import_Export' ) ) {

        class Pofo_Customize_Import_Export extends WP_Customize_Control {

            public function enqueue() {

                $blank_file_error = __( 'Please select settings file', 'pofo-addons' );
                $valid_file_error = __( 'Please select valid file type', 'pofo-addons' );

                wp_enqueue_script( 'pofo-addons-customizer-import', POFO_ADDONS_ROOT_DIR.'/assets/js/admin/pofo-addons-customizer-import-control.js', array( 'jquery' ) );

                wp_localize_script( 'pofo-addons-customizer-import', 'pofoImport', array(
                    'customizeurl'   => admin_url( 'customize.php' ),
                    'exportnonce'    => wp_create_nonce( 'pofo-exporting' ),
                    'blankFileError' => $blank_file_error,
                    'validFileError' => $valid_file_error,
                ));
            }

            public function render_content() {
                ?>
                    <span class="customize-control-title">
                        <?php esc_html_e( 'Export', 'pofo-addons' ); ?>
                    </span>
                    <span class="description customize-control-description">
                        <?php esc_html_e( 'Click the below button for export the customization settings.', 'pofo-addons' ); ?>
                    </span>
                    <input type="button" class="button button-primary" name="pofo-export-button" value="<?php esc_attr_e( 'Export', 'pofo-addons' ); ?>" />
                    <hr class="pofo-import-separator"/>
                    <span class="customize-control-title">
                        <?php esc_html_e( 'Import', 'pofo-addons' ); ?>
                    </span>
                    <span class="description customize-control-description">
                        <?php esc_html_e( 'Upload a file for import customization settings.', 'pofo-addons' ); ?>
                    </span>
                    <div class="pofo-import-controls">
                        <input type="file" name="pofo-import-file" class="pofo-import-file" />
                        <?php wp_nonce_field( 'pofo-importing', 'pofo-import' ); ?>
                    </div>
                    <div class="pofo-uploading display-none"><?php esc_html_e( 'Importing...', 'pofo-addons' ); ?></div>
                    <input type="button" class="button button-primary" name="pofo-import-button" value="<?php esc_attr_e( 'Import', 'pofo-addons' ); ?>" />
                <?php
            }
        }
    }
}