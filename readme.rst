
Note: There is an English version below the Portuguese one.

###############################################
Modelo de aplicação para controle de atividades
###############################################

Eu criei um projeto seguindo as regras definidas abaixo como um exemplo de código entregue como parte de um processo seletivo real. Não foi utilizado nenhum framework para que sirva como uma implementação dos meus conhecimentos em PHP "puro".

*********************
Conteúdo da Aplicação
*********************
- A aplicação foi homologada para funcionamento com o banco de dados MySQL e no navegador Mozzila Firefox 54 ou superior em desktop.

*Tela de Listagem*

- Tela para listar as atividades, podendo filtrar pelo “Status” e pela “Situação”;
- A cada atividade listada, deve-se checar o “Status” dela e se for “Concluído”, alterar a cor de fundo da linha;
- Na linha de cada atividade listada, exibir um botão de “Editar” para acessar a tela de edição da atividade;
- No final da tela, exibir um botão para incluir uma nova atividade.


*Tela de Cadastro/Alteração*

- Tela para fazer a manutenção das atividades, podendo alterar os campos disponíveis, respeitando as regras citadas a seguir.


***************************
Outras Informações e Regras
***************************

Cada atividade consiste em:

- Nome
- Descrição
- Data de Início
- Data de Fim
- Status (itens pré-cadastrados: Pendente, Em Desenvolvimento, Em Teste, Concluído)[1];
- Situação (Ativo, Inativo)

 [1] Os itens disponíveis em “Status” devem ser previamente cadastrados em uma tabela no banco de dados. Não deve ter tela para manutenção do mesmo.

Deve-se considerar as regras:

#. O campo nome é de preenchimento obrigatório e deve possuir o total de 255 caracteres;
#. O campo descrição é de preenchimento obrigatório e deve possuir o total de 600 caracteres;
#. O campo data de início é de preenchimento obrigatório e deve ser no formato “DATE”;
#. O campo data de fim não é de preenchimento obrigatório desde que o status da atividade seja diferente de “Concluído” (deve ser no formato “DATE”);
#. O campo status é de preenchimento obrigatório.
#. Uma vez uma atividade marcada com o status “Concluído” ela jamais poderá ter alguma informação alterada (inclusive o status);

Utilizar as tecnologias: 

- PHP
- Mysql
- HTML
- CSS
- Bootstrap
- Javascript/Jquery/Ajax
- GIT

Considerar:

#. Orientação a objetos;
#. Utilização da estrutura MVC;
#. Utilização de procedures no banco de dados;
#. Tipagem correta dos dados no banco de dados;

******************
Entrega do Projeto
******************

A entrega do projeto deve contempla os itens:

#. Modelo de dados (formato png, jpg, etc) criado para atender o projeto (utilizando a ferramenta Mysql Workbench, por exemplo);
#. Script para criação do banco de dados disponível na pasta “src” na raíz do projeto;
#. Código fonte disponibilizado em algum repositório GITHUB ou BITBUCKET (retornar e-mail com o link do repositório para ser clonado);


**********
INSTALAÇÃO
**********

#. Crie um servidor PHP com banco de dados MySQL.
#. Copie (ou clone) o projeto para o servidor.
#. Execute o script contido em /src diretamente no banco de dados. Esta ação irá criar o schema 'ds_3004' (caso este esquema já exista, é importante renomeá-lo no script e na classe de conexao.)
#. Preencha os dados de usuario, senha e endereço do banco na classe de conexão lib/conexao.php (por padrão estão definidos root, root e localhost, respectivamente)


----


########################################
Example of software for tasks management
########################################

I created a project following the rules below as an example of code. It is written in Portuguese because it was delivered as part of a real hiring process for a Brazilian company. It was made with no framework due to be an implementation of my knowledge about "pure PHP".


****************
Software Content
****************
- The application must run with MySQL database and using the browser Mozilla Firefox 54 or newer on a computer.

*List Page*

- Page to list the tasks, it is possible to filter by "Status" and "Situação";
- If a task has the "Status" as "Concluído" (Done), the row background color must be different; 
- Each row must show a "Editar" (Edit) button, due to make changes on that task.
- At the bottom of the page, must be placed a button to add a new task.


*Add/Edit Page*

- Page to allow changes and creation of new tasks, it must implement the following rules:


**************************
More information and rules
**************************

Each task must contain:

- "Nome" (Name)
- "Descrição" (Description)
- "Data de Início" (Begin Date)
- "Data de Fim" (End Date)
- "Status (itens pré-cadastrados: Pendente, Em Desenvolvimento, Em Teste, Concluído)[1];" (Status with the following choices: stand by, on development, being tested, done)
- "Situação (Ativo, Inativo)" (Situation: active, inactive)

 [1] The "Status" choices must be stored in a table of the database. It is not required to create a page to edit them. 

The following rules must be implemented:

#. The "Nome" field is required and must be filled with 255 characters or less;
#. The "descrição" field is required and must be filled with 600 characters or less;
#. The "data de início" field is required and must be filled/show in the "DATE" format;
#. The "data de fim" field is required only if the task status is equal to "Concluído" and must be filled/show in the "DATE" format;
#. The "status" field is required and once a task is saved with the "Status" "Concluído", the task must not be edited anymore.

The following language/tools must be used:

- PHP
- Mysql
- HTML
- CSS
- Bootstrap
- JavaScript/Jquery/Ajax
- GIT

It must be used:

#. Object Orientation programming;
#. MVC design pattern;
#. database procedures;
#. the correct database data type;

********
Delivery
********

The project delivery must contain:


#. Data Model (as an image) created for the project (using Mysql Workbench tool);
#. Script for the creation of the database structure and data, it must be inside the "src" folder in the project root;
#. Source code available on GITHUB


************************
INSTALLATION INSTRUCTIONS
************************

#. Create an instance of a PHP server with MySQL database.
#. Copy (or clone) this project to the server related folder.
#. Run the script in the /scr folder on the database. This will create the 'ds_3004' schema.
#. Fill the information about user, password, and database path in the file lib/conexao.php (by default they are set as root, root and localhost, respectively)




