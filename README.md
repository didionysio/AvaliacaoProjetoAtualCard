# AvaliacaoProjetoAtualCard
 Avaliação de Conhecimentos – PHP – Junior
## Enunciado do Teste

Desenvolver um sistema em PHP (Laravel) para gerenciamento de marcação de consultas, incluindo o cadastro de especialidades, médicos, pacientes e consultas.

### 1. Requisitos

- **CRUD de Especialidades, Médicos, Pacientes e Consultas.**
- **Associar pacientes aos médicos nas consultas.**
- **Permitir buscar médicos pelo CRM ou pela especialidade.**
- **Utilização de Laravel e MySQL para o backend.**
- **Frontend utilizando Blade.**
- **Integração com API de consulta de CEP (ex: ViaCEP).**
- **Tela de autenticação, cadastro, login e logout.**

### 2. Campos do Banco de Dados

#### Tabela `especialidades`

| Coluna      | Tipo        | Descrição                               |
|-------------|-------------|-----------------------------------------|
| `id`        | Chave primária, auto incremento | Identificador único da especialidade. |
| `nome`      | String      | Nome da especialidade médica (ex: "Cardiologia", "Pediatria"). |
| `created_at` | Timestamp   | Data de criação.                       |
| `updated_at` | Timestamp   | Data da última atualização.           |

#### Tabela `medicos`

| Coluna         | Tipo        | Descrição                                               |
|----------------|-------------|---------------------------------------------------------|
| `id`           | Chave primária, auto incremento | Identificador único do médico. |
| `nome`         | String      | Nome completo do médico.                                |
| `especialidade_id` | Chave estrangeira para `especialidades` | Referência à especialidade do médico. |
| `crm`          | String, único | Número do CRM do médico.                                |
| `created_at`   | Timestamp   | Data de criação.                                        |
| `updated_at`   | Timestamp   | Data da última atualização.                             |

#### Tabela `pacientes`

| Coluna         | Tipo        | Descrição                                               |
|----------------|-------------|---------------------------------------------------------|
| `id`           | Chave primária, auto incremento | Identificador único do paciente. |
| `nome`         | String      | Nome completo do paciente.                              |
| `cpf`          | String, único | CPF do paciente.                                       |
| `data_cadastro` | Timestamp   | Data e hora do cadastro do paciente.                    |
| `email`        | String, único | E-mail do paciente.                                    |
| `cep`          | String      | CEP para consulta do endereço.                          |
| `endereco`     | String      | Endereço completo do paciente.                          |
| `numero`       | String      | Número do endereço do paciente.                         |
| `created_at`   | Timestamp   | Data de criação.                                        |
| `updated_at`   | Timestamp   | Data da última atualização.                             |

#### Tabela `telefones`

| Coluna        | Tipo        | Descrição                                               |
|---------------|-------------|---------------------------------------------------------|
| `id`          | Chave primária, auto incremento | Identificador único do telefone. |
| `paciente_id` | Chave estrangeira para `pacientes` | Referência ao paciente.               |
| `numero`      | String      | Número do telefone do paciente.                        |
| `created_at`  | Timestamp   | Data de criação.                                        |
| `updated_at`  | Timestamp   | Data da última atualização.                             |

#### Tabela `consultas`

| Coluna          | Tipo        | Descrição                                               |
|-----------------|-------------|---------------------------------------------------------|
| `id`            | Chave primária, auto incremento | Identificador único da consulta. |
| `paciente_id`   | Chave estrangeira para `pacientes` | Referência ao paciente.            |
| `medico_id`     | Chave estrangeira para `medicos` | Referência ao médico.              |
| `data_consulta` | Datetime    | Data e hora da consulta.                                |
| `data_agendamento` | Datetime    | Data e hora do agendamento da consulta.                |
| `created_at`    | Timestamp   | Data de criação.                                        |
| `updated_at`    | Timestamp   | Data da última atualização.                             |

### 3. Funcionalidades Diferenciais (Extras)

- **Busca de Médicos**: Implementar a busca de médicos pelo CRM ou pelo nome da especialidade.
- **Validação de CPF**: Verificar a validade do CPF no momento do cadastro do paciente.
- **Integração com API de CEP**: Utilizar a API ViaCEP para preencher automaticamente o campo de endereço a partir do CEP fornecido.
- **Notificações de Consultas**: Enviar um e-mail de confirmação ao paciente quando uma consulta for marcada.

### 4. Regras de Negócio

- **Telefone de Pacientes**: Um paciente pode ter mais de um número de telefone, por isso a tabela telefones tem relação de um para muitos com pacientes.
- **Especialidade Pediatria**: Caso o paciente tenha menos de 12 anos completos, permitir consultas apenas com a especialidade "Pediatria".
- **Responsável pelo Paciente**: Caso o paciente seja menor de idade, pedir o nome e CPF de um responsável.
- **Consultas**: As consultas devem ser associadas a um paciente e um médico, e conter o horário da consulta e do agendamento.
- **Relacionamentos no Laravel**: Utilizar relacionamentos `belongsTo` para associações entre pacientes, médicos e consultas no modelo Laravel.

### 5. Usar

- **Backend**: MySQL, Composer, Laravel 7 ou superior.
- **Frontend**: Utilizar o Blade do Laravel (opcional).
- **Conceitual**: POO, PSRs e qualidade e organização de código.
- **Documentação**: O código deve ser documentado com padrão PHPDocs.