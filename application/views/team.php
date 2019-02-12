<?php $this->load->view('partial/header') ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Team</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="container">
        <!-- <div class="jumbotron text-center">
            <h1>Team</h1>
        </div> -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
            <div class="card-header text-center"><h3>Team</h3></div>
                <div class="card-body text-center">
                    <img src="<?= base_url('uploads/'. $tim->logo) ?>" alt="" height="150" width="150">
                    <h1 class=""><?= $tim->nama_team; ?></h1>
                    <h2 class="text-secondary">(<?= $tim->kode_team; ?>)</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 8px">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header text-center"><h4>Top Goal</h4></div>
                <div class="card-body text-center">
                    <h2 class="text-primary"><?= $goal[0]->nama_pemain ?></h2>
                    <img class="img-rounded" height="150" width="150" src="<?= base_url('uploads/players/user_default.jpg') ?>" alt="">
                    <h2 class="text-primary"><?= $goal[0]->goal ?> Goal</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header text-center"><h4>Top Assist</h4></div>
                <div class="card-body text-center">
                    <h2 class="text-primary"><?= $assist[0]->nama_pemain ?></h2>
                    <img class="img-rounded" height="150" width="150" src="<?= base_url('uploads/players/user_default.jpg') ?>" alt="">
                    <h2 class="text-primary"><?= $assist[0]->assist ?> Assist</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 8px">
        <div class="col-lg-12">
            <div class="card">
                <table class="table table-bordered">
                    <thead>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Posisi</th>
                        <th>Goal</th>
                        <th>Assist</th>
                        <th>Own Goal</th>
                    </thead>
                    <tbody>
                    <?php $no = 1; ?>
                        <?php foreach($squad as $s){ ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $s->nama_pemain; ?></td>
                                <td><?= $s->posisi ?></td>
                                <td><?= $s->goal ?></td>
                                <td><?= $s->assist; ?></td>
                                <td><?= $s->owngoal; ?></td> 
                            </tr>
                        <?php }  ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>

    </div>    
</body>
</html>