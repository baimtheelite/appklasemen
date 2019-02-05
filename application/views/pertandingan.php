<?php $this->load->view('partial/header.php') ?>
<!-- <div id="timsama" class="alert alert-warning alert"></div> -->
<?= form_open(''); ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
               <div class="col-md-6">
                    <div class="card text-center">
                        <div class="card-header">
                            <h4>Home</h4>
                        </div>
                        <div class="card-body">
                            <img id="logohome" class="rounded mx-auto d-block" src=""  alt="" width="150" height="150">
                        </div>
                        <div class="card-footer">
                            <select name="home" id="home">
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
                            <h4>Away</h4>            
                        </div>
                        <div class="card-body">
                            <img id="logoaway" class="rounded mx-auto d-block" src="" alt="" width="150" height="150">
                        </div>
                        <div class="card-footer">
                        <select name="away" id="away">
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
                        <th>No</th>
                        <th>Nama</th>
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
                        <th>No</th>
                        <th>Nama</th>
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
            $("#logohome").fadeOut("slow");
            $.ajax({
                url         : '<?= base_url("Klasemen/match/"); ?>' +home,
                type        : 'GET',
                async       : false,
                dataType    : 'json',
                data        : {home:home},
                success     : function(data){
                    $("#teamhome").val(data.team[0].kode_team)
                    $("#logohome").attr("src", "<?= base_url('uploads/'); ?>"+data.team[0].logo);
                    $("#logohome").fadeIn("slow");

                    var html = ''
                    var i;
                    for(i = 0; i < data.pemain.length; i++){
                        html += '<tr>'+
                                    '<td><span class="badge badge-secondary">'+data.pemain[i].nomor_punggung+'</span></td>'+
                                    '<td>'+data.pemain[i].nama_pemain+'</td>'+
                                    '<td><input class="enable goal-home form-control col-6" name="pemain_home['+data.pemain[i].id_pemain+'][goal_home]" type="number" value="0" disabled></td>'+
                                    '<td><input class="enable assist-home form-control col-6" name="pemain_home['+data.pemain[i].id_pemain+'][assist_home]" type="number" value="0" disabled></td>'+
                                    '<td><input class="enable owngoal-home form-control col-6" name="pemain_home['+data.pemain[i].id_pemain+'][owngoal_home]" type="number" value="0" disabled></td>'+
                                '</tr>'
                    }
                    $("#table-home").slideDown("slow", function(){
                        $(this).html(html);
                    });
                }
            })
        });

        $('#away').change(function(){
            var away = $(this).val();
            $("#logoaway").fadeOut("slow");
            $.ajax({
                url         : '<?= base_url("Klasemen/match/"); ?>' +away,
                type        : 'GET',
                async       : false,
                dataType    : 'json',
                data        : {away:away},
                success     : function(data){
                    $("#teamaway").val(data.team[0].kode_team);                    
                    $("#logoaway").attr("src", "<?= base_url('uploads/'); ?>"+data.team[0].logo);
                    $("#logoaway").fadeIn("slow");
                    
                    var html = ''
                    var i;
                    for(i = 0; i < data.pemain.length; i++){
                        html += '<tr>'+
                                    '<td><span class="badge badge-secondary">'+data.pemain[i].nomor_punggung+'</span></td>'+
                                    '<td>'+data.pemain[i].nama_pemain+'</td>'+
                                    '<td><input class="enable goal-away form-control col-6" name="pemain_away['+data.pemain[i].id_pemain+'][goal_away]" type="number" value="0" disabled></td>'+
                                    '<td><input class="enable assist-away form-control col-6" name="pemain_away['+data.pemain[i].id_pemain+'][assist_away]" type="number" value="0" disabled></td>'+
                                    '<td><input class="enable owngoal-away form-control col-6" name="pemain_away['+data.pemain[i].id_pemain+'][owngoal_away]" type="number" value="0" disabled></td>'+
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
                }else{
                    $("#submit, .enable").attr("disabled", "true");     
                    //$("#timsama").html("Tim sama! ubah team!")
                    alert("Tim home dan away sama. Ubah team!");
                }
            }   
        })
        
        $("#table-home, #table-away").on("click", ".goal-home, .goal-away, .owngoal-home, .owngoal-away",function(){
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
