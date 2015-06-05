<h1>Cadastrar Stop words</h1>
<?php
echo $this->Form->create('Stopword', array('inputDefaults' => array('type' => 'text')));
echo $this->Form->input('termos', array('label' => 'Termos', 'rows' => 3));
echo $this->Form->end('Salvar');