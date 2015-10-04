<h1>Lista de palavras-chave conectadas</h1>

<table>
    <thead>
    <th><?php echo $this->Paginator->sort('Palavraschave.palavra', 'Palavra'); ?></th>
</thead>
<tbody>
    <?php foreach ($palavras as $palavra): ?>
        <tr>      
            <td>
                <?php
                echo $palavra['Palavraschave']['palavra'];
                ?>
            </td>           
        </tr>

    <?php endforeach; ?>
</tbody>
</table>

<div class="paging">
<?php
echo $this->Paginator->prev('Anterior');
echo $this->Paginator->numbers();
echo $this->Paginator->next('Próximo');
?>
</div>
    