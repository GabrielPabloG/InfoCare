<?php 
	include_once("../Dao/conexao.php");
	session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InfoCare</title>
    <link href="../css/default.css" rel="stylesheet">
    <link href="../cssCadastro/css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/component.css" rel="stylesheet">
    <script type="text/javascript" src="prototype.js"></script>
    <script type="text/javascript" language="javascript">
        //Verifica se CPF é válido
        function TestaCPF(strCPF) {
            var Soma, Resto, borda_original;
            Soma = 0;

            var cpf = strCPF.replace(/\D/g, '');

            if (cpf == "00000000000") {
                document.getElementById("cpfIdoso").setCustomValidity('Inválido');
                return false;
            }

            for (i = 1; i <= 9; i++) {
                Soma = Soma + parseInt(cpf.substring(i - 1, i)) * (11 - i);
            }

            Resto = (Soma * 10) % 11;
            if ((Resto == 10) || (Resto == 11)) {
                Resto = 0;
            }

            if (Resto != parseInt(cpf.substring(9, 10))) {
                document.getElementById("cpfIdoso").setCustomValidity('Inválido');
                return false;
            }

            Soma = 0;
            for (i = 1; i <= 10; i++) {
                Soma = Soma + parseInt(cpf.substring(i - 1, i)) * (12 - i);
            }

            Resto = (Soma * 10) % 11;
            if ((Resto == 10) || (Resto == 11)) {
                Resto = 0;
            }

            if (Resto != parseInt(cpf.substring(10, 11))) {
                document.getElementById("cpfIdoso").setCustomValidity('Inválido');
                return false;
            }

            document.getElementById("cpfIdoso").setCustomValidity('');
            return true;
        } //Verifica se CPF é válido
        function TestaCPF(strCPF) {
            var Soma, Resto, borda_original;
            Soma = 0;

            var cpf = strCPF.replace(/\D/g, '');

            if (cpf == "00000000000") {
                document.getElementById("cpfIdoso").setCustomValidity('Inválido');
                return false;
            }

            for (i = 1; i <= 9; i++) {
                Soma = Soma + parseInt(cpf.substring(i - 1, i)) * (11 - i);
            }

            Resto = (Soma * 10) % 11;
            if ((Resto == 10) || (Resto == 11)) {
                Resto = 0;
            }

            if (Resto != parseInt(cpf.substring(9, 10))) {
                document.getElementById("cpfIdoso").setCustomValidity('Inválido');
                return false;
            }

            Soma = 0;
            for (i = 1; i <= 10; i++) {
                Soma = Soma + parseInt(cpf.substring(i - 1, i)) * (12 - i);
            }

            Resto = (Soma * 10) % 11;
            if ((Resto == 10) || (Resto == 11)) {
                Resto = 0;
            }

            if (Resto != parseInt(cpf.substring(10, 11))) {
                document.getElementById("cpfIdoso").setCustomValidity('Inválido');
                return false;
            }

            document.getElementById("cpfIdoso").setCustomValidity('');
            return true;
        }

    </script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.mask.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    
    <link href="../css/Func.css" type="text/css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="imagens/favicon.ico">
    <script src="../js/modernizr.custom.js"></script>
</head>

<body>
    <?php
           include 'verificacao.php';
            $conexao = abrirconexao();
       ?>
    <div id="topo"></div>
    <header class="cabecalho">
        <a href="../View/homeGerente.php">
            <h1 class="logo"></h1>
        </a>
        <div class="novomenu">
            <div id="dl-menu" class="dl-menuwrapper">
                <br><br>
                <button class="dl-trigger" style="background-color: transparent"></button>
                <ul class="dl-menu" style=" background-color: rgba(52,103,125,0.8);">
                    <li>
                        <a href="../View/listarRes.php">Responsáveis</a>
                    </li>
                    <li>
                        <a href="../View/listCuidador.php">Cuidadores</a>
                    </li>

                    <li>
                        <a href="../View/homeGerente.php">Pacientes</a>
                    </li>

                    <li>
                        <a href="../View/logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container theme-showcase" role="main">
        <div class="page-header">
            <h1>Cadastrar Idoso</h1>
        </div>
        <div>

            <!-- Nav tabs 
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#dados_pessoais" aria-controls="home" role="tab" data-toggle="tab">Dados Pessoais</a></li>
                <li role="presentation"><a href="#dados_de_acesso" aria-controls="dados_de_acesso" role="tab" data-toggle="tab">Dados de Acesso</a></li>
                <li role="presentation"><a href="#medicacao" aria-controls="medicacao" role="tab" data-toggle="tab">Medicação</a></li>
            </ul>
-->
            <!-- Tab panes -->
            <?php
            if($_SESSION['direto'] == 0) {
                @$_SESSION['cpfResponsavel'] = $_POST['cpfPessoa'];    
            }
            
            $sqlResponsavel = "SELECT codResponsavel, nomeResponsavel, cpfResponsavel FROM tbResponsavel WHERE cpfResponsavel = '".$_SESSION['cpfResponsavel']."'";
                
                $resultado = $conexao->query($sqlResponsavel);
            

        while($linharesultado = mysqli_fetch_array($resultado)){
            $cpf = $linharesultado['cpfResponsavel'];
            $cod = $linharesultado['codResponsavel'];
            $nome = $linharesultado['nomeResponsavel'];
            
        }
            $numresultado = mysqli_num_rows($resultado);
            
            if($numresultado <= 0)
            echo'
            <form class="form-horizontal" action="cadastroIdosoTab.php" method="post" enctype="multipart/form-data">
                <label>CPF Responsável:</label><input type="text" class="form-control" id="cpfPessoa" name="cpfPessoa" required="" placeholder="CPF Responsavel" onblur="TestaCPF(this.value);">
                <button type="submit">Procurar</button>
            </form>
            
            <script type="text/javascript">
                                    $("#cpfPessoa").mask("999.999.999-99");

                                </script>
            ';
                if($numresultado > 0) {
                    echo '
                    <form class="form-horizontal" action="../Controller/rotinasCadastroIdoso.php" method="post" enctype="multipart/form-data">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="dados_pessoais">
                        <div style="padding-top:20px;">
                            <label>Idoso:</label>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nome</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nomeIdoso" name="nomeIdoso" required="" placeholder="Nome">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">CPF</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="cpfIdoso" name="cpfIdoso" required="" placeholder="CPF" onblur="TestaCPF(this.value);">
                                </div>
                                <script type="text/javascript">
                                    $("#cpfIdoso").mask("999.999.999-99");

                                </script>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Sexo</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="sexoIdoso" name="sexoIdoso" required="">
                                        <option value="Masculino">Masculino</option>
                                        <option value="Feminino">Feminino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nascimento</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="nascIdoso" name="nascIdoso" required="" placeholder="Data Nascimento" onchange="validardataDeNascimento(this.value);">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Peso</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="peso" name="peso" required="" placeholder="Peso">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Altura</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="altura" name="altura" required="" placeholder="Altura">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Foto</label>
                                <div class="col-sm-10">
                                    <input type="file" required name="foto" style="opacity: 100%; cursor: pointer; font-family: comfortaa; color: rgba(52,103,125);">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <a href="cadastroIdosoTab.php" class="btn btn-secondary">Outro Responsável</a>
                                    <a class="btn btn-success" href="#dados_de_acesso" aria-controls="dados_de_acesso" role="tab" data-toggle="tab" onclick="$("#topo").animatescroll();">Avançar</a>
                                </div>
                            </div>
                            <input type="hidden" value='.$cod.' name="codResponsavel" id="codResponsavel">
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="dados_de_acesso">
                        <div style="padding-top:20px;">
                            <label>Anamnese:</label>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Declinio Congnitivo</label>
                                <div class="col-sm-10">
                                    <input type="radio" id="declinioCongnitivo" name="declinioCongnitivo" required="" placeholder="declinioCongnitivo" value="Sim">Sim
                                    <input type="radio" id="declinioCongnitivo" name="declinioCongnitivo" required="" placeholder="declinioCongnitivo" checked=true value="Não">Não
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Dificuldade Fala</label>
                                <div class="col-sm-10">
                                    <input type="radio" id="dificuldadeFala" name="dificuldadeFala" required="" placeholder="dificuldadeFala" value="Sim">Sim
                                    <input type="radio" id="dificuldadeFala" name="dificuldadeFala" required="" placeholder="dificuldadeFala"checked=true value="Não">Não
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Audição</label>
                                <div class="col-sm-10">
                                    <select id="audicao" name="audicao" required="">
                                        <option value="Sem Aparelho">Sem Aparelho</option>
                                        <option value="Com Aparelho">Com Aparelho</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Acidente Vascular Encefálico</label>
                                <div class="col-sm-10">
                                    <input type="radio" id="acidenteVascularEncefalico" name="acidenteVascularEncefalico" required="" placeholder="acidenteVascularEncefalico" value="Sim">Sim
                                    <input type="radio" id="acidenteVascularEncefalico" name="acidenteVascularEncefalico" required="" placeholder="acidenteVascularEncefalico" checked=true value="Não">Não
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Traumatismo Cranio Encefálico</label>
                                <div class="col-sm-10">
                                    <input type="radio" id="traumatismoCranioEncefalico" name="traumatismoCranioEncefalico" required="" placeholder="traumatismoCranioEncefalico" value="Sim">Sim
                                    <input type="radio" id="traumatismoCranioEncefalico" name="traumatismoCranioEncefalico" required="" placeholder="traumatismoCranioEncefalico"checked=true value="Não">Não
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Hipertensão Arterial</label>
                                <div class="col-sm-10">
                                    <input type="radio" id="hipertensaoArterial" name="hipertensaoArterial" required="" placeholder="hipertensaoArterial" value="Sim">Sim
                                    <input type="radio" id="hipertensaoArterial" name="hipertensaoArterial" required="" placeholder="hipertensaoArterial"checked=true value="Não">Não
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Hipotireoidismo</label>
                                <div class="col-sm-10">
                                    <input type="radio" id="hipotireoidismo" name="hipotireoidismo" required="" placeholder="hipotireoidismo" value="Sim">Sim
                                    <input type="radio" id="hipotireoidismo" name="hipotireoidismo" required="" placeholder="hipotireoidismo"checked=true value="Não">Não
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tipo Diabetes</label>
                                <div class="col-sm-10">
                                    <select id="tipoDiabetes" name="tipoDiabetes" required="">
                                        <option value="Nenhum">Nenhum</option>
                                        <option value="Tipo 1">Tipo 1</option>
                                        <option value="Tipo 2">Tipo 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tipo Cancer</label>
                                <div class="col-sm-10">
                                    <select id="tipoCancer" name="tipoCancer" required="">
                                        <option value="Nenhum">Nenhum</option>
                                        <option value="Ânus">Ânus</option>
                                        <option value="Bexiga">Bexiga</option>
                                        <option value="Boca e Orofaringe">Boca e Orofaringe</option>
                                        <option value="Colorretal">Colorretal</option>
                                        <option value="Cabeça e Pescoço">Cabeça e Pescoço</option>
                                        <option value="Cavidade Nasal e Seios Paranasais">Cavidade Nasal e Seios Paranasais</option>
                                        <option value="Cavidade Oral e Orofaringe">Cavidade Oral e Orofaringe</option>
                                        <option value="Colo do Útero">Colo do Útero</option>
                                        <option value="Doença de Castleman">Doença de Castleman</option>
                                        <option value="Doença Trofoblástica Gestacional">Doença Trofoblástica Gestacional</option>
                                        <option value="Endométrio">Endométrio</option>
                                        <option value="Esôfago">Esôfago</option>
                                        <option value="Estômago">Estômago</option>
                                        <option value="Fígado">Fígado</option>
                                        <option value="Garganta">Garganta</option>
                                        <option value="Gástrico">Gástrico</option>
                                        <option value="GIST">GIST</option>
                                        <option value="Glândula Suprarrenal">Glândula Suprarrenal</option>
                                        <option value="Glândulas Salivares">Glândulas Salivares</option>
                                        <option value="Intestino Delgado">Intestino Delgado</option>
                                        <option value="Laringe e Hipofaringe">Laringe e Hipofaringe</option>
                                        <option value="Leucemia Linfóide Aguda (LLA)">Leucemia Linfóide Aguda (LLA)</option>
                                        <option value="Leucemia Linfóide Crônica (LLC)">Leucemia Linfóide Crônica (LLC)</option>
                                        <option value="Leucemia Mieloide Aguda (LMA)">Leucemia Mieloide Aguda (LMA)</option>
                                        <option value="Leucemia Mieloide Crônica (LMC)">Leucemia Mieloide Crônica (LMC)</option>
                                        <option value="Leucemia Mielomonocítica Crônica (LMMC)">Leucemia Mielomonocítica Crônica (LMMC)</option>
                                        <option value="Linfoma de Hodgkin">Linfoma de Hodgkin</option>
                                        <option value="Linfoma de Pele">Linfoma de Pele</option>
                                        <option value="Linfoma Não Hodgkin">Linfoma Não Hodgkin</option>
                                        <option value="Macroglobulinemia Waldenstrom">Macroglobulinemia Waldenstrom</option>
                                        <option value="Mama">Mama</option>
                                        <option value="Mama Avançado">Mama Avançado</option>
                                        <option value="Mama em Homens">Mama em Homens</option>
                                        <option value="Melanoma">Melanoma</option>
                                        <option value="Mesotelioma">Mesotelioma</option>
                                        <option value="Mieloma Múltiplo">Mieloma Múltiplo</option>
                                        <option value="Nasofaringe">Nasofaringe</option>
                                        <option value="Neuroblastoma">Neuroblastoma</option>
                                        <option value="Neuroendócrinos">Neuroendócrinos</option>
                                        <option value="Olho">Olho</option>
                                        <option value="Ovário">Ovário</option>
                                        <option value="Osteossarcoma">Osteossarcoma</option>
                                        <option value="Pâncreas">Pâncreas</option>
                                        <option value="Pele Basocelular e Espinocelular">Pele Basocelular e Espinocelular</option>
                                        <option value="Pele de Células de Merkel">Pele de Células de Merkel</option>
                                        <option value="Pênis">Pênis</option>
                                        <option value="Próstata">Próstata</option>
                                        <option value="Pulmão de Não Pequenas Células">Pulmão de Não Pequenas Células</option>
                                        <option value="Pulmão de Pequenas Células">Pulmão de Pequenas Células</option>
                                        <option value="Raros">Raros</option>
                                        <option value="Rim">Rim</option>
                                        <option value="Rabdomiossarcoma">Rabdomiossarcoma</option>
                                        <option value="Retinoblastoma">Retinoblastoma</option>
                                        <option value="Sarcoma de Kaposi">Sarcoma de Kaposi</option>
                                        <option value="Sarcoma de Partes Moles">Sarcoma de Partes Moles</option>
                                        <option value="Sarcoma Uterino">Sarcoma Uterino</option>
                                        <option value="Síndrome Mielodisplásica">Síndrome Mielodisplásica</option>
                                        <option value="Sítio Primário Desconhecido">Sítio Primário Desconhecido</option>
                                        <option value="Testículo">Testículo</option>
                                        <option value="Timo">Timo</option>
                                        <option value="Tireoide">Tireoide</option>
                                        <option value="Tumor Carcinoide de Pulmão">Tumor Carcinoide de Pulmão</option>
                                        <option value="Tumor Carcinoide Gastrointestinal">Tumor Carcinoide Gastrointestinal</option>
                                        <option value="Tumor de Ewing">Tumor de Ewing</option>
                                        <option value="Tumor de Wilms">Tumor de Wilms</option>
                                        <option value="Tumor Gastro Intestinal">Tumor Gastro Intestinal</option>
                                        <option value="Tumores Cerebrais/SNC">Tumores Cerebrais/SNC</option>
                                        <option value="Tumores Neuroendócrinos">Tumores Neuroendócrinos</option>
                                        <option value="Tumores Ósseos">Tumores Ósseos</option>
                                        <option value="Tumores Pituitários">Tumores Pituitários</option>
                                        <option value="Vagina">Vagina</option>
                                        <option value="Vesícula">Vesícula</option>
                                        <option value="Via Biliar">Via Biliar</option>
                                        <option value="Vulva">Vulva</option>
                                        <option value="Outro">Outro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tipo Cirurgia</label>
                                <div class="col-sm-10">
                                    <select id="tipoCirurgia" name="tipoCirurgia" required="">
                                        <option value="Nenhuma">Nenhuma</option>
                                        <option value="Maior">Maior</option>
                                        <option value="Menor">Menor</option>
                                        <option value="Eletiva">Eletiva</option>
                                        <option value="Urgência/Emergência">Urgência/Emergência</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Uso Medicamento</label>
                                <div class="col-sm-10">
                                    <input type="radio" id="usoMedicamento1" name="usoMedicamento" required="" placeholder="usoMedicamento" value="Sim" onclick="myFunction()">Sim
                                    <input type="radio" id="usoMedicamento" name="usoMedicamento" required="" placeholder="usoMedicamento"checked=true value="Não" onclick="myFunction()">Não
                                </div>
                            </div>
                            <style>
                                #cadastroMedicamento {
                                    display: none;
                                }
                            </style>
                            <script>
function myFunction() {
  var x = document.getElementById("usoMedicamento1").checked;
  
  if(x == true){ 
  cadastroMedicamento.style.display = "block";
  } else {
    cadastroMedicamento.style.display = "none";
  }
}
</script>
                            <div id="cadastroMedicamento" style="padding-top:20px;">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nome da medicação</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nomeMedicamento" name="nomeMedicamento" placeholder="Nome da medicação">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Dosagem</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="dosagemMedicamento" name="dosagemMedicamento"  placeholder="Dosagem">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Horário da medicação</label>
                                <div class="col-sm-10">
                                    <input type="time" class="form-control" id="horarioMedicamento" name="horarioMedicamento"  placeholder="Horário da medicação">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Posologia</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="posologia" name="posologia" placeholder="Posologia">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Composicao Medicamento</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="composicaoMedicamento" name="composicaoMedicamento"  placeholder="Composicao Medicamento">
                                </div>
                            </div>
                        </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tratamento Realizado</label>
                                <div class="col-sm-10">
                                    <input type="radio" id="tratamentoRealizado" name="tratamentoRealizado" required="" placeholder="tratamentoRealizado" value="Sim">Sim
                                    <input type="radio" id="tratamentoRealizado" name="tratamentoRealizado" required="" placeholder="tratamentoRealizado"checked=true value="Não">Não
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <a href="#dados_pessoais" aria-controls="home" role="tab" data-toggle="tab" class="btn btn-danger">Voltar</a>
                                    <a class="btn btn-success" href="#dados_de_acesso1" aria-controls="dados_de_acesso1" role="tab" data-toggle="tab">Avançar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="dados_de_acesso1">
                        <label>Questionamento: </label>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Utilização Óculos</label>
                            <div class="col-sm-10">
                                <input type="radio" id="utilizacaoOculos" name="utilizacaoOculos" required="" placeholder="utilizacaoOculos" value="Sim">Sim
                                <input type="radio" id="utilizacaoOculos" name="utilizacaoOculos" required="" placeholder="utilizacaoOculos"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Prótese Auditiva</label>
                            <div class="col-sm-10">
                                <input type="radio" id="proteseAuditiva" name="proteseAuditiva" required="" placeholder="proteseAuditiva" value="Sim">Sim
                                <input type="radio" id="proteseAuditiva" name="proteseAuditiva" required="" placeholder="proteseAuditiva"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Carteira de Vacinação</label>
                            <div class="col-sm-10">
                                <input type="radio" id="carteiraVacinacao" name="carteiraVacinacao" required="" placeholder="carteiraVacinacao" value="Sim">Sim
                                <input type="radio" id="carteiraVacinacao" name="carteiraVacinacao" required="" placeholder="carteiraVacinacao"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tabagista</label>
                            <div class="col-sm-10">
                                <input type="radio" id="tabagista" name="tabagista" required="" placeholder="tabagista" value="Sim">Sim
                                <input type="radio" id="tabagista" name="tabagista" required="" placeholder="tabagista"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Etilista</label>
                            <div class="col-sm-10">
                                <input type="radio" id="etilista" name="etilista" required="" placeholder="etilista" value="Sim">Sim
                                <input type="radio" id="etilista" name="etilista" required="" placeholder="etilista"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Dependência Etilismo</label>
                            <div class="col-sm-10">
                                <input type="radio" id="dependenciaEtilismo" name="dependenciaEtilismo" required="" placeholder="dependenciaEtilismo" value="Sim">Sim
                                <input type="radio" id="dependenciaEtilismo" name="dependenciaEtilismo" required="" placeholder="dependenciaEtilismo"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tipo Sanguíneo</label>
                            <div class="col-sm-10">
                                <select id="tipoSanguineo" name="tipoSanguineo" required="">
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Uso Prótese Dentária</label>
                            <div class="col-sm-10">
                                <input type="radio" id="usoProteseDentaria" name="usoProteseDentaria" required="" placeholder="usoProteseDentaria" value="Sim">Sim
                                <input type="radio" id="usoProteseDentaria" name="usoProteseDentaria" required="" placeholder="usoProteseDentaria"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Uso Medicamento Contínuo</label>
                            <div class="col-sm-10">
                                <input type="radio" id="usoMedicamentoContinuo" name="usoMedicamentoContinuo" required="" placeholder="usoMedicamentoContinuo" value="Sim">Sim
                                <input type="radio" id="usoMedicamentoContinuo" name="usoMedicamentoContinuo" required="" placeholder="usoMedicamentoContinuo"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Uso Substância Psicoativa</label>
                            <div class="col-sm-10">
                                <input type="radio" id="usoSubstanciaPsicoativa" name="usoSubstanciaPsicoativa" required="" placeholder="usoSubstanciaPsicoativa" value="Sim">Sim
                                <input type="radio" id="usoSubstanciaPsicoativa" name="usoSubstanciaPsicoativa" required="" placeholder="usoSubstanciaPsicoativa"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Alergia Medicamento</label>
                            <div class="col-sm-10">
                                <input type="radio" id="alergiaMedicamento" name="alergiaMedicamento" required="" placeholder="alergiaMedicamento" value="Sim">Sim
                                <input type="radio" id="alergiaMedicamento" name="alergiaMedicamento" required="" placeholder="alergiaMedicamento"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Convenio</label>
                            <div class="col-sm-10">
                                <input type="radio" id="convenio" name="convenio" required="" placeholder="convenio" value="Sim">Sim
                                <input type="radio" id="convenio" name="convenio" required="" placeholder="convenio"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Encaminhamento Unidade Hospitalar</label>
                            <div class="col-sm-10">
                                <input type="radio" id="encaminhamentoUnidadeHospitalar" name="encaminhamentoUnidadeHospitalar" required="" placeholder="encaminhamentoUnidadeHospitalar" value="Sim">Sim
                                <input type="radio" id="encaminhamentoUnidadeHospitalar" name="encaminhamentoUnidadeHospitalar" required="" placeholder="encaminhamentoUnidadeHospitalar"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Atividade Manual</label>
                            <div class="col-sm-10">
                                <input type="radio" id="atividadeManual" name="atividadeManual" required="" placeholder="atividadeManual" value="Sim">Sim
                                <input type="radio" id="atividadeManual" name="atividadeManual" required="" placeholder="atividadeManual"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <a href="#dados_de_acesso" aria-controls="dados_de_acesso" role="tab" data-toggle="tab" class="btn btn-danger">Voltar</a>
                            <a class="btn btn-success" href="#dados_de_acesso2" aria-controls="dados_de_acesso2" role="tab" data-toggle="tab">Avançar</a>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="dados_de_acesso2">
                        <label>Pele:</label>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Integridade Pele</label>
                            <div class="col-sm-10">
                                <input type="radio" id="integridadePele" name="integridadePele" required="" placeholder="integridadePele" value="Sim">Sim
                                <input type="radio" id="integridadePele" name="integridadePele" required="" placeholder="integridadePele"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Hidratação Pele</label>
                            <div class="col-sm-10">
                                <input type="radio" id="hidratacaoPele" name="hidratacaoPele" required="" placeholder="hidratacaoPele" value="Sim">Sim
                                <input type="radio" id="hidratacaoPele" name="hidratacaoPele" required="" placeholder="hidratacaoPele"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Dermatite</label>
                            <div class="col-sm-10">
                                <input type="radio" id="dermatite" name="dermatite" required="" placeholder="dermatite" value="Sim">Sim
                                <input type="radio" id="dermatite" name="dermatite" required="" placeholder="dermatite"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Prurido</label>
                            <div class="col-sm-10">
                                <input type="radio" id="prurido" name="prurido" required="" placeholder="prurido" value="Sim">Sim
                                <input type="radio" id="prurido" name="prurido" required="" placeholder="prurido"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Micose Unha</label>
                            <div class="col-sm-10">
                                <input type="radio" id="micoseUnha" name="micoseUnha" required="" placeholder="micoseUnha" value="Sim">Sim
                                <input type="radio" id="micoseUnha" name="micoseUnha" required="" placeholder="micoseUnha"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Escamação Pele</label>
                            <div class="col-sm-10">
                                <input type="radio" id="escamacaoPele" name="escamacaoPele" required="" placeholder="escamacaoPele" value="Sim">Sim
                                <input type="radio" id="escamacaoPele" name="escamacaoPele" required="" placeholder="escamacaoPele"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Ictericia Pele</label>
                            <div class="col-sm-10">
                                <input type="radio" id="ictericiaPele" name="ictericiaPele" required="" placeholder="ictericiaPele" value="Sim">Sim
                                <input type="radio" id="ictericiaPele" name="ictericiaPele" required="" placeholder="ictericiaPele"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Ferida Pele</label>
                            <div class="col-sm-10">
                                <input type="radio" id="feridaPele" name="feridaPele" required="" placeholder="feridaPele" value="Sim">Sim
                                <input type="radio" id="feridaPele" name="feridaPele" required="" placeholder="feridaPele"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Petequia Pele</label>
                            <div class="col-sm-10">
                                <input type="radio" id="petequiaPele" name="petequiaPele" required="" placeholder="petequiaPele" value="Sim">Sim
                                <input type="radio" id="petequiaPele" name="petequiaPele" required="" placeholder="petequiaPele"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Hematoma Pele</label>
                            <div class="col-sm-10">
                                <input type="radio" id="hematomaPele" name="hematomaPele" required="" placeholder="hematomaPele" value="Sim">Sim
                                <input type="radio" id="hematomaPele" name="hematomaPele" required="" placeholder="hematomaPele"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Úlcera</label>
                            <div class="col-sm-10">
                                <input type="radio" id="ulceraPele" name="ulceraPele" required="" placeholder="ulceraPele" value="Sim">Sim
                                <input type="radio" id="ulceraPele" name="ulceraPele" required="" placeholder="ulceraPele"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <a href="#dados_de_acesso1" aria-controls="dados_de_acesso1" role="tab" data-toggle="tab" class="btn btn-danger">Voltar</a>
                            <a class="btn btn-success" href="#dados_de_acesso3" aria-controls="dados_de_acesso3" role="tab" data-toggle="tab">Avançar</a>
                        </div>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="dados_de_acesso3">
                        <label>Pulmonar:</label>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tipo Tosse</label>
                            <div class="col-sm-10">
                                <select id="tipoTosse" name="tipoTosse" required="">
                                    <option value="Nenhuma">Nenhuma</option>
                                    <option value="Tosse seca">Tosse seca</option>
                                    <option value="Tosse produtiva">Tosse produtiva</option>
                                    <option value="Tosse medicamentosa">Tosse medicamentosa</option>
                                    <option value="Tosse alérgica">Tosse alérgica</option>
                                    <option value="Tosse espasmódica">Tosse espasmódica</option>
                                    <option value="Tosse paroxística">Tosse paroxística</option>
                                    <option value="Tosse aguda e subaguda">Tosse aguda e subaguda</option>
                                    <option value="Tosse crônica">Tosse crônica</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Ascultação</label>
                            <div class="col-sm-10">
                                <input type="radio" id="ascultacao" name="ascultacao" required="" placeholder="ascultacao" value="Sim">Sim
                                <input type="radio" id="ascultacao" name="ascultacao" required="" placeholder="ascultacao"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tipo Dispnéia</label>
                            <div class="col-sm-10">
                                <select id="tipoDispineia" name="tipoDispineia" required="">
                                    <option value="Nenhum">Nenhum</option>
                                    <option value="Taquipneia">Taquipneia</option>
                                    <option value="Bradipneia">Bradipneia</option>
                                    <option value="Hiperpnéia">Hiperpnéia</option>
                                    <option value="Hipopnéia">Hipopnéia</option>
                                    <option value="Apnéia">Apnéia</option>
                                    <option value="Ortopnéia">Ortopnéia</option>
                                    <option value="Platipneia">Platipneia</option>
                                    <option value="Trepopneia">Trepopneia</option>
                                    <option value="Dispnéia">Dispnéia </option>
                                    <option value="Resp agônica">Resp agônica</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <a href="#dados_de_acesso2" aria-controls="dados_de_acesso2" role="tab" data-toggle="tab" class="btn btn-danger">Voltar</a>
                            <a class="btn btn-success" href="#dados_de_acesso4" aria-controls="dados_de_acesso4" role="tab" data-toggle="tab">Avançar</a>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="dados_de_acesso4">
                        <label>Alimentação:</label>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Alimentação Solo</label>
                            <div class="col-sm-10">
                                <input type="radio" id="alimentacaoSolo" name="alimentacaoSolo" required="" placeholder="alimentacaoSolo" value="Sim">Sim
                                <input type="radio" id="alimentacaoSolo" name="alimentacaoSolo" required="" placeholder="alimentacaoSolo"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Dificuldade Deglutição</label>
                            <div class="col-sm-10">
                                <input type="radio" id="dificuldadeDegluticao" name="dificuldadeDegluticao" required="" placeholder="dificuldadeDegluticao" value="Sim">Sim
                                <input type="radio" id="dificuldadeDegluticao" name="dificuldadeDegluticao" required="" placeholder="dificuldadeDegluticao"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Uso Sonda</label>
                            <div class="col-sm-10">
                                <input type="radio" id="usoSonda" name="usoSonda" required="" placeholder="usoSonda" value="Sim">Sim
                                <input type="radio" id="usoSonda" name="usoSonda" required="" placeholder="usoSonda"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Restrição Alimento</label>
                            <div class="col-sm-10">
                                <input type="radio" id="restricaoAlimento" name="restricaoAlimento" required="" placeholder="restricaoAlimento" value="Sim">Sim
                                <input type="radio" id="restricaoAlimento" name="restricaoAlimento" required="" placeholder="restricaoAlimento"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Preferência Alimento</label>
                            <div class="col-sm-10">
                                <input type="radio" id="preferenciaAlimento" name="preferenciaAlimento" required="" placeholder="preferenciaAlimento" value="Sim">Sim
                                <input type="radio" id="preferenciaAlimento" name="preferenciaAlimento" required="" placeholder="preferenciaAlimento"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <a href="#dados_de_acesso3" aria-controls="dados_de_acesso3" role="tab" data-toggle="tab" class="btn btn-danger">Voltar</a>
                            <a class="btn btn-success" href="#dados_de_acesso5" aria-controls="dados_de_acesso5" role="tab" data-toggle="tab">Avançar</a>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="dados_de_acesso5">
                        <label>Locomoção:</label>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Locomoção Solo</label>
                            <div class="col-sm-10">
                                <input type="radio" id="locomocaoSolo" name="locomocaoSolo" required="" placeholder="locomocaoSolo" value="Sim">Sim
                                <input type="radio" id="locomocaoSolo" name="locomocaoSolo" required="" placeholder="locomocaoSolo"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Cadeirante</label>
                            <div class="col-sm-10">
                                <input type="radio" id="cadeirante" name="cadeirante" required="" placeholder="cadeirante" value="Sim">Sim
                                <input type="radio" id="cadeirante" name="cadeirante" required="" placeholder="cadeirante"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Acamação</label>
                            <div class="col-sm-10">
                                <input type="radio" id="acamacao" name="acamacao" required="" placeholder="acamacao" value="Sim">Sim
                                <input type="radio" id="acamacao" name="acamacao" required="" placeholder="acamacao"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Apoio Físico</label>
                            <div class="col-sm-10">
                                <input type="radio" id="apoioFisico" name="apoioFisico" required="" placeholder="apoioFisico" value="Sim">Sim
                                <input type="radio" id="apoioFisico" name="apoioFisico" required="" placeholder="apoioFisico"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Esporte Terapia</label>
                            <div class="col-sm-10">
                                <input type="radio" id="esporteTerapia" name="esporteTerapia" required="" placeholder="esporteTerapia" value="Sim">Sim
                                <input type="radio" id="esporteTerapia" name="esporteTerapia" required="" placeholder="esporteTerapia"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <a href="#dados_de_acesso4" aria-controls="dados_de_acesso4" role="tab" data-toggle="tab" class="btn btn-danger">Voltar</a>
                            <a class="btn btn-success" href="#dados_de_acesso6" aria-controls="dados_de_acesso6" role="tab" data-toggle="tab">Avançar</a>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="dados_de_acesso6">
                        <label>Relacionamento:</label>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Status Comunicação</label>
                            <div class="col-sm-10">
                                <input type="radio" id="statusComunicacao" name="statusComunicacao" required="" placeholder="statusComunicacao" value="Sim">Sim
                                <input type="radio" id="statusComunicacao" name="statusComunicacao" required="" placeholder="statusComunicacao"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Agressividade</label>
                            <div class="col-sm-10">
                                <select id="agressividade" name="agressividade" required="">
                                    <option value="Nenhuma">Nenhuma</option>
                                    <option value="Pouca">Pouca</option>
                                    <option value="Moderado">Moderada</option>
                                    <option value="Muita">Muita</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Temperamento</label>
                            <div class="col-sm-10">
                                <select id="temperamento" name="temperamento" required="">
                                    <option value="Colérico">Colérico</option>
                                    <option value="Melancólico">Melancólico</option>
                                    <option value="Sanguíneo">Sanguíneo</option>
                                    <option value="Fleumático">Fleumático</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Anterioridade Casa Repouso</label>
                            <div class="col-sm-10">
                                <input type="radio" id="anterioridadeCasaRepouso" name="anterioridadeCasaRepouso" required="" placeholder="anterioridadeCasaRepouso" value="Sim">Sim
                                <input type="radio" id="anterioridadeCasaRepouso" name="anterioridadeCasaRepouso" required="" placeholder="anterioridadeCasaRepouso"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Irritabilidade</label>
                            <div class="col-sm-10">
                                <input type="radio" id="irritabilidade" name="irritabilidade" required="" placeholder="irritabilidade" value="Sim">Sim
                                <input type="radio" id="irritabilidade" name="irritabilidade" required="" placeholder="irritabilidade"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <a href="#dados_de_acesso5" aria-controls="dados_de_acesso5" role="tab" data-toggle="tab" class="btn btn-danger">Voltar</a>
                            <a class="btn btn-success" href="#dados_de_acesso7" aria-controls="dados_de_acesso7" role="tab" data-toggle="tab">Avançar</a>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="dados_de_acesso7">
                        <label>Exame:</label>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Conclusão Hemograma</label>
                            <div class="col-sm-10">
                                <input type="radio" id="conclusaoHemograma" name="conclusaoHemograma" required="" placeholder="conclusaoHemograma" value="Sim">Sim
                                <input type="radio" id="conclusaoHemograma" name="conclusaoHemograma" required="" placeholder="conclusaoHemograma"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tipo Urina</label>
                            <div class="col-sm-10">
                                <select id="tipoUrina" name="tipoUrina" required="">
                                    <option value="Urina amarelo escuro">Urina amarelo escuro</option>
                                    <option value="Urina laranja">Urina laranja</option>
                                    <option value="Urina vermelha ou rosa">Urina vermelha ou rosa</option>
                                    <option value="Urina roxa">Urina roxa</option>
                                    <option value="Urina azul">Urina azul</option>
                                    <option value="Urina verde">Urina verde</option>
                                    <option value="Urina marrom">Urina marrom</option>
                                    <option value="Urina esbranquiçada">Urina esbranquiçada</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Parasitologico Fezes</label>
                            <div class="col-sm-10">
                                <input type="radio" id="parasitologicoFezes" name="parasitologicoFezes" required="" placeholder="parasitologicoFezes" value="Sim">Sim
                                <input type="radio" id="parasitologicoFezes" name="parasitologicoFezes" required="" placeholder="parasitologicoFezes"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Glicemia Jejum</label>
                            <div class="col-sm-10">
                                <input type="radio" id="glicemiaJejum" name="glicemiaJejum" required="" placeholder="glicemiaJejum" value="Sim">Sim
                                <input type="radio" id="glicemiaJejum" name="glicemiaJejum" required="" placeholder="glicemiaJejum"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Colesterol</label>
                            <div class="col-sm-10">
                                <select id="colesterol" name="colesterol" required="">
                                    <option value="Alto">Alto</option>
                                    <option value="Baixo">Baixo</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tipo Hepatite</label>
                            <div class="col-sm-10">
                                <select id="tipoHepatite" name="tipoHepatite" required="">
                                    <option value="Nenhum">Nenhum</option>
                                    <option value="HEPATITE A">HEPATITE A</option>
                                    <option value="HEPATITE B">HEPATITE B</option>
                                    <option value="HEPATITE C">HEPATITE C</option>
                                    <option value="HEPATITE D">HEPATITE D</option>
                                    <option value="HEPATITE E">HEPATITE E</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">HIV</label>
                            <div class="col-sm-10">
                                <input type="radio" id="hiv" name="hiv" required="" placeholder="hiv" value="Sim">Sim
                                <input type="radio" id="hiv" name="hiv" required="" placeholder="hiv"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">VDRL</label>
                            <div class="col-sm-10">
                                <input type="radio" id="vdrl" name="vdrl" required="" placeholder="vdrl" value="Sim">Sim
                                <input type="radio" id="vdrl" name="vdrl" required="" placeholder="vdrl"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Atestado Neurologico</label>
                            <div class="col-sm-10">
                                <input type="radio" id="atestadoNeurologico" name="atestadoNeurologico" required="" placeholder="atestadoNeurologico" value="Sim">Sim
                                <input type="radio" id="atestadoNeurologico" name="atestadoNeurologico" required="" placeholder="atestadoNeurologico"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Raio X Pulmão</label>
                            <div class="col-sm-10">
                                <input type="radio" id="raioxPulmao" name="raioxPulmao" required="" placeholder="raioxPulmao" value="Sim">Sim
                                <input type="radio" id="raioxPulmao" name="raioxPulmao" required="" placeholder="raioxPulmao"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Receituário Médico</label>
                            <div class="col-sm-10">
                                <input type="radio" id="receituarioMedico" name="receituarioMedico" required="" placeholder="receituarioMedico" value="Sim">Sim
                                <input type="radio" id="receituarioMedico" name="receituarioMedico" required="" placeholder="receituarioMedico"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <a href="#dados_de_acesso6" aria-controls="dados_de_acesso6" role="tab" data-toggle="tab" class="btn btn-danger">Voltar</a>
                            <a class="btn btn-success" href="#dados_de_acesso8" aria-controls="dados_de_acesso8" role="tab" data-toggle="tab">Avançar</a>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="dados_de_acesso8">
                        <label>Eliminação:</label>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Frequência Evacuação</label>
                            <div class="col-sm-10">
                                <select id="frequenciaEvacuacao" name="frequenciaEvacuacao" required="">
                                    <option value="Pouco">Pouco</option>
                                    <option value="Moderado">Moderado</option>
                                    <option value="Muito">Muito</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Aspecto Fezes</label>
                            <div class="col-sm-10">
                                <select id="aspecto" name="aspecto" required="">
                                    <option value="Tipo 1">Tipo 1</option>
                                    <option value="Tipo 2">Tipo 2</option>
                                    <option value="Tipo 3">Tipo 3</option>
                                    <option value="Tipo 4">Tipo 4</option>
                                    <option value="Tipo 5">Tipo 5</option>
                                    <option value="Tipo 6">Tipo 6</option>
                                    <option value="Tipo 7">Tipo 7</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Odor Urina</label>
                            <div class="col-sm-10">
                                <input type="radio" id="odorUrina" name="odorUrina" required="" placeholder="odorUrina" value="Sim">Sim
                                <input type="radio" id="odorUrina" name="odorUrina" required="" placeholder="odorUrina"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Frequência Urina</label>
                            <div class="col-sm-10">
                                <select id="frequenciaUrina" name="frequenciaUrina" required="">
                                    <option value="Sim">Pouco</option>
                                    <option value="Não">Moderado</option>
                                    <option value="Não">Muito</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Queixa Gases</label>
                            <div class="col-sm-10">
                                <input type="radio" id="queixaGases" name="queixaGases" required="" placeholder="queixaGases" value="Sim">Sim
                                <input type="radio" id="queixaGases" name="queixaGases" required="" placeholder="queixaGases"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Uso Fralda Geriátrica</label>
                            <div class="col-sm-10">
                                <input type="radio" id="usoFraldaGeriatrica" name="usoFraldaGeriatrica" required="" placeholder="usoFraldaGeriatrica" value="Sim">Sim
                                <input type="radio" id="usoFraldaGeriatrica" name="usoFraldaGeriatrica" required="" placeholder="usoFraldaGeriatrica"checked=true value="Não">Não
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <a href="cadastroIdosoTab.php" class="btn btn-secondary">Outro Responsável</a>
                            <a href="#dados_pessoais" aria-controls="home" role="tab" data-toggle="tab" class="btn btn-info">Ínicio</a>
                            <a href="#dados_de_acesso7" aria-controls="dados_de_acesso7" role="tab" data-toggle="tab" class="btn btn-danger">Voltar</a>
                            <button type="submit" class="btn btn-success">Cadastrar</button>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="medicacao">
                        
                    </div>
                </div>
            </form>

        </div>
    </div> ';
                }
                else {
                    echo('Responsável não existe ou CPF incorreto <a class="btn btn-secondary" href="cadastroPessoa.php">Cadastre Responsável</a>');
                    
                    $sqlListaResponsavel = "SELECT * FROM tbResponsavel";
                    $resultado = mysqli_query($conn, $sqlListaResponsavel);
                    
                    echo'<table class="table">
                            <tr>
                                <th>Nome Responsável</th>
                                <th>CPF Responsável</th>
                            </tr>
                        ';
                    while($rows = mysqli_fetch_assoc($resultado))
                    {
                        echo'
                        <tr>
                            <td>'.$rows['nomeResponsavel'].'</td>
                            <td>'.$rows['cpfResponsavel'].'</td>
                        </tr>
                        ';
                    }
                    echo'</table>';
                }
                
            
            ?>




            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
            <script src="../js/jquery.min.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="../js/bootstrap.min.js"></script>
            <script type="text/javascript" language="javascript">
                function validardataDeNascimento(data) {

                    dataAtual = new Date();

                    data = new Date(data);

                    if (data < dataAtual) {
                        console.log("Data Valida");
                        return true;
                    } else {
                        alert("Data inválida");
                        document.getElementById('nascIdoso').value = ("");
                        return false;
                    }


                }
        
            </script>
            <script src="../js/jquery.dlmenu.js"></script>
            <script>
                $(function() {
                    $('#dl-menu').dlmenu({
                        animationClasses: {
                            classin: 'dl-animate-in-2',
                            classout: 'dl-animate-out-2'
                        }
                    });
                });

            </script>
</body>

</html>
