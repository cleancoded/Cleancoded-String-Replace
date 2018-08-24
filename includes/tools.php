<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function ccd_stripslashes( $value ){
    $value = is_array($value) ?
                array_map('ccd_stripslashes', $value) :
                stripslashes($value);
    return $value;
}