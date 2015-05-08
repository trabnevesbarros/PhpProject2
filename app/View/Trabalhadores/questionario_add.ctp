<h1>Responder questionario</h1>
<?php
$key;
$respondidas;
echo $this->Form->create('Trabalhadoresresposta');
if (isset($respostas)) {
    foreach ($respostas as $key => $resposta) {
        echo $this->Form->input('Trabalhadoresresposta.' . $key . '.resposta', array(
            'label' => $resposta['Trabalhadorespergunta']['pergunta'],
            'value' => $resposta['Trabalhadoresresposta']['resposta']));
        echo $this->Form->input('Trabalhadoresresposta.' . $key . '.id', array(
            'type' => 'hidden',
            'value' => $resposta['Trabalhadoresresposta']['id']));
        $respondidas[] = $resposta['Trabalhadorespergunta'];
    }

    foreach ($perguntas as $key => $pergunta) {
        if (array_search($pergunta['Trabalhadorespergunta'], $respondidas) === false) {
            echo $this->Form->input('Trabalhadoresresposta.' . $key . '.resposta', array(
                'label' => $pergunta['Trabalhadorespergunta']['pergunta']));
            echo $this->Form->hidden('Trabalhadoresresposta.' . $key . '.trabalhador_id', array(
                'value' => $trabalhador['Trabalhador']['id']));
            echo $this->Form->hidden('Trabalhadoresresposta.' . $key . '.trabalhadorespergunta_id', array(
                'value' => $pergunta['Trabalhadorespergunta']['id']));
        } else {
            $key --;
        }
    }
} else {
    foreach ($perguntas as $key => $pergunta) {
        echo $this->Form->input('Trabalhadoresresposta.' . $key . '.resposta', array(
            'label' => $pergunta['Trabalhadorespergunta']['pergunta']));
        echo $this->Form->hidden('Trabalhadoresresposta.' . $key . '.trabalhador_id', array(
            'value' => $trabalhador['Trabalhador']['id']));
        echo $this->Form->hidden('Trabalhadoresresposta.' . $key . '.trabalhadorespergunta_id', array(
            'value' => $pergunta['Trabalhadorespergunta']['id']));
    }
}
echo $this->Form->end('Salvar');
