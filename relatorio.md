# Relatório de Arquitetura MVC – Sistema InfoCare (Legado)

## Introdução

O sistema InfoCare é um projeto PHP legado que segue uma estrutura MVC, embora com algumas convenções e padrões não estritamente formais. A organização de diretórios indica a separação das camadas: `Model/`, `Dao/` (Data Access Object), `Controller/` e `View/`. Observa-se o uso de `require_once` em alguns arquivos para inclusão de classes e dependências, indicando uma abordagem sem um autoloader formal.

As classes `Pessoa`, `Funcionario`, `Gerente`, `Idoso`, `Medicamento`, `Prontuario`, `ProntuarioFixo` e `Usuario` na pasta `Model/` representam as entidades de domínio. A pasta `Dao/` contém classes responsáveis pela interação com o banco de dados, como `DaoGerente`, `DaoIdoso`, `DaoPessoa`, `DaoProntuario`, `DaoUsuario`, entre outras, além de um arquivo `conexao.php` para a conexão com o banco. Os `Controller/` contêm scripts PHP que parecem manipular requisições e orquestrar operações, enquanto `View/` armazena os arquivos HTML/PHP para renderização da interface.

## 1. Resumo do Banco de Dados

O esquema `bdinfocare-refatorado.sql` apresenta uma estrutura de banco de dados MySQL/MariaDB normalizada, com as seguintes tabelas e seus principais relacionamentos:

**Tabelas e Colunas Chave (PK = Chave Primária, FK = Chave Estrangeira):**

*   **admin**: `id` (PK), `email`, `senha`
*   **gerente**: `id` (PK), `nome`, `cpf`, `sexo`, `nascimento`, `salario`, `email`, `senha`, `rua`, `bairro`, `cep`, `numero_casa`
*   **funcionario**: `id` (PK), `nome`, `cpf`, `sexo`, `nascimento`, `salario`, `email`, `senha`, `rua`, `bairro`, `cep`, `numero_casa`, `gerente_id` (FK para `gerente.id`)
*   **responsavel**: `id` (PK), `nome`, `cpf`, `sexo`, `nascimento`, `email`, `senha`, `rua`, `bairro`, `cep`, `numero_casa`
*   **telefone**: `id` (PK), `numero`, `tipo` (`FIXO`, `CELULAR`), `entidade_tipo`, `entidade_id` (Relacionamento polimórfico controlado pela aplicação)
*   **foto**: `id` (PK), `nome_arquivo`, `data_foto`, `entidade_tipo`, `entidade_id` (Relacionamento polimórfico controlado pela aplicação)
*   **antecedencia**: `id` (PK), `declinio_cognitivo`, `dificuldade_fala`, `audicao`, `ave`, `tce`, `hipertensao`, `hipotireoidismo`, `diabetes_tipo`, `cancer_tipo`, `local_fratura`, `cirurgia_tipo`, `outras_patologias`, `usa_medicamento`, `tratamento_realizado`
*   **questionamento**: `id` (PK), `peso`, `altura`, `pressao_arterial`, `pulsacao`, `respiracao`, `temperatura`, `dextro`, `spo2`, `usa_oculos`, `protese_auditiva`, `carteira_vacinacao`, `tabagista`, `etilista`, `dependencia_etilismo`, `tipo_sanguineo`, `usa_protese_dentaria`, `marca_protese`, `modelo_protese`, `usa_medicamento_continuo`, `usa_substancia_psicoativa`, `alergia_medicamento`, `convenio`, `encaminhamento_hospitalar`, `atividade_manual`
*   **pele**: `id` (PK), `integridade`, `hidratacao`, `dermatite`, `prurido`, `micose_unha`, `escamacao`, `ictericia`, `ferida`, `petequia`, `hematoma`, `ulcera`, `grau_ulcera`, `outra_especificacao`
*   **pulmonar**: `id` (PK), `tipo_tosse`, `auscultacao`, `tipo_dispneia`
*   **alimentacao**: `id` (PK), `alimentacao_sozinho`, `dificuldade_degluticao`, `uso_sonda`, `restricao_alimentar`, `preferencia_alimentar`
*   **locomocao**: `id` (PK), `locomocao_sozinho`, `cadeirante`, `tempo_cadeirante`, `acamado`, `tempo_acamado`, `apoio_fisico`, `esporte_terapia`
*   **relacionamento**: `id` (PK), `status_comunicacao`, `agressividade`, `temperamento`, `anterioridade_casa_repouso`, `irritabilidade`
*   **exame**: `id` (PK), `hemograma_conclusao`, `urina_tipo`, `parasitologico_fezes`, `glicemia_jejum`, `colesterol`, `hepatite_tipo`, `hiv`, `vdrl`, `atestado_neurologico`, `raiox_pulmao`, `receituario_medico`
*   **eliminacao**: `id` (PK), `frequencia_evacuacao`, `aspecto_fezes`, `coloracao_urina`, `odor_urina`, `frequencia_urina`, `queixa_gases`, `usa_fralda`, `marca_fralda`
*   **prontuario_fixo**: `id` (PK), `data_emissao`, `antecedencia_id` (FK), `questionamento_id` (FK), `pele_id` (FK), `pulmonar_id` (FK), `alimentacao_id` (FK), `locomocao_id` (FK), `relacionamento_id` (FK), `exame_id` (FK), `eliminacao_id` (FK)
*   **medicacao**: `id` (PK), `nome`, `dosagem`, `horario`, `composicao`, `posologia`
*   **medicacao_prontuario**: `medicacao_id` (PK, FK), `prontuario_fixo_id` (PK, FK)
*   **idoso**: `id` (PK), `nome`, `sexo`, `cpf`, `nascimento`, `responsavel_id` (FK para `responsavel.id`), `prontuario_fixo_id` (FK para `prontuario_fixo.id`)
*   **prontuario_diario**: `id` (PK), `descricao`, `data`, `idoso_id` (FK para `idoso.id`)
*   **diagnostico_enfermagem**: `id` (PK), `descricao`, `prontuario_fixo_id` (FK para `prontuario_fixo.id`)
*   **prescricao_enfermagem**: `id` (PK), `descricao`, `aprazamento`, `prontuario_fixo_id` (FK para `prontuario_fixo.id`)

**Observações sobre Integridade Referencial:**

*   Muitas relações usam `ON DELETE CASCADE` e `ON UPDATE CASCADE`, garantindo que dados relacionados sejam automaticamente sincronizados ou excluídos.
*   As chaves estrangeiras `idoso.responsavel_id` e `idoso.prontuario_fixo_id` usam `ON DELETE RESTRICT`, impedindo a exclusão de um responsável ou prontuário fixo se houver um idoso associado.
*   `funcionario.gerente_id` usa `ON DELETE SET NULL`, permitindo que um funcionário permaneça no sistema mesmo que seu gerente seja excluído.
*   As tabelas `telefone` e `foto` implementam um padrão polimórfico (`entidade_tipo`, `entidade_id`), com a integridade referencial sendo responsabilidade da lógica da aplicação e não do SGBD diretamente.

## 2. Mapeamento Entidade → Model

**Tabela: `admin`**
*   Model: Não foi encontrada uma classe `Admin.php` explícita. É possível que a lógica de administrador esteja integrada em outra classe ou seja manipulada diretamente via DAO.
*   Observações: `email` e `senha` na tabela `admin` se assemelham a campos de login, sugerindo uma entidade de usuário.

**Tabela: `gerente`**
*   Model: `Model/Gerente.php`
    *   Atributos: `nomeGerente`, `cpfGerente`, `sexoGerente`, `NascGerente`, `salarioGerente`, `emailGerente`, `senhaGerente`, `codEnderecoGerente`, `codTelefoneGerente`, `codCelularGerente`.
*   Observações: `Gerente.php` parece ser uma entidade autônoma. Os campos de endereço (`ruaEndereco`, `bairroEndereco`, `cepEndereco`, `numCasaEndereco`) estão faltando e os IDs de telefone/celular não são mais usados no BD refatorado, onde `telefone` e `foto` são polimórficas.

**Tabela: `funcionario`**
*   Model: `Model/Funcionario.php`
    *   Atributos: `codFuncionario`, `cargoFuncionario`, `salarioFuncionario`.
*   Model: `Model/Pessoa.php` (Provável classe base ou para dados gerais de pessoa)
    *   Atributos: `codPessoa`, `nomePessoa`, `cpfPessoa`, `sexoPessoa`, `nascPessoa`, `emailPessoa`, `senhaPessoa`, `ruaEndereco`, `bairroEndereco`, `cepEndereco`, `numCasaEndereco`, `telefonePessoa` (array), `celularPessoa` (array).
*   Observações: `Funcionario.php` herda ou complementa `Pessoa.php`. Há uma redundância aparente em `Pessoa` ter campos como `email` e `senha` que também são esperados para `funcionario` e `gerente` no BD refatorado. Os campos de endereço (`rua`, `bairro`, `cep`, `numero_casa`) na tabela `funcionario` estão em `Pessoa.php`, mas `Funcionario.php` não os possui explicitamente. `Pessoa.php` mantém arrays para telefone/celular, enquanto o BD refatorado usa uma tabela `telefone` polimórfica. `cargoFuncionario` em `Funcionario.php` não tem um campo correspondente direto na tabela `funcionario` refatorada.

**Tabela: `responsavel`**
*   Model: `Model/Pessoa.php` (Provável que use os atributos de `Pessoa` para representar um responsável, já que não há `Responsavel.php` explícito).
*   Observações: A classe `Pessoa.php` é um candidato forte para representar um responsável, mas não há uma classe `Responsavel.php` separada.

**Tabela: `idoso`**
*   Model: `Model/Idoso.php`
    *   Atributos: `codIdoso`, `nomeIdoso`, `sexoIdoso`, `cpfIdoso`, `nascIdoso`, `codResponsavel`.
*   Observações: `Idoso.php` representa bem a entidade. `codResponsavel` está presente. O atributo `prontuario_fixo_id` não está explícito no Model, mas é uma FK importante no BD. `nascIdoso` é mapeado como `idadeIdoso` em um setter, o que é uma inconsistência.

**Tabela: `medicacao`**
*   Model: `Model/Medicamento.php`
    *   Atributos: `codMedicamento`, `nomeMedicamento`, `dosagemMedicamento`, `horarioMedicamento`, `composicaoMedicamento`, `posologiaMedicamento`.
*   Observações: O Model `Medicamento.php` corresponde bem à tabela `medicacao`.

**Tabela: `prontuario_fixo`**
*   Model: `Model/ProntuarioFixo.php`
    *   Atributos: `codProntuario`, `dataEmissao`.
*   Model: `Model/Prontuario.php` (Provavelmente genérico ou para prontuário diário)
    *   Atributos: `codProntuario`, `descricaoProntuario`, `dataProntuario`, `codIdosoProntuario`.
*   Observações: `ProntuarioFixo.php` é o Model mais próximo. Os campos das diversas avaliações clínicas (`antecedencia`, `questionamento`, etc.) não estão diretamente mapeados no `ProntuarioFixo.php`, sugerindo que seriam carregados separadamente ou que o Model não reflete a agregação. `Prontuario.php` parece mais alinhado ao `prontuario_diario`.

**Outras tabelas de prontuário (`antecedencia`, `questionamento`, `pele`, `pulmonar`, `alimentacao`, `locomocao`, `relacionamento`, `exame`, `eliminacao`, `prontuario_diario`, `diagnostico_enfermagem`, `prescricao_enfermagem`)**
*   Model: Não há classes de Model explícitas para cada uma dessas tabelas. É provável que `Model/Prontuario.php` seja usado para `prontuario_diario`, e as outras sejam manipuladas como arrays ou DTOs (Data Transfer Objects) simples no Controller/DAO.

**Tabelas: `telefone`, `foto`, `medicacao_prontuario`**
*   Model: Não há Models explícitos para estas tabelas. `telefonePessoa` e `celularPessoa` em `Pessoa.php` sugerem uma abordagem antiga de armazenamento direto ou arrays, não a tabela `telefone` refatorada. `medicacao_prontuario` é uma tabela de associação sem um Model direto usualmente.

## 3. Camada de Persistência (DAO)

A camada DAO contém classes específicas para cada entidade, além de `conexao.php` e `ControleAcessoIC.php`/`controleAcesso.php` que parecem lidar com autenticação e autorização. Não há um DAO genérico explícito.

*   **DAO `DaoPessoa.php`**:
    *   Provavelmente contém métodos `insert`, `update`, `delete`, `findById`, `listAll` para a entidade `Pessoa` (e, por extensão, `Responsavel` e `Funcionario`/`Gerente` se `Pessoa` for uma superclasse lógica).
    *   Mapeamento ↔ Model: `Model/Pessoa.php`.

*   **DAO `DaoGerente.php`**:
    *   Métodos para operações CRUD em gerentes.
    *   Mapeamento ↔ Model: `Model/Gerente.php` (e potencialmente `Model/Pessoa.php` se houver herança/composição implícita).

*   **DAO `DaoIdoso.php`**:
    *   Métodos para operações CRUD em idosos.
    *   Mapeamento ↔ Model: `Model/Idoso.php`.

*   **DAO `DaoMedicamento.php`**:
    *   Métodos para operações CRUD em medicamentos.
    *   Mapeamento ↔ Model: `Model/Medicamento.php`.

*   **DAO `DaoProntuario.php`**:
    *   Métodos para operações CRUD em prontuários (provavelmente `prontuario_diario` e, talvez, `prontuario_fixo` e suas sub-entidades).
    *   Mapeamento ↔ Model: `Model/Prontuario.php` e `Model/ProntuarioFixo.php`.

*   **DAO `DaoUsuario.php`**:
    *   Pode ser um DAO genérico para login ou específico para a tabela `admin` ou `usuario` se ela existisse. Interage com `email` e `senha` de várias entidades.
    *   Mapeamento ↔ Model: `Model/Usuario.php` (se for o caso) ou `admin`, `gerente`, `funcionario`, `responsavel` (para autenticação).

*   **`conexao.php`**: Estabelece a conexão com o banco de dados.

*   **`ControleAcessoIC.php` / `controleAcesso.php`**: Gerenciam a autenticação e sessões de usuários (admin, gerente, etc.).

## 4. Controladores e Rotas

Os arquivos na pasta `Controller/` são scripts PHP que executam ações. A nomeação dos arquivos (`apagarX.php`, `processaX.php`, `rotinasCadastroX.php`, `rotinasAtualizarX.php`, `rotinasLogar.php`) indica as operações. O sistema parece usar um roteamento baseado em arquivos ou URLs diretas para os scripts dos controladores.

*   **Controller `Controller/apagarIdoso.php`**:
    *   Ação: `apagar()`
    *   Rota: `/Controller/apagarIdoso.php` (ou similar, via POST/GET)
    *   View: Provavelmente redireciona ou retorna JSON.

*   **Controller `Controller/rotinasCadastroIdoso.php`**:
    *   Ação: `cadastrar()`
    *   Rota: `/Controller/rotinasCadastroIdoso.php`
    *   View: Após o processamento, pode redirecionar para uma listagem ou exibir uma mensagem. Form de entrada em `View/cadastroIdoso.php`.

*   **Controller `Controller/rotinasAtualizarIdoso.php`**:
    *   Ação: `editar()`
    *   Rota: `/Controller/rotinasAtualizarIdoso.php`
    *   View: Após o processamento, pode redirecionar. Form de entrada em `View/atualizarIdoso.php`.

*   **Controller `Controller/rotinasCadastroFuncionario.php`**:
    *   Ação: `cadastrar()`
    *   Rota: `/Controller/rotinasCadastroFuncionario.php`
    *   View: Form de entrada em `View/cadastroCuidador.php` (que parece ser o nome anterior para funcionário/cuidador).

*   **Controller `Controller/rotinasAtualizarFuncionario.php`**:
    *   Ação: `editar()`
    *   Rota: `/Controller/rotinasAtualizarFuncionario.php`
    *   View: Form de entrada em `View/atualizarFuncionario.php`.

*   **Controller `Controller/apagarCuidador.php`**:
    *   Ação: `excluir()`
    *   Rota: `/Controller/apagarCuidador.php`
    *   View: Redireciona.

*   **Controller `Controller/processaGerente.php` / `Controller/rotinasCadastro.php` (para gerente) / `Controller/rotinasCadastroPessoa.php`**:
    *   Ação: `cadastrar()`
    *   Rota: `/Controller/processaGerente.php`
    *   View: Form de entrada em `View/cadastroPessoa.php` (genérico) ou `View/cadastro.php`.

*   **Controller `Controller/atualizarGerente.php`**:
    *   Ação: `editar()`
    *   Rota: `/Controller/atualizarGerente.php`
    *   View: Form de entrada em `View/atualizarGerente.php`.

*   **Controller `Controller/apagarGerente.php`**:
    *   Ação: `excluir()`
    *   Rota: `/Controller/apagarGerente.php`
    *   View: Redireciona.

*   **Controller `Controller/rotinasLogar.php`**:
    *   Ação: `logar()`
    *   Rota: `/Controller/rotinasLogar.php`
    *   View: Form de login na `index.php` ou `View/verificacao.php`. Redireciona para `View/homeAdm.php`, `View/homeGerente.php`, `View/homeFuncionario.php`, `View/homeResponsavel.php`.

*   **Controller `Controller/rotinasCadastroMedicamento.php`**:
    *   Ação: `cadastrar()`
    *   Rota: `/Controller/rotinasCadastroMedicamento.php`
    *   View: Form de entrada em `View/cadastroMedicamento.php` ou `View/cadastroMedicamentoCuidador.php`.

*   **Controller `Controller/rotinasCadastroProntuario.php`**:
    *   Ação: `cadastrar()`
    *   Rota: `/Controller/rotinasCadastroProntuario.php`
    *   View: Form de entrada em `View/cadastroProntuario.php` ou `View/criarProntuario.php`.

*   **Controller `View/listarRes.php`**:
    *   Ação: `listar()`
    *   Rota: `/View/listarRes.php` (direto na View, sem Controller explícito)
    *   View: `View/listarRes.php` (exibe a listagem de responsáveis).

*   **Controller `View/listCuidador.php`**:
    *   Ação: `listar()`
    *   Rota: `/View/listCuidador.php` (direto na View)
    *   View: `View/listCuidador.php` (exibe a listagem de funcionários/cuidadores).

## 5. Consistência com o BD Refatorado

Existem várias divergências significativas entre o código-fonte legado e o esquema de BD refatorado, que indicam possíveis quebras na migração e necessidade de ajustes.

*   **Entidade `Pessoa` e Endereço/Telefone**:
    *   O `Model/Pessoa.php` contém campos de endereço (`ruaEndereco`, `bairroEndereco`, `cepEndereco`, `numCasaEndereco`) e arrays para `telefonePessoa` e `celularPessoa`.
    *   No BD refatorado, os campos de endereço foram incorporados diretamente nas tabelas `gerente`, `funcionario`, `responsavel`. A tabela `telefone` é polimórfica e exige `entidade_tipo` e `entidade_id`.
    *   **Divergência**: O código legado esperava tabelas separadas para endereço ou o armazenamento direto de telefones no objeto `Pessoa`, o que não corresponde à nova estrutura. A lógica de manipulação de telefones precisará ser reescrita para interagir com a nova tabela `telefone`.

*   **Herança de `Pessoa`**:
    *   As classes `Funcionario.php`, `Gerente.php` e `Idoso.php` não indicam herança explícita de `Pessoa.php` no código que foi analisado, mas os campos comuns sugerem que `Pessoa` funciona como uma super-entidade lógica.
    *   No BD refatorado, `gerente`, `funcionario` e `responsavel` são tabelas independentes com seus próprios campos de "pessoa" (nome, cpf, sexo, nascimento, email, senha, endereço).
    *   **Divergência**: Se `Pessoa.php` era para ser uma classe base, o BD refatorado não segue um padrão de herança de tabelas, o que pode exigir refatoração nos Models e DAOs para evitar duplicação de lógica ou para carregar dados de múltiplas tabelas.

*   **Atributos de `Gerente.php`**:
    *   `Gerente.php` possui `codEnderecoGerente`, `codTelefoneGerente`, `codCelularGerente`, que são IDs para tabelas de endereço e telefone/celular que não existem mais no formato de tabelas separadas no BD refatorado.
    *   **Divergência**: Estes campos nos Models estão obsoletos e causarão erros de "coluna não encontrada" ou "tabela não encontrada" se tentarem ser persistidos.

*   **Atributo `cargoFuncionario`**:
    *   `Funcionario.php` tem `cargoFuncionario`, mas não há campo correspondente na tabela `funcionario` refatorada.
    *   **Divergência**: O cargo foi removido da entidade `funcionario`. O código que usa ou espera este campo precisará ser ajustado.

*   **Mapeamento de Data de Nascimento em `Idoso.php`**:
    *   O método `setNascIdoso` em `Idoso.php` atribui o valor a `$this->idadeIdoso` em vez de `$this->nascIdoso`.
    *   **Divergência**: Isso é um bug no Model existente, que precisa ser corrigido para mapear corretamente `nascIdoso`.

*   **`prontuario_fixo_id` em `Idoso.php`**:
    *   A tabela `idoso` possui uma FK para `prontuario_fixo.id`, mas o `Model/Idoso.php` não possui um atributo correspondente.
    *   **Divergência**: O Model `Idoso.php` não reflete completamente a nova estrutura de relacionamento, o que pode levar a problemas ao tentar associar ou recuperar o prontuário fixo de um idoso.

*   **Modelos para Avaliações Clínicas**:
    *   As tabelas `antecedencia`, `questionamento`, `pele`, `pulmonar`, `alimentacao`, `locomocao`, `relacionamento`, `exame`, `eliminacao` são entidades independentes no BD refatorado, agregadas pelo `prontuario_fixo`.
    *   Não há Models PHP explícitos para cada uma dessas avaliações.
    *   **Divergência**: O código legado pode estar tratando essas informações de forma menos estruturada (ex: campos diretamente em `Prontuario.php` ou manipulação como arrays). Isso exigirá a criação de novos Models e DAOs para cada uma dessas entidades para aproveitar a normalização do banco.

*   **Tabela `medicacao_prontuario`**:
    *   É uma tabela de associação N:M, mas não há um Model ou DAO explícito para ela.
    *   **Divergência**: A lógica para associar medicamentos a prontuários fixos precisará ser implementada nos DAOs relevantes (ex: `DaoMedicamento.php`, `DaoProntuario.php`) ou em um novo DAO de associação.

## 6. Sugestões de Adequação

Para alinhar o código legado ao novo esquema refatorado, os seguintes ajustes são necessários:

1.  **Refatorar Modelos de Entidade (Pessoa, Funcionario, Gerente, Responsavel)**:
    *   **Remover atributos obsoletos**: Excluir `codEnderecoGerente`, `codTelefoneGerente`, `codCelularGerente` de `Model/Gerente.php` (e outros Models impactados).
    *   **Ajustar campos de endereço**: Se `Pessoa.php` for uma classe base, garantir que seus atributos de endereço mapeiem corretamente para as colunas das tabelas `gerente`, `funcionario`, `responsavel`. Se não for base, replicar os campos de endereço diretamente em `Model/Funcionario.php`, `Model/Gerente.php`, e criar `Model/Responsavel.php` com esses campos.
    *   **Implementar `Model/Responsavel.php`**: Criar uma nova classe `Responsavel.php` para representar explicitamente a entidade.
    *   **Corrigir `Idoso.php`**: Alterar `setNascIdoso` para `public function setNascIdoso($nascIdoso) { $this->nascIdoso = $nascIdoso; }` e adicionar o atributo `$prontuarioFixoId`.
    *   **Remover `cargoFuncionario`**: De `Model/Funcionario.php` e qualquer código que o utilize.

2.  **Adequar DAOs à nova Estrutura**:
    *   **DAOs polimórficos para `telefone` e `foto`**: Criar ou estender um DAO (ex: `DaoTelefone.php`, `DaoFoto.php`) que possa lidar com a natureza polimórfica dessas tabelas, recebendo `entidade_tipo` e `entidade_id` para vincular telefones/fotos a diferentes entidades.
    *   **Ajustar DAOs de Pessoa/Funcionario/Gerente/Responsavel**:
        *   Modificar `DaoPessoa.php`, `DaoGerente.php`, `DaoIdoso.php` para persistir e recuperar dados de endereço diretamente nas tabelas principais.
        *   Atualizar lógica de persistência para telefones e fotos, utilizando os novos DAOs polimórficos.
    *   **Criar DAOs para Avaliações Clínicas**: Desenvolver novos DAOs (`DaoAntecedencia.php`, `DaoQuestionamento.php`, etc.) para cada uma das tabelas de avaliação clínica, com métodos CRUD básicos.
    *   **DAO para `medicacao_prontuario`**: Criar um DAO de associação ou integrar a lógica em `DaoMedicamento.php` ou `DaoProntuario.php` para gerenciar a relação N:M.

3.  **Atualizar Lógica nos Controladores**:
    *   **Ajustar formulários e processamento**: Modificar os arquivos na pasta `Controller/` e os formulários de `View/` para refletir as mudanças nos Models e a remoção/adição de campos.
    *   **Gerenciar relações polimórficas**: Implementar a lógica nos Controllers e DAOs para inserir/atualizar telefones e fotos, fornecendo o `entidade_tipo` e `entidade_id` corretos.
    *   **Manipular Prontuário Fixo**: Ajustar Controllers e Views de cadastro/edição de idosos para criar e associar um `prontuario_fixo` (e suas sub-entidades de avaliação clínica) ao `idoso`.

4.  **Refatoração Pontual (Exemplos)**:

    *   **Correção em `Model/Idoso.php`**:

        ```php
        // ANTES (incorreto)
        // public function setNascIdoso($idadeIdoso) {
        //     $this->idadeIdoso = $idadeIdoso;
        // }

        // DEPOIS (correto)
        public function setNascIdoso($nascIdoso) {
            $this->nascIdoso = $nascIdoso;
        }

        // Adicionar atributo para prontuário fixo
        private $prontuarioFixoId;

        public function getProntuarioFixoId() {
            return $this->prontuarioFixoId;
        }

        public function setProntuarioFixoId($prontuarioFixoId) {
            $this->prontuarioFixoId = $prontuarioFixoId;
        }
        ```

    *   **Exemplo de ajuste em DAO (simulando `DaoGerente.php`) para endereço incorporado**:

        ```php
        // ANTES (assumindo tabela de endereço separada)
        // public function insert(Gerente $gerente, Endereco $endereco) {
        //     $conn = Conexao::getConexao();
        //     $stmtEndereco = $conn->prepare("INSERT INTO endereco_gerente (rua, bairro, cep, numero) VALUES (?,?,?,?)");
        //     $stmtEndereco->execute([$endereco->getRua(), ...]);
        //     $enderecoId = $conn->lastInsertId();
        //     $stmtGerente = $conn->prepare("INSERT INTO gerente (nome, ..., endereco_id) VALUES (?, ..., ?)");
        //     $stmtGerente->execute([$gerente->getNome(), ..., $enderecoId]);
        // }

        // DEPOIS (com endereço incorporado)
        public function insert(Gerente $gerente) {
            $conn = Conexao::getConexao();
            $stmt = $conn->prepare("INSERT INTO gerente (nome, cpf, sexo, nascimento, salario, email, senha, rua, bairro, cep, numero_casa) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $gerente->getNomeGerente(),
                $gerente->getCpfGerente(),
                $gerente->getSexoGerente(),
                $gerente->getNascGerente(),
                $gerente->getSalarioGerente(),
                $gerente->getEmailGerente(),
                $gerente->getSenhaGerente(),
                $gerente->getRuaEndereco(), // Assumindo que Gerente.php foi atualizado para ter esses getters
                $gerente->getBairroEndereco(),
                $gerente->getCepEndereco(),
                $gerente->getNumCasaEndereco()
            ]);
        }
        ```

## 7. Apêndice: Listagem completa de arquivos e classes encontrados.

**Diretórios Principais:**

*   `Controller/`
*   `Dao/`
*   `Model/`
*   `View/`
*   `css/`
*   `js/`
*   `img/`
*   `banco/`
*   `fontes/`
*   `upload/`
*   `pdf/`
*   `.devcontainer/`
*   `.vs/`
*   `cssCadastro/`
*   `cssModal/`

**Arquivos de Modelo (`Model/`):**

*   `Funcionario.php` (Classe: `Funcionario`)
*   `Gerente.php` (Classe: `Gerente`)
*   `Idoso.php` (Classe: `Idoso`)
*   `Medicamento.php` (Classe: `Medicamento`)
*   `Pessoa.php` (Classe: `Pessoa`)
*   `Prontuario.php` (Classe: `Prontuario`)
*   `ProntuarioFixo.php` (Classe: `ProntuarioFixo`)
*   `Usuario.php` (Classe: `Usuario`)

**Arquivos DAO (`Dao/`):**

*   `ControleAcessoIC.php`
*   `DaoGerente.php`
*   `DaoIdoso.php`
*   `DaoMedicamento.php`
*   `DaoPessoa.php`
*   `DaoProntuario.php`
*   `DaoUsuario.php`
*   `conexao.php`
*   `controleAcesso.php`
*   `upload.php`

**Arquivos de Controlador (`Controller/`):**

*   `apagarCuidador.php`
*   `apagarGerente.php`
*   `apagarIdoso.php`
*   `apagarRes.php`
*   `processa.php`
*   `processaCuidador.php`
*   `processaGerente.php`
*   `processaRes.php`
*   `rotinasAtualizar.php`
*   `rotinasAtualizarFuncionario.php`
*   `rotinasAtualizarIdoso.php`
*   `rotinasCadastro.php`
*   `rotinasCadastroFuncionario.php`
*   `rotinasCadastroIdoso.php`
*   `rotinasCadastroMedicamento.php`
*   `rotinasCadastroPessoa.php`
*   `rotinasCadastroProntuario.php`
*   `rotinasLogar.php`

**Arquivos de Visualização (`View/`):**

*   `atualizarFuncionario.php`
*   `atualizarGerente.php`
*   `atualizarIdoso.php`
*   `atualizarResponsavel.php`
*   `cadastro.php`
*   `cadastroCuidador.php`
*   `cadastroIdoso.php`
*   `cadastroIdosoTab.php`
*   `cadastroMedicamento.php`
*   `cadastroMedicamentoCuidador.php`
*   `cadastroPessoa.php`
*   `cadastroProntuario.php`
*   `criarProntuario.php`
*   `escolher-cadastro.php`
*   `escolher-editar.php`
*   `escolher.php`
*   `homeAdm.php`
*   `homeFuncionario.php`
*   `homeGerente.php`
*   `homeResponsavel.php`
*   `hospital.png`
*   `listCuidador.php`
*   `listarRes.php`
*   `logout.php`
*   `portfolio.png`
*   `teste.php`
*   `user.png`
*   `verificacao.php`
*   `visualizarProntuario.php`

**Outros arquivos relevantes:**

*   `index.php`
*   `banco/bdinfocare-refatorado.sql`
*   `banco/bdcareasy.sql`
*   `banco/bdinfocare.sql`