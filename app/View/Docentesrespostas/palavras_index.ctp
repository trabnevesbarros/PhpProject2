<h1>Lista de palavras-chave conectadas</h1>

<table>
    <thead>
    <th>Palavra</th>
</thead>
<tbody>
    <?php foreach ($resposta_palavras as $palavra): ?>
        <tr>      
            <td>
                <?php
                echo $palavra['palavra'];
                ?>
            </td>           
        </tr>

    <?php endforeach; ?>
</tbody>
</table>
    