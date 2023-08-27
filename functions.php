<?php
if ($isset($_POST['submitbtn'])) {
    $data = array(
        'email' => $_POST['inputEmail'],
        'password' => $_POST['inputPassword'],
        'address' => $_POST['inputAddress'],
        'city' => $_POST['inputCity'],
        'zip' => $_POST['inputZip'],

    );
    //add tbl name
    $table_name = " ";
    $result = $wpdb->insert($table_name, $data, $format = NULL);
    if ($result == 1) {
        echo '<script>alert("Saved!");</script>';
    } else
        echo '<script>alert("Not Saved!");</script>';
}

if ($isset($_POST['searchForm'])) {
    $query = $_GET['query'];

    $min_length = 3;

    if (strlen($query) >= $min_length) {

        $query = htmlspecialchars($query);

        $query = mysql_real_escape_string($query);

        //change tbl and query
        $raw_results = mysql_query("SELECT * FROM articles
			WHERE (`title` LIKE '%" . $query . "%') OR (`text` LIKE '%" . $query . "%')") or die(mysql_error());

        if (mysql_num_rows($raw_results) > 0) {

            while ($results = mysql_fetch_array($raw_results)) {

                echo "<p><h3>" . $results['title'] . "</h3>" . $results['text'] . "</p>";
            }
        } else {
            echo "No results";
        }
    } else {
        echo "Minimum length is " . $min_length;
    }
}
