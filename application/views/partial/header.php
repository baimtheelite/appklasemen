<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Klasemen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url('resources/css/bootstrap.min.css') ?>"/> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= base_url('resources/css/w3-colors-win8.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('resources/css/w3.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('resources/css/mdb.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('resources/fontawesome-free-5.7.1-web/css/all.css') ?>">

    <script src="<?= base_url('resources/js/popper.min.js') ?>"></script>
    <script src="<?= base_url('resources/js/bootstrap.min.js') ?>"></script>    
    <script src="<?= base_url('resources/js/jquery-3.3.1.js')?>"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <style>
        .fog{
            opacity: 0.3;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 8px">
    <!-- <a class="navbar-brand" href="#">Navbar</a> -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item <?= ($active == '' ? 'active' : '') ?>">
                <a class="nav-link" href="<?= base_url('Klasemen'); ?>">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?= ($active == 'pertandingan' ? 'active' : '') ?>">
                <a class="nav-link" href="<?= base_url('Klasemen/pertandingan') ?>">Pertandingan</a>
            </li>
            <li class="nav-item <?= ($active == 'match_results' ? 'active' : '') ?>">
                <a class="nav-link" href="<?= base_url('Klasemen/match_results') ?>">Hasil</a>
            </li>
        </ul>
    </div>
    </nav>