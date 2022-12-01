<?php
$themeStyleSheet = '/light_theme.css';
if (!empty($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark') {
    $themeStyleSheet = '/dark_theme.css';
}
$lang = "ru";
if (!empty($_COOKIE['lang']) && $_COOKIE['lang'] == 'en') {
    $lang = "en";
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Страница с cookies</title>
    <link id="theme-link" rel="stylesheet" href="<?php echo $themeStyleSheet; ?>" type="text/css"/>
</head>
<?php if ($lang == "ru"):
    include "lang/ru/page.php"
    ?>
<?php else:
    include "lang/en/page.php"
    ?>
<?php endif ?>
<script src="/cookies.js"></script>
</html>

