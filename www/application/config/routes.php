<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * @package  Core
 *
 * Sets the default route to "welcome"
 */
$config['_default'] = 'nakarte';

$config['poi/([0-9]+)'] = 'nakarte/poi/$1';
$config['poi/([0-9]+)/related(/([0-9]+))?'] = 'places/related/$1/$3';
//$config['places/related/([0-9]+)(/([0-9]+))?'] = 'places/related/$1/$3';
$config['create_poi'] = 'nakarte/create_poi';
$config['map/rubric/([0-9]+)'] = 'rubrics/show/$1';
$config['admin'] = 'admin/list_objects_city/8';

$config['admin/object/([0-9]+)/list_rubrics'] = 'json/object_list_rubrics/$1';
$config['admin/object/([0-9]+)/list_attributes'] = 'json/object_list_attributes/$1';
$config['admin/object/([0-9]+)/add_object_to_rubric/([0-9]+)'] = 'auth_json/add_object_to_rubric/$1/$2';
$config['admin/object/([0-9]+)/remove_object_from_rubric/([0-9]+)'] = 'auth_json/remove_object_from_rubric/$1/$2';

$config['admin/edit_rubric/([0-9]+)/rubric_list_attribute_types'] = 'json/rubric_list_attribute_types/$1';
$config['admin/edit_rubric/([0-9]+)/add_attribute_to_rubric/([0-9]+)'] = 'auth_json/add_attribute_to_rubric/$1/$2';
$config['admin/edit_rubric/([0-9]+)/remove_attribute_from_rubric/([0-9]+)'] = 'auth_json/remove_attribute_from_rubric/$1/$2';

$config['people/all/([0-9]+)'] = 'people/all/$1';

$config['places/(latest)(/([0-9]*))?'] = 'places/show_places/$3/$1';
$config['places/(popular)(/([0-9]*))?'] = 'places/show_places/$3/$1';
$config['places/(all)(/([0-9]*))?'] = 'places/show_places/$3/$1';
$config['places(/([0-9]*))?'] = 'places/show_places/$3/$1';

//$config['places/popular/([0-9]*)'] = 'places/popular/$1';
//$config['places/popular'] = 'places/popular';

$config['photos/all/([0-9]*)'] = 'photos/all/$1';
$config['photos/popular/([0-9]*)'] = 'photos/popular/$1';
$config['photos/add/'] = 'photos/popular/$1';
$config['photos/upload'] = 'photos/upload';
$config['photos/id/([0-9][A-Z]*)'] = 'photos/id/$1';
$config['photos/vote/'] = 'photos/addVote/';
$config['u([0-9]+)/'] = 'profile/index/$1';
$config['u([0-9]+)/friends(/([0-9]+))?'] = '/profile/friends/$1/$3';
$config['u([0-9]+)/favorite_places(/([0-9]+))?'] = '/profile/favorite_places/$1/$3';
$config['u([0-9]+)/been_places(/([0-9]+))?'] = '/profile/been_places/$1/$3';
$config['u([0-9]+)/photos(/([0-9]+))?'] = '/profile/photos/$1/$3';

