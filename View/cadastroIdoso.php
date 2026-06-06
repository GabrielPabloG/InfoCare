<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>InfoCare - Cadastro de Paciente e Prontuário</title>
    <link href="../css/default.css" rel="stylesheet">
    <link href="../cssCadastro/css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="../css/Ger.css" type="text/css" rel="stylesheet">
    <link href="../css/component.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="imagens/favicon.ico">
    
    <script type="text/javascript" src="prototype.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.mask.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/modernizr.custom.js"></script>

    <script type="text/javascript" language="javascript">
        //Verifica se CPF é válido
        function TestaCPF(strCPF) {
            var Soma, Resto;
            Soma = 0;
            var cpf = strCPF.replace(/\D/g, '');

            if (cpf == "00000000000") {
                document.getElementById("cpf").setCustomValidity('Inválido');
                return false;
            }

            for (i = 1; i <= 9; i++) Soma = Soma + parseInt(cpf.substring(i - 1, i)) * (11 - i);
            Resto = (Soma * 10) % 11;
            if ((Resto == 10) || (Resto == 11)) Resto = 0;

            if (Resto != parseInt(cpf.substring(9, 10))) {
                document.getElementById("cpf").setCustomValidity('Inválido');
                return false;
            }

            Soma = 0;
            for (i = 1; i <= 10; i++) Soma = Soma + parseInt(cpf.substring(i - 1, i)) * (12 - i);
            Resto = (Soma * 10) % 11;
            if ((Resto == 10) || (Resto == 11)) Resto = 0;

            if (Resto != parseInt(cpf.substring(10, 11))) {
                document.getElementById("cpf").setCustomValidity('Inválido');
                return false;
            }

            document.getElementById("cpf").setCustomValidity('');
            return true;
        }

        function validardataDeNascimento(data) {
            var dataAtual = new Date();
            var dataEscolhida = new Date(data);

            if (dataEscolhida < dataAtual) {
                return true;
            } else {
                alert("Data inválida. A data de nascimento não pode ser no futuro.");
                document.getElementById('nascimento').value = ("");
                return false;
            }
        }
    </script>
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
                    <li><a href="../View/listarRes.php">Responsáveis</a></li>
                    <li><a href="../View/listCuidador.php">Cuidadores</a></li>
                    <li><a href="../View/homeGerente.php">Pacientes</a></li>
                    <li><a href="../View/logout.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </header>

    <div style="margin-top: 8%">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Dados do Paciente</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Prontuário Clínico</a>
            </li>
        </ul>
    </div>

    <div class="tab-content" id="myTabContent">
        <form action="../Controller/rotinasCadastroProntuario.php" method="post" enctype="multipart/form-data">
            
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" style="padding-top:20px;">
                <br>
                <h2>Dados do Idoso:</h2>

                <div class="form-row">
                    <div class="form-group col-md-3 col-sm-4">
                        <input type="text" class="form-control" id="nome" name="nome" required="" placeholder="Nome Completo">
                    </div>

                    <div class="form-group col-md-2 col-sm-3 col-6">
                        <input type="text" class="form-control" id="cpf" name="cpf" required="" placeholder="CPF" onblur="TestaCPF(this.value);">
                    </div>
                    <script type="text/javascript"> $("#cpf").mask("000.000.000-00"); </script>

                    <div class="form-group col-md-2 col-sm-3 col-4">
                        <select class="form-control" id="sexo" name="sexo" required="">
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-10">
                        <input type="date" class="form-control" id="nascimento" name="nascimento" required="" placeholder="Data Nascimento" onchange="validardataDeNascimento(this.value);">
                    </div>

                    <input type="hidden" name="responsavel_id" id="responsavel_id" value="<?php echo isset($_POST['codResponsavel']) ? $_POST['codResponsavel'] : (isset($_POST['responsavel_id']) ? $_POST['responsavel_id'] : ''); ?>">
                </div>

                <div class="form-row">
                    <label>Foto do idoso: </label>
                    <input type='file' required name='foto' style='opacity: 100%; cursor: pointer; font-family: comfortaa; color: rgba(52,103,125);'>
                </div>
            </div>

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab" style="padding-top:20px;">

                <h2>Antecedência:</h2>
                <div class="form-row">
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="declinioCongnitivo" required="" placeholder="Declínio Congnitivo"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="dificuldadeFala" required="" placeholder="Dificuldade Fala"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="audicao" required="" placeholder="Audição"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="acidenteVascularEncefalico" required="" placeholder="AVC"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="traumatismoCranioEncefalico" required="" placeholder="Traumatismo Craniano"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="hipertensaoArterial" required="" placeholder="Hipertensão Arterial"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="hipotireoidismo" required="" placeholder="Hipotireoidismo"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="tipoDiabetes" required="" placeholder="Tipo Diabetes"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="tipoCancer" required="" placeholder="Tipo Câncer"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="localFratura" required="" placeholder="Local Fratura"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="tipoCirurgia" required="" placeholder="Tipo Cirurgia"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="outrasPatologias" required="" placeholder="Outras Patologias"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="usoMedicamento" required="" placeholder="Uso Medicamento"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="tratamentoRealizado" required="" placeholder="Tratamento Realizado"></div>
                </div>

                <br><h2>Questionamento:</h2>
                <div class="form-row">
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="peso" required="" placeholder="Peso"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="altura" required="" placeholder="Altura"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="pressaoArterial" required="" placeholder="Pressão Arterial"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="pulsacao" required="" placeholder="Pulsação"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="respiracao" required="" placeholder="Respiração"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="temperatura" required="" placeholder="Temperatura"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="dextro" required="" placeholder="Dextro"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="spo2" required="" placeholder="SpO2"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="utilizacaoOculos" required="" placeholder="Utilização Óculos"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="proteseAuditiva" required="" placeholder="Prótese Auditiva"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="carteiraVacinacao" required="" placeholder="Carteira Vacinação"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="tabagista" required="" placeholder="Tabagista"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="etilista" required="" placeholder="Etilista"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="dependenciaEtilismo" required="" placeholder="Dependência Etilismo"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="tipoSanguineo" required="" placeholder="Tipo Sanguíneo"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="usoProteseDentaria" required="" placeholder="Uso Prótese Dentária"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="marcaProteseDentaria" required="" placeholder="Marca Prótese"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="modeloProtoseDentaria" required="" placeholder="Modelo Prótese"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="usoMedicamentoContinuo" required="" placeholder="Medicamento Contínuo"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="usoSubstanciaPsicoativa" required="" placeholder="Substância Psicoativa"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="alergiaMedicamento" required="" placeholder="Alergia a Medicamento"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="convenio" required="" placeholder="Convênio"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="encaminhamentoUnidadeHospitalar" required="" placeholder="Encaminhamento Hospitalar"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="atividadeManual" required="" placeholder="Atividade Manual"></div>
                </div>

                <br><h2>Pele:</h2>
                <div class="form-row">
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="integridade" required="" placeholder="Integridade"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="hidratacao" required="" placeholder="Hidratação"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="dermatite" required="" placeholder="Dermatite"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="prurido" required="" placeholder="Prurido"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="micose_unha" required="" placeholder="Micose na Unha"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="escamacao" required="" placeholder="Escamação"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="ictericia" required="" placeholder="Icterícia"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="ferida" required="" placeholder="Ferida"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="petequia" required="" placeholder="Petéquia"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="hematoma" required="" placeholder="Hematoma"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="ulcera" required="" placeholder="Úlcera"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="grau_ulcera" required="" placeholder="Grau da Úlcera"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="outra_especificacao" required="" placeholder="Outra Especificação"></div>
                </div>

                <br><h2>Pulmonar:</h2>
                <div class="form-row">
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="tipoTosse" required="" placeholder="Tipo Tosse"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="ascultacao" required="" placeholder="Auscultação"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="tipoDispineia" required="" placeholder="Tipo Dispneia"></div>
                </div>

                <br><h2>Alimentação:</h2>
                <div class="form-row">
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="alimentacaoSolo" required="" placeholder="Alimentação Solo"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="dificuldadeDegluticao" required="" placeholder="Dificuldade Deglutição"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="usoSonda" required="" placeholder="Uso de Sonda"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="restricaoAlimento" required="" placeholder="Restrição Alimentar"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="preferenciaAlimento" required="" placeholder="Preferência Alimentar"></div>
                </div>

                <br><h2>Locomoção:</h2>
                <div class="form-row">
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="locomocaoSolo" required="" placeholder="Locomoção Solo"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="cadeirante" required="" placeholder="Cadeirante"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="tempoCadeirante" required="" placeholder="Tempo Cadeirante"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="acamacao" required="" placeholder="Acamado"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="tempoAcamacao" required="" placeholder="Tempo Acamado"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="apoioFisico" required="" placeholder="Apoio Físico"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="esporteTerapia" required="" placeholder="Esporte/Terapia"></div>
                </div>

                <br><h2>Relacionamento:</h2>
                <div class="form-row">
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="statusComunicacao" required="" placeholder="Status Comunicação"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="agressividade" required="" placeholder="Agressividade"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="temperamento" required="" placeholder="Temperamento"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="anterioridadeCasaRepouso" required="" placeholder="Casa de Repouso Anterior"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="irritabilidade" required="" placeholder="Irritabilidade"></div>
                </div>

                <br><h2>Exames:</h2>
                <div class="form-row">
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="conclusaoHemograma" required="" placeholder="Hemograma"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="tipoUrina" required="" placeholder="Urina"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="parasitologicoFezes" required="" placeholder="Fezes"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="glicemiaJejum" required="" placeholder="Glicemia"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="colesterol" required="" placeholder="Colesterol"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="tipoHepatite" required="" placeholder="Hepatite"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="hiv" required="" placeholder="HIV"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="vdrl" required="" placeholder="VDRL"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="atestadoNeurologico" required="" placeholder="Atestado Neurológico"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="raioxPulmao" required="" placeholder="Raio-X Pulmão"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="receituarioMedico" required="" placeholder="Receituário Médico"></div>
                </div>

                <br><h2>Eliminação:</h2>
                <div class="form-row">
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="frequenciaEvacuacao" required="" placeholder="Frequência Evacuação"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="aspecto" required="" placeholder="Aspecto"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="coloracaoUrina" required="" placeholder="Coloração Urina"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="odorUrina" required="" placeholder="Odor Urina"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="frequenciaUrina" required="" placeholder="Frequência Urina"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="queixaGases" required="" placeholder="Queixa de Gases"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="usoFraldaGeriatrica" required="" placeholder="Uso Fralda Geriátrica"></div>
                    <div class="form-group col-md-2 col-sm-4 col-10"><input type="text" class="form-control" name="marcaFraldaGeriatrica" required="" placeholder="Marca Fralda"></div>
                </div>

                <div class="enviar mt-4 mb-5">
                    <button type="button" class="btn btn-secondary" onclick="$('#home-tab').tab('show')">Voltar para Dados Pessoais</button>&nbsp;&nbsp;&nbsp;
                    <input type="submit" class="btn btn-primary" name="cadastrar" value="Registrar Idoso e Prontuário">
                </div>
            </div>

            <?php if(isset($_SESSION['cadastrando2'])) echo "<p class='text-info'>" . $_SESSION['cadastrando2'] . "</p>"; ?>
        </form>
    </div>

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