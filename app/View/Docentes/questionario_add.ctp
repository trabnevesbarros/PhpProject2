<h1>Responder questionario</h1>
<?php
$key;
$respondidas;
echo $this->Form->create('Docentesresposta');
if (isset($respostas)) {
    foreach ($respostas as $key => $resposta) {
        echo $this->Form->input('Docentesresposta.' . $key . '.resposta', array(
            'label' => $resposta['Pergunta']['pergunta'],
            'value' => $resposta['Docentesresposta']['resposta']));
        echo $this->Form->input('Docentesresposta.' . $key . '.id', array(
            'type' => 'hidden',
            'value' => $resposta['Docentesresposta']['id']));
        $respondidas[] = $resposta['Pergunta'];
    }

    foreach ($perguntas as $key => $pergunta) {
        if (array_search($pergunta['Pergunta'], $respondidas) === false) {
            echo $this->Form->input('Docentesresposta.' . $key . '.resposta', array(
                'label' => $pergunta['Pergunta']['pergunta']));
            echo $this->Form->hidden('Docentesresposta.' . $key . '.docente_id', array(
                'value' => $docente['Docente']['id']));
            echo $this->Form->hidden('Docentesresposta.' . $key . '.pergunta_id', array(
                'value' => $pergunta['Pergunta']['id']));
        } else {
            $key --;
        }
    }
} else {
    foreach ($perguntas as $key => $pergunta) {
        echo $this->Form->input('Docentesresposta.' . $key . '.resposta', array(
            'label' => $pergunta['Pergunta']['pergunta']));
        echo $this->Form->hidden('Docentesresposta.' . $key . '.docente_id', array(
            'value' => $docente['Docente']['id']));
        echo $this->Form->hidden('Docentesresposta.' . $key . '.pergunta_id', array(
            'value' => $pergunta['Pergunta']['id']));
    }
}
echo $this->Form->end('Salvar');
