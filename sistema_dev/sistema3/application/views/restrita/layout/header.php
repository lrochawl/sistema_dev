<!DOCTYPE html>
<html lang="en">


<!-- blank.html  21 Nov 2019 03:54:41 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>WL TOPOS - <?= isset($titulo) ? $titulo : 'LOJA' ?></title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url("public/assets/css/app.min.css"); ?>">
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url("public/assets/css/style.css"); ?>">
    

    <?php if (isset($styles)) : ?>

        <?php foreach ($styles as $style) : ?>
            <link rel="stylesheet" href="<?= base_url("public/assets/" . $style); ?>">
        <?php endforeach ?>

    <?php endif; ?>

    <!-- Custom style CSS -->
    <link rel="stylesheet" href="<?= base_url("public/assets/css/components.css"); ?>">
    <link rel='shortcut icon' type='image/x-icon' href='public/assets/img/favicon.ico' />
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">