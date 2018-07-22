<?php

    $id_user = $this->uri->segment(3);

    if($id_user == NULL) {
        redirect('crud/retrieve');
    }    

    $query = $this->crud_model->do_getById($id_user)->row();

    echo form_open("crud/update/$id_user");
    echo validation_errors('<p>','</p>');

    if($this->session->flashdata('edicaook')) {
        echo "<p>".$this->session->flashdata('edicaook')."</p>";
    }
    echo form_label('NOME:');
    echo form_input(array('name' => 'nome'), set_value('nome', $query->nome), 'autofocus');
    echo form_label('EMAIL:');
    echo form_input(array('name' => 'email'), set_value('email', $query->email), 'disable="disable"');
    echo form_label('LOGIN:');
    echo form_input(array('name' => 'login'), set_value('login', $query->login), 'disable="disable"');
    echo form_label('SENHA:');
    echo form_password(array('name' => 'senha'), set_value('senha'));
    echo form_label('REPITA A SENHA:');
    echo form_password(array('name' => 'senha_repeat'), set_value('senha_repeat'));
    echo form_submit(array('name' => 'cadastrar'), 'Salvar');
    echo form_hidden('idusuario', $query->id);
    echo form_close();

?>