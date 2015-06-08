<h1>Docentes Formações</h1>

<table>
    <thead>
    <th>ID</th>
    <th>Nome</th>
    <th colspan="3">Acao</th>
    </thead>
    
    <tbody>
        <?php foreach ($docentesformacaos as $docentesformacao):?>
            <tr>
                <td><?php echo $docentesformacao['Docenteformacaos']['id'];?></td>
                
                <td><?php echo $docentesformacao['Docentesformacaos']['docente_id']?></td>
                
                <td><?php echo $docentesformacao['Docentesformacaos']['formacao_id']?></td>
                
                </tr>
            
        <?php endforeach; ?>  
        
    </tbody>

</table>         