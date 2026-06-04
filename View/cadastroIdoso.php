<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <meta charset="UTF-8">
    <title>InfoCare</title>
    <link href="../css/default.css" rel="stylesheet">
    <link href="../cssCadastro/css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="../css/Ger.css" type="text/css" rel="stylesheet">
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
    <link href="../css/Ger.css" type="text/css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="imagens/favicon.ico">
    <script src="../js/modernizr.custom.js"></script>
    <link href="../css/component.css" rel="stylesheet">
</head>

<body class="fundo" id="fundoCadastro">
    <?php
            session_start();
           include 'verificacao.php';
       ?>

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
    <div style="margin-top: 8%">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Dados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
            </li>
        </ul>
    </div>
    <div class="tab-content" id="myTabContent">
        <form action="../Controller/rotinasCadastroIdoso.php" method="post" enctype="multipart/form-data">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" style="padding-top:20px;">
                <br>
                <h2>Dados do Idoso:</h2>

                <div class="form-row">
                    <div class="form-group col-md-3 col-sm-4" id="nomeIdoso">
                        <input type="text" class="form-control" id="nomeIdoso" name="nomeIdoso" required="" placeholder="Nome">
                    </div>

                    <div class="form-group col-md-2 col-sm-3 col-6">
                        <input type="text" class="form-control" id="cpfIdoso" name="cpfIdoso" required="" placeholder="CPF" onblur="TestaCPF(this.value);">
                    </div>

                    <script type="text/javascript">
                        $("#cpfIdoso").mask("999.999.999-99");

                    </script>

                    <div class="form-group col-md-2 col-sm-3 col-4">
                        <select class="form-control" id="sexoIdoso" name="sexoIdoso" required="">
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2 col-sm-4 col-10">
                        <input type="date" class="form-control" id="nascIdoso" name="nascIdoso" required="" placeholder="Data Nascimento" onchange="validardataDeNascimento(this.value);">
                    </div>
                    <input type="hidden" name="codResponsavel" id="codResponsavel" value="<?php 
                $id = $_POST['codResponsavel'];
                echo($id);
                ?>">

                </div>

                <div class="form-row">
                    <label>Foto do idoso: </label>
                    <input type='file' required name='foto' style='opacity: 100%; cursor: pointer; font-family: comfortaa; color: rgba(52,103,125);'>
                </div>

            </div>

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                <h2>Antecedência:</h2>
                <div class="form-row">
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="declinioCongnitivo" name="declinioCongnitivo" required="" placeholder="declinioCongnitivo">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="dificuldadeFala" name="dificuldadeFala" required="" placeholder="dificuldadeFala">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="audicao" name="audicao" required="" placeholder="audicao">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="acidenteVascularEncefalico" name="acidenteVascularEncefalico" required="" placeholder="acidenteVascularEncefalico">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="traumatismoCranioEncefalico" name="traumatismoCranioEncefalico" required="" placeholder="traumatismoCranioEncefalico">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="hipertensaoArterial" name="hipertensaoArterial" required="" placeholder="hipertensaoArterial">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="hipotireoidismo" name="hipotireoidismo" required="" placeholder="hipotireoidismo">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="tipoDiabetes" name="tipoDiabetes" required="" placeholder="tipoDiabetes">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="tipoCancer" name="tipoCancer" required="" placeholder="tipoCancer">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="localFratura" name="localFratura" required="" placeholder="localFratura">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="tipoCirurgia" name="tipoCirurgia" required="" placeholder="tipoCirurgia">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="outrasPatologias" name="outrasPatologias" required="" placeholder="outrasPatologias">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="usoMedicamento" name="usoMedicamento" required="" placeholder="usoMedicamento">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="tratamentoRealizado" name="tratamentoRealizado" required="" placeholder="tratamentoRealizado">
                    </div>
                </div>

                <br>
                <h2>Questionamento:</h2>
                <div class="form-row">
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="peso" name="peso" required="" placeholder="peso">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="altura" name="altura" required="" placeholder="altura">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="pressaoArterial" name="pressaoArterial" required="" placeholder="pressaoArterial">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="pulsacao" name="pulsacao" required="" placeholder="pulsacao">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="respiracao" name="respiracao" required="" placeholder="respiracao">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="temperatura" name="temperatura" required="" placeholder="temperatura">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="dextro" name="dextro" required="" placeholder="dextro">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="spo2" name="spo2" required="" placeholder="spo2">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="utilizacaoOculos" name="utilizacaoOculos" required="" placeholder="utilizacaoOculos">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="proteseAuditiva" name="proteseAuditiva" required="" placeholder="proteseAuditiva">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="carteiraVacinacao" name="carteiraVacinacao" required="" placeholder="carteiraVacinacao">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="tabagista" name="tabagista" required="" placeholder="tabagista">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="etilista" name="etilista" required="" placeholder="etilista">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="dependenciaEtilismo" name="dependenciaEtilismo" required="" placeholder="dependenciaEtilismo">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="tipoSanguineo" name="tipoSanguineo" required="" placeholder="tipoSanguineo">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="usoProteseDentaria" name="usoProteseDentaria" required="" placeholder="usoProteseDentaria">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="marcaProteseDentaria" name="marcaProteseDentaria" required="" placeholder="marcaProteseDentaria">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="modeloProtoseDentaria" name="modeloProtoseDentaria" required="" placeholder="modeloProtoseDentaria">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="usoMedicamentoContinuo" name="usoMedicamentoContinuo" required="" placeholder="usoMedicamentoContinuo">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="usoSubstanciaPsicoativa" name="usoSubstanciaPsicoativa" required="" placeholder="usoSubstanciaPsicoativa">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="alergiaMedicamento" name="alergiaMedicamento" required="" placeholder="alergiaMedicamento">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="convenio" name="convenio" required="" placeholder="convenio">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="encaminhamentoUnidadeHospitalar" name="encaminhamentoUnidadeHospitalar" required="" placeholder="encaminhamentoUnidadeHospitalar">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="atividadeManual" name="atividadeManual" required="" placeholder="atividadeManual">
                    </div>
                </div>
                <br>
                <h2>Pele:</h2>
                <div class="form-row">
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="integridadePele" name="integridadePele" required="" placeholder="integridadePele">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="hidratacaoPele" name="hidratacaoPele" required="" placeholder="hidratacaoPele">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="dermatite" name="dermatite" required="" placeholder="dermatite">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="prurido" name="prurido" required="" placeholder="prurido">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="micoseUnha" name="micoseUnha" required="" placeholder="micoseUnha">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="escamacaoPele" name="escamacaoPele" required="" placeholder="escamacaoPele">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="ictericiaPele" name="ictericiaPele" required="" placeholder="ictericiaPele">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="feridaPele" name="feridaPele" required="" placeholder="feridaPele">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="petequiaPele" name="petequiaPele" required="" placeholder="petequiaPele">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="hematomaPele" name="hematomaPele" required="" placeholder="hematomaPele">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="ulceraPele" name="ulceraPele" required="" placeholder="ulceraPele">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="grauUlcera" name="grauUlcera" required="" placeholder="grauUlcera">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="outraEspecificacao" name="outraEspecificacao" required="" placeholder="outraEspecificacao">
                    </div>
                </div>
                <h2>Pulmonar:</h2>
                <div class="form-row">
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="tipoTosse" name="tipoTosse" required="" placeholder="tipoTosse">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="ascultacao" name="ascultacao" required="" placeholder="ascultacao">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="tipoDispineia" name="tipoDispineia" required="" placeholder="tipoDispineia">
                    </div>
                </div>
                <h2>Alimentação:</h2>
                <div class="form-row">
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="alimentacaoSolo" name="alimentacaoSolo" required="" placeholder="alimentacaoSolo">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="dificuldadeDegluticao" name="dificuldadeDegluticao" required="" placeholder="dificuldadeDegluticao">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="usoSonda" name="usoSonda" required="" placeholder="usoSonda">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="restricaoAlimento" name="restricaoAlimento" required="" placeholder="restricaoAlimento">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="preferenciaAlimento" name="preferenciaAlimento" required="" placeholder="preferenciaAlimento">
                    </div>
                </div>
                <br>
                <h2>Locomoção:</h2>
                <div class="form-row">
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="locomocaoSolo" name="locomocaoSolo" required="" placeholder="locomocaoSolo">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="cadeirante" name="cadeirante" required="" placeholder="cadeirante">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="tempoCadeirante" name="tempoCadeirante" required="" placeholder="Data Nascimento">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="acamacao" name="acamacao" required="" placeholder="acamacao">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="tempoAcamacao" name="tempoAcamacao" required="" placeholder="tempoAcamacao">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="apoioFisico" name="apoioFisico" required="" placeholder="apoioFisico">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="esporteTerapia" name="esporteTerapia" required="" placeholder="esporteTerapia">
                    </div>
                </div>
                <br>
                <h2>Relacionamento:</h2>
                <div class="form-row">
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="statusComunicacao" name="statusComunicacao" required="" placeholder="statusComunicacao">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="agressividade" name="agressividade" required="" placeholder="agressividade">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="temperamento" name="temperamento" required="" placeholder="temperamento">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="anterioridadeCasaRepouso" name="anterioridadeCasaRepouso" required="" placeholder="anterioridadeCasaRepouso">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="irritabilidade" name="irritabilidade" required="" placeholder="irritabilidade">
                    </div>
                </div>
                <br>
                <h2>Exame:</h2>
                <div class="form-row">
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="conclusaoHemograma" name="conclusaoHemograma" required="" placeholder="conclusaoHemograma">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="tipoUrina" name="tipoUrina" required="" placeholder="tipoUrina">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="parasitologicoFezes" name="parasitologicoFezes" required="" placeholder="parasitologicoFezes">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="glicemiaJejum" name="glicemiaJejum" required="" placeholder="glicemiaJejum">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="colesterol" name="colesterol" required="" placeholder="colesterol">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="tipoHepatite" name="tipoHepatite" required="" placeholder="tipoHepatite">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="hiv" name="hiv" required="" placeholder="hiv">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="vdrl" name="vdrl" required="" placeholder="vdrl">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="atestadoNeurologico" name="atestadoNeurologico" required="" placeholder="atestadoNeurologico">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="raioxPulmao" name="raioxPulmao" required="" placeholder="raioxPulmao">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="receituarioMedico" name="receituarioMedico" required="" placeholder="receituarioMedico">
                    </div>
                </div>
                <br>
                <h2>Eliminação:</h2>
                <div class="form-row">
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="frequenciaEvacuacao" name="frequenciaEvacuacao" required="" placeholder="frequenciaEvacuacao">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="aspecto" name="aspecto" required="" placeholder="aspecto">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="coloracaoUrina" name="coloracaoUrina" required="" placeholder="coloracaoUrina">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="odorUrina" name="odorUrina" required="" placeholder="odorUrina">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="frequenciaUrina" name="frequenciaUrina" required="" placeholder="frequenciaUrina">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="queixaGases" name="queixaGases" required="" placeholder="queixaGases">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="usoFraldaGeriatrica" name="usoFraldaGeriatrica" required="" placeholder="usoFraldaGeriatrica">
                    </div>
                    <div class="form-group  col-md-2 col-sm-4 col-10">
                        <input type="text" class="form-control" id="marcaFraldaGeriatrica" name="marcaFraldaGeriatrica" required="" placeholder="marcaFraldaGeriatrica">
                    </div>
                </div>
                <div class="enviar">
                    <a data-toggle="tab" href="#profile" class="btn btn-primary" id="registerUser" aria-selected="false">Voltar</a>&nbsp;&nbsp;&nbsp;
                    <input type="submit" class="btn btn-primary" id="loginUser" name="login" value="Registrar">
                </div>
            </div>



            <?php 
            echo($_SESSION['cadastrando2']); 
        ?>

        </form>
    </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
