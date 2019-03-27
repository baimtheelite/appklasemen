    <?php
    class Klasemen extends CI_Controller
    {
        public function __construct(){
            parent::__construct();
            $this->load->model('M_klasemen', 'm');
        }

        public function index(){
            $data['active'] = $this->uri->segment(2);
            $data['team'] = $this->m->query('SELECT * FROM tbl_team ORDER BY points DESC, goal_difference DESC');
            $data['team_card'] = $this->m->query('SELECT * FROM tbl_team ORDER BY nama_team');
            
            $this->load->view('index', $data);
        }
        
        public function pertandingan(){
            if(isset($_POST['hasil_match'])){
                //UPDATE Goal, assist, own goal pemain HOME
                $pemain             = $this->input->post('pemain');
                $id_match_post      = $this->input->post('id_match_results');

                foreach ($pemain as $id => $val) {
                    $this->m->query('UPDATE 
                                        tbl_pemain 
                                    SET 
                                        goal    = (goal + '.$val["goal"].'),
                                        assist  = (assist   + '.$val["assist"].'), 
                                        owngoal = (owngoal  + '.$val["owngoal"].') 
                                    WHERE 
                                        id_pemain = '.$id.' 
                                    ');
                    $this->m->query('INSERT INTO 
                                        tbl_match_results_detail (id_pemain, goal, assist, owngoal, side, id_match_results)
                                    VALUES
                                        ('.$id.', '.$val["goal"].', '.$val["assist"].', '.$val["owngoal"].', "'.$val["side"].'", '.$id_match_post.')
                                    ');
                }

                $skor_home = $this->input->post('skorhome');
                $skor_away = $this->input->post('skoraway');
                $team_home = $this->input->post('teamhome');
                $id_team_home = $this->input->post('home');
                $id_team_away = $this->input->post('away');
                $team_away = $this->input->post('teamaway');

                $match_result = array(
                                    'id_team_home' => $id_team_home,
                                    'id_team_away' => $id_team_away,
                                    'skor_home' => $skor_home,
                                    'skor_away' => $skor_away,
                                    'tanggal' => date("Y/m/d"),
                                    'id_match_results' => $id_match_post
                                );
                $this->m->Insert('tbl_match_results', $match_result);

                if($skor_home > $skor_away){
                    $this->m->query('UPDATE 
                                        tbl_team
                                    SET
                                        menang          = (menang       + 1),
                                        points          = (points       + 3),
                                        goal_for        = (goal_for     + '.$skor_home.'),
                                        goal_against    = (goal_against + '.$skor_away.'),
                                        goal_difference = (goal_for     - goal_against)
                                    WHERE 
                                        kode_team = "'.$team_home.'"
                    ');
                    $this->m->query('UPDATE 
                                        tbl_team
                                    SET
                                        kalah       = (kalah + 1),
                                        goal_for        = (goal_for     + '.$skor_away.'),
                                        goal_against    = (goal_against + '.$skor_home.'),
                                        goal_difference = (goal_for     - goal_against),
                                        points          = (points       + 0)
                                    WHERE
                                        kode_team = "'.$team_away.'"
                                    ');
                }
                else if($skor_home == $skor_away){
                    $this->m->query('UPDATE 
                                        tbl_team
                                    SET
                                        seri            = (seri + 1),
                                        points          = (points + 1),
                                        goal_for        = (goal_for + '.$skor_home.'),
                                        goal_against    = (goal_against + '.$skor_away.'),
                                        goal_difference = (goal_for - goal_against)
                                    WHERE 
                                        kode_team IN ("'.$team_home.'", "'.$team_away.'")
                                        ');
                }
                else{
                    $this->m->query('UPDATE 
                                        tbl_team
                                    SET
                                        menang          = (menang + 1),
                                        points          = (points + 3),
                                        goal_for        = (goal_for + '.$skor_away.'),
                                        goal_against    = (goal_against + '.$skor_home.'),
                                        goal_difference = (goal_for - goal_against)
                                    WHERE 
                                        kode_team = "'.$team_away.'"');
                    $this->m->query('UPDATE 
                                        tbl_team
                                    SET
                                        kalah           = (kalah + 1),
                                        goal_for        = (goal_for     + '.$skor_home.'),
                                        goal_against    = (goal_against + '.$skor_away.'),
                                        goal_difference = (goal_for     - goal_against),
                                        points          = (points       + 0)
                                    WHERE
                                        kode_team = "'.$team_home.'"
                                    ');                    
                }

                redirect('Klasemen');
            }
            $active = $this->uri->segment(2);
            $team = $this->m->query('SELECT * FROM tbl_team ORDER BY nama_team ASC');
            $id_match_results   = $this->m->max('tbl_match_results', 'id_match_results');            
            $data = array(
                'id_match_results' => ($id_match_results[0]['id_match_results'] + 1),
                'team' => $team,
                'active' => $active
            );
            $this->load->view('pertandingan.php', $data);
        }
        
        public function match_results(){
            $data['active'] = $this->uri->segment(2);
            $data['results'] = $this->m->query('SELECT *, team_home.kode_team as home, team_away.kode_team as away, team_home.logo as logo_home, team_away.logo as logo_away, DATE_FORMAT(tanggal, "%d %M %Y") as tgl 
                                                FROM tbl_match_results 
                                                INNER JOIN tbl_team as team_home ON tbl_match_results.id_team_home = team_home.id_team
                                                INNER JOIN tbl_team as team_away ON tbl_match_results.id_team_away = team_away.id_team
                                                ORDER BY id_match_results DESC
                                                ');
            $this->load->view('hasil_pertandingan', $data);
        }

        public function match_results_detail($id_match_results){
            $active = $this->uri->segment(2);
           $home = $this->m->query('SELECT *, tbl_match_results_detail.goal as goal, tbl_match_results_detail.assist as assist, tbl_match_results_detail.owngoal as owngoal, DATE_FORMAT(tanggal, "%d %M %Y") as tgl 
                                                    FROM tbl_match_results_detail
                                                    INNER JOIN tbl_pemain ON tbl_match_results_detail.id_pemain = tbl_pemain.id_pemain
                                                    INNER JOIN tbl_team ON tbl_team.id_team = tbl_pemain.id_team
                                                    INNER JOIN tbl_match_results ON tbl_match_results.id_match_results = tbl_match_results_detail.id_match_results
                                                    WHERE tbl_match_results_detail.id_match_results = '.$id_match_results.' AND side = "home"
                                                ');      
            $away = $this->m->query('SELECT *, tbl_match_results_detail.goal as goal, tbl_match_results_detail.assist as assist, tbl_match_results_detail.owngoal as owngoal, DATE_FORMAT(tanggal, "%d %M %Y") as tgl
                                                    FROM tbl_match_results_detail
                                                    INNER JOIN tbl_pemain ON tbl_match_results_detail.id_pemain = tbl_pemain.id_pemain
                                                    INNER JOIN tbl_team ON tbl_team.id_team = tbl_pemain.id_team
                                                    INNER JOIN tbl_match_results ON tbl_match_results.id_match_results = tbl_match_results_detail.id_match_results
                                                    WHERE tbl_match_results_detail.id_match_results = '.$id_match_results.' AND side = "away"
                                                ');
            $data_home = $home->result();
            $data_away = $away->result();
            
            $result_detail = array(
                'home' => $home,
                'away' => $away,
                'data_home' => $data_home[0],
                'data_away' => $data_away[0],
                'active' => $active
            );            
                                                
            $this->load->view('hasil_pertandingan_detail', $result_detail);
        }

        public function team($id_team = 0){
            $active = $this->uri->segment(2);
            $id_team = $this->uri->segment(3);
            
            $tim = $this->m->GetWhere('tbl_team', array('id_team' => $id_team));
            $posisi = $this->m->query('SELECT * FROM tbl_team ORDER BY points DESC, goal_difference DESC');
            $squad = $this->m->query('SELECT 
                                       *
                                    FROM 
                                        tbl_team, tbl_pemain
                                    WHERE tbl_team.id_team = tbl_pemain.id_team AND tbl_team.id_team = '.$id_team.'
                                    ORDER BY FIELD (posisi, "kiper", "belakang", "tengah", "striker")
                                    ');
            $goal = $this->m->query('SELECT 
                                       id_pemain, nama_pemain, goal
                                    FROM 
                                        tbl_team, tbl_pemain
                                    WHERE tbl_team.id_team = tbl_pemain.id_team AND tbl_team.id_team = '.$id_team.'
                                    ORDER BY goal DESC
                                    LIMIT 1 
                                    ');
            $assist = $this->m->query('SELECT 
                                       id_pemain, nama_pemain, assist
                                    FROM 
                                        tbl_team, tbl_pemain                                    
                                    WHERE tbl_team.id_team = tbl_pemain.id_team AND tbl_team.id_team = '.$id_team.'
                                    ORDER BY assist DESC
                                    LIMIT 1
                                    ');
             $results = $this->m->query('SELECT 
                                        *, team_home.kode_team as home, team_away.kode_team as away, team_home.logo as logo_home, team_away.logo as logo_away, DATE_FORMAT(tanggal, "%d %M %Y") as tgl 
                                    FROM 
                                        tbl_match_results 
                                    INNER JOIN tbl_team as team_home ON tbl_match_results.id_team_home = team_home.id_team
                                    INNER JOIN tbl_team as team_away ON tbl_match_results.id_team_away = team_away.id_team
                                    WHERE team_home.id_team = '.$id_team.' OR team_away.id_team = '.$id_team.'
                                        ');
                                        
            $t = $tim->result();
            $s = $squad->result();                        
            $g = $goal->result();
            $a = $assist->result();
            $p = $posisi->result();

                $data = array(
                    'tim' => $t[0],
                    'squad' => $s,
                    'goal'      => $g,
                    'assist' => $a,
                    'posisi' => $p,
                    'results' => $results,
                    'active' => $active
                );
            $this->load->view('team', $data);
        }
        
        public function match($idteam = 0){
            $res = array();
            $res['team'] = $this->m->query('SELECT * FROM tbl_team 
                                    WHERE id_team = '.$idteam)->result_array();
            $res['pemain']= $this->m->GetWhere('tbl_pemain', array('id_team' => $idteam))->result_array();
            echo json_encode($res);    
        }

        public function cek_match(){
            $id_team_home = $this->input->get('home');
            $id_team_away = $this->input->get('away');
            $data = array('id_team_home' => $id_team_home, 'id_team_away' => $id_team_away);
            $exist = $this->m->GetWhere('tbl_match_results', $data);
            $res['match'] = $exist->result_array();
            $res['exist'] = $exist->num_rows();

            echo json_encode($res);
        }

        public function top_player(){
            $top_skor = $this->m->query('SELECT * 
                                        FROM tbl_pemain 
                                        INNER JOIN tbl_team
                                        WHERE tbl_pemain.id_team = tbl_team.id_team
                                        ORDER BY goal DESC')->result();
            $top_assist = $this->m->query('SELECT * 
                                        FROM tbl_pemain 
                                        INNER JOIN tbl_team
                                        WHERE tbl_pemain.id_team = tbl_team.id_team
                                        ORDER BY assist DESC')->result();
            $top_owngoal = $this->m->query('SELECT * 
                                        FROM tbl_pemain 
                                        INNER JOIN tbl_team
                                        WHERE tbl_pemain.id_team = tbl_team.id_team
                                        ORDER BY owngoal DESC')->result();
            $data = array(
                'active'        => $this->uri->segment(2),
                'top_skor'      =>  $top_skor,
                'top_assist'    => $top_assist,
                'top_owngoal'   => $top_owngoal
            );
            $this->load->view('top_player', $data);
        }

    public function insert(){
        if(isset($_POST['insert_team'])){
            $data = array();
            $max   = $this->m->max('tbl_team', 'id_team');
            $id_team = ($max[0]['id_team'] + 1);           
            $data['nama_team'] = $this->input->post('nama_team');
            $data['kode_team'] = $this->input->post('kode_team');
            $data['id_team'] = $id_team;

            $pemain = $this->input->post('pemain');
            
            foreach ($pemain as $p => $val) {
                $this->m->query('INSERT INTO 
                                    tbl_pemain(nama_pemain, nomor_punggung, posisi, id_team) 
                                VALUES ("'.$val["nama_pemain"].'","'.$val["nomor_punggung"].'", "'.$val["posisi"].'",'.$id_team.') 
                                ');
            }
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1000;
            $config['max_width']            = 5000;
            $config['max_height']           = 5000;

            $this->load->library('upload', $config);
            if (!empty($_FILES['logo']['name'])){ 
                if(!$this->upload->do_upload('logo')){
                    echo $this->upload->display_errors();
                }else{
                    $data['logo'] = $this->upload->data()['file_name'];
                }
            }else{
                    $logo_arr = ['logo-default.png', 'logo-default1.png', 'logo-default2.png'];
                    $logo_rand = $logo_arr[array_rand($logo_arr)];
                    $data['logo'] = $logo_rand;
            }
            $success = $this->m->Insert('tbl_team', $data);
            if($success){
                redirect('/');
            }
            }

            if(isset($_POST['insert_pemain'])){
                $id_team = $this->input->post('id_team');
                $pemain = $this->input->post('pemain');

                foreach($pemain as $p => $val){
                    $this->m->query('INSERT INTO 
                                        tbl_pemain(nama_pemain, nomor_punggung, posisi, id_team) 
                                    VALUES ("'.$val["nama_pemain"].'","'.$val["nomor_punggung"].'", "'.$val["posisi"].'",'.$id_team.') 
                                ');               
                }
                redirect('/');
        }
    }
}   
