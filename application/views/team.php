<?php $this->load->view('partial/header') ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                <div class="card-header text-center"><h3>Team</h3></div>
                    <div class="card-body text-center">
                        <img src="<?= base_url('uploads/'. $tim->logo) ?>" alt="" height="150" width="150">
                        <h1 class=""><?= $tim->nama_team; ?></h1>
                        <h2 class="text-secondary">(<?= $tim->kode_team; ?>) <button type="button" class="btn-sm btn-outline-primary" data-toggle="modal" data-target="#posisiTeam">Lihat Posisi</button></h2>
                    </div>
                </div>
            </div>
        </div>
    <!-- Statistik -->
    <div class="row" style="margin-top: 8px">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Statistik</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Menang -->
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                <h3 class="text-center">Menang</h3>
                                </div>
                                <div class="card-body text-center">
                                    <h1 class="text-success"><?= $tim->menang; ?></h1>
                                </div>
                            </div>
                        </div>
                        <!-- Seri -->
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header bg-secondary text-white">
                                    <h3 class="text-center">Seri</h3>
                                </div>
                                <div class="card-body text-center">
                                    <h1 class="text-secondary"><?= $tim->seri; ?></h1>
                                </div>
                            </div>
                        </div>
                        <!-- Kalah -->
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header bg-danger text-white">
                                    <h3 class="text-center">Kalah</h3>
                                </div>
                                <div class="card-body text-center">
                                    <h1 class="text-danger"><?= $tim->kalah; ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 8px">
                        <!-- Goal For -->
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                <h3 class="text-center">Goal For</h3>
                                </div>
                                <div class="card-body text-center">
                                    <h1 class="text-success"><?= $tim->goal_for; ?></h1>
                                </div>
                            </div>
                        </div>
                        <!-- Goal Difference -->
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header bg-secondary text-white">
                                    <h3 class="text-center">Goal Difference</h3>
                                </div>
                                <div class="card-body text-center">
                                    <h1 class="text-secondary"><?= $tim->goal_difference; ?></h1>
                                </div>
                            </div>
                        </div>
                        <!-- Goal Against -->
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header bg-danger text-white">
                                    <h3 class="text-center">Goal Against</h3>
                                </div>
                                <div class="card-body text-center">
                                    <h1 class="text-danger"><?= $tim->goal_against; ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Points -->
                    <div class="row" style="margin-top: 8px">
                        <div class="col-lg-4">
                        
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h3 class="text-center">Points</h3>
                                </div>
                                <div class="card-body text-center">
                                    <h1 class="text-primary"><?= $tim->points; ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top Goal -->
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
        <!-- Top Assist -->
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
    <!-- Daftar Pemain -->
    <div class="row" style="margin-top: 8px">
        <div class="col-lg-12">
            <div class="card">
            <div class="card-header text-center">
                <h2>Squad</h2>
            </div>
            <div class="card-body">
                <button class="btn btn-default" data-toggle="modal" data-target="#tambahPemain"><i class="fa fa-plus"></i> Tambah Pemain</button>
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
    <!-- Hasil Pertandingan -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center"><h2>Hasil Pertandingan</h2></div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>No.</th>
                            <th>Home</th>
                            <th></th>
                            <th></th>
                            <th>Away</th>
                            <th>Tanggal</th>
                            <th></th>
                        </thead>
                        <tbody>
                        <?php if($results->num_rows() > 0){ ?>
                            <?php foreach($results->result() as $r){ 
                                $no = 1
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><img width="50" height="50" src="<?= base_url('uploads/'.$r->logo_home) ?>" alt=""> <?=$r->home; ?></td>
                                    <td><h2><?= $r->skor_home; ?></h2></td>
                                    <td><h2><?= $r->skor_away;?></h2></td>
                                    <td><img width="50" height="50" src="<?= base_url('uploads/'.$r->logo_away) ?>" alt=""><?= $r->away;?></td>
                                    <td><?= $r->tgl;?></td>
                                    <td><a class="btn btn-primary" href="<?= base_url('Klasemen/match_results_detail/'.$r->id_match_results); ?>">Buka</a></td>
                            <?php } ?>
                        <?php } ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        <?php $this->load->view('partial/posisi_team');  ?>  
        <?php $this->load->view('partial/tambah_pemain');  ?>  
    </div>  

</body>
</html>