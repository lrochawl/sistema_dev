<?php

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mapos_model');
    }

    public function index()
    {
      
        $this->load->view('mapos/login');
    }

    public function sair()
    {
        $this->session->sess_destroy();
        return redirect($_SERVER['HTTP_REFERER']);
    }

    public function verificarLogin()
    {
        header('Access-Control-Allow-Origin: ' . base_url());
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'E-mail', 'valid_email|required|trim');
        $this->form_validation->set_rules('senha', 'Senha', 'required|trim');
        if ($this->form_validation->run() == false) {
            $json = ['result' => false, 'message' => validation_errors()];
            echo json_encode($json);
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('senha');
            $this->load->model('setdb_model');
            $user = $this->setdb_model->check_login($email);

            if ($user) {
                // Verificar se acesso está expirado
                if ($this->chk_date($user->dataExpiracao)) {
                    $json = ['result' => false, 'message' => 'A conta do usuário está expirada, por favor entre em contato com o administrador do sistema.'];
                    echo json_encode($json);
                    die();
                }

                // Verificar credenciais do usuário
                if (password_verify($password, $user->senha)) {
                    $session_data = [
                        'nome' => $user->nome,
                        'email' => $user->email,
                        'url_image_user' => $user->url_image_user,
                        'id' => $user->idUsuarios,
                        'id_administrativo_emitente' => $user->administrativo_emitente_id,
                        'permissao' => $user->permissoes_id,
                        'sistema' => $user->sistema,
                        'dbEmpresa' => $user->dbEmpresa,
                        'logado' => true,
                    ];

                    $this->session->set_userdata($session_data);
                    log_info('Efetuou login no sistema');
                    $json = ['result' => true];
                    echo json_encode($json);
                } else {
                    $json = ['result' => false, 'message' => 'Os dados de acesso estão incorretos.'];
                    echo json_encode($json);
                }
            } else {
                $json = ['result' => false, 'message' => 'Usuário não encontrado, verifique se suas credenciais estão corretass.'];
                echo json_encode($json);
            }
        }
        die();
    }

    public function verificarAPI()
    {
        header('Access-Control-Allow-Origin: ' . base_url());
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type');
        header('Content-Type: application/json');

        $this->load->library('form_validation');
        //  $this->form_validation->set_rules('email', 'E-mail', 'valid_email|required|trim');
        //  $this->form_validation->set_rules('token', 'API_TOKEN', 'required|trim');
        if ($this->form_validation->run() == true) {
            $json = ['result' => false, 'message' => validation_errors()];
            echo json_encode($json);
        } else {
           // $email = $this->input->post('email');
            $password = $this->input->post('token');
            $term = $this->input->post('term');
            $password = "topos1212";
            $this->load->model('setdb_model');
            $user = $this->setdb_model->check_login('estoque@gmail.com');

            if ($user) {
                // Verificar se acesso está expirado
                if ($this->chk_date($user->dataExpiracao)) {
                    $json = ['result' => false, 'message' => 'A conta do usuário está expirada, por favor entre em contato com o administrador do sistema.'];
                    echo json_encode($json);
                    die();
                }

                // Verificar credenciais do usuário
                if (password_verify($password, $user->senha)) {
                    $session_data = [
                        'nome' => $user->nome,
                        'email' => $user->email,
                        'url_image_user' => $user->url_image_user,
                        'id' => $user->idUsuarios,
                        'id_administrativo_emitente' => $user->administrativo_emitente_id,
                        'permissao' => $user->permissoes_id,
                        'sistema' => $user->sistema,
                        'dbEmpresa' => $user->dbEmpresa,
                        'logado' => true,
                    ];

                    $this->session->set_userdata($session_data);
                    log_info('Efetuou login no sistema');
                    $json = ['result' => true];

                    if ($term == "cidade" || $term == "estado") {

                        if ($term == "cidade") {
                            echo (file_get_contents(base_url('assets/json/cidades.json')));
                        }
                        
                        if($term == "estado"){
                            echo (file_get_contents(base_url('assets/json/estado.json')));
                        }
                    }else{
                        echo json_encode(array("erro" => "Verifique o termo de pesquisa"));
                    }
                } else {
                    $json = ['result' => false, 'message' => 'Os dados de acesso estão incorretos.'];
                    echo json_encode($json);
                }
            } else {
                $json = ['result' => false, 'message' => 'Usuário não encontrado, verifique se suas credenciais estão corretass.'];
                echo json_encode($json);
            }
        }
        die();
    }


    private function chk_date($data_banco)
    {
        $data_banco = new DateTime($data_banco);
        $data_hoje = new DateTime("now");

        return $data_banco < $data_hoje;
    }
}
