<?php
/*
Plugin Name: GZippy
Plugin URI: http://blog.shamalt.hu/wordpress/
Description: GZippy re-enables gzip compression under WordPress.
Author: Shamalt
Version: 1.0.2.1
Author URI: http://blog.shamalt.hu/

Copyright (C) 2008 Shamalt

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

function gzippy() {
	ob_start('ob_gzhandler');
}

if(!stristr($_SERVER['REQUEST_URI'], 'tinymce') && !ini_get('zlib.output_compression')) {
	add_action('init', 'gzippy');
}

?>