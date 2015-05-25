<?php defined('SYSPATH') OR die('No direct access allowed.');

$config['photo_path'] = "/userdata/photo/";

$config['avatars_path'] = "/userdata/avatars/";
// Avatar resize parameters
$config['avatar_sm_width'] = 38;  
$config['avatar_sm_height'] = 38;
$config['avatar_mid_width'] = 180;
$config['avatar_mid_height'] = 145;

$config['avatars_stand_path'] = "/static/i/";

$config['photos_per_page'] = 9;
$config['latest_photo_count'] = 10;

// Thumb resize parameters
$config['thumb_resize_width'] = 128;  
$config['thumb_resize_height'] = 128; // не применяется, т.к. выравнивается по ширине

// Image resize paremeters 

$config['image_resize_width'] = 1024;  
$config['image_resize_height'] = 768; 
