<h1>Responder questionario</h1>
<?php
echo $this->Form->create('Empregadoresresposta');
foreach ($perguntas as $key=>$pergunta) {
    echo $this->Form->input('Empregadoresresposta.'.$key.'.resposta', array('label' => $pergunta['Pergunta']['pergunta']));
    echo $this->Form->hidden('Empregadoresresposta.'.$key.'.empregador_id', array('value' => $empregador['Empregador']['id']));
    echo $this->Form->hidden('Empregadoresresposta.'.$key.'.pergunta_id', array('value' => $pergunta['Pergunta']['id']));
}
echo $this->Form->end('Salvar');
