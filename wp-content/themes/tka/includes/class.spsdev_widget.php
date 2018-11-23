<?php
class Spsdev_Widget extends WP_Widget {

	protected $fields = array();

	public function __construct( $id_base, $name, $widget_options = array(), $control_options = array() ) {
		
		parent::__construct(  $id_base, $name, $widget_options, $control_options );
		
	}

	protected function add_field($id, $args) {
		if(!isset($args['id']))
			$args['id'] = $id;
		$this->fields[$id] = $args;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//spsdev::debug($new_instance);die;
		if(!empty($this->fields)) {
			foreach ($this->fields as $id => $args) {
				switch ($args['type']) {
					case 'text':
						switch ($args['data_type']) {
							case 'number':
								$instance[$id] = (!empty($new_instance[$id])) ? intval( $new_instance[$id] ) : '';
								break;
							case 'decimal':
								$instance[$id] = (!empty($new_instance[$id])) ? floatval( $new_instance[$id] ) : '';
								break;
							case 'email':
								$instance[$id] = (!empty($new_instance[$id])) ? sanitize_email( $new_instance[$id] ) : '';
								break;
							case 'key':
								$instance[$id] = (!empty($new_instance[$id])) ? sanitize_key( $new_instance[$id] ) : '';
								break;
							case 'url':
								$instance[$id] = (!empty($new_instance[$id])) ? esc_url( $new_instance[$id] ) : '';
								break;
							default:
								$instance[$id] = (!empty($new_instance[$id])) ? sanitize_text_field( $new_instance[$id] ) : '';
								break;
						}
						break;
					case 'hidden':
						$instance[$id] = (!empty($new_instance[$id])) ? wp_kses_post( $new_instance[$id] ) : '';
						break;
					case 'textarea':
						$instance[$id] = (!empty($new_instance[$id])) ? wp_kses_post( $new_instance[$id] ) : '';
						break;
					case 'checkbox':
						$instance[$id] = (isset($new_instance[$id])) ? $args['cbvalue'] : '';
						break;
					case 'select':
						$instance[$id] = (!empty($new_instance[$id])) ? sanitize_text_field( $new_instance[$id] ) : '';
						break;
					case 'radio':
						$instance[$id] = (!empty($new_instance[$id])) ? sanitize_text_field( $new_instance[$id] ) : '';
						break;
					default:
						$instance[$id] = (!empty($new_instance[$id])) ? sanitize_text_field( $new_instance[$id] ) : '';
						break;
				}
			}
			
		}
		return $instance;
	}

	public function form( $instance ) {
		if(!empty($this->fields)) {
			foreach ($this->fields as $id => $args) {
				$callback = "widget_{$args['type']}_input";
				$this->$callback($instance, $args);
			}
			
		}
	}

	/**
	 * Widget Form Output a text input box.
	 *
	 */
	public function widget_text_input( $instance, $field ) {

		$field['placeholder']   = isset( $field['placeholder'] ) ? $field['placeholder'] : '';
		$field['class']         = isset( $field['class'] ) ? $field['class'] : 'short';
		$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
		$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
		if(isset( $instance[$field['id']] )) {
			$field['value'] = $instance[$field['id']];
		} else {
			$field['value'] = isset( $field['value'] ) ? $field['value'] : '';
		}
		$field['name']          = isset( $field['name'] ) ? $field['name'] : $this->get_field_name($field['id']);
		$field['type']          = isset( $field['type'] ) ? $field['type'] : 'text';
		$data_type              = empty( $field['data_type'] ) ? '' : $field['data_type'];

		switch ( $data_type ) {
			case 'number' :
				$field['class'] .= ' input_number';
				$field['value']  = intval( $field['value'] );
				break;
			case 'email' :
				$field['class'] .= ' input_email';
				$field['value']  = sanitize_email( $field['value'] );
				break;
			case 'decimal' :
				$field['class'] .= ' input_decimal';
				$field['value']  = floatval( $field['value'] );
				break;
			case 'url' :
				$field['class'] .= ' input_url';
				$field['value']  = esc_url( $field['value'] );
				break;
			case 'key' :
				$field['class'] .= ' input_key';
				$field['value']  = sanitize_key( $field['value'] );
				break;
			default :
				$field['class'] .= ' input_text';
				$field['value']  = sanitize_text_field( $field['value'] );
				break;
		}

		// Custom attribute handling
		$custom_attributes = array();

		if ( ! empty( $field['custom_attributes'] ) && is_array( $field['custom_attributes'] ) ) {

			foreach ( $field['custom_attributes'] as $attribute => $value ){
				$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $value ) . '"';
			}
		}

		echo '<p class="form-field ' . esc_attr( $this->get_field_id($field['id']) ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><label for="' . esc_attr( $this->get_field_id($field['id']) ) . '">' . esc_html( $field['label'] ) . '</label><input type="' . esc_attr( $field['type'] ) . '" class="' . esc_attr( $field['class'] ) . '" style="' . esc_attr( $field['style'] ) . '" name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $this->get_field_id($field['id']) ) . '" value="' . esc_attr( $field['value'] ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" ' . implode( ' ', $custom_attributes ) . ' /> ';

		if ( ! empty( $field['description'] ) ) {

			if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
				echo $field['description'];
			} else {
				echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
			}
		}
		echo '</p>';

	}

	/**
	 * Output a hidden input box.
	 *
	 * @param array $field
	 */
	public function widget_hidden_input( $instance, $field ) {

		if(isset( $instance[$field['id']] )) {
			$field['value'] = $instance[$field['id']];
		} else {
			$field['value'] = isset( $field['value'] ) ? $field['value'] : '';
		}
		$field['name']          = isset( $field['name'] ) ? $field['name'] : $this->get_field_name($field['id']);
		$field['class'] = isset( $field['class'] ) ? $field['class'] : '';

		echo '<input type="hidden" class="' . esc_attr( $field['class'] ) . '" name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $this->get_field_id($field['id']) ) . '" value="' . esc_attr( $field['value'] ) .  '" /> ';
	}

	/**
	 * Output a textarea input box.
	 *
	 * @param array $field
	 */
	public function widget_textarea_input( $instance, $field ) {
		
		$field['placeholder']   = isset( $field['placeholder'] ) ? $field['placeholder'] : '';
		$field['class']         = isset( $field['class'] ) ? $field['class'] : 'widefat';
		$field['cols']         = isset( $field['cols'] ) ? absint($field['cols']) : 20;
		$field['rows']         = isset( $field['rows'] ) ? absint($field['rows']) : 3;
		$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
		$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
		if(isset( $instance[$field['id']] )) {
			$field['value'] = $instance[$field['id']];
		} else {
			$field['value'] = isset( $field['value'] ) ? $field['value'] : '';
		}
		$field['name']          = isset( $field['name'] ) ? $field['name'] : $this->get_field_name($field['id']);

		// Custom attribute handling
		$custom_attributes = array();

		if ( ! empty( $field['custom_attributes'] ) && is_array( $field['custom_attributes'] ) ) {

			foreach ( $field['custom_attributes'] as $attribute => $value ){
				$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $value ) . '"';
			}
		}

		echo '<p class="form-field ' . esc_attr( $this->get_field_id($field['id']) ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><label for="' . esc_attr( $this->get_field_id($field['id']) ) . '">' . wp_kses_post( $field['label'] ) . '</label><textarea class="' . esc_attr( $field['class'] ) . '" style="' . esc_attr( $field['style'] ) . '"  name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $this->get_field_id($field['id']) ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" rows="'.$field['rows'].'" cols="'.$field['cols'].'" ' . implode( ' ', $custom_attributes ) . '>' . esc_textarea( $field['value'] ) . '</textarea> ';

		if ( ! empty( $field['description'] ) ) {

			if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
				echo $field['description'];
			} else {
				echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
			}
		}
		echo '</p>';
	}

	/**
	 * Output a checkbox input box.
	 *
	 * @param array $field
	 */
	public function widget_checkbox_input( $instance, $field ) {
		
		$field['class']         = isset( $field['class'] ) ? $field['class'] : 'checkbox';
		$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
		$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
		$field['cbvalue']       = isset( $field['cbvalue'] ) ? $field['cbvalue'] : 'on';
		if(isset( $instance[$field['id']] )) {
			$field['value'] = $instance[$field['id']];
		} else {
			$field['value'] = isset( $field['value'] ) ? $field['value'] : '';
		}
		$field['name']          = isset( $field['name'] ) ? $field['name'] : $this->get_field_name($field['id']);

		// Custom attribute handling
		$custom_attributes = array();

		if ( ! empty( $field['custom_attributes'] ) && is_array( $field['custom_attributes'] ) ) {

			foreach ( $field['custom_attributes'] as $attribute => $value ){
				$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $value ) . '"';
			}
		}
		
		echo '<p class="form-field ' . esc_attr( $this->get_field_id($field['id']) ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label> <input type="checkbox" class="' . esc_attr( $field['class'] ) . '" style="' . esc_attr( $field['style'] ) . '" name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $field['cbvalue'] ) . '" ' . checked( $field['value'], $field['cbvalue'], false ) . '  ' . implode( ' ', $custom_attributes ) . '/> ';

		if ( ! empty( $field['description'] ) ) {

			if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
				echo $field['description'];
			} else {
				echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
			}
		}

		echo '</p>';
	}

	/**
	 * Output a select input box.
	 *
	 * @param array $field
	 */
	public function widget_select_input( $instance, $field ) {

		$field['class']         = isset( $field['class'] ) ? $field['class'] : 'select short';
		$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
		$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
		if(isset( $instance[$field['id']] )) {
			$field['value'] = $instance[$field['id']];
		} else {
			$field['value'] = isset( $field['value'] ) ? $field['value'] : '';
		}
		$field['name']          = isset( $field['name'] ) ? $field['name'] : $this->get_field_name($field['id']);

		// Custom attribute handling
		$custom_attributes = array();

		if ( ! empty( $field['custom_attributes'] ) && is_array( $field['custom_attributes'] ) ) {

			foreach ( $field['custom_attributes'] as $attribute => $value ){
				$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $value ) . '"';
			}
		}

		echo '<p class="form-field ' . esc_attr( $this->get_field_id($field['id']) ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label><select id="' . esc_attr( $field['id'] ) . '" name="' . esc_attr( $field['name'] ) . '" class="' . esc_attr( $field['class'] ) . '" style="' . esc_attr( $field['style'] ) . '" ' . implode( ' ', $custom_attributes ) . '>';

		foreach ( $field['options'] as $key => $value ) {
			echo '<option value="' . esc_attr( $key ) . '" ' . selected( esc_attr( $field['value'] ), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
		}

		echo '</select> ';

		if ( ! empty( $field['description'] ) ) {

			if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
				echo $field['description'];
			} else {
				echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
			}
		}
		echo '</p>';
	}

	/**
	 * Output a radio input box.
	 *
	 * @param array $field
	 */
	public function widget_radio_input( $instance, $field ) {

		$field['class']         = isset( $field['class'] ) ? $field['class'] : 'select short';
		$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
		$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
		if(isset( $instance[$field['id']] )) {
			$field['value'] = $instance[$field['id']];
		} else {
			$field['value'] = isset( $field['value'] ) ? $field['value'] : '';
		}
		$field['name']          = isset( $field['name'] ) ? $field['name'] : $this->get_field_name($field['id']);

		echo '<fieldset class="form-field ' . esc_attr( $this->get_field_id($field['id']) ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><legend>' . wp_kses_post( $field['label'] ) . '</legend><ul class="wc-radios">';

		foreach ( $field['options'] as $key => $value ) {

			echo '<li><label><input
					name="' . esc_attr( $field['name'] ) . '"
					value="' . esc_attr( $key ) . '"
					type="radio"
					class="' . esc_attr( $field['class'] ) . '"
					style="' . esc_attr( $field['style'] ) . '"
					' . checked( esc_attr( $field['value'] ), esc_attr( $key ), false ) . '
					/> ' . esc_html( $value ) . '</label>
			</li>';
		}
		echo '</ul>';

		if ( ! empty( $field['description'] ) ) {

			if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
				echo $field['description'];
			} else {
				echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
			}
		}

		echo '</fieldset>';
	}

}
