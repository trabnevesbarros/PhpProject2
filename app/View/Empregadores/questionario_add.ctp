<h1>Responder questionario</h1>
<?php
$key;
$respondidas;
echo $this->Form->create('Empregadoresresposta');
if (isset($respostas)) {
    foreach ($respostas as $key => $resposta) {
        echo $this->Form->input('Empregadoresresposta.' . $key . '.resposta', array(
            'label' => $resposta['Pergunta']['pergunta'],
            'value' => $resposta['Empregadoresresposta']['resposta']));
        echo $this->Form->input('Empregadoresresposta.' . $key . '.id', array(
            'type' => 'hidden',
            'value' => $resposta['Empregadoresresposta']['id']));
        $respondidas[] = $resposta['Pergunta'];
    }

    foreach ($perguntas as $key => $pergunta) {
        if (array_search($pergunta['Pergunta'], $respondidas) === false) {
            echo $this->Form->input('Empregadoresresposta.' . $key . '.resposta', array(
                'label' => $pergunta['Pergunta']['pergunta']));
            echo $this->Form->hidden('Empregadoresresposta.' . $key . '.empregador_id', array(
                'value' => $empregador['Empregador']['id']));
            echo $this->Form->hidden('Empregadoresresposta.' . $key . '.pergunta_id', array(
                'value' => $pergunta['Pergunta']['id']));
        } else {
            $key --;
        }
    }
} else {
    foreach ($perguntas as $key => $pergunta) {
        echo $this->Form->input('Empregadoresresposta.' . $key . '.resposta', array(
            'label' => $pergunta['Pergunta']['pergunta']));
        echo $this->Form->hidden('Empregadoresresposta.' . $key . '.empregador_id', array(
            'value' => $empregador['Empregador']['id']));
        echo $this->Form->hidden('Empregadoresresposta.' . $key . '.pergunta_id', array(
            'value' => $pergunta['Pergunta']['id']));
    }
}
echo $this->Form->end('Salvar');
