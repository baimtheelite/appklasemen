<?php $this->load->view('partial/header.php') ?>

    <div class="container">
        <div class="jumbotron text-center bg-light">
            <h1>Hasil Pertandingan</h1>
            <h2><?= $data_home->nama_team ?> vs <?= $data_away->nama_team ?></h2>
            <h3 class="text-muted"><?= $data_home->tgl ?></h3>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3 class="text-center text-primary">Home</h3>
                        <img height="100" width="100" src="<?= base_url('uploads/'.$data_home->logo); ?>">
                    </div>
                    <div class="card-body">
                        <table class="table table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Pemain</th>
                                    <th>Goal</th>
                                    <th>Assist</th>
                                    <th>Own Goal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach($home->result() as $h){ ?>
                                    <tr>
                                       <td><?=$no++; ?></td>
                                       <td><?= $h->nama_pemain ?></td>
                                       <td><span <?= ($h->goal > 0 ? 'class="badge bg-success"' : '') ?>><?= $h->goal ?></span></td>
                                       <td><span <?= ($h->assist > 0 ? 'class="badge bg-secondary"' : '') ?>><?= $h->assist ?></span></td>
                                       <td><?= $h->owngoal ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3 class="text-center text-danger">Away</h3>
                        <img height="100" width="100" src="<?= base_url('uploads/'.$data_away->logo); ?>">
                    </div>
                    <div class="card-body">
                        <table class="table table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Pemain</th>
                                    <th>Goal</th>
                                    <th>Assist</th>
                                    <th>Own Goal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach($away->result() as $a){ ?>
                                    <tr>
                                       <td><?=$no++; ?></td>
                                       <td><?= $a->nama_pemain ?></td>
                                       <td><span <?= ($a->goal > 0 ? 'class="badge bg-success"' : '') ?>><?= $a->goal ?></span></td>
                                       <td><span <?= ($a->assist > 0 ? 'class="badge bg-secondary"' : '') ?>><?= $a->assist ?></span></td>
                                       <td><?= $a->owngoal ?></td>
                                    </tr>
                                <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>