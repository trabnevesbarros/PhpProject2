<h1>Responder questionario</h1>
<?php
$key;
$respondidas;
echo $this->Form->create('Trabalhadoresresposta');
if (isset($respostas)) {
    foreach ($respostas as $key => $resposta) {
        echo $this->Form->input('Trabalhadoresresposta.' . $key . '.resposta', array(
            'label' => $resposta['Pergunta']['pergunta'],
            'value' => $resposta['Trabalhadoresresposta']['resposta']));
        echo $this->Form->input('Trabalhadoresresposta.' . $key . '.id', array(
            'type' => 'hidden',
            'value' => $resposta['Trabalhadoresresposta']['id']));
        $respondidas[] = $resposta['Pergunta'];
    }

    foreach ($perguntas as $key => $pergunta) {
        if (array_search($pergunta['Pergunta'], $respondidas) === false) {
            echo $this->Form->input('Trabalhadoresresposta.' . $key . '.resposta', array(
                'label' => $pergunta['Pergunta']['pergunta']));
            echo $this->Form->hidden('Trabalhadoresresposta.' . $key . '.trabalhador_id', array(
                'value' => $trabalhador['Trabalhador']['id']));
            echo $this->Form->hidden('Trabalhadoresresposta.' . $key . '.pergunta_id', array(
                'value' => $pergunta['Pergunta']['id']));
        } else {
            $key --;
        }
    }
} else {
    foreach ($perguntas as $key => $pergunta) {
        echo $this->Form->input('Trabalhadoresresposta.' . $key . '.resposta', array(
            'label' => $pergunta['Pergunta']['pergunta']));
        echo $this->Form->hidden('Trabalhadoresresposta.' . $key . '.trabalhador_id', array(
            'value' => $trabalhador['Trabalhador']['id']));
        echo $this->Form->hidden('Trabalhadoresresposta.' . $key . '.pergunta_id', array(
            'value' => $pergunta['Pergunta']['id']));
    }
}
echo $this->Form->end('Salvar');
