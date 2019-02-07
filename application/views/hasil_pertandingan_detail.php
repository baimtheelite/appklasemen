<?php $this->load->view('partial/header.php') ?>

    <div class="container">
        <div class="jumbotron text-center">
            <h1>Hasil Pertandingan</h1>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <table class="table table">
                    <h3 class="text-center text-primary">Home</h3>
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
                               <td><?= $h->goal ?></td>
                               <td><?= $h->assist ?></td>
                               <td><?= $h->owngoal ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6">
                <table class="table table">
                    <h3 class="text-center text-primary">Home</h3>
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
                               <td><?= $a->goal ?></td>
                               <td><?= $a->assist ?></td>
                               <td><?= $a->owngoal ?></td>
                            </tr>
                        <?php } ?>
                </table>
            </div>
        </div>
    </div>