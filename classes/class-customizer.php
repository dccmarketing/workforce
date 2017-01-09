<?php

/**
 * Workforce Customizer
 *
 * Contains methods for customizing the theme customization screen.
 *
 * @link 			https://codex.wordpress.org/Theme_Customization_API
 * @since 			1.0.0
 * @package 		Workforce
 * @subpackage 		Workforce/classes
 */
class workforce_Customizer {

	/**
	 * Constructor
	 */
	public function __construct() {}

	/**
	 * Registers all the WordPress hooks and filters for this class.
	 */
	public function hooks() {

		add_action( 'customize_register', 	array( $this, 'register_panels' ) );
		add_action( 'customize_register', 	array( $this, 'register_sections' ) );
		add_action( 'customize_register', 	array( $this, 'register_fields' ) );
		add_action( 'wp_head', 				array( $this, 'header_output' ) );
		//add_action( 'customize_register', 	array( $this, 'load_customize_controls' ), 0 );

	} // hooks()

	/**
	 * Registers custom panels for the Customizer
	 *
	 * @hooked 		customize_register
	 * @see			add_action( 'customize_register', $func )
	 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since 		1.0.0
	 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	 */
	public function register_panels( $wp_customize ) {

		// Register panels here

	} // register_panels()

	/**
	 * Registers custom sections for the Customizer
	 *
	 * Existing sections:
	 *
	 * Slug 				Priority 		Title
	 *
	 * title_tagline 		20 				Site Identity
	 * colors 				40				Colors
	 * header_image 		60				Header Image
	 * background_image 	80				Background Image
	 * nav_menus			100 			Navigation
	 * widgets 				110 			Widgets
	 * static_front_page 	120 			Static Front Page
	 * default 				160 			all others
	 *
	 * @hooked 		customize_register
	 * @see			add_action( 'customize_register', $func )
	 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since 		1.0.0
	 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	 */
	public function register_sections( $wp_customize ) {

		// Tablet Menu Section
		$wp_customize->add_section( 'tablet_menu',
			array(
				'active_callback' 	=> '',
				'capability'  		=> 'edit_theme_options',
				'description'  		=> esc_html__( '', 'workforce' ),
				'panel' 			=> 'nav_menus',
				'priority'  		=> 10,
				'theme_supports'  	=> '',
				'title'  			=> esc_html__( 'Tablet Menu Style', 'workforce' ),
			)
		);
		
		// Images Section
		$wp_customize->add_section( 'images',
			array(
				'active_callback' 	=> '',
				'capability'  		=> 'edit_theme_options',
				'description'  		=> esc_html__( '', 'workforce' ),
				'panel' 			=> '',
				'priority'  		=> 10,
				'theme_supports'  	=> '',
				'title'  			=> esc_html__( 'Images', 'workforce' ),
			)
		);
		
		// Footer Section
		$wp_customize->add_section( 'footer',
			array(
				'capability' 	=> 'edit_theme_options',
				'description' 	=> esc_html__( '', 'workforce' ),
				'panel' 		=> 'theme_options',
				'priority' 		=> 10,
				'title' 		=> esc_html__( 'Footer', 'workforce' )
			)
		);

	} // register_sections()

	/**
	 * Registers controls/fields for the Customizer
	 *
	 * Note: To enable instant preview, we have to actually write a bit of custom
	 * javascript. See live_preview() for more.
	 *
	 * Note: To use active_callbacks, don't add these to the selecting control, it apepars these conflict:
	 * 		'transport' => 'postMessage'
	 * 		$wp_customize->get_setting( 'field_name' )->transport = 'postMessage';
	 *
	 * @hooked 		customize_register
	 * @see			add_action( 'customize_register', $func )
	 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since 		1.0.0
	 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	 */
	public function register_fields( $wp_customize ) {

		// Enable live preview JS for default fields
		$wp_customize->get_setting( 'blogname' )->transport 		= 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport 	= 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';



		// Site Identity Section Fields

		// Google Tag Manager ID Field
		$wp_customize->add_setting(
			'tag_manager_id',
			array(
				'capability' 		=> 'edit_theme_options',
				'default'  			=> '',
				'sanitize_callback' => 'sanitize_text_field',
				'transport' 		=> 'postMessage',
				'type' 				=> 'theme_mod'
			)
		);
		$wp_customize->add_control(
			'tag_manager_id',
			array(
				'active_callback' 	=> '',
				'description' 		=> esc_html__( 'Enter the Google Tag Manager container ID.', 'workforce' ),
				'label'  			=> esc_html__( 'Google Tag Manager ID', 'workforce' ),
				'priority' 			=> 10,
				'section'  			=> 'title_tagline',
				'settings' 			=> 'tag_manager_id',
				'type' 				=> 'text'
			)
		);
		$wp_customize->get_setting( 'tag_manager_id' )->transport = 'postMessage';


		// Tablet Menu Field
		$wp_customize->add_setting(
			'tablet_menu',
			array(
				'capability' 		=> 'edit_theme_options',
				'default'  			=> '',
				'sanitize_callback' => 'sanitize_text_field',
				'transport' 		=> 'postMessage',
				'type' 				=> 'theme_mod'
			)
		);
		$wp_customize->add_control(
			'tablet_menu',
			array(
				'active_callback' 	=> '',
				'choices' 			=> array(
					'tablet-slide-ontop-from-left' 		=> esc_html__( 'Slide On Top from Left', 'workforce' ),
					'tablet-slide-ontop-from-right' 	=> esc_html__( 'Slide On Top from Right', 'workforce' ),
					'tablet-slide-ontop-from-top' 		=> esc_html__( 'Slide On Top from Top', 'workforce' ),
					'tablet-slide-ontop-from-bottom' 	=> esc_html__( 'Slide On Top from Bottom', 'workforce' ),
					'tablet-push-from-left' 			=> esc_html__( 'Push In from Left', 'workforce' ),
					'tablet-push-from-right' 			=> esc_html__( 'Push In from Right', 'workforce' ),
				),
				'description' 		=> esc_html__( 'Select how the tablet menu appears.', 'workforce' ),
				'label'  			=> esc_html__( 'Tablet Menu', 'workforce' ),
				'priority' 			=> 10,
				'section'  			=> 'tablet_menu',
				'settings' 			=> 'tablet_menu',
				'type' 				=> 'select'
			)
		);
		$wp_customize->get_setting( 'tablet_menu' )->transport = 'postMessage';
		
		
		
		// Images Fields
		
		// Default Featured Image Field
		$wp_customize->add_setting(
			'default_featured_image' ,
			array(
				'capability' 			=> 'edit_theme_options',
				'default'  				=> '',
				'sanitize_callback' 	=> 'esc_url_raw',
				'transport' 			=> 'postMessage',
				'type' 					=> 'theme_mod'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Media_Control(
				$wp_customize,
				'default_featured_image',
				array(
					'active_callback' 	=> '',
					'description' 		=> esc_html__( '', 'workforce' ),
					'label' 			=> esc_html__( 'Default Featured Image', 'workforce' ),
					'priority' 			=> 10,
					'section' 			=> 'images',
					'settings' 			=> 'default_featured_image'
				)
			)
		);
		
		
		
		// Footer Locations Label Field
		$wp_customize->add_setting(
			'footer_locs_label',
			array(
				'default'  			=> '',
				'sanitize_callback' => 'sanitize_text_field',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'footer_locs_label',
			array(
				'description' 	=> esc_html__( '', 'workforce' ),
				'label'  	=> esc_html__( 'Footer Locations Label', 'workforce' ),
				'priority' => 10,
				'section'  	=> 'footer',
				'settings' 	=> 'footer_locs_label',
				'type' 		=> 'text'
			)
		);
		$wp_customize->get_setting( 'footer_locs_label' )->transport = 'postMessage';






		// Register more fields here.

	} // register_fields()

	/**
	 * This will generate a line of CSS for use in header output. If the setting
	 * ($mod_name) has no defined value, the CSS will not be output.
	 *
	 * @access 		public
	 * @since 		1.0.0
	 * @see 		header_output()
	 * @param 		string 		$selector 		CSS selector
	 * @param 		string 		$style 			The name of the CSS *property* to modify
	 * @param 		string 		$mod_name 		The name of the 'theme_mod' option to fetch
	 * @param 		string 		$prefix 		Optional. Anything that needs to be output before the CSS property
	 * @param 		string 		$postfix 		Optional. Anything that needs to be output after the CSS property
	 * @param 		bool 		$echo 			Optional. Whether to print directly to the page (default: true).
	 * @return 		string 						Returns a single line of CSS with selectors and a property.
	 */
	public function generate_css( $selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true ) {

		$return = '';
		$mod 	= get_theme_mod( $mod_name );
		
		if ( empty( $mod ) ) { return; }

		$return = sprintf('%s { %s:%s; }',
			$selector,
			$style,
			$prefix . $mod . $postfix
		);

		if ( $echo ) {

			echo $return;
			return;

		}

		return $return;

	} // generate_css()

	/**
	 * This will output the custom WordPress settings to the live theme's WP head.
	 *
	 * @hooked 		wp_head
	 * @access 		public
	 * @see 		add_action( 'wp_head', $func )
	 * @since 		1.0.0
	 */
	public function header_output() {

		?><!-- Customizer CSS -->
		<style type="text/css"><?php

			// pattern:
			// $this->generate_css( 'selector', 'style', 'mod_name', 'prefix', 'postfix', true );
			//
			// background-image example:
			// $this->generate_css( '.class', 'background-image', 'background_image_example', 'url(', ')' );

		?></style><!-- Customizer CSS --><?php

		/**
		 * Hides all but the first Soliloquy slide while using Customizer previewer.
		 */
		if ( is_customize_preview() ) {

			?><style type="text/css">

				li.soliloquy-item:not(:first-child) {
					display: none !important;
				}

			</style><!-- Customizer CSS --><?php

		}

	} // header_output()

	/**
	 * Returns TRUE based on which link type is selected, otherwise FALSE
	 *
	 * @param 	object 		$control 			The control object
	 * @return 	bool 							TRUE if conditions are met, otherwise FALSE
	 */
	public function states_of_country_callback( $control ) {

		$country_setting = $control->manager->get_setting('country')->value();

		if ( 'us_state' === $control->id && 'US' === $country_setting ) { return true; }
		if ( 'canada_state' === $control->id && 'CA' === $country_setting ) { return true; }
		if ( 'australia_state' === $control->id && 'AU' === $country_setting ) { return true; }
		if ( 'default_state' === $control->id && ! $this->custom_countries( $country_setting ) ) { return true; }

		return false;

	} // states_of_country_callback()

	/**
	 * Returns true if a country has a custom select menu
	 *
	 * @param 		string 		$country 			The country code to check
	 * @return 		bool 							TRUE if the code is in the array, FALSE otherwise
	 */
	public function custom_countries( $country ) {

		$countries = array( 'US', 'CA', 'AU' );

		return in_array( $country, $countries );

	} // custom_countries()

	/**
	 * Returns an array of countries or a country name.
	 *
	 * @param 		string 		$country 		Country code to return (optional)
	 * @return 		array|string 				Array of countries or a single country name
	 */
	public function country_list( $country = '' ) {

		$countries = array();

		$countries['AF'] = esc_html__( 'Afghanistan (‫افغانستان‬‎)', 'workforce' );
		$countries['AX'] = esc_html__( 'Åland Islands (Åland)', 'workforce' );
		$countries['AL'] = esc_html__( 'Albania (Shqipëri)', 'workforce' );
		$countries['DZ'] = esc_html__( 'Algeria (‫الجزائر‬‎)', 'workforce' );
		$countries['AS'] = esc_html__( 'American Samoa', 'workforce' );
		$countries['AD'] = esc_html__( 'Andorra', 'workforce' );
		$countries['AO'] = esc_html__( 'Angola', 'workforce' );
		$countries['AI'] = esc_html__( 'Anguilla', 'workforce' );
		$countries['AQ'] = esc_html__( 'Antarctica', 'workforce' );
		$countries['AG'] = esc_html__( 'Antigua and Barbuda', 'workforce' );
		$countries['AR'] = esc_html__( 'Argentina', 'workforce' );
		$countries['AM'] = esc_html__( 'Armenia (Հայաստան)', 'workforce' );
		$countries['AW'] = esc_html__( 'Aruba', 'workforce' );
		$countries['AC'] = esc_html__( 'Ascension Island', 'workforce' );
		$countries['AU'] = esc_html__( 'Australia', 'workforce' );
		$countries['AT'] = esc_html__( 'Austria (Österreich)', 'workforce' );
		$countries['AZ'] = esc_html__( 'Azerbaijan (Azərbaycan)', 'workforce' );
		$countries['BS'] = esc_html__( 'Bahamas', 'workforce' );
		$countries['BH'] = esc_html__( 'Bahrain (‫البحرين‬‎)', 'workforce' );
		$countries['BD'] = esc_html__( 'Bangladesh (বাংলাদেশ)', 'workforce' );
		$countries['BB'] = esc_html__( 'Barbados', 'workforce' );
		$countries['BY'] = esc_html__( 'Belarus (Беларусь)', 'workforce' );
		$countries['BE'] = esc_html__( 'Belgium (België)', 'workforce' );
		$countries['BZ'] = esc_html__( 'Belize', 'workforce' );
		$countries['BJ'] = esc_html__( 'Benin (Bénin)', 'workforce' );
		$countries['BM'] = esc_html__( 'Bermuda', 'workforce' );
		$countries['BT'] = esc_html__( 'Bhutan (འབྲུག)', 'workforce' );
		$countries['BO'] = esc_html__( 'Bolivia', 'workforce' );
		$countries['BA'] = esc_html__( 'Bosnia and Herzegovina (Босна и Херцеговина)', 'workforce' );
		$countries['BW'] = esc_html__( 'Botswana', 'workforce' );
		$countries['BV'] = esc_html__( 'Bouvet Island', 'workforce' );
		$countries['BR'] = esc_html__( 'Brazil (Brasil)', 'workforce' );
		$countries['IO'] = esc_html__( 'British Indian Ocean Territory', 'workforce' );
		$countries['VG'] = esc_html__( 'British Virgin Islands', 'workforce' );
		$countries['BN'] = esc_html__( 'Brunei', 'workforce' );
		$countries['BG'] = esc_html__( 'Bulgaria (България)', 'workforce' );
		$countries['BF'] = esc_html__( 'Burkina Faso', 'workforce' );
		$countries['BI'] = esc_html__( 'Burundi (Uburundi)', 'workforce' );
		$countries['KH'] = esc_html__( 'Cambodia (កម្ពុជា)', 'workforce' );
		$countries['CM'] = esc_html__( 'Cameroon (Cameroun)', 'workforce' );
		$countries['CA'] = esc_html__( 'Canada', 'workforce' );
		$countries['IC'] = esc_html__( 'Canary Islands (islas Canarias)', 'workforce' );
		$countries['CV'] = esc_html__( 'Cape Verde (Kabu Verdi)', 'workforce' );
		$countries['BQ'] = esc_html__( 'Caribbean Netherlands', 'workforce' );
		$countries['KY'] = esc_html__( 'Cayman Islands', 'workforce' );
		$countries['CF'] = esc_html__( 'Central African Republic (République centrafricaine)', 'workforce' );
		$countries['EA'] = esc_html__( 'Ceuta and Melilla (Ceuta y Melilla)', 'workforce' );
		$countries['TD'] = esc_html__( 'Chad (Tchad)', 'workforce' );
		$countries['CL'] = esc_html__( 'Chile', 'workforce' );
		$countries['CN'] = esc_html__( 'China (中国)', 'workforce' );
		$countries['CX'] = esc_html__( 'Christmas Island', 'workforce' );
		$countries['CP'] = esc_html__( 'Clipperton Island', 'workforce' );
		$countries['CC'] = esc_html__( 'Cocos (Keeling) Islands (Kepulauan Cocos (Keeling))', 'workforce' );
		$countries['CO'] = esc_html__( 'Colombia', 'workforce' );
		$countries['KM'] = esc_html__( 'Comoros (‫جزر القمر‬‎)', 'workforce' );
		$countries['CD'] = esc_html__( 'Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)', 'workforce' );
		$countries['CG'] = esc_html__( 'Congo (Republic) (Congo-Brazzaville)', 'workforce' );
		$countries['CK'] = esc_html__( 'Cook Islands', 'workforce' );
		$countries['CR'] = esc_html__( 'Costa Rica', 'workforce' );
		$countries['CI'] = esc_html__( 'Côte d’Ivoire', 'workforce' );
		$countries['HR'] = esc_html__( 'Croatia (Hrvatska)', 'workforce' );
		$countries['CU'] = esc_html__( 'Cuba', 'workforce' );
		$countries['CW'] = esc_html__( 'Curaçao', 'workforce' );
		$countries['CY'] = esc_html__( 'Cyprus (Κύπρος)', 'workforce' );
		$countries['CZ'] = esc_html__( 'Czech Republic (Česká republika)', 'workforce' );
		$countries['DK'] = esc_html__( 'Denmark (Danmark)', 'workforce' );
		$countries['DG'] = esc_html__( 'Diego Garcia', 'workforce' );
		$countries['DJ'] = esc_html__( 'Djibouti', 'workforce' );
		$countries['DM'] = esc_html__( 'Dominica', 'workforce' );
		$countries['DO'] = esc_html__( 'Dominican Republic (República Dominicana)', 'workforce' );
		$countries['EC'] = esc_html__( 'Ecuador', 'workforce' );
		$countries['EG'] = esc_html__( 'Egypt (‫مصر‬‎)', 'workforce' );
		$countries['SV'] = esc_html__( 'El Salvador', 'workforce' );
		$countries['GQ'] = esc_html__( 'Equatorial Guinea (Guinea Ecuatorial)', 'workforce' );
		$countries['ER'] = esc_html__( 'Eritrea', 'workforce' );
		$countries['EE'] = esc_html__( 'Estonia (Eesti)', 'workforce' );
		$countries['ET'] = esc_html__( 'Ethiopia', 'workforce' );
		$countries['FK'] = esc_html__( 'Falkland Islands (Islas Malvinas)', 'workforce' );
		$countries['FO'] = esc_html__( 'Faroe Islands (Føroyar)', 'workforce' );
		$countries['FJ'] = esc_html__( 'Fiji', 'workforce' );
		$countries['FI'] = esc_html__( 'Finland (Suomi)', 'workforce' );
		$countries['FR'] = esc_html__( 'France', 'workforce' );
		$countries['GF'] = esc_html__( 'French Guiana (Guyane française)', 'workforce' );
		$countries['PF'] = esc_html__( 'French Polynesia (Polynésie française)', 'workforce' );
		$countries['TF'] = esc_html__( 'French Southern Territories (Terres australes françaises)', 'workforce' );
		$countries['GA'] = esc_html__( 'Gabon', 'workforce' );
		$countries['GM'] = esc_html__( 'Gambia', 'workforce' );
		$countries['GE'] = esc_html__( 'Georgia (საქართველო)', 'workforce' );
		$countries['DE'] = esc_html__( 'Germany (Deutschland)', 'workforce' );
		$countries['GH'] = esc_html__( 'Ghana (Gaana)', 'workforce' );
		$countries['GI'] = esc_html__( 'Gibraltar', 'workforce' );
		$countries['GR'] = esc_html__( 'Greece (Ελλάδα)', 'workforce' );
		$countries['GL'] = esc_html__( 'Greenland (Kalaallit Nunaat)', 'workforce' );
		$countries['GD'] = esc_html__( 'Grenada', 'workforce' );
		$countries['GP'] = esc_html__( 'Guadeloupe', 'workforce' );
		$countries['GU'] = esc_html__( 'Guam', 'workforce' );
		$countries['GT'] = esc_html__( 'Guatemala', 'workforce' );
		$countries['GG'] = esc_html__( 'Guernsey', 'workforce' );
		$countries['GN'] = esc_html__( 'Guinea (Guinée)', 'workforce' );
		$countries['GW'] = esc_html__( 'Guinea-Bissau (Guiné Bissau)', 'workforce' );
		$countries['GY'] = esc_html__( 'Guyana', 'workforce' );
		$countries['HT'] = esc_html__( 'Haiti', 'workforce' );
		$countries['HM'] = esc_html__( 'Heard & McDonald Islands', 'workforce' );
		$countries['HN'] = esc_html__( 'Honduras', 'workforce' );
		$countries['HK'] = esc_html__( 'Hong Kong (香港)', 'workforce' );
		$countries['HU'] = esc_html__( 'Hungary (Magyarország)', 'workforce' );
		$countries['IS'] = esc_html__( 'Iceland (Ísland)', 'workforce' );
		$countries['IN'] = esc_html__( 'India (भारत)', 'workforce' );
		$countries['ID'] = esc_html__( 'Indonesia', 'workforce' );
		$countries['IR'] = esc_html__( 'Iran (‫ایران‬‎)', 'workforce' );
		$countries['IQ'] = esc_html__( 'Iraq (‫العراق‬‎)', 'workforce' );
		$countries['IE'] = esc_html__( 'Ireland', 'workforce' );
		$countries['IM'] = esc_html__( 'Isle of Man', 'workforce' );
		$countries['IL'] = esc_html__( 'Israel (‫ישראל‬‎)', 'workforce' );
		$countries['IT'] = esc_html__( 'Italy (Italia)', 'workforce' );
		$countries['JM'] = esc_html__( 'Jamaica', 'workforce' );
		$countries['JP'] = esc_html__( 'Japan (日本)', 'workforce' );
		$countries['JE'] = esc_html__( 'Jersey', 'workforce' );
		$countries['JO'] = esc_html__( 'Jordan (‫الأردن‬‎)', 'workforce' );
		$countries['KZ'] = esc_html__( 'Kazakhstan (Казахстан)', 'workforce' );
		$countries['KE'] = esc_html__( 'Kenya', 'workforce' );
		$countries['KI'] = esc_html__( 'Kiribati', 'workforce' );
		$countries['XK'] = esc_html__( 'Kosovo (Kosovë)', 'workforce' );
		$countries['KW'] = esc_html__( 'Kuwait (‫الكويت‬‎)', 'workforce' );
		$countries['KG'] = esc_html__( 'Kyrgyzstan (Кыргызстан)', 'workforce' );
		$countries['LA'] = esc_html__( 'Laos (ລາວ)', 'workforce' );
		$countries['LV'] = esc_html__( 'Latvia (Latvija)', 'workforce' );
		$countries['LB'] = esc_html__( 'Lebanon (‫لبنان‬‎)', 'workforce' );
		$countries['LS'] = esc_html__( 'Lesotho', 'workforce' );
		$countries['LR'] = esc_html__( 'Liberia', 'workforce' );
		$countries['LY'] = esc_html__( 'Libya (‫ليبيا‬‎)', 'workforce' );
		$countries['LI'] = esc_html__( 'Liechtenstein', 'workforce' );
		$countries['LT'] = esc_html__( 'Lithuania (Lietuva)', 'workforce' );
		$countries['LU'] = esc_html__( 'Luxembourg', 'workforce' );
		$countries['MO'] = esc_html__( 'Macau (澳門)', 'workforce' );
		$countries['MK'] = esc_html__( 'Macedonia (FYROM) (Македонија)', 'workforce' );
		$countries['MG'] = esc_html__( 'Madagascar (Madagasikara)', 'workforce' );
		$countries['MW'] = esc_html__( 'Malawi', 'workforce' );
		$countries['MY'] = esc_html__( 'Malaysia', 'workforce' );
		$countries['MV'] = esc_html__( 'Maldives', 'workforce' );
		$countries['ML'] = esc_html__( 'Mali', 'workforce' );
		$countries['MT'] = esc_html__( 'Malta', 'workforce' );
		$countries['MH'] = esc_html__( 'Marshall Islands', 'workforce' );
		$countries['MQ'] = esc_html__( 'Martinique', 'workforce' );
		$countries['MR'] = esc_html__( 'Mauritania (‫موريتانيا‬‎)', 'workforce' );
		$countries['MU'] = esc_html__( 'Mauritius (Moris)', 'workforce' );
		$countries['YT'] = esc_html__( 'Mayotte', 'workforce' );
		$countries['MX'] = esc_html__( 'Mexico (México)', 'workforce' );
		$countries['FM'] = esc_html__( 'Micronesia', 'workforce' );
		$countries['MD'] = esc_html__( 'Moldova (Republica Moldova)', 'workforce' );
		$countries['MC'] = esc_html__( 'Monaco', 'workforce' );
		$countries['MN'] = esc_html__( 'Mongolia (Монгол)', 'workforce' );
		$countries['ME'] = esc_html__( 'Montenegro (Crna Gora)', 'workforce' );
		$countries['MS'] = esc_html__( 'Montserrat', 'workforce' );
		$countries['MA'] = esc_html__( 'Morocco (‫المغرب‬‎)', 'workforce' );
		$countries['MZ'] = esc_html__( 'Mozambique (Moçambique)', 'workforce' );
		$countries['MM'] = esc_html__( 'Myanmar (Burma) (မြန်မာ)', 'workforce' );
		$countries['NA'] = esc_html__( 'Namibia (Namibië)', 'workforce' );
		$countries['NR'] = esc_html__( 'Nauru', 'workforce' );
		$countries['NP'] = esc_html__( 'Nepal (नेपाल)', 'workforce' );
		$countries['NL'] = esc_html__( 'Netherlands (Nederland)', 'workforce' );
		$countries['NC'] = esc_html__( 'New Caledonia (Nouvelle-Calédonie)', 'workforce' );
		$countries['NZ'] = esc_html__( 'New Zealand', 'workforce' );
		$countries['NI'] = esc_html__( 'Nicaragua', 'workforce' );
		$countries['NE'] = esc_html__( 'Niger (Nijar)', 'workforce' );
		$countries['NG'] = esc_html__( 'Nigeria', 'workforce' );
		$countries['NU'] = esc_html__( 'Niue', 'workforce' );
		$countries['NF'] = esc_html__( 'Norfolk Island', 'workforce' );
		$countries['MP'] = esc_html__( 'Northern Mariana Islands', 'workforce' );
		$countries['KP'] = esc_html__( 'North Korea (조선 민주주의 인민 공화국)', 'workforce' );
		$countries['NO'] = esc_html__( 'Norway (Norge)', 'workforce' );
		$countries['OM'] = esc_html__( 'Oman (‫عُمان‬‎)', 'workforce' );
		$countries['PK'] = esc_html__( 'Pakistan (‫پاکستان‬‎)', 'workforce' );
		$countries['PW'] = esc_html__( 'Palau', 'workforce' );
		$countries['PS'] = esc_html__( 'Palestine (‫فلسطين‬‎)', 'workforce' );
		$countries['PA'] = esc_html__( 'Panama (Panamá)', 'workforce' );
		$countries['PG'] = esc_html__( 'Papua New Guinea', 'workforce' );
		$countries['PY'] = esc_html__( 'Paraguay', 'workforce' );
		$countries['PE'] = esc_html__( 'Peru (Perú)', 'workforce' );
		$countries['PH'] = esc_html__( 'Philippines', 'workforce' );
		$countries['PN'] = esc_html__( 'Pitcairn Islands', 'workforce' );
		$countries['PL'] = esc_html__( 'Poland (Polska)', 'workforce' );
		$countries['PT'] = esc_html__( 'Portugal', 'workforce' );
		$countries['PR'] = esc_html__( 'Puerto Rico', 'workforce' );
		$countries['QA'] = esc_html__( 'Qatar (‫قطر‬‎)', 'workforce' );
		$countries['RE'] = esc_html__( 'Réunion (La Réunion)', 'workforce' );
		$countries['RO'] = esc_html__( 'Romania (România)', 'workforce' );
		$countries['RU'] = esc_html__( 'Russia (Россия)', 'workforce' );
		$countries['RW'] = esc_html__( 'Rwanda', 'workforce' );
		$countries['BL'] = esc_html__( 'Saint Barthélemy (Saint-Barthélemy)', 'workforce' );
		$countries['SH'] = esc_html__( 'Saint Helena', 'workforce' );
		$countries['KN'] = esc_html__( 'Saint Kitts and Nevis', 'workforce' );
		$countries['LC'] = esc_html__( 'Saint Lucia', 'workforce' );
		$countries['MF'] = esc_html__( 'Saint Martin (Saint-Martin (partie française))', 'workforce' );
		$countries['PM'] = esc_html__( 'Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)', 'workforce' );
		$countries['WS'] = esc_html__( 'Samoa', 'workforce' );
		$countries['SM'] = esc_html__( 'San Marino', 'workforce' );
		$countries['ST'] = esc_html__( 'São Tomé and Príncipe (São Tomé e Príncipe)', 'workforce' );
		$countries['SA'] = esc_html__( 'Saudi Arabia (‫المملكة العربية السعودية‬‎)', 'workforce' );
		$countries['SN'] = esc_html__( 'Senegal (Sénégal)', 'workforce' );
		$countries['RS'] = esc_html__( 'Serbia (Србија)', 'workforce' );
		$countries['SC'] = esc_html__( 'Seychelles', 'workforce' );
		$countries['SL'] = esc_html__( 'Sierra Leone', 'workforce' );
		$countries['SG'] = esc_html__( 'Singapore', 'workforce' );
		$countries['SX'] = esc_html__( 'Sint Maarten', 'workforce' );
		$countries['SK'] = esc_html__( 'Slovakia (Slovensko)', 'workforce' );
		$countries['SI'] = esc_html__( 'Slovenia (Slovenija)', 'workforce' );
		$countries['SB'] = esc_html__( 'Solomon Islands', 'workforce' );
		$countries['SO'] = esc_html__( 'Somalia (Soomaaliya)', 'workforce' );
		$countries['ZA'] = esc_html__( 'South Africa', 'workforce' );
		$countries['GS'] = esc_html__( 'South Georgia & South Sandwich Islands', 'workforce' );
		$countries['KR'] = esc_html__( 'South Korea (대한민국)', 'workforce' );
		$countries['SS'] = esc_html__( 'South Sudan (‫جنوب السودان‬‎)', 'workforce' );
		$countries['ES'] = esc_html__( 'Spain (España)', 'workforce' );
		$countries['LK'] = esc_html__( 'Sri Lanka (ශ්‍රී ලංකාව)', 'workforce' );
		$countries['VC'] = esc_html__( 'St. Vincent & Grenadines', 'workforce' );
		$countries['SD'] = esc_html__( 'Sudan (‫السودان‬‎)', 'workforce' );
		$countries['SR'] = esc_html__( 'Suriname', 'workforce' );
		$countries['SJ'] = esc_html__( 'Svalbard and Jan Mayen (Svalbard og Jan Mayen)', 'workforce' );
		$countries['SZ'] = esc_html__( 'Swaziland', 'workforce' );
		$countries['SE'] = esc_html__( 'Sweden (Sverige)', 'workforce' );
		$countries['CH'] = esc_html__( 'Switzerland (Schweiz)', 'workforce' );
		$countries['SY'] = esc_html__( 'Syria (‫سوريا‬‎)', 'workforce' );
		$countries['TW'] = esc_html__( 'Taiwan (台灣)', 'workforce' );
		$countries['TJ'] = esc_html__( 'Tajikistan', 'workforce' );
		$countries['TZ'] = esc_html__( 'Tanzania', 'workforce' );
		$countries['TH'] = esc_html__( 'Thailand (ไทย)', 'workforce' );
		$countries['TL'] = esc_html__( 'Timor-Leste', 'workforce' );
		$countries['TG'] = esc_html__( 'Togo', 'workforce' );
		$countries['TK'] = esc_html__( 'Tokelau', 'workforce' );
		$countries['TO'] = esc_html__( 'Tonga', 'workforce' );
		$countries['TT'] = esc_html__( 'Trinidad and Tobago', 'workforce' );
		$countries['TA'] = esc_html__( 'Tristan da Cunha', 'workforce' );
		$countries['TN'] = esc_html__( 'Tunisia (‫تونس‬‎)', 'workforce' );
		$countries['TR'] = esc_html__( 'Turkey (Türkiye)', 'workforce' );
		$countries['TM'] = esc_html__( 'Turkmenistan', 'workforce' );
		$countries['TC'] = esc_html__( 'Turks and Caicos Islands', 'workforce' );
		$countries['TV'] = esc_html__( 'Tuvalu', 'workforce' );
		$countries['UM'] = esc_html__( 'U.S. Outlying Islands', 'workforce' );
		$countries['VI'] = esc_html__( 'U.S. Virgin Islands', 'workforce' );
		$countries['UG'] = esc_html__( 'Uganda', 'workforce' );
		$countries['UA'] = esc_html__( 'Ukraine (Україна)', 'workforce' );
		$countries['AE'] = esc_html__( 'United Arab Emirates (‫الإمارات العربية المتحدة‬‎)', 'workforce' );
		$countries['GB'] = esc_html__( 'United Kingdom', 'workforce' );
		$countries['US'] = esc_html__( 'United States', 'workforce' );
		$countries['UY'] = esc_html__( 'Uruguay', 'workforce' );
		$countries['UZ'] = esc_html__( 'Uzbekistan (Oʻzbekiston)', 'workforce' );
		$countries['VU'] = esc_html__( 'Vanuatu', 'workforce' );
		$countries['VA'] = esc_html__( 'Vatican City (Città del Vaticano)', 'workforce' );
		$countries['VE'] = esc_html__( 'Venezuela', 'workforce' );
		$countries['VN'] = esc_html__( 'Vietnam (Việt Nam)', 'workforce' );
		$countries['WF'] = esc_html__( 'Wallis and Futuna', 'workforce' );
		$countries['EH'] = esc_html__( 'Western Sahara (‫الصحراء الغربية‬‎)', 'workforce' );
		$countries['YE'] = esc_html__( 'Yemen (‫اليمن‬‎)', 'workforce' );
		$countries['ZM'] = esc_html__( 'Zambia', 'workforce' );
		$countries['ZW'] = esc_html__( 'Zimbabwe', 'workforce' );

		if ( ! empty( $country ) ) {

			return $countries[$country];

		}

		return $countries;

	} // country_list()

	/**
	 * Loads files for Custom Controls.
	 *
	 * @hooked
	 */
	public function load_customize_controls() {

		$files[] = 'control-editor.php';
		$files[] = 'control-layout-picker.php';
		$files[] = 'control-multiple-checkboxes.php';
		$files[] = 'control-select-category.php';
		$files[] = 'control-select-menu.php';
		$files[] = 'control-select-post.php';
		$files[] = 'control-select-post-type.php';
		//$files[] = 'control-select-recent-post.php';
		$files[] = 'control-select-tag.php';
		$files[] = 'control-select-taxonomy.php';
		$files[] = 'control-select-user.php';

		foreach ( $files as $file ) {

			require_once( trailingslashit( get_stylesheet_directory() ) . 'classes/customizer/' . $file );

		}

	} // load_customize_controls()

	/**
	 * Returns an array of the Australian states and Territories.
	 * The optional parameters allows for returning just one state.
	 *
	 * @param 		string 		$state 		The state to return.
	 * @return 		array 					An array containing states.
	 */
	private function states_list_australia( $state = '' ) {

		$states = array();

		$states['ACT'] = esc_html__( 'Australian Capital Territory', 'workforce' );
		$states['NSW'] = esc_html__( 'New South Wales', 'workforce' );
		$states['NT' ] = esc_html__( 'Northern Territory', 'workforce' );
		$states['QLD'] = esc_html__( 'Queensland', 'workforce' );
		$states['SA' ] = esc_html__( 'South Australia', 'workforce' );
		$states['TAS'] = esc_html__( 'Tasmania', 'workforce' );
		$states['VIC'] = esc_html__( 'Victoria', 'workforce' );
		$states['WA' ] = esc_html__( 'Western Australia', 'workforce' );

		if ( ! empty( $state ) ) {

			return $states[$state];

		}

		return $states;

	} // states_list_australia()



	/**
	 * Returns an array of the Canadian states and Territories.
	 * The optional parameters allows for returning just one state.
	 *
	 * @param 		string 		$state 		The state to return.
	 * @return 		array 					An array containing states.
	 */
	private function states_list_canada( $state = '' ) {

		$states = array();

		$states['AB'] = esc_html__( 'Alberta', 'workforce' );
		$states['BC'] = esc_html__( 'British Columbia', 'workforce' );
		$states['MB'] = esc_html__( 'Manitoba', 'workforce' );
		$states['NB'] = esc_html__( 'New Brunswick', 'workforce' );
		$states['NL'] = esc_html__( 'Newfoundland and Labrador', 'workforce' );
		$states['NT'] = esc_html__( 'Northwest Territories', 'workforce' );
		$states['NS'] = esc_html__( 'Nova Scotia', 'workforce' );
		$states['NU'] = esc_html__( 'Nunavut', 'workforce' );
		$states['ON'] = esc_html__( 'Ontario', 'workforce' );
		$states['PE'] = esc_html__( 'Prince Edward Island', 'workforce' );
		$states['QC'] = esc_html__( 'Quebec', 'workforce' );
		$states['SK'] = esc_html__( 'Saskatchewan', 'workforce' );
		$states['YT'] = esc_html__( 'Yukon', 'workforce' );

		if ( ! empty( $state ) ) {

			return $states[$state];

		}

		return $states;

	} // states_list_canada()

	/**
	 * Returns an array of the US states and Territories.
	 * The optional parameters allows for returning just one state.
	 *
	 * @param 		string 		$state 		The state to return.
	 * @return 		array 					An array containing states.
	 */
	private function states_list_unitedstates( $state = '' ) {

		$states = array();

		$states['AL'] = esc_html__( 'Alabama', 'workforce' );
		$states['AK'] = esc_html__( 'Alaska', 'workforce' );
		$states['AZ'] = esc_html__( 'Arizona', 'workforce' );
		$states['AR'] = esc_html__( 'Arkansas', 'workforce' );
		$states['CA'] = esc_html__( 'California', 'workforce' );
		$states['CO'] = esc_html__( 'Colorado', 'workforce' );
		$states['CT'] = esc_html__( 'Connecticut', 'workforce' );
		$states['DE'] = esc_html__( 'Delaware', 'workforce' );
		$states['DC'] = esc_html__( 'District of Columbia', 'workforce' );
		$states['FL'] = esc_html__( 'Florida', 'workforce' );
		$states['GA'] = esc_html__( 'Georgia', 'workforce' );
		$states['HI'] = esc_html__( 'Hawaii', 'workforce' );
		$states['ID'] = esc_html__( 'Idaho', 'workforce' );
		$states['IL'] = esc_html__( 'Illinois', 'workforce' );
		$states['IN'] = esc_html__( 'Indiana', 'workforce' );
		$states['IA'] = esc_html__( 'Iowa', 'workforce' );
		$states['KS'] = esc_html__( 'Kansas', 'workforce' );
		$states['KY'] = esc_html__( 'Kentucky', 'workforce' );
		$states['LA'] = esc_html__( 'Louisiana', 'workforce' );
		$states['ME'] = esc_html__( 'Maine', 'workforce' );
		$states['MD'] = esc_html__( 'Maryland', 'workforce' );
		$states['MA'] = esc_html__( 'Massachusetts', 'workforce' );
		$states['MI'] = esc_html__( 'Michigan', 'workforce' );
		$states['MN'] = esc_html__( 'Minnesota', 'workforce' );
		$states['MS'] = esc_html__( 'Mississippi', 'workforce' );
		$states['MO'] = esc_html__( 'Missouri', 'workforce' );
		$states['MT'] = esc_html__( 'Montana', 'workforce' );
		$states['NE'] = esc_html__( 'Nebraska', 'workforce' );
		$states['NV'] = esc_html__( 'Nevada', 'workforce' );
		$states['NH'] = esc_html__( 'New Hampshire', 'workforce' );
		$states['NJ'] = esc_html__( 'New Jersey', 'workforce' );
		$states['NM'] = esc_html__( 'New Mexico', 'workforce' );
		$states['NY'] = esc_html__( 'New York', 'workforce' );
		$states['NC'] = esc_html__( 'North Carolina', 'workforce' );
		$states['ND'] = esc_html__( 'North Dakota', 'workforce' );
		$states['OH'] = esc_html__( 'Ohio', 'workforce' );
		$states['OK'] = esc_html__( 'Oklahoma', 'workforce' );
		$states['OR'] = esc_html__( 'Oregon', 'workforce' );
		$states['PA'] = esc_html__( 'Pennsylvania', 'workforce' );
		$states['RI'] = esc_html__( 'Rhode Island', 'workforce' );
		$states['SC'] = esc_html__( 'South Carolina', 'workforce' );
		$states['SD'] = esc_html__( 'South Dakota', 'workforce' );
		$states['TN'] = esc_html__( 'Tennessee', 'workforce' );
		$states['TX'] = esc_html__( 'Texas', 'workforce' );
		$states['UT'] = esc_html__( 'Utah', 'workforce' );
		$states['VT'] = esc_html__( 'Vermont', 'workforce' );
		$states['VA'] = esc_html__( 'Virginia', 'workforce' );
		$states['WA'] = esc_html__( 'Washington', 'workforce' );
		$states['WV'] = esc_html__( 'West Virginia', 'workforce' );
		$states['WI'] = esc_html__( 'Wisconsin', 'workforce' );
		$states['WY'] = esc_html__( 'Wyoming', 'workforce' );
		$states['AS'] = esc_html__( 'American Samoa', 'workforce' );
		$states['AA'] = esc_html__( 'Armed Forces America (except Canada)', 'workforce' );
		$states['AE'] = esc_html__( 'Armed Forces Africa/Canada/Europe/Middle East', 'workforce' );
		$states['AP'] = esc_html__( 'Armed Forces Pacific', 'workforce' );
		$states['FM'] = esc_html__( 'Federated States of Micronesia', 'workforce' );
		$states['GU'] = esc_html__( 'Guam', 'workforce' );
		$states['MH'] = esc_html__( 'Marshall Islands', 'workforce' );
		$states['MP'] = esc_html__( 'Northern Mariana Islands', 'workforce' );
		$states['PR'] = esc_html__( 'Puerto Rico', 'workforce' );
		$states['PW'] = esc_html__( 'Palau', 'workforce' );
		$states['VI'] = esc_html__( 'Virgin Islands', 'workforce' );

		if ( ! empty( $state ) ) {

			return $states[$state];

		}

		return $states;

	} // states_list_unitedstates()

} // class

/**
 * Sanitizes the input for the Google Analytics code field.
 * 
 * @param 		mixed 		$input 		The field input.
 * @return 		mixed 					The sanitized input.
 */
function workforce_sanitize_analytics_code( $input ) {
	
	return stripslashes( wp_filter_post_kses( $input ) );
	
} // workforce_sanitize_analytics_code()
