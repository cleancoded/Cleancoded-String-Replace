<?php

/*
 * Plugin Name: CLEANCODED String Replace
 * Plugin URI: https://cleancoded.com/
 * Description: CLEANCODED String Replace replaces any defined string with another string within any WordPress website.
 * Version: 1.0
 * Author: CLEANCODED
 * Author URI: https://cleancoded.com/
 * License: GPL
 * 
 *  CLEANCODED String Replace is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 2 of the License, or
 *  any later version.
 * 
 *  CLEANCODED String Replace is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *  GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with cleancoded String Replace. If not, see https://www.google.com/?q=GNU+General+Public+License
 */

if ( ! defined( 'ABSPATH' ) ) exit;

require_once 'includes/tools.php';
require_once 'includes/class-cleancoded-string-replace.php';
require_once 'includes/class-cleancoded-string-replace-settings.php';
require_once 'includes/class-cleancoded-string-replace-replacer.php';

function cleancoded_string_replace(){

    $instance = cleancoded_String_Replace::instance( '2.0.5', __FILE__ );

    if( is_null( $instance->settings ) ){
        $instance->settings = Cleancoded_String_Replace_Settings::instance( $instance );
    }

    if( is_null( $instance->replacer ) ){
        $instance->replacer = Cleancoded_String_Replace_Replacer::instance( $instance );
    }

    return $instance;
}

cleancoded_string_replace();
