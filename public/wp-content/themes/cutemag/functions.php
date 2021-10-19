<?php
/**
* CuteMag functions and definitions.
*
* @link https://developer.wordpress.org/themes/basics/theme-functions/
*
* @package CuteMag WordPress Theme
* @copyright Copyright (C) 2021 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

define( 'CUTEMAG_PROURL', 'https://themesdna.com/cutemag-pro-wordpress-theme/' );
define( 'CUTEMAG_CONTACTURL', 'https://themesdna.com/contact/' );
define( 'CUTEMAG_THEMEOPTIONSDIR', trailingslashit( get_template_directory() ) . 'theme-setup' );

require_once( trailingslashit( CUTEMAG_THEMEOPTIONSDIR ) . 'theme-options.php' );
require_once( trailingslashit( CUTEMAG_THEMEOPTIONSDIR ) . 'theme-functions.php' );