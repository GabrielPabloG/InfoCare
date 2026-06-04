# InfoCare

Sistema web para gestão de instituições de cuidados a idosos (casas de repouso, asilos).  
Desenvolvido originalmente como Trabalho de Conclusão de Curso (TCC) e posteriormente revisado com melhorias estruturais e de ambiente.

---

## 📋 Funcionalidades

- Cadastro e gerenciamento de **idosos**, **responsáveis**, **funcionários** e **gerentes**
- Prontuário fixo com avaliações clínicas:
  - Antecedentes médicos
  - Questionário (peso, altura, sinais vitais, hábitos)
  - Pele, sistema pulmonar, alimentação, eliminações, locomoção e relacionamento/comportamento
  - Exames complementares
- Registro de medicamentos com posologia e aprazamento
- Diagnósticos e prescrições de enfermagem
- Prontuário diário para evolução do residente
- Galeria de fotos vinculada a qualquer entidade (idoso, funcionário, etc.)
- Controle de acesso por perfil: **Admin**, **Gerente**, **Funcionário** e **Responsável**

---

## 🧱 Tecnologias

| Camada        | Tecnologia original   | Ambiente atual (Dev Container)       |
|---------------|-----------------------|--------------------------------------|
| Backend       | PHP 7.2               | Node.js (para ferramentas) + PHP via container |
| Banco de dados| MariaDB 10.1          | (pode ser executado em contêiner separado) |
| Frontend      | HTML/CSS/JS + PHP     | -                                    |
| Padrão        | MVC caseiro           | -                                    |
| Ambiente dev  | XAMPP/WAMP            | Docker + VS Code Dev Containers      |

---

## 📁 Estrutura de Diretórios
.
├── controller/ # Lógica das requisições
├── dao/ # Acesso a dados (Data Access Objects)
├── model/ # Classes de domínio
├── view/ # Templates e páginas
├── .devcontainer/ # Configuração do ambiente Docker
├── bdinfocare-refatorado.sql # Esquema do banco refatorado e normalizado
├── README.md
└── .gitignore

text

---

## 🗄️ Banco de Dados

O banco passou por uma **refatoração completa** (arquivo `bdinfocare-refatorado.sql`) com os seguintes objetivos:

- Eliminação de tabelas redundantes de endereço e telefone
- Adoção de estrutura polimórfica para telefones e fotos
- Normalização de nomes e tipos (ENUMs, CPF único, etc.)
- Integração de diagnósticos e prescrições de enfermagem ao prontuário fixo

**Principais entidades:**
`admin`, `gerente`, `funcionario`, `responsavel`, `idoso`, `prontuario_fixo`, `medicacao`, `prontuario_diario`, `diagnostico_enfermagem`, `prescricao_enfermagem`, `foto`, `telefone`

---

## ⚙️ Configuração do Ambiente de Desenvolvimento

### ✅ Usando Dev Container (recomendado)

1. Instale [Docker Desktop](https://www.docker.com/products/docker-desktop/) e o [VS Code](https://code.visualstudio.com/) com a extensão **Dev Containers**.
2. Clone o repositório e abra a pasta no VS Code.
3. Quando solicitado, clique em **"Reopen in Container"**.
4. O container será construído com todas as ferramentas (PHP, Composer, Git, ZSH, Claude Code, Crush etc.).
5. Para o banco de dados, execute um contêiner MariaDB separado ou utilize o serviço incluso (se adicionado ao `docker-compose.yml`).

### 🛠️ Configuração manual

- Servidor web com PHP 7.2+ (Apache ou Nginx)
- MariaDB 10.1 ou superior
- Importe o banco:
  ```bash
  mysql -u root -p < bdinfocare-refatorado.sql
Ajuste as credenciais do banco no arquivo config.php (ou onde a aplicação espera).

Login padrão do admin (apenas para testes):
E-mail: adm@adm
Senha: adm
⚠️ Altere imediatamente em produção!

🚀 Como executar
Com o ambiente configurado, acesse o sistema via navegador (http://localhost ou a porta definida).

Faça login com um perfil válido (Admin, Gerente, Funcionário ou Responsável).

Navegue pelas funcionalidades de cadastro, prontuários e relatórios.

🤝 Contribuição e Versionamento
Este repositório segue a convenção de Conventional Commits (ex: feat, fix, chore, refactor).
Commits em inglês para facilitar padronização.

Para contribuir:

Crie uma branch a partir de main

Faça suas alterações e commits padronizados

Abra um Pull Request detalhando as mudanças

👥 Autoria e Contexto
Projeto desenvolvido como Trabalho de Conclusão de Curso (TCC).
Instituição: ETEC de Guaianazes.
Ano: 2019 (original) / 2026 (refatoração)

📄 Licença
Este projeto está sob a licença MIT. Consulte o arquivo LICENSE (se disponível) para mais detalhes.
