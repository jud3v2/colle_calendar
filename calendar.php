<?php
// @workspace
function formatDate(string $date): string
{
        $year = substr($date, 0, 4);
        $month = substr($date, 4, 2);
        $day = substr($date, 6, 2);
        return $day.'-'.$month.'-'.$year;
}

function formatDateForMonth(string $date, $flag = false): string
{
        $year = substr($date, 0, 4);
        $month = substr($date, 4, 2);

        if($flag) {
                return $year.$month.PHP_EOL;
        } else {
                return $year.'-'.$month.PHP_EOL;
        }
}

function isBetween(string $date, string $dateBegin, string $dateEnd): bool
{
        $date = (int) formatDateForMonth($date, true);
        $dateBegin = (int) $dateBegin;
        $dateEnd = (int) $dateEnd;
        return $date >= $dateBegin && $date <= $dateEnd;
}

function display_event(array $event, $flag = false)
{
        // format the date
        $formatedDate = formatDate($event['date']);

        if($flag) {
                // show event details with space
                echo '  The "'.$event['name'].'" event will take place on '
                    .$formatedDate.' in '.$event['location'].PHP_EOL;
        } else {
                // show the event details
                echo 'The "'.$event['name'].'" event will take place on '
                .$formatedDate.' in '.$event['location'].PHP_EOL;
        }
}

function display_events_by_month(array $events)
{
        $eventsByMonth = [];

        foreach ($events as $event) {
                $eventsByMonth[] = $event;
        }

        // sort by $event['date']
        usort($eventsByMonth, function($a, $b) {
                return $a['date'] <=> $b['date'];
        });

        foreach ($eventsByMonth as $key=> $event) {
                if(!isset($eventsByMonth[$key - 1])
                    || $event['date'] !== $eventsByMonth[$key - 1]['date']) {
                        echo formatDateForMonth($event['date']);
                }
                display_event($event, true);
        }
}

function display_events_between_months(array $events, string $dateBegin, string $dateEnd)
{
        $eventsBetweenMonths = [];
        foreach ($events as $key => $event) {
                //var_dump(isBetween($event['date'], $dateBegin, $dateEnd));
                if(isBetween($event['date'], $dateBegin, $dateEnd)) {
                        $eventsBetweenMonths[] = $event;
                }
        }

        // sort by $event['date']
        usort($eventsBetweenMonths, function($a, $b) {
                return $a['date'] <=> $b['date'];
        });

        foreach ($eventsBetweenMonths as $key => $event) {
                if(!isset($eventsBetweenMonths[$key - 1])
                    || $event['date'] !== $eventsBetweenMonths[$key - 1]['date']) {
                        echo formatDateForMonth($event['date']);
                }
                display_event($event, true);
        }

}

function display_calendar(array $events, string $dateBegin, string $dateEnd) {

}