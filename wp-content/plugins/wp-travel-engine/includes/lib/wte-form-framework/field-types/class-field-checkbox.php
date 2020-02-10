<?php
/**
 * Input field class for checkbox.
 *
 * @since 2.2.6
 * @package WP Travel Engine
 */

class WP_Travel_Engine_Form_Field_Checkbox {

    /**
     * field object.
     *
     * @var obj
     */
	private $field;

    /**
     * Initialize checkbox class
     *
     * @param obj $field
     * @return void
     */
    function init( $field ) {

		$this->field = $field;

        return $this;
	}

    /**
     * Checkbox field
     *
     * @param boolean $display
     * @return void
     */
    function render( $display = true ) {

		$validations = '';

        if ( isset( $this->field['validations'] ) ) :

            foreach ( $this->field['validations'] as $key => $attr ) :

				$validations .= sprintf( '%s="%s"', $key, $attr );

            endforeach;

        endif;

		$output = '';

		if ( ! empty( $this->field['options'] ) ) {

            $index = 0;

			foreach ( $this->field['options'] as $key => $value ) {

				// Option Attributes.
                $option_attributes = '';

				if ( isset( $this->field['option_attributes'] ) && count( $this->field['option_attributes'] ) > 0 ) {

					foreach ( $this->field['option_attributes'] as $key1 => $attr ) {
						if ( ! is_array( $attr ) ) {
							$option_attributes .= sprintf( '%s="%s"', $key1, $attr );
						} else {
							foreach( $attr as $att ) {
								$option_attributes .= sprintf( '%s="%s"', $key1, $att );
							}
						}
					}
				}
				if ( is_array( $this->field['default'] ) && count( $this->field['default'] ) > 0 ) {

					$checked = ( in_array( $key, $this->field['default'] ) ) ? 'checked' : '';

				} else {

					$checked = ( $key === $this->field['default'] ) ? 'checked' : '';

				}

                    $error_coontainer_id     = sprintf( 'error_container-%s', $this->field['id'] );
					// $output .= sprintf( '<label class="radio-checkbox-label"><input type="checkbox" id="%s" name="%s[]" %s value="%s" %s %s />%s</label>', $this->field['id'], $this->field['name'],  $option_attributes, $key, $checked, $validations, $value );

					$output .= sprintf( '<div class="wpte-bf-checkbox-wrap">
					<input type="checkbox" name="%s[]" value="%s" id="%s" %s %s %s>
					<label for="%s">
						%s
					</label>
				</div>', $this->field['name'], $key, $this->field['id'], $option_attributes, $checked, $validations, $this->field['id'], $value );

				$index++;
            }

			$output .= sprintf( '<div id="%s"></div>', $error_coontainer_id );
		}

		if ( ! $display ) {
			return $output;
		}

		echo $output;
	}
}
