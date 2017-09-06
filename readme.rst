
###############################################
Modelo de aplicação para controle de atividades
###############################################

*********************
Conteúdo da Aplicação
*********************

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

****************************
Observações do desenvolvedor
****************************

- A especificação não determinava se o campo status deveria ser obrigatório ou não. Optou-se por torná-lo obrigatório.
- A aplicação foi homologada para funcionamento com o banco de dados MySQL e no navegador Mozzila Firefox 54 ou superior em desktop.


