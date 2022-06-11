<?php
/* Template Name: Clear Theme Data Page */
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 3/8/2020
 * Time: 12:11 PM
 */
if (isset($_REQUEST["todo"]) && $_REQUEST["todo"] == "DELETE") {
    deactivated_theme(); // Removing all theme tables and setting saved .
    _e("Theme Data Has Been Cleared . To Again Start With Default Setting You Can Reactivate The Theme", 'library-management-system');
} else {
    _e("Illegal Access", 'library-management-system');
}
?>