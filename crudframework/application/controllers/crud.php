<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('array');
        $this->load->model('crud_model');
        // Carregar model com apelido.
        // Utilizar o apelido(segundo parametro) no lugar do nome da model.
        // Só se quiser, mas pode usar a forma padrão normalmente.
        //$this->load->model('crud_model', 'crud');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('table');
    }

    public function index() {

        $dados = array('title' => 'CRUD CODEIGNITER', 'tela' => '');
        $this->load->view('crud', $dados);
    }

    public function create() {

        // Validacao
        $this->form_validation->set_rules('nome', 'NOME', 'trim|required|alpha|max_length[50]|ucwords');
        $this->form_validation->set_rules('email', 'EMAIL', 'trim|required|max_length[50]|strtolower|valid_email|is_unique[crud.email]');
        $this->form_validation->set_rules('login', 'LOGIN', 'trim|required|max_length[50]|strtolower|is_unique[crud.login]');
        $this->form_validation->set_rules('senha', 'SENHA', 'trim|required|strtolower');
        $this->form_validation->set_message('matches', 'O campo %s está diferente do campo %s.');
        $this->form_validation->set_rules('senha_repeat', 'REPITA A SENHA', 'trim|required|strtolower|matches[senha]');
        
        if($this->form_validation->run() == TRUE) {
            $dados = elements(array('nome', 'email', 'login', 'senha'), $this->input->post());
            $dados['senha'] = md5($dados['senha']);
            $this->crud_model->do_insert($dados);
        }

        $dados = array('title' => 'CRUD - CREATE', 'tela' => 'create');
        $this->load->view('crud', $dados);
    }

    public function retrieve() {
        
        $dados = array('title' => 'CRUD - RETRIEVE', 'tela' => 'retrieve', 'usuarios' => $this->crud_model->do_getAll()->result());
        $this->load->view('crud', $dados);
    }

    public function update() {

        // Validacao
        $this->form_validation->set_rules('nome', 'NOME', 'trim|required|alpha|max_length[50]|ucwords');
        $this->form_validation->set_rules('senha', 'SENHA', 'trim|required|strtolower');
        $this->form_validation->set_message('matches', 'O campo %s está diferente do campo %s.');
        $this->form_validation->set_rules('senha_repeat', 'REPITA A SENHA', 'trim|required|strtolower|matches[senha]');
        
        if($this->form_validation->run() == TRUE) {
            $dados = elements(array('nome', 'senha'), $this->input->post());
            $dados['senha'] = md5($dados['senha']);
            $this->crud_model->do_update($dados, array('id' => $this->input->post('idusuario')));
        }

        $dados = array('title' => 'CRUD - UPDATE', 'tela' => 'update');
        $this->load->view('crud', $dados);
    }

    public function delete() {

        if($this->input->post('idusuario') > 0) {
            $this->crud_model->do_delete(array('id' => $this->input->post('idusuario')));
        }

        $dados = array('title' => 'CRUD - DELETE', 'tela' => 'delete');
        $this->load->view('crud', $dados);
    }

}

?>