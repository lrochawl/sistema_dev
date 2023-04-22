<?php defined('BASEPATH') or exit('Ação não permitida');

class Usuarios extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {


        $dataHeader = array(
            'titulo' => 'Usuários cadastrados',
            'styles' => array(
                'bundles/datatables/datatables.min.css',
                'bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'bundles/datatables/datatables.min.js',
                'bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
                'bundles/jquery-ui/jquery-ui.min.js',
                'js/page/datatables.js'
            )
        );
        $dataBody = array(
            'titulo' => 'Usuários cadastrados',
            'usuarios' => $this->ion_auth->users()->result()
        );

        $this->load->view('restrita/layout/header', $dataHeader);
        $this->load->view('restrita/usuarios/index', $dataBody);
        $this->load->view('restrita/layout/sidebar_settings');
        $this->load->view('restrita/layout/footer');
    }

    public function core($usuario_id = NULL)
    {
        $usuario_id = (int) $usuario_id;

        if (!$usuario_id) {
            //cadastrar
            

            $this->form_validation->set_rules('first_name', 'Nome', 'trim|required|min_length[4]|max_length[45]');
            $this->form_validation->set_rules('last_name', 'Sobrenome', 'trim|required|min_length[4]|max_length[45]');
            $this->form_validation->set_rules('email', 'E-mail', 'trim|required|min_length[4]|max_length[100]|valid_email|callback_valida_email');
            $this->form_validation->set_rules('username', 'Usuário', 'trim|required|min_length[4]|max_length[50]|callback_valida_usuario');
            $this->form_validation->set_rules('password', 'Senha', 'trim|required|min_length[4]|max_length[200]');
            $this->form_validation->set_rules('confirma', 'Confirma Senha', 'trim|required|min_length[4]|max_length[200]|matches[password]');

            if ($this->form_validation->run()) {
                echo '<pre>';
                    print_r($data);
                    exit();
            } else {
                $data = array(
                    'titulo' => 'Cadastrar usuário',
                    'groups' => $this->ion_auth->groups()->result(),
                );
                // echo '<pre>';
                // print_r($data['perfil']);
                // exit();
                $this->load->view('restrita/layout/header', $data);
                $this->load->view('restrita/usuarios/core');
                $this->load->view('restrita/layout/footer');
            }

        } else {
            //editar
            if (!$usuario = $this->ion_auth->user($usuario_id)->row()) {
                $this->session->set_flashdata('erro', 'Usuário não foi encontrado');
                redirect('restrita/usuarios');
            } else {

                $this->form_validation->set_rules('first_name', 'Nome', 'trim|required|min_length[4]|max_length[45]');
                $this->form_validation->set_rules('last_name', 'Sobrenome', 'trim|required|min_length[4]|max_length[45]');
                $this->form_validation->set_rules('email', 'E-mail', 'trim|required|min_length[4]|max_length[100]|valid_email|callback_valida_email');
                $this->form_validation->set_rules('username', 'Usuário', 'trim|required|min_length[4]|max_length[50]|callback_valida_usuario');
                $this->form_validation->set_rules('password', 'Senha', 'trim|min_length[4]|max_length[200]');
                $this->form_validation->set_rules('confirma', 'Confirma Senha', 'trim|min_length[4]|max_length[200]|matches[password]');


                if ($this->form_validation->run()) {


                    $data = elements(
                        array(
                            'first_name',
                            'last_name',
                            'email',
                            'username',
                            'password',
                            'perfil',
                            'active'

                        ),
                        $this->input->post(),
                    );

                    // Não atualiza a senha se a mesma não for passada

                    $password = $this->input->post('password');

                    if (!$password) {
                        unset($data['password']);
                    }

                    // Sanetizando o $data
                    $data = html_escape($data);
                    // echo '<pre>';
                    // print_r($data);
                    // exit();
                    if ($this->ion_auth->update($usuario_id, $data)) {

                        $perfil = (int) $this->input->post('perfil');

                        if ($perfil) {
                            $this->ion_auth->remove_from_group(NULL, $usuario_id);
                            $this->ion_auth->add_to_group($perfil, $usuario_id);
                        }

                        $this->session->set_flashdata('sucesso', 'Dados salvos com sucesso');
                    } else {
                        $this->session->set_flashdata('erro', $this->ion_auth->erros());
                    }

                    redirect('restrita/usuarios');
                } else {

                    $data = array(
                        'titulo' => 'Editar usuário',
                        'usuario' => $usuario,
                        'perfil' => $this->ion_auth->get_users_groups($usuario_id)->row(),
                        'groups' => $this->ion_auth->groups()->result(),
                    );
                    // echo '<pre>';
                    // print_r($data['perfil']);
                    // exit();
                    $this->load->view('restrita/layout/header', $data);
                    $this->load->view('restrita/usuarios/core');
                    $this->load->view('restrita/layout/footer');
                }
            }
        }
    }

    public function valida_email($email)
    {

        $usuario_id = (int) $this->input->post('usuario_id');

        if (!$usuario_id) {
            //Cadastrando

            if ($this->core_model->get_by_id('users', array('email' => $email))) {
                $this->form_validation->set_message('valida_email', 'Esse e-mail já existe');
                return false;
            } else {
                return true;
            }
        } else {
            //Editando

            if ($this->core_model->get_by_id('users', array('email' => $email, 'id !=' => $usuario_id))) {
                $this->form_validation->set_message('valida_email', 'Esse e-mail já existe');
                return false;
            } else {
                return true;
            }
        }
    }

    public function valida_usuario($username)
    {
        $usuario_id = (int) $this->input->post('usuario_id');

        if (!$usuario_id) {
            //Cadastrando uduário

            if ($this->core_model->get_by_id('users', array('username' => $username))) {
                $this->form_validation->set_message('valida_usuario', 'Usuário já existe');
                return false;
            } else {
                return true;
            }
        } else {
            //Editando usuário

            if ($this->core_model->get_by_id('users', array('username' => $username, 'id !=' => $usuario_id))) {
                $this->form_validation->set_message('valida_usuario', 'Usuário já existe');
                return false;
            } else {
                return true;
            }
        }
    }
}
