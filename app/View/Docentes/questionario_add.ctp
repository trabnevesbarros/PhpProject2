<h1>Responder questionario</h1>
<?php
$key;
$respondidas;
echo $this->Form->create('Docentesresposta');
if (isset($respostas)) {
    foreach ($respostas as $key => $resposta) {
        echo $this->Form->input('Docentesresposta.' . $key . '.resposta', array(
            'label' => $resposta['Docentespergunta']['pergunta'],
            'value' => $resposta['Docentesresposta']['resposta']));
        echo $this->Form->input('Docentesresposta.' . $key . '.id', array(
            'type' => 'hidden',
            'value' => $resposta['Docentesresposta']['id']));
        $respondidas[] = $resposta['Docentespergunta'];
    }

    foreach ($perguntas as $key => $pergunta) {
        if (array_search($pergunta['Docentespergunta'], $respondidas) === false) {
            echo $this->Form->input('Docentesresposta.' . $key . '.resposta', array(
                'label' => $pergunta['Docentespergunta']['pergunta']));
            echo $this->Form->hidden('Docentesresposta.' . $key . '.docente_id', array(
                'value' => $docente['Docente']['id']));
            echo $this->Form->hidden('Docentesresposta.' . $key . '.docentespergunta_id', array(
                'value' => $pergunta['Docentespergunta']['id']));
        } else {
            $key --;
        }
    }
} else {
    foreach ($perguntas as $key => $pergunta) {
        echo $this->Form->input('Docentesresposta.' . $key . '.resposta', array(
            'label' => $pergunta['Docentespergunta']['pergunta']));
        echo $this->Form->hidden('Docentesresposta.' . $key . '.docente_id', array(
            'value' => $docente['Docente']['id']));
        echo $this->Form->hidden('Docentesresposta.' . $key . '.docentespergunta_id', array(
            'value' => $pergunta['Docentespergunta']['id']));
    }
}
echo $this->Form->end('Salvar');
