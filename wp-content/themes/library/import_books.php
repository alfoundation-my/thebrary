<?php
/* Template Name: Import Books Page */
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 3/8/2020
 * Time: 4:12 PM
 */
if (isset($_REQUEST["todo"]) && $_REQUEST["todo"] == "import_from_file") {
    $fp = fopen($_FILES['fileToUpload']['tmp_name'], 'rb');
    $sql_code = "";
    while (($line = fgets($fp)) !== false) {
        $sql_code .= $line;
    }
    if (!empty($sql_code)) {
        global $wpdb;
        $imported = false;
        $queries = explode(");", $sql_code); // Exploding multiple queries in to array as query doesn't support multiple sql function in one go.
        foreach ($queries as $query) {
            if (!empty($query)) {
                $wpdb->query($query . ");");
            }
            $imported = true;
        }
        if ($imported) {
            _e("Books Has Been Imported Successfully.", "library-management-system");
            echo "<br/><a href='" . home_url() . "/manage-books'>Back</a>";
        } else {
            _e("Books Import Failed.", "library-management-system");
        }
    } else {
        _e("No Sql data found.", "library-management-system");
    }
} else {
    $sql_code = file_get_contents("https://library-management.com/demo_books.sql");
    if (!empty($sql_code)) {
        global $wpdb;
        $imported = false;
        $queries = explode(");", $sql_code); // Exploding multiple queries in to array as query doesn't support multiple sql function in one go.
        foreach ($queries as $query) {
            if (!empty($query)) {
                $wpdb->query($query . ");");
            }
            $imported = true;
        }
        if ($imported) {
            _e("Demo Content Has Been Imported Successfully.", "library-management-system");
            echo "<br/><a href='" . home_url() . "/manage-books'>Back</a>";
        } else {
            _e("Demo Import Failed.", "library-management-system");
        }
    } else {
        _e("No Demo data found.", "library-management-system");
    }
}
?>