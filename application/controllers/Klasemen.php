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
                $pemain_home = $this->input->post('pemain_home');
                foreach ($pemain_home as $id => $val) {
                    $this->m->query('UPDATE 
                                        tbl_pemain 
                                    SET 
                                        goal    = (goal + '.$val["goal_home"].'),
                                        assist  = (assist   + '.$val["assist_home"].'), 
                                        owngoal = (owngoal  + '.$val["owngoal_home"].') 
                                        WHERE 
                                        id_pemain = '.$id.' ');
                                    }

                //UPDATE Goal, assist, own goal pemain AWAY
                $pemain_away = $this->input->post('pemain_away');
                foreach ($pemain_away as $id => $val) {
                    $this->m->query('UPDATE 
                                        tbl_pemain 
                                    SET 
                                        goal    = (goal + '.$val["goal_away"].'),
                                        assist  = (assist   + '.$val["assist_away"].'), 
                                        owngoal = (owngoal  + '.$val["owngoal_away"].') 
                                    WHERE 
                                        id_pemain = '.$id.' ');
                }
                $skor_home = $this->input->post('skorhome');
                $skor_away = $this->input->post('skoraway');
                $team_home = $this->input->post('teamhome');
                $team_away = $this->input->post('teamaway');

                if($skor_home > $skor_away){
                    $this->m->query('UPDATE 
                                        tbl_team
                                    SET
                                        menang          = (menang + 1),
                                        points          = (points + 3),
                                        goal_for        = (goal_for + '.$skor_home.'),
                                        goal_against    = (goal_against + '.$skor_away.'),
                                        goal_difference = (goal_for - goal_against)
                                    WHERE 
                                        kode_team = "'.$team_home.'"
                    ');
                    $this->m->query('UPDATE 
                                        tbl_team
                                    SET
                                        kalah = (kalah + 1)
                                    WHERE
                                        kode_team = "'.$team_away.'"
                                    ');
                }
                else if($skor_home == $skor_away){
                    $this->m->query('UPDATE 
                                        tbl_team
                                    SET
                                        seri          = (seri + 1),
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
                                        kalah = (kalah + 1)
                                    WHERE
                                        kode_team = "'.$team_home.'"
                                    ');                    
                }

                redirect('Klasemen');
            }
    
            $data['team'] = $this->m->GetRecord('tbl_team');
            $this->load->view('pertandingan.php', $data);
        }
                

        public function match($idteam = 0){
            $res = array();
            $res['team'] = $this->m->query('SELECT * FROM tbl_team 
                                    WHERE id_team = '.$idteam)->result_array();
            $res['pemain']= $this->m->GetWhere('tbl_pemain', array('id_team' => $idteam))->result_array();
            echo json_encode($res);    
    }
    }
