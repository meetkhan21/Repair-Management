<?php
function convertHtmlTime($date,$time){
    $newDate = date($date);
    $newTime = date($time);
    $datetime = new DateTime($newDate.$newTime);
    return date_format($datetime, 'YmdHis');
}