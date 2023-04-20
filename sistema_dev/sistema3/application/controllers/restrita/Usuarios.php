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
            'usuarios' => $this->ion_auth->users()->result(),

        );

        $this->load->view('restrita/layout/header', $dataHeader);
        $this->load->view('restrita/usuarios/index', $dataBody);
        $this->load->view('restrita/layout/sidebar_settings');
        $this->load->view('restrita/layout/footer');
    }

    public function core($usuario_id = NULL)
    {

        if (!$usuario_id) {
            //cadastrar
            exit('Cadastrar novo usuário');

        } else {
            //editar
            if (!$usuario = $this->ion_auth->user($usuario_id)->row()) {
                exit('Usuario não exist');
            } else {

              
                $data = array(
                    'titulo' => 'Editar usuário',
                    'usuario' => $usuario,

                    'perfil' => $this->ion_auth->get_users_groups($usuario_id)->row(),
                    'groups' => $this->ion_auth->groups()->result(),
                );
                
                $this->load->view('restrita/layout/header', $data);
                $this->load->view('restrita/usuarios/core');
                $this->load->view('restrita/layout/footer');
            }
        }
    }
}
