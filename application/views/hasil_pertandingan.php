<?php $this->load->view('partial/header.php') ?>

    <div class="container">
        <div class="jumbotron text-center">
            <h1>Hasil Pertandingan</h1>
        </div>

        <table class="table table">
        <thead>
            <tr>
                <th>Home</th>
                <th></th>
                <th></th>
                <th>Away</th>
                <th>Tanggal</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($results->result() as $hasil){ ?>
                    <tr>
                        <td><img width="50" height="50" src="<?= base_url('uploads/'.$hasil->logo_home) ?>" alt=""> <?=$hasil->home; ?></td>
                        <td><h2><?= $hasil->skor_home; ?></h2></td>
                        <td><h2><?= $hasil->skor_away;?></h2></td>
                        <td><img width="50" height="50" src="<?= base_url('uploads/'.$hasil->logo_away) ?>" alt=""><?= $hasil->away;?></td>
                        <td><?= $hasil->tgl;?></td>
                        <td><a class="btn btn-primary" href="<?= base_url('Klasemen/match_results_detail/'.$hasil->id_match_results); ?>">Buka</a></td>
                    </tr>
                <?php } ?>
        </tbody>
        </table>
    </div>