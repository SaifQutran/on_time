<?php
function head($title)
{
    Date_default_timezone_set('Asia/Riyadh');
    echo
    "<!DOCTYPE html>
    <html lang='ar' dir='rtl'>
    <head>
        <meta charset='utf-8' />
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no' />
        <title>أون تايم - $title</title>
        <link rel='icon' type='image/x-icon' href='assets/favicon.ico' />
        <link href='../assets/css/bootstrap-5.3.2/dist/css/bootstrap.rtl.css' rel='stylesheet' />
        <link href='../assets/css/style.css' rel='stylesheet' />
        
        <link rel='stylesheet' href='../assets/fonts/material-icon/css/material-design-iconic-font.min.css'>
        <link href='https://fonts.googleapis.com/icon?family=Material+Icons+Sharp' rel='stylesheet'>
        <link rel='stylesheet' href='../assets/css/dist/css/main.css' />
        <link href='https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css' rel='stylesheet'>
    </head>";
}
function closeHTML()
{
    echo "</html>";
}
function tester($print)
{
?>
    <script>
        console.log('<?= "<pre>" . var_dump($print) . "</pre>" ?>');
    </script>

<?php
}
function alerter($print)
{
?>
    <script>
        alert("<?= $print ?>");
    </script>

<?php
}
function scripts()
{
    echo "
        <script src='https://use.fontawesome.com/releases/v6.3.0/js/all.js' crossorigin='anonymous'></script>
        <script src='../assets/css/bootstrap-5.3.2/dist/js/bootstrap.js' crossorigin='anonymous'></script>
        <script src='../assets/js/app.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/chart.js'></script>
        <script src='../assets/css/dist/js/main.min.js'></script>";
}
function progressLine($progress)
{
?>
    <div class="border border-dark" style="height:15px; width:100px;padding:2px; background-color: rgba(255,255,255,0.5); border-radius:20px;">
        <div style="width:<?=$progress?>%;height:100%;background-color:green; border-radius:20px;">&nbsp;</div>
    </div>
<?php
}
