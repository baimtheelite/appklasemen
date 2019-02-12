<?php $this->load->view('partial/header.php') ?>
<div style="visibility: hidden" id="timsama" class="alert alert-warning alert text-center">Tim Home dan Away Sama. Tidak dapat mengubah skor!</div>
<?= form_open(''); ?>
<div class="container">
    <div class="row">
    <input name="id_match_results" type="hidden" readonly value="<?= $id_match_results; ?>">
        <div class="col-lg-12">
            <div class="row">
               <div class="col-md-6">
                    <div class="card text-center">
                        <div class="card-header">
                            <h4 class="text-primary">Home</h4>
                        </div>
                        <div class="card-body">
                            <img id="logohome" class="rounded mx-auto d-block" src=""  alt="" width="150" height="150">
                        </div>
                        <div class="card-footer">
                            <select class="form-control-lg" name="home" id="home">
                              <option value="" selected disabled hidden>-Pilih Team- </option>
                                <?php foreach ($team->result() as $match) { ?>
                                        <option value="<?= $match->id_team; ?>"><?= $match->nama_team; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 32px; margin-bottom: 32px;">
                        <div class="card w-50 mx-auto">
                            <div class="card-header">
                                <input name="teamhome" class="form-control form-control-lg col-4 mx-auto text-center" value="" id="teamhome" type="text" readonly>
                            </div>
                            <div class="card-body">
                                <input name="skorhome" class="form-control form-control-lg col-3 mx-auto text-center" value="0" id="skorhome" type="number" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card text-center">
                        <div class="card-header">
                            <h4 class="text-danger">Away</h4>            
                        </div>
                        <div class="card-body">
                            <img id="logoaway" class="rounded mx-auto d-block" src="" alt="" width="150" height="150">
                        </div>
                        <div class="card-footer">
                        <select class="form-control-lg" name="away" id="away">
                              <option value="" selected disabled hidden>-Pilih Team- </option>
                                <?php foreach ($team->result() as $match) { ?>
                                        <option value="<?= $match->id_team; ?>"><?= $match->nama_team; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 32px; margin-bottom: 32px;">
                        <div class="card w-50 mx-auto">
                            <div class="card-header">
                                <input name="teamaway" class="form-control form-control-lg col-4 mx-auto text-center" value="" id="teamaway" type="text" readonly>
                            </div>
                            <div class="card-body">
                                <input name="skoraway" class="form-control form-control-lg col-3 mx-auto text-center" value="0" id="skoraway" type="number" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <table class="table">
                    <thead>
                        <th>Nama</th>
                        <th></th>
                        <th>Goal</th>
                        <th>Assist</th>
                        <th>Own Goal</th>
                    </thead>
                    <tbody id="table-home">

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <table class="table">
                    <thead>
                        <th>Nama</th>
                        <th></th>
                        <th>Goal</th>
                        <th>Assist</th>
                        <th>Own Goal</th>
                    </thead>
                    <tbody id="table-away">

                    </tbody>
                </table>
            </div>
        </div>
        <button id="submit" name="hasil_match" class="btn btn-primary btn-block" type="submit" disabled>Submit</button>
    </div>
    </div>
    <?= form_close(); ?>

</body>

<script>
    $(document).ready(function(){
        $('#home').change(function(){
            var home = $(this).val();
            $.ajax({
                url         : '<?= base_url("Klasemen/match/"); ?>' +home,
                type        : 'GET',
                async       : false,
                dataType    : 'json',
                data        : {home:home},
                success     : function(data){
                    $("#teamhome").val(data.team[0].kode_team)
                    $("#logohome").attr("src", "<?= base_url('uploads/'); ?>"+data.team[0].logo);

                    var html = '';
                    var i;
                    for(i = 0; i < data.pemain.length; i++){
                        html += '<tr>'+
                                    '<td>'+data.pemain[i].nama_pemain+'</td>'+
                                    '<td><span class="badge badge-primary">'+data.pemain[i].nomor_punggung+'</span></td>'+
                                    '<td><input class="enable goal-home form-control col-6" name="pemain['+data.pemain[i].id_pemain+'][goal]" type="number" value="0" disabled></td>'+
                                    '<td><input class="enable assist-home form-control col-6" name="pemain['+data.pemain[i].id_pemain+'][assist]" type="number" value="0" disabled></td>'+
                                    '<td><input class="enable owngoal-home form-control col-6" name="pemain['+data.pemain[i].id_pemain+'][owngoal]" type="number" value="0" disabled></td>'+
                                    '<input type="hidden" name="pemain['+data.pemain[i].id_pemain+'][side]" value="home">'+
                                '</tr>'
                    }
                        $("#table-home").html(html);
                }
            })
        });

        $('#away').change(function(){
            var away = $(this).val();
            $.ajax({
                url         : '<?= base_url("Klasemen/match/"); ?>' +away,
                type        : 'GET',
                async       : false,
                dataType    : 'json',
                data        : {away:away},
                success     : function(data){
                    $("#teamaway").val(data.team[0].kode_team);                    
                    $("#logoaway").attr("src", "<?= base_url('uploads/'); ?>"+data.team[0].logo);
                    
                    var html = ''
                    var i;
                    for(i = 0; i < data.pemain.length; i++){
                        html += '<tr>'+
                                    '<td>'+data.pemain[i].nama_pemain+'</td>'+
                                    '<td><span class="badge badge-danger">'+data.pemain[i].nomor_punggung+'</span></td>'+
                                    '<td><input class="enable goal-away form-control col-6" name="pemain['+data.pemain[i].id_pemain+'][goal]" type="number" value="0" disabled></td>'+
                                    '<td><input class="enable assist-away form-control col-6" name="pemain['+data.pemain[i].id_pemain+'][assist]" type="number" value="0" disabled></td>'+
                                    '<td><input class="enable owngoal-away form-control col-6" name="pemain['+data.pemain[i].id_pemain+'][owngoal]" type="number" value="0" disabled></td>'+
                                    '<input type="hidden" name="pemain['+data.pemain[i].id_pemain+'][side]" value="away">'+                                
                                '</tr>'
                    }
                    $("#table-away").html(html);
                }
            })
        })

        $(document).on("change", "#away, #home", function(){
            if($("#home").val() != null && $("#away").val() != null) {
                if($("#home").val() != $("#away").val()){
                    $("#submit, .enable").removeAttr("disabled");
                    $("#timsama").css('visibility', 'hidden');
                }else{
                    $("#submit, .enable").attr("disabled", "true");     
                    $("#timsama").css('visibility', 'visible');
                    alert("Tim home dan away sama. Ubah team!");
                }
            }   
        })
        
        $("#table-home, #table-away").on("click", ".goal-home, .goal-away, .owngoal-home, .owngoal-away", function(){
            var totalGoalHome = 0;
            var totalGoalAway = 0;

            $(".goal-home, .owngoal-away").each(function(){
                 totalGoalHome = totalGoalHome + parseInt($(this).val());
            })           
            $("#skorhome").val(totalGoalHome);
            
            $(".goal-away, .owngoal-home").each(function(){
                 totalGoalAway = totalGoalAway + parseInt($(this).val());
            })            
            $("#skoraway").val(totalGoalAway);
        })

    })
</script>
</html>
