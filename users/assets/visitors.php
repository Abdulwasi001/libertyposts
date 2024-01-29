<?php
    $ip = $_SERVER['REMOTE_ADDR'];
    $date = date("d-m-y");

    function isMobile() {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|hiptop|mini|mobi|palm|phone|pie|tablet|up\.broswer|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }

    if (isMobile()) {
        $mobile = '1';
    } else {
        $mobile = '0';
    }

    $stored_ip = mysqli_query($db, "SELECT * FROM visitors WHERE visitor_ip = '$ip' ");
    if (mysqli_num_rows($stored_ip) == 1) {
        // update lastvisit
        $sql = mysqli_query($db, "UPDATE visitors SET `lastvisit`='$date' WHERE visitor_ip = '$ip' ");
    } else if (mysqli_num_rows($stored_ip) == 0) {
        $sql_insert = "INSERT INTO visitors (visitor_ip, firstVisit, lastVisit, mob) VALUES ('$ip', '$date', '$date', '$mobile')";
        $query_run = mysqli_query($db, $sql_insert);
    }
?>