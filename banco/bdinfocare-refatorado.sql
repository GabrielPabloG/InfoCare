CREATE DATABASE bdinfocare_refatorado
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE bdinfocare_refatorado;

-- ---------------------------------------------------
-- Tabela de administradores
-- ---------------------------------------------------
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(40) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(255) NOT NULL  -- armazenar hash
) ENGINE=InnoDB;

-- ---------------------------------------------------
-- Gerente
-- ---------------------------------------------------
CREATE TABLE gerente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(40) NOT NULL,
    cpf CHAR(14) NOT NULL UNIQUE,
    sexo ENUM('M','F') NOT NULL,
    nascimento DATE NOT NULL,
    salario DECIMAL(10,2) NOT NULL,
    email VARCHAR(75) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    -- endereço incorporado
    rua VARCHAR(100) NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    cep VARCHAR(9) NOT NULL,
    numero_casa VARCHAR(10) NOT NULL
) ENGINE=InnoDB;

-- ---------------------------------------------------
-- Funcionário
-- ---------------------------------------------------
CREATE TABLE funcionario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(40) NOT NULL,
    cpf CHAR(14) NOT NULL UNIQUE,
    sexo ENUM('M','F') NOT NULL,
    nascimento DATE NOT NULL,
    salario DECIMAL(10,2) NOT NULL,
    email VARCHAR(75) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    -- endereço
    rua VARCHAR(100) NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    cep VARCHAR(9) NOT NULL,
    numero_casa VARCHAR(10) NOT NULL,
    -- vínculo com gerente
    gerente_id INT,
    FOREIGN KEY (gerente_id) REFERENCES gerente(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ---------------------------------------------------
-- Responsável (tutor/familiar)
-- ---------------------------------------------------
CREATE TABLE responsavel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(40) NOT NULL,
    cpf CHAR(14) NOT NULL UNIQUE,
    sexo ENUM('M','F') NOT NULL,
    nascimento DATE NOT NULL,
    email VARCHAR(75) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    -- endereço
    rua VARCHAR(100) NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    cep VARCHAR(9) NOT NULL,
    numero_casa VARCHAR(10) NOT NULL
) ENGINE=InnoDB;

-- ---------------------------------------------------
-- Telefone unificado (fixo e celular) para gerente, funcionário, responsável
-- (integridade referencial controlada pela aplicação)
-- ---------------------------------------------------
CREATE TABLE telefone (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero VARCHAR(25) NOT NULL,
    tipo ENUM('FIXO','CELULAR') NOT NULL,
    entidade_tipo ENUM('GERENTE','FUNCIONARIO','RESPONSAVEL') NOT NULL,
    entidade_id INT NOT NULL,
    -- Índice para busca rápida
    INDEX idx_entidade (entidade_tipo, entidade_id)
) ENGINE=InnoDB;

-- ---------------------------------------------------
-- Tabela de fotos (polimórfica)
-- ---------------------------------------------------
CREATE TABLE foto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_arquivo VARCHAR(100) NOT NULL,
    data_foto DATE NOT NULL,
    entidade_tipo ENUM('ADMIN','GERENTE','FUNCIONARIO','RESPONSAVEL','IDOSO') NOT NULL,
    entidade_id INT NOT NULL,
    INDEX idx_foto_entidade (entidade_tipo, entidade_id)
) ENGINE=InnoDB;

-- ---------------------------------------------------
-- Tabelas clínicas (avaliações independentes)
-- ---------------------------------------------------
CREATE TABLE antecedencia (
    id INT AUTO_INCREMENT PRIMARY KEY,
    declinio_cognitivo VARCHAR(50),
    dificuldade_fala VARCHAR(50),
    audicao VARCHAR(50),
    ave VARCHAR(50),  -- Acidente Vascular Encefálico
    tce VARCHAR(50),  -- Traumatismo Cranioencefálico
    hipertensao VARCHAR(50),
    hipotireoidismo VARCHAR(50),
    diabetes_tipo VARCHAR(50),
    cancer_tipo VARCHAR(50),
    local_fratura VARCHAR(50),
    cirurgia_tipo VARCHAR(50),
    outras_patologias VARCHAR(50),
    usa_medicamento CHAR(1) NOT NULL,  -- S/N
    tratamento_realizado VARCHAR(50)
) ENGINE=InnoDB;

CREATE TABLE questionamento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    peso DECIMAL(5,2),
    altura DECIMAL(3,2),
    pressao_arterial VARCHAR(50),
    pulsacao VARCHAR(50),
    respiracao VARCHAR(50),
    temperatura DECIMAL(4,1),
    dextro VARCHAR(25),
    spo2 VARCHAR(50),
    usa_oculos CHAR(1),
    protese_auditiva CHAR(1),
    carteira_vacinacao VARCHAR(50),
    tabagista VARCHAR(50),
    etilista VARCHAR(50),
    dependencia_etilismo CHAR(1),
    tipo_sanguineo VARCHAR(10),
    usa_protese_dentaria CHAR(1),
    marca_protese VARCHAR(25),
    modelo_protese VARCHAR(25),
    usa_medicamento_continuo CHAR(1),
    usa_substancia_psicoativa CHAR(1),
    alergia_medicamento CHAR(1),
    convenio VARCHAR(50),
    encaminhamento_hospitalar VARCHAR(50),
    atividade_manual VARCHAR(50)
) ENGINE=InnoDB;

CREATE TABLE pele (
    id INT AUTO_INCREMENT PRIMARY KEY,
    integridade VARCHAR(25),
    hidratacao VARCHAR(25),
    dermatite CHAR(1),
    prurido CHAR(1),
    micose_unha CHAR(1),
    escamacao CHAR(1),
    ictericia CHAR(1),
    ferida CHAR(1),
    petequia CHAR(1),
    hematoma CHAR(1),
    ulcera CHAR(1),
    grau_ulcera VARCHAR(25),
    outra_especificacao VARCHAR(50)
) ENGINE=InnoDB;

CREATE TABLE pulmonar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo_tosse VARCHAR(50),
    auscultacao VARCHAR(50),
    tipo_dispneia VARCHAR(50)
) ENGINE=InnoDB;

CREATE TABLE alimentacao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    alimentacao_sozinho CHAR(1),
    dificuldade_degluticao CHAR(1),
    uso_sonda CHAR(1),
    restricao_alimentar VARCHAR(50),
    preferencia_alimentar VARCHAR(50)
) ENGINE=InnoDB;

CREATE TABLE locomocao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    locomocao_sozinho CHAR(1),
    cadeirante CHAR(1),
    tempo_cadeirante VARCHAR(50),
    acamado CHAR(1),
    tempo_acamado VARCHAR(25),
    apoio_fisico VARCHAR(50),
    esporte_terapia VARCHAR(50)
) ENGINE=InnoDB;

CREATE TABLE relacionamento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    status_comunicacao VARCHAR(50),
    agressividade VARCHAR(50),
    temperamento VARCHAR(50),
    anterioridade_casa_repouso CHAR(1),
    irritabilidade VARCHAR(50)
) ENGINE=InnoDB;

CREATE TABLE exame (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hemograma_conclusao VARCHAR(50),
    urina_tipo VARCHAR(25),
    parasitologico_fezes VARCHAR(50),
    glicemia_jejum VARCHAR(50),
    colesterol VARCHAR(50),
    hepatite_tipo VARCHAR(25),
    hiv VARCHAR(50),
    vdrl VARCHAR(50),
    atestado_neurologico VARCHAR(50),
    raiox_pulmao VARCHAR(50),
    receituario_medico VARCHAR(50)
) ENGINE=InnoDB;

CREATE TABLE eliminacao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    frequencia_evacuacao VARCHAR(25),
    aspecto_fezes VARCHAR(50),
    coloracao_urina VARCHAR(25),
    odor_urina VARCHAR(25),
    frequencia_urina VARCHAR(25),
    queixa_gases CHAR(1),
    usa_fralda CHAR(1),
    marca_fralda VARCHAR(25)
) ENGINE=InnoDB;

-- ---------------------------------------------------
-- Prontuário Fixo (agregador de avaliações)
-- ---------------------------------------------------
CREATE TABLE prontuario_fixo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data_emissao DATE NOT NULL,
    antecedencia_id INT,
    questionamento_id INT,
    pele_id INT,
    pulmonar_id INT,
    alimentacao_id INT,
    locomocao_id INT,
    relacionamento_id INT,
    exame_id INT,
    eliminacao_id INT,
    FOREIGN KEY (antecedencia_id) REFERENCES antecedencia(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (questionamento_id) REFERENCES questionamento(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (pele_id) REFERENCES pele(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (pulmonar_id) REFERENCES pulmonar(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (alimentacao_id) REFERENCES alimentacao(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (locomocao_id) REFERENCES locomocao(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (relacionamento_id) REFERENCES relacionamento(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (exame_id) REFERENCES exame(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (eliminacao_id) REFERENCES eliminacao(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------
-- Medicamentos
-- ---------------------------------------------------
CREATE TABLE medicacao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    dosagem VARCHAR(50) NOT NULL,
    horario TIME NOT NULL,
    composicao VARCHAR(75),
    posologia VARCHAR(50)
) ENGINE=InnoDB;

-- Associação medicamento ↔ prontuário fixo
CREATE TABLE medicacao_prontuario (
    medicacao_id INT NOT NULL,
    prontuario_fixo_id INT NOT NULL,
    PRIMARY KEY (medicacao_id, prontuario_fixo_id),
    FOREIGN KEY (medicacao_id) REFERENCES medicacao(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (prontuario_fixo_id) REFERENCES prontuario_fixo(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------
-- Idoso
-- ---------------------------------------------------
CREATE TABLE idoso (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(40) NOT NULL,
    sexo ENUM('M','F') NOT NULL,
    cpf CHAR(14) NOT NULL UNIQUE,
    nascimento DATE NOT NULL,
    responsavel_id INT NOT NULL,
    prontuario_fixo_id INT NOT NULL,
    FOREIGN KEY (responsavel_id) REFERENCES responsavel(id) ON DELETE RESTRICT,
    FOREIGN KEY (prontuario_fixo_id) REFERENCES prontuario_fixo(id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------
-- Prontuário Diário (evoluções)
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS prontuario_diario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idoso_id INT NOT NULL,
    funcionario_id INT NOT NULL,
    observacao TEXT NOT NULL,
    data_registro DATETIME NOT NULL,
    FOREIGN KEY (idoso_id) REFERENCES idoso(id) ON DELETE CASCADE,
    FOREIGN KEY (funcionario_id) REFERENCES funcionario(id) ON DELETE CASCADE
);

-- ---------------------------------------------------
-- Diagnósticos e Prescrições de Enfermagem
-- (vinculados ao prontuário fixo)
-- ---------------------------------------------------
CREATE TABLE diagnostico_enfermagem (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(100) NOT NULL,
    prontuario_fixo_id INT NOT NULL,
    FOREIGN KEY (prontuario_fixo_id) REFERENCES prontuario_fixo(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE prescricao_enfermagem (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(75) NOT NULL,
    aprazamento VARCHAR(50) NOT NULL,
    prontuario_fixo_id INT NOT NULL,
    FOREIGN KEY (prontuario_fixo_id) REFERENCES prontuario_fixo(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------
-- Reset de Senha (para recuperação de senha)
-- ---------------------------------------------------

CREATE TABLE password_resets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    token VARCHAR(64) NOT NULL,
    tipo ENUM('admin','gerente','funcionario','responsavel') NOT NULL,
    expira_em DATETIME NOT NULL,
    usado TINYINT(1) DEFAULT 0,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
); ENGINE=InnoDB;

DELIMITER //

-- 1. Trigger para limpar telefones de Funcionários
CREATE TRIGGER trg_cascade_telefone_funcionario
AFTER DELETE ON funcionario
FOR EACH ROW
BEGIN
    DELETE FROM telefone 
    WHERE entidade_id = OLD.id 
    AND entidade_tipo = 'funcionario';
END; //

-- 2. Trigger para limpar telefones de Idosos
CREATE TRIGGER trg_cascade_telefone_idoso
AFTER DELETE ON idoso
FOR EACH ROW
BEGIN
    DELETE FROM telefone 
    WHERE entidade_id = OLD.id 
    AND entidade_tipo = 'idoso';
END; //

-- 3. Trigger para limpar telefones de Responsáveis
CREATE TRIGGER trg_cascade_telefone_responsavel
AFTER DELETE ON responsavel
FOR EACH ROW
BEGIN
    DELETE FROM telefone 
    WHERE entidade_id = OLD.id 
    AND entidade_tipo = 'responsavel';
END; //

DELIMITER ;