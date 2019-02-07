<?php $this->load->view('partial/header.php') ?>

    <div class="container">
        <div class="jumbotron text-center">
            <h1>Klasemen Liga Tarkam</h1>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Tabel Klasemen</h2>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead>
                                <th>Posisi</th>
                                <th><!-- Logo --></th>
                                <th>Team</th>
                                <th>Menang</th>
                                <th>Seri</th>
                                <th>Kalah</th>
                                <th>Goal For</th>
                                <th>Goal Against</th>
                                <th>Goal Difference</th>
                                <th>Points</th>
                            </thead>
                            <tbody>
                                <!-- Rekor Klasemen -->
                                <?php $no = 1; ?>
                                <?php foreach ($team->result() as $klasemen) { ?>
                                    <tr >
                                        <td><?= $no; ?></td>
                                        <td><img src="<?= base_url('uploads/').$klasemen->logo ?>" alt="no logo" width="50" height="50"></td>
                                        <td><?= $klasemen->nama_team; ?></td>
                                        <td><?= $klasemen->menang ?></td>
                                        <td><?= $klasemen->seri ?></td>
                                        <td><?= $klasemen->kalah ?></td>
                                        <td><?= $klasemen->goal_for ?></td>
                                        <td><?= $klasemen->goal_against ?></td>
                                        <td><?= $klasemen->goal_difference ?></td>
                                        <td><?= $klasemen->points ?></td>
                                    </tr>
                                    <?php $no++; ?>
                               <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <table class="table"></table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Team</h4>
                    </div>
                    <div class="card-body">
                    <?php 
                    $row_count = 0 ;
                    $num_of_cols = 4;
                    ?>
                        <div class="row">
                        <?php foreach ($team->result() as $tim ) { ?>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <h5><?=  $tim->nama_team; ?></h5>
                                    </div>
                                    <div class="card-body text-center">
                                        <img class="img-fluid" src="<?= base_url('uploads/'). $tim->logo ?>" alt="no logo" width="150" height="150">
                                    </div>
                                </div>
                            </div>
                            <?php 
                            $row_count++; 
                            if($row_count % $num_of_cols == 0) echo '</div><div class="row" style="margin-top: 8px">';
                            ?>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>