<?php

/**
 * A class of methods using hooks in the theme.
 *
 * @package Workforce
 * @author DCC Marketing <web@dccmarketing.com>
 */
class workforce_Soliloquy {

	/**
	 * Constructor
	 */
	public function __construct() {} // __construct()

	/**
	 * Loads all filter and action calls
	 */
	public function hooks() {

		add_action( 'workforce_content_before', array( $this, 'soliloquy_home' ), 10 );

	} // loader()

	/**
	 * Displays the "Home" Soliloquy slider on the front page.
	 *
	 * @hooked 		workforce_content_while_before 		10
	 *
	 * @return 		mixed 							The Home Soliloquy slider
	 */
	public function soliloquy_home() {

		if ( ! is_front_page() ) { return; }
		if ( ! function_exists( 'soliloquy' ) ) { return; }

		soliloquy( 'home', 'slug' );

	} // soliloquy_home()

} // class
