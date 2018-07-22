<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud_model extends CI_Model {

    // Insere um registro
    public function do_insert($dados = NULL) {
        if($dados != NULL) {
            $this->db->insert('crud', $dados);
            $this->session->set_flashdata('cadastrook', 'Cadastro efetuado com sucesso.');
            redirect('crud/create');
        }
    }

    // Altera um registro
    public function do_update($dados = NULL, $condicao = NULL) {
        if($dados != NULL && $condicao != NULL) {
            $this->db->update('crud', $dados, $condicao);
            $this->session->set_flashdata('edicaook', 'Edicao efetuada com sucesso.');
            redirect(current_url());
        }
    }

    // Busca todos os registros
    public function do_getAll() {
        return $this->db->get('crud');
    }

    // Busca por id um registro
    public function do_getById($id = NULL) {

        if($id != NULL) {
            $this->db->where('id', $id);
            $this->db->limit(1);
            return $this->db->get('crud');
        } else {
            return FALSE;
        }
        
    }

    // Deleta um registro
    public function do_delete($condicao = NULL) {
        if($condicao != NULL) {
            $this->db->delete('crud', $condicao);
            $this->session->set_flashdata('excluirok', 'Registro deletado com sucesso.');
            redirect('crud/retrieve');
        }
    }

}

?>