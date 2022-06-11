<?php
/* Template Name: Backup Theme Data Page */
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 3/8/2020
 * Time: 12:38 PM
 */
if (isset($_REQUEST["todo"]) && $_REQUEST["todo"] == "BACKUP") {
    $con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); // or PDO
    $backup = new SQL_Backup($con);
    //$backup->table_name = array("tblbooks", "tblborrowed", "tblpayments", "tblcourses", "tblrequests", "tblstudents", "tblsubbooks", "tblyears", "tblusers", "tblslides", "wp_users", "wp_usermeta","wp_post","wp_postmeta");
    //$backup->archive = 'zip';
    $backup->archive = false;
    $backup->phpmyadmin = true;
    $backup->sql_unique = true;
    $backup->ext = "sql";
    $res = $backup->execute();
    if ($res) {
        _e("Backup entire db. Files can be found under backup/databases/", 'library-management-system');
    } else {
        _e("Backup failed", 'library-management-system');
    };
}
?>