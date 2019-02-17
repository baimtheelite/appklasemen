<!-- Modal -->
<div class="modal fade" id="posisiTeam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
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
                <?php foreach ($posisi as $klasemen) { ?>
                    <tr class="<?= ($klasemen->id_team != $tim->id_team) ? 'fog':'' ?>"" >
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
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>