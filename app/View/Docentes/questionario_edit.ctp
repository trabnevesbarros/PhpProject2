<h1>Alterar registro</h1>
<?php
echo $this->Form->create('Docentesresposta');
echo $this->Form->input('resposta', array('label' => $resposta['Pergunta']['pergunta']));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Salvar');
