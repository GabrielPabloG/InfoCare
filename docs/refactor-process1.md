# Refactor Process 1 — Resumo

**Resumo**

- **Origem**: Baseado em `/workspace/relatorio.md` e análise atual do repositório.
- **Objetivo**: Alinhar Models, DAOs e Controllers ao esquema do banco `bdinfocare-refatorado.sql`, removendo convenções legadas (`cod*`, `nomeXxx` específicas) e adotando `id`, `nome`, `cpf`, `nascimento`, etc.

**O Que o Relatório Recomendava**

- **Modelos**: Atualizar `Pessoa`, `Funcionario`, `Gerente`, `Responsavel`, `Idoso` para refletir as colunas das tabelas (ex.: `rua`, `bairro`, `cep`, `numero_casa`, `prontuario_fixo_id`).
- **DAOs**: Criar/adaptar DAOs para persistir os novos campos e para gerir tabelas polimórficas `telefone`/`foto` e a associação `medicacao_prontuario`.
- **Prontuários clínicos**: Criar Models/DAOs para `antecedencia`, `questionamento`, `pele`, `pulmonar`, `alimentacao`, `locomocao`, `relacionamento`, `exame`, `eliminacao` e integrar com `prontuario_fixo`.
- **Controllers/Views**: Ajustar formulários e lógica em `Controller/` e `View/` para usar os novos nomes de campo e as novas APIs de DAO.

**O Que Foi Feito (estado atual)**

- **Models atualizados/criados**:
  - `Model/Funcionario.php`: reescrito para usar `id`, `nome`, `cpf`, `sexo`, `nascimento`, `salario`, `email`, `senha`, `rua`, `bairro`, `cep`, `numero_casa`, `gerenteId`.
  - `Model/Idoso.php`: reescrito para o mesmo padrão (removidos `cod*`, `nomeIdoso` etc.).
- **DAOs implementados/atualizados**:
  - `Dao/DaoFuncionario.php`: novo DAO PDO com métodos CRUD (`insert`, `update`, `delete`, `listAll`, `getById`).
  - `Dao/DaoIdoso.php`: criado/ajustado para o novo `Idoso` model (CRUD com PDO).
  - `Dao/DaoResponsavel.php`: criado seguindo o padrão dos outros DAOs.
- **Controllers ajustados**:
  - `Controller/rotinasCadastroFuncionario.php`: adaptado para usar o novo `Funcionario` e para hash de senha; usa `id`/`gerenteId` corretamente.
  - `Controller/rotinasCadastroIdoso.php`, `rotinasAtualizarIdoso.php`, `rotinasCadastroPessoa.php`: atualizados para usar os novos getters/setters e para criar/associar `ProntuarioFixo` quando aplicável.
- **Legado parcial corrigido**:
  - Diversos arquivos de `pdf/Dao/*` foram atualizados para usar os novos getters (ex.: `getNome()`, `getCpf()`, `getId()`) em vez de `getNomeIdoso()`/`getCodIdoso()`.
- **Validações sintáticas**:
  - Foram executadas verificações de erros (ferramentas internas) em vários arquivos alterados; muitos retornaram "No errors found".

**Evidências / Arquivos Alterados (exemplos)**

- `Model/Funcionario.php`
- `Dao/DaoFuncionario.php`
- `Dao/DaoResponsavel.php`
- `Model/Idoso.php`
- `Dao/DaoIdoso.php`
- `Controller/rotinasCadastroFuncionario.php`
- `Controller/rotinasCadastroIdoso.php`
- `pdf/Dao/DaoIdoso.php` (ajustes parciais)

**Referências Legadas Encontradas (exemplos)**

- O scanner encontrou correspondências legadas (20 matches reportados). Exemplos concretos:
  - `/workspace/pdf/index.php` — consultas e templates ainda usam `codIdoso`, `nomeIdoso`, `nascIdoso`, `codResponsavel`.
  - `/workspace/pdf/Dao/DaoProntuario.php` — `descProntuario`, `codIdoso` em SQL.
  - `/workspace/pdf/Dao/DaoIdoso.php` — `SELECT codIdoso, nomeIdoso, sexoIdoso, cpfIdoso ...`.
  - `/workspace/Model/Medicamento.php` — método `getCodMedicamento()` (uso de `cod*`).

**O Que Ainda Falta (pendências)**

- **Views**: Atualizar `View/*.php` que ainda referenciam campos legados (`codFuncionario`, `codResponsavel`, `nomeIdoso`, etc.). Arquivos com prioridade alta: `View/listCuidador.php`, `View/listarRes.php`, `View/atualizarIdoso.php`, `View/cadastroIdoso.php`.
- **PDF / Scripts legados**: Revisar/atualizar arquivos em `/workspace/pdf/` que usam a estrutura antiga (consultas SQL que referenciam `tbIdoso.codIdoso`, `tbResponsavel.codResponsavel`, etc.).
- **Conversão mysqli → PDO**: Muitos scripts antigos usam concatenação de SQL (mysqli). Recomenda-se migrar para PDO + prepared statements para prevenir injeção SQL.
- **DAOs faltantes**: Criar DAOs para as tabelas de avaliação clínica (`antecedencia`, `questionamento`, `pele`, `pulmonar`, `alimentacao`, `locomocao`, `relacionamento`, `exame`, `eliminacao`) e para `medicacao_prontuario` (associação N:M).
- **Polimorfismo (telefone/foto)**: Implementar/ajustar `DaoTelefone.php` e `DaoFoto.php` para aceitar `entidade_tipo` e `entidade_id` e migrar a lógica que atualmente usa arrays em `Pessoa.php`.
- **Cobertura de testes**: Criar testes manuais ou scripts de integração para validar os fluxos principais: cadastro/edição/exclusão de `funcionario`, `responsavel`, `idoso` (+criação de `prontuario_fixo`), e geração de PDFs.

**Prioridade e Próximos Passos Recomendados**

- **1 — Corrigir Views críticas (alta)**: adaptar os formulários e listagens para usar `id`/`nome`/`cpf` e enviar POSTs esperados pelos controllers atualizados.
- **2 — Corrigir `/workspace/pdf/` (média-alta)**: atualizar SQL e templates para usar os novos nomes das colunas e os getters do Model.
- **3 — Implementar DAOs clínicos (média)**: criar `DaoAntecedencia.php`, `DaoQuestionamento.php`, etc., e garantir que `DaoProntuarioFixo.php` monte as FK corretamente.
- **4 — Converter mysqli → PDO (média)**: priorizar arquivos expostos ao usuário (controllers/views/pdf) e scripts de upload.
- **5 — Testes end-to-end (alta)**: montar um ambiente com o schema `banco/bdinfocare-refatorado.sql` e executar os fluxos principais.

Sugestões de comandos para investigação rápida (no shell `zsh`):

```bash
# Procurar ocorrências legadas (cod*, nomeIdoso, getCod)
grep -RIn "\bcod[A-Za-z0-9_]*\b\|nomeIdoso\|getCod" -n /workspace | head -n 200

# Listar arquivos em pdf/ que usam codIdoso
grep -RIn "codIdoso\|nomeIdoso" /workspace/pdf | sort -u
```

**Observações Finais**

- O trabalho de refatoração já avançou nos Models/DAOs centrais (`Funcionario`, `Idoso`, `Responsavel`) e em controllers de cadastro; porém ainda existem pontos importantes a tratar nas Views e nos scripts legados (principalmente em `/workspace/pdf/`), além da necessidade de criar DAOs para as tabelas de avaliação clínica.
- Este arquivo foi gerado em 2026-06-06 após leitura de `/workspace/relatorio.md` e escaneamento parcial do repositório para tokens legados.

---

Se desejar, eu posso:

- 1. Rodar uma varredura completa por `cod*` e preparar um patch automático para as Views mais simples (substituições seguras), ou
- 2. Começar a migrar os arquivos em `/workspace/pdf/` para o novo modelo e converter suas consultas para PDO.

Indique qual ação prefere que eu execute em seguida.
