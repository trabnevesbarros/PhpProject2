<h1>Empregadores Formações</h1>

<table>
    <thead>
    <th>ID</th>
    <th>Nome</th>
    <th colspan="3">Acao</th>
    </thead>
    
    <tbody>
        <?php foreach ($empregadoresformacaos as $empregadoresformacao):?>
            <tr>
                <td><?php echo $empregadoresformacao['Empregadorformacaos']['id'];?></td>
                
                <td><?php echo $empregadoresformacao['Empregadoresformacaos']['empregador_id']?></td>
                
                <td><?php echo $empregadoresformacao['Empregadoresformacaos']['formacao_id']?></td>
                
                </tr>
            
        <?php endforeach; ?>  
        
    </tbody>

</table>         