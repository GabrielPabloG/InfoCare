**Refactoring Report: Current Project Status (Phase 4)**

## 1. Visão Geral

O projeto em questão está passando por um processo de refatoração para modernizar sua arquitetura, migrando de um código legado para um padrão MVC (Model-View-Controller). Até o momento, a Fase 4 da refatoração foi concluída, com focos nos componentes Model, DAO e Controller. No entanto, o projeto ainda contém resquícios do código legado, especialmente na camada View, que ainda não foi totalmente revisitada.

## 2. Status da Refatoração por Camada

### 2.1. Model (Concluída - Fase 4)

**Padrão Observado:**

*   **Classes de Entidade/DTOs:** Os arquivos na pasta `Model/` agora representam classes de entidade pura (Data Transfer Objects), como `Idoso.php`.
*   **Encapsulamento Adequado:** Cada classe possui propriedades privadas e métodos públicos de *getter* e *setter* para acessar e modificar seus atributos, garantindo o encapsulamento.
*   **Independência de Banco de Dados:** As classes Model não contêm lógica de acesso a banco de dados, nem dependem diretamente de `conexao.php` ou de classes DAO.

**Exemplo (`Model/Idoso.php`):**

```php
class Idoso {
    private $id;
    private $nome;
    private $cpf;
    private $sexo;
    private $nascimento;
    private $responsavelId;
    private $prontuarioFixoId;

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }
    // ... outros getters e setters
}
```

### 2.2. DAO (Data Access Object) (Concluída - Fase 4)

**Padrão Observado:**

*   **Classes Dedicadas ao Acesso a Dados:** Os arquivos na pasta `Dao/` contêm classes DAO (ex: `DaoIdoso`), que são responsáveis exclusivamente pela interação com o banco de dados.
*   **Uso de PDO e Prepared Statements:** As operações de CRUD (`insert`, `update`, `delete`, `listAll`, `getById`) utilizam a extensão PDO do PHP e *prepared statements*, o que melhora a segurança (prevenção de SQL Injection) e a performance.
*   **Tratamento de Exceções:** Blocos `try-catch` com `PDOException` são utilizados para tratar erros de banco de dados, retornando `false` ou um array vazio em caso de falha.
*   **Dependência da Conexão e do Modelo:** As classes DAO dependem da classe `Conexao` (para obter a instância da conexão com o banco) e das classes Model correspondentes (para receber e retornar objetos).

**Exemplo (`Dao/DaoIdoso.php`):**

```php
require_once 'conexao.php';
require_once '../Model/Idoso.php';

class DaoIdoso {
    public function insert(Idoso $idoso) {
        try {
            $conn = Conexao::getConexao();
            $sql = "INSERT INTO idoso (...) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                $idoso->getNome(),
                // ... outros valores
            ]);
            return $conn->lastInsertId();
        } catch (PDOException $e) {
            echo "Erro ao cadastrar idoso: " . $e->getMessage();
            return false;
        }
    }
    // ... outros métodos CRUD
}
```
**Diferenças e Legado:**
*   Foi identificado um arquivo em `Dao/` que contém uma estrutura HTML completa (`Dao/DaoIdoso.php` na minha análise inicial se mostrou ser um View). Isto indica que, embora a intenção fosse refatorar o DAO, alguns arquivos foram renomeados ou contêm código de apresentação, o que é um resquício do legado e viola o princípio de responsabilidade única. A correção desse problema deve ser priorizada.

### 2.3. Controller (Concluída - Fase 4)

**Padrão Observado:**

*   **Lógica de Negócios e Orquestração:** Os arquivos na pasta `Controller/` (ex: `rotinasCadastroIdoso.php`) agora contêm a lógica de processamento das requisições, orquestrando as interações entre a View e a camada de persistência (DAO).
*   **Recebimento de Dados:** Os Controllers recebem dados via `$_POST` (ou `$_GET`), validam-nos e os utilizam para criar ou atualizar objetos Model.
*   **Interação com DAO:** Instanciam as classes DAO apropriadas e chamam seus métodos para realizar operações no banco de dados.
*   **Redirecionamento/Resposta:** Após processar a requisição, os Controllers redirecionam o usuário para a View adequada (`header("Location: ...")`), passando mensagens de sucesso ou erro via parâmetros de URL.
*   **Controle de Sessão:** Demonstra o uso de `session_start()` para gerenciar estados de usuário, como ID do responsável logado.

**Exemplo (`Controller/rotinasCadastroIdoso.php`):**

```php
session_start();
require_once '../Dao/conexao.php'; // Considerar mover conexao.php para um local mais centralizado ou através de um padrão de injeção de dependência.
require_once '../Model/Idoso.php';
require_once '../Dao/DaoIdoso.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idoso = new Idoso();
    $idoso->setNome($_POST['nome']);
    // ... setar outros atributos do Idoso
    $daoIdoso = new DaoIdoso();
    $idGerado = $daoIdoso->insert($idoso);

    if ($idGerado) {
        header("Location: ../View/listarRes.php?sucesso=1");
    } else {
        header("Location: ../View/cadastroIdoso.php?erro=1");
    }
    exit();
}
```

## 3. Situação Atual da View (Legado Persistente)

A camada View é a que mais demonstra a presença de código legado e ainda não foi totalmente refatorada.

**Padrões Observados (Legado):**

*   **Mistura de HTML, CSS e JavaScript:** Arquivos como `View/cadastroIdoso.php` e `View/cadastroPessoa.php` contêm uma grande quantidade de marcação HTML, estilização CSS (`<link>`) e scripts JavaScript (`<script>`) diretamente incorporados.
*   **Lógica de Validação no Cliente:** Funções JavaScript para validação como `TestaCPF` e `pesquisacep` são implementadas diretamente no HTML da View, o que é esperado para validação de front-end, mas a View não deve conter nenhuma lógica de *business* ou acesso a dados.
*   **Possível Lógica de Servidor Misturada:** Em alguns arquivos `View`, há inclusão de outros arquivos PHP (`include 'verificacao.php';`) e manipulação de variáveis de sessão (`session_start();`), o que é aceitável para aspectos de apresentação (ex: exibir dados do usuário logado), mas deve ser monitorado para garantir que nenhuma lógica de negócio complexa ou acesso direto a dados esteja presente.
*   **HTML não Dinâmico:** As Views ainda parecem ser majoritariamente estáticas ou com pouca interatividade controlada por PHP de forma dinâmica, sugerindo falta de um motor de template ou uma abordagem mais moderna para geração de HTML.

**Exemplo (`View/cadastroIdoso.php` e `View/cadastroPessoa.php`):**

Ambos os arquivos contêm a estrutura completa de uma página web (doctype, head, body) e scripts para validação de CPF, máscaras de input, e consultas de CEP (ViaCEP). A inclusão de `verificacao.php` também é notável, pois pode conter lógica que idealmente estaria em um Controller ou em um Helper de View.

## 4. Próximos Passos (Fase 5 - Refatoração da View)

A prioridade clara para a próxima fase da refatoração deve ser a camada View. As ações incluem:

1.  **Separação de Preocupações:**
    *   Remover todo o JavaScript não relacionado à interação puramente visual para arquivos `.js` separados.
    *   Centralizar CSS em arquivos `.css` dedicados.
    *   Garantir que não haja lógica de negócios ou acesso a dados diretamente nas Views.
2.  **Uso de Motores de Template:** Avaliar a introdução de um motor de template (Twig, Blade, etc.) para tornar a geração de HTML mais robusta, segura e legível, separando o PHP da marcação.
3.  **Componentização:** Quebrar Views grandes em componentes menores e reutilizáveis (cabeçalhos, rodapés, formulários, etc.).
4.  **Validação de Formulários:** Assegurar que toda validação de front-end tenha uma contraparte de validação no back-end (nos Controllers) para garantir a integridade dos dados, independentemente do JavaScript.
5.  **Revisão de Inclusões:** Analisar o conteúdo de arquivos incluídos nas Views (como `verificacao.php`) para refatorar qualquer lógica inadequada para a camada de apresentação.

A conclusão das fases Model, DAO e Controller representa um avanço significativo na modernização da arquitetura, mas a View permanece como o principal ponto de legado a ser tratado para que o projeto alcance plenamente os benefícios do padrão MVC.
