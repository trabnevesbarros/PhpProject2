<h1>Alterar registro</h1>
<?php
echo $this->Form->create('Perguntastipo', array('inputDefaults' => array('type' => 'text')));
echo $this->Form->input('tipo', array('label' => 'Pergunta'));
echo $this->form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Salvar');
