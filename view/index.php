<?php

include '../view/commons/header.php';
include '../view/commons/footer.php';
?>
<link rel="stylesheet" href="../web/css/bootstrap.css">
<link rel="stylesheet" href="../web/css/custom.css">
<link rel="stylesheet" href="../web/assets/font-awesome-4.7.0/css/font-awesome.min.css">

<!-- ENDNAVBAR -->

<?php

    $service = new Google_Service_Calendar($client);
    $calendarId = 'primary';
    $optParams = array(
        'maxResults' => 10,
        'orderBy' => 'startTime',
        'singleEvents' => TRUE,
        'timeMin' => date('c'),
    );
    $results = $service->events->listEvents($calendarId, $optParams);

    if (count($results->getItems()) == 0) {
        print "No upcoming events found.\n";
    } else {
        print "Upcoming events:\n";
        foreach ($results->getItems() as $event) {
            $start = $event->start->dateTime;
            if (empty($start)) {
                $start = $event->start->date;
            }
            printf("%s (%s +++LIEU+++ %s)\n\n\n\t", $event->getSummary(), $start, $event->location);
        }
    }
    ?>
    <?php
    $plus = new Google_Service_Plus($client);
    $mail = $plus->people->get('me');
    echo '<PRE>';
    var_dump($mail['emails']['0']['value']);
    echo '</PRE>';


?>
</body>
</html>
