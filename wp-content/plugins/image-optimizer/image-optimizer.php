<?php
/*
Plugin Name: Image Optimizer
Plugin URI: http://blog.mudy.info/my-plugins/
Description: Reduce uploaded images's size with Optipng and Jhead. There is no option for this plugin.
Version: 1.0
Author: Yejun Yang
Author URI: http://blog.mudy.info/
*/
/*  Copyright 2009 Yejun Yang (yejunx AT gmail DOT com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
function io_processing($file){
	$ext = strtolower(array_pop(explode('.',$file)));
	if ($ext == 'png') {
		exec('optipng -o4 '.escapeshellarg($file));
	}
	if ($ext == 'jpeg' || $ext == 'jpg') {
		exec('jhead -purejpg '.escapeshellarg($file));

	}
	return $file;
}

function io_attach($data, $postID){
	$file = get_attached_file($postID, true);

	io_processing($file);
	
	return $data;
}

//if (is_admin()){
	add_filter('image_make_intermediate_size','io_processing');
	add_filter('wp_update_attachment_metadata', 'io_attach',0,2);
//}
?>