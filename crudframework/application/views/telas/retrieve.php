<?php

    echo "<h2>Lista de registros</h2>";

    if($this->session->flashdata('excluirok')) {
        echo "<p>".$this->session->flashdata('excluirok')."</p>";
    }
    
    $this->table->set_heading('ID', 'NOME', 'EMAIL', 'LOGIN', 'OPERAÇÕES');

    foreach($usuarios as $linha) {
        $this->table->add_row($linha->id, $linha->nome, $linha->email, $linha->login, anchor("crud/update/$linha->id", 'Editar'), anchor("crud/delete/$linha->id", 'Excluir'));
    }

    echo $this->table->generate();

?>