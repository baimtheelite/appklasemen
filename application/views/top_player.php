<?php $this->load->view('partial/header.php') ?>
<div class="container">

    <div class="jumbotron text-center">
        <h1>Klasemen Liga Tarkam</h1>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card text-center">
                <div class="card-header bg-primary text-white">Top Goal</div>
                <div class="card-body">
                    <h2><?= $top_skor[0]->nama_pemain ?></h2>
                    <img class="img-rounded" height="150" width="150" src="<?= base_url('uploads/players/user_default.jpg') ?>" alt="">
                    <h2><?= $top_skor[0]->goal; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card text-center">
                <div class="card-header bg-secondary text-white">Top Assist</div>
                <div class="card-body">
                    <h2><?= $top_assist[0]->nama_pemain ?></h2>
                    <img class="img-rounded" height="150" width="150" src="<?= base_url('uploads/players/user_default.jpg') ?>" alt="">
                    <h2><?= $top_assist[0]->assist; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
                <div class="card text-center">
                    <div class="card-header">Top Own Goal</div>
                    <div class="card-body">
                        <h2><?= $top_owngoal[0]->nama_pemain ?></h2>
                    <img class="img-rounded" height="150" width="150" src="<?= base_url('uploads/players/user_default.jpg') ?>" alt="">
                    <h2><?= $top_owngoal[0]->owngoal; ?></h2>
                    </div>
                </div>
            </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-4">
            <div class="card">
                <table class="table" id="topSkor">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Pemain</th>
                            <th>Goal</th>
                            <th>Tim</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($top_skor as $top){ ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <th><?= $top->nama_pemain; ?></th>
                            <th><?= $top->goal; ?></th>
                            <th><img src="<?= base_url('uploads/'.$top->logo); ?>" alt="" width="50" height="50"></th>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>       
        </div>
        <div class="col-lg-4">
            <div class="card">
                <table class="table" id="topAssist">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Pemain</th>
                            <th>Assist</th>
                            <th>Tim</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($top_assist as $top){ ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <th><?= $top->nama_pemain; ?></th>
                            <th><?= $top->assist; ?></th>
                            <th><img src="<?= base_url('uploads/'.$top->logo); ?>" alt="" width="50" height="50"></th>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>       
        </div>
        <div class="col-lg-4">
            <div class="card">
                <table class="table" id="topOwngoal">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Pemain</th>
                            <th>Own Goal</th>
                            <th>Tim</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($top_owngoal as $top){ ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <th><?= $top->nama_pemain; ?></th>
                            <th><?= $top->owngoal; ?></th>
                            <th><img src="<?= base_url('uploads/'.$top->logo); ?>" alt="" width="50" height="50"></th>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>       
        </div>
    </div>
</div>

<script>
    $("#topSkor").DataTable();
    $("#topAssist").DataTable();
    $("#topOwngoal").DataTable();
</script>
</body>
</html>                    