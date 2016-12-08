<?php
/**
 * Gravity Forms Modifications
 */

/* Styles
==============================================================================*/

/**
 * Load custom CSS
 */
function joe_upm_gravityforms_enqueue_styles() {

	$pluginbase = basename( __DIR__ );
	$handle     = JOE_UPM_PREFIX . '-' . $pluginbase;
	$deps       = array();

	// If Gravity Forms built-in styles are enabled
	if ( ! get_option( 'rg_gforms_disable_css' ) ) {

		$deps = array( 'gforms_reset_css', 'gforms_formsmain_css', 'gforms_ready_class_css', 'gforms_browsers_css' );

	}

	wp_register_style( $handle, plugin_dir_url( __FILE__ ) . 'css/' . $pluginbase . '-mods.css', $deps, JOE_UPM_VER );
	wp_enqueue_style( $handle );

}
add_action( 'wp_enqueue_scripts', 'joe_upm_gravityforms_enqueue_styles' );


/* Form Builder
==============================================================================*/

/**
 * Adds support for hiding the field label and sub-label.
 *
 * @link https://www.gravityhelp.com/documentation/article/gform_enable_field_label_visibility_settings/
 */
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );


/* Shortcodes
==============================================================================*/

/**
 * Extend Gravity Forms Shortcode: Entries Left
 *
 * Usage: [gravityforms action="entries_left" id="yourformid"]
 *
 * @link http://gravitywiz.com/2012/09/19/shortcode-display-number-of-entries-left/
 */

function joe_upm_gravityforms_shortcode_entries_left( $output, $atts ) {

	extract( shortcode_atts( array(
		'id'     => false,
		'format' => false // should be 'comma', 'decimal'
	), $atts ) );

	if( ! $id )
		return '';

	$form = RGFormsModel::get_form_meta( $id );
	if( ! rgar( $form, 'limitEntries' ) || ! rgar( $form, 'limitEntriesCount' ) )
		return '';

	$entry_count = RGFormsModel::get_lead_count( $form['id'], '', null, null, null, null, 'active' );
	$entries_left = rgar( $form, 'limitEntriesCount' ) - $entry_count;
	$output = $entries_left;

	if( $format ) {

		$format = $format == 'decimal' ? '.' : ',';
		$output = number_format( $entries_left, 0, false, $format );

	}

	return $entries_left > 0 ? $output : 0;

}
add_filter( 'gform_shortcode_entries_left', 'joe_upm_gravityforms_shortcode_entries_left', 10, 2 );

/**
 * Extend Gravity Forms Shortcode: Entry Count
 *
 * Usage: [gravityforms action="entry_count" id="yourformid"]
 *
 * @link http://gravitywiz.com/shortcode-display-number-entries-submitted/
 */

function joe_upm_gravityforms_shortcode_entry_count( $output, $atts ) {

	extract( shortcode_atts( array(
		'id'     => false,
		'status' => 'total', // accepts 'total', 'unread', 'starred', 'trash', 'spam'
		'format' => false, // should be 'comma', 'decimal'
		'offset' => '50' // how many to add to actual number
	), $atts ) );

	$valid_statuses = array( 'total', 'unread', 'starred', 'trash', 'spam' );

    if( ! $id || ! in_array( $status, $valid_statuses ) ) {

		return current_user_can( 'update_core' ) ? __( 'Invalid "id" (the form ID) or "status" (i.e. "total", "trash", etc.) parameter passed.' ) : '';

	}

	$counts = GFFormsModel::get_form_counts( $id );
	$output = rgar( $counts, $status ) + $offset;

	if( $format ) {

		$format = $format == 'decimal' ? '.' : ',';
		$output = number_format( $output, 0, false, $format );

	}

	return $output;

}
add_filter( 'gform_shortcode_entry_count', 'joe_upm_gravityforms_shortcode_entry_count', 10, 2 );


/* Address Modifiers
==============================================================================*/

/* State
------------------------------------------------------------------------------*/

/**
 * Evaluate input state
 */
function joe_upm_gravityforms_evaluate_state( $form_meta ) {

	foreach( $form_meta['fields'] as $field ) {

		if( $field['type'] == 'address' ) {

			foreach( $field['inputs'] as $input ) {

				if( $input['label'] == 'State / Province' ) {

					$state = $_POST['input_' . str_replace( '.', '_', $input['id'] )];
					$_POST['input_' . str_replace( '.', '_', $input['id'] )] = joe_upm_gravityforms_abbreviate_state( $state );

				}

			}

		}

	}

}
add_action( 'gform_pre_submission', 'joe_upm_gravityforms_evaluate_state' );

/**
 * Change input state name to state abbreviations
 */
function joe_upm_gravityforms_abbreviate_state( $state ) {

	if( strlen( $state ) == 2 ) {

		$newstate = $state;

	} else {

		$state = ucwords( strtolower( $state ) );

		switch( $state ) {

			case 'Alaska':
				$newstate = 'AK';
				break;
			case 'Alabama':
				$newstate = 'AL';
				break;
			case 'Arkansas':
				$newstate = 'AR';
				break;
			case 'Arizona':
				$newstate = 'AZ';
				break;
			case 'California':
				$newstate = 'CA';
				break;
			case 'Colorado':
				$newstate = 'CO';
				break;
			case 'Connecticut':
				$newstate = 'CT';
				break;
			case 'Delaware':
				$newstate = 'DE';
				break;
			case 'District of Columbia':
				$newstate = 'DC';
				break;
			case 'Florida':
				$newstate = 'FL';
				break;
			case 'Georgia':
				$newstate = 'GA';
				break;
			case 'Hawaii':
				$newstate = 'HI';
				break;
			case 'Iowa':
				$newstate = 'IA';
				break;
			case 'Idaho':
				$newstate = 'ID';
				break;
			case 'Illinois':
				$newstate = 'IL';
				break;
			case 'Indiana':
				$newstate = 'IN';
				break;
			case 'Kansas':
				$newstate = 'KS';
				break;
			case 'Kentucky':
				$newstate = 'KY';
				break;
			case 'Louisiana':
				$newstate = 'LA';
				break;
			case 'Massachusetts':
				$newstate = 'MA';
				break;
			case 'Maryland':
				$newstate = 'MD';
				break;
			case 'Maine':
				$newstate = 'ME';
				break;
			case 'Michigan':
				$newstate = 'MI';
				break;
			case 'Minnesota':
				$newstate = 'MN';
				break;
			case 'Missouri':
				$newstate = 'MO';
				break;
			case 'Mississippi':
				$newstate = 'MS';
				break;
			case 'Montana':
				$newstate = 'MT';
				break;
			case 'North Carolina':
				$newstate = 'NC';
				break;
			case 'North Dakota':
				$newstate = 'ND';
				break;
			case 'Nebraska':
				$newstate = 'NE';
				break;
			case 'New Hampshire':
				$newstate = 'NH';
				break;
			case 'New Jersey':
				$newstate = 'NJ';
				break;
			case 'New Mexico':
				$newstate = 'NM';
				break;
			case 'Nevada':
				$newstate = 'NV';
				break;
			case 'New York':
				$newstate = 'NY';
				break;
			case 'Ohio':
				$newstate = 'OH';
				break;
			case 'Oklahoma':
				$newstate = 'OK';
				break;
			case 'Oregon':
				$newstate = 'OR';
				break;
			case 'Pennsylvania':
				$newstate = 'PA';
				break;
			case 'Rhode Island':
				$newstate = 'RI';
				break;
			case 'South Carolina':
				$newstate = 'SC';
				break;
			case 'South Dakota':
				$newstate = 'SD';
				break;
			case 'Tennessee':
				$newstate = 'TN';
				break;
			case 'Texas':
				$newstate = 'TX';
				break;
			case 'Utah':
				$newstate = 'UT';
				break;
			case 'Virginia':
				$newstate = 'VA';
				break;
			case 'Vermont':
				$newstate = 'VT';
				break;
			case 'Washington':
				$newstate = 'WA';
				break;
			case 'Wisconsin':
				$newstate = 'WI';
				break;
			case 'West Virginia':
				$newstate = 'WV';
				break;
			case 'Wyoming':
				$newstate = 'WY';
				break;
			case 'Armed Forces Americas':
				$newstate = 'AA';
				break;
			case 'Armed Forces Europe':
				$newstate = 'AE';
				break;
			case 'Armed Forces Pacific':
				$newstate = 'AP';
				break;

		}

	}

	return $newstate;

}