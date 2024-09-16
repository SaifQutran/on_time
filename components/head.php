<?php
function head($title)
{
    echo
    "<!DOCTYPE html>
    <html lang='ar' dir='rtl'>
    <head>
        <meta charset='utf-8' />
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no' />
        <title>أون تايم - $title</title>
        <link rel='icon' type='image/x-icon' href='assets/favicon.ico' />
        <script src='https://use.fontawesome.com/releases/v6.3.0/js/all.js' crossorigin='anonymous'></script>
        <link href='../assets/css/bootstrap-5.3.2/dist/css/bootstrap.rtl.css' rel='stylesheet' />
        <link href='../assets/css/style.css' rel='stylesheet' />
    </head>";
}
function closeHTML(){
    echo "</html>";
}
