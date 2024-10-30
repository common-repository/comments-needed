<?php
/*
Plugin Name: Comments Needed
Plugin URI: http://www.thuhd.com/projects
Description: Remind one-time visitors to leave some comments.
Version: 0.1
Author: HD@THU
Author URI: http://www.thuhd.com
License: GPLv3
*/

/*
    Copyright (C) 2009 HD@THU

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

//Text that displays on the alert dialog
$cn_alertinfo = "Hey, visitor! I would appreciate if you could leave some comments here.";

function cn_add_script() {
	global    $cn_alertinfo;

	//Decide when the script is actviated
	if (is_singular() && !is_user_logged_in() &&!is_admin() && comments_open() && !isset($_COOKIE['comment_author_'.COOKIEHASH])) {
?>

<script type="text/JavaScript">
var cn_commented='0';
window.onload = function(){
	if (document.getElementById("commentform")){
        document.getElementById("commentform").onsubmit = function (){
        	cn_commented='1';
        	return true;
        	}
    	}
}
window.onbeforeunload = function(){
	if (cn_commented!='1') {
        	return "<?php echo $cn_alertinfo; ?>";
    	}
}
</script>

<?php
	}
}

add_filter('wp_footer', 'cn_add_script');
?>