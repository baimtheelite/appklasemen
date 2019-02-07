    <?php
    class Klasemen extends CI_Controller
    {
        public function __construct(){
            parent::__construct();
            $this->load->model('M_klasemen', 'm');
        }

        public function index(){
            $data['team'] = $this->m->query('SELECT * FROM tbl_team ORDER BY points DESC');
            
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
            $team = $this->m->query('SELECT * FROM tbl_team ORDER BY nama_team ASC');
            $id_match_results   = $this->m->max('tbl_match_results', 'id_match_results');            
            $data = array(
                'id_match_results' => ($id_match_results[0]['id_match_results'] + 1),
                'team' => $team
            );
            $this->load->view('pertandingan.php', $data);
        }
        
        public function match_results(){
            $data['results'] = $this->m->query('SELECT *, team_home.kode_team as home, team_away.kode_team as away, team_home.logo as logo_home, team_away.logo as logo_away, DATE_FORMAT(tanggal, "%d %M %Y") as tgl 
                                                FROM tbl_match_results 
                                                INNER JOIN tbl_team as team_home ON tbl_match_results.id_team_home = team_home.id_team
                                                INNER JOIN tbl_team as team_away ON tbl_match_results.id_team_away = team_away.id_team
                                                ');
            $this->load->view('hasil_pertandingan', $data);
        }

        public function match_results_detail($id_match_results){            
           $result_detail['home'] = $this->m->query('SELECT *, tbl_match_results_detail.goal as goal, tbl_match_results_detail.assist as assist, tbl_match_results_detail.owngoal as owngoal 
                                                    FROM tbl_match_results_detail
                                                    INNER JOIN tbl_pemain
                                                    ON tbl_match_results_detail.id_pemain = tbl_pemain.id_pemain
                                                    WHERE id_match_results = '.$id_match_results.' AND side = "home"
                                                ');      
            $result_detail['away'] = $this->m->query('SELECT *, tbl_match_results_detail.goal as goal, tbl_match_results_detail.assist as assist, tbl_match_results_detail.owngoal as owngoal
                                                    FROM tbl_match_results_detail
                                                    INNER JOIN tbl_pemain
                                                    ON tbl_match_results_detail.id_pemain = tbl_pemain.id_pemain
                                                    WHERE id_match_results = '.$id_match_results.' AND side = "away"
                                                ');
            $this->load->view('hasil_pertandingan_detail', $result_detail);
        }

        public function match($idteam = 0){
            $res = array();
            $res['team'] = $this->m->query('SELECT * FROM tbl_team 
                                    WHERE id_team = '.$idteam)->result_array();
            $res['pemain']= $this->m->GetWhere('tbl_pemain', array('id_team' => $idteam))->result_array();
            echo json_encode($res);    
    }
    }
