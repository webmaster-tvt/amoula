<?php
/**
 * Customizer Control: Social Icons
 *
 * @package Pofo
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

if( class_exists('WP_Customize_Control') ) {

	if( ! class_exists( 'Pofo_Post_Customize_Social_Icons' ) ) {

		class Pofo_Post_Customize_Social_Icons extends WP_Customize_Control {

		    public $type = 'pofo_post_social_icons';

		    public function render_content() {

		    	$arr = array();
		        if ( empty( $this->choices ) ) {
		            return;
		        }
		        ?>

		        <?php if ( ! empty( $this->label ) ) : ?>
		            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		        <?php endif; ?>

		        <?php if ( ! empty( $this->description ) ) : ?>
		            <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
		        <?php endif; ?>

		        <?php $multi_values = ! is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>

		        <ul class="pofo-post-social-icon-list">
		        	
		            <?php 
		            	$i = $j = 0;
		            	foreach ( $this->choices as $value => $label ) : 
		            ?>
			                <li class="<?php echo $value ?>">
			                    <label>
			                    	<?php 
				                    	if( in_array( $value, $multi_values ) ) {
				                    		$j = array_search( $value, $multi_values );
				                    		$val_checked = $multi_values[$j+1];
				                    	} else {
				                    		$val_checked = '0';
				                    	}
			                    	?>
			                    	<input type="checkbox" <?php echo checked( $val_checked, '1' ); ?> id="post-social-icons-status-<?php echo esc_html($i) ?>" class="customize-control-checkbox-social" value="1">
			                        <input type="text" id="post-social-icons-<?php echo esc_html($i) ?>" class="customize-control-textbox-social <?php echo esc_html($value) ?>" value="<?php echo esc_html($label) ?>" data-value="<?php echo esc_html($value) ?>" data-label="<?php echo esc_html($label) ?>" readonly />
			                        <img src="<?php echo POFO_ADDONS_ROOT_DIR ?>/pofo-shortcodes/images/move-icon.png" class="icon-move" alt="<?php echo esc_attr__( 'Move', 'pofo-addons' ) ?>"> 
			                    </label>
			                </li>
			            <?php 
			            	$i++;
			            endforeach;
			            ?>
		        </ul>
		        <input type="hidden" class="pofo-post-social-icon-list" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
		    <?php }
		}
	}
}