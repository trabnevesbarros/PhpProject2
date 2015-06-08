<h1>Trabalhadores Formações</h1>

<table>
    <thead>
    <th>ID</th>
    <th>Nome</th>
    <th colspan="3">Acao</th>
    </thead>
    
    <tbody>
        <?php foreach ($trabalhadoresformacaos as $trabalhadoresformacao):?>
            <tr>
                <td><?php echo $trabalhadoresformacao['Trabalhadorformacaos']['id'];?></td>
                
                <td><?php echo $trabalhadoresformacao['Trabalhadoresformacaos']['trabalhador_id']?></td>
                
                <td><?php echo $trabalhadoresformacao['Trabalhadoresformacaos']['formacao_id']?></td>
                
                </tr>
            
        <?php endforeach; ?>  
        
    </tbody>

</table>         