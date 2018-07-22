<?php

    echo form_open('crud/create');
    echo validation_errors('<p>','</p>');

    if($this->session->flashdata('cadastrook')) {
        echo "<p>".$this->session->flashdata('cadastrook')."</p>";
    }

        echo form_label('NOME:');
        echo form_input(array('name' => 'nome', set_value('nome'), 'autofocus'));
        echo form_label('EMAIL:');
        echo form_input(array('name' => 'email', set_value('email'), 'autofocus'));
        echo form_label('LOGIN:');
        echo form_input(array('name' => 'login', set_value('login'), 'autofocus'));
        echo form_label('SENHA:');
        echo form_password(array('name' => 'senha', set_value('senha'), 'autofocus'));
        echo form_label('REPITA A SENHA:');
        echo form_password(array('name' => 'senha_repeat', set_value('senha_repeat'), 'autofocus'));
        echo form_submit(array('name' => 'cadastrar'), 'Cadastrar');
    echo form_close();

?>