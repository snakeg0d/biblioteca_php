<html>
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <title>Novo Empréstimo</title>  
    </head>

    <body>
    <?php require 'navbar.php'; ?>
        <br>
        <div class="container bg-light">
            <div class ="row"> 
                <div class = "col mt-5">
                    <h1 >Emprestar Livro</h1>

                        <form  action="actions.php?action=save_emp" method="POST" role="form">
                            <?php   require 'connection_mysql.php';  
                               //recebe o array de livros
                                $livros = isset($_POST['ckLivros']) ?  $livros = $_POST['ckLivros'] : null;

                                //verifica se não é nulo
                               if($livros !== null){
                                    $numLivros = 1;
                                    foreach($livros as $idLinha){
                                        //faz  a consulta no BD com o ID atual
                                        $sql = "SELECT id_livro, titulo FROM livros WHERE id_livro = ".$idLinha;
                                        $result = $conn->query($sql);
                                        //cria um array associativo com o resultado da consulta
                                        while($linhaBD = mysqli_fetch_assoc($result)){
                                            //preenche o form com o titulo 
                                            echo "
                                                <div class='form-group'>
                                                <label>Livro ".$numLivros." Titulo:</label>
                                                <input type='text' class='form-control'value='".$linhaBD['titulo']."' disabled > <br> 
                                                <input type='hidden' name='livros[]' value='".$linhaBD['id_livro']."'> 
                                                </div>
                                            ";
                                        }
                                        $numLivros++;
                                    }
                                    $conn->close();
                               }else{
                                //Se o array vier vazio, avisa e redireciona para a tela anterior
                                echo "<script> alert ('Atenção selecione pelo menos um livro!');
                                location.href='list_livro_disp.php'; </script>";
                               }      
                            ?>
                            <div class="form-group">
                                    <label for="inputAutor">ID do cliente:</label>
                                    <div id="emailHelp" class="form-text"><strong> Inserir ID do cliente que deseja emprestar: </strong></div>
                                    <input type="text" class="form-control" name="txtId_cliente" id="inputAutor" > <br>  
                            </div>
                            <div class="form-group">
                                    <label for="inputAutor">Observações:</label>
                                    <input type="text" class="form-control" name="txtObs" id="inputObs" > <br>  
                            </div>
                            <button type="submit" class="btn btn-primary">Emprestar</button>
                            <a  class="btn btn-danger" onclick="if(confirm('Tem certeza que deseja cancelar?')){location.href='index.php';}else{false;}">Cancelar</a>
                        </form>
                </div>
            </div>  
         </div>
    </body> 
</html>
