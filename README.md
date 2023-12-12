# Processo seletivo - Desenvolvedor Full Stack PHP Júnior
Bem vindo, candidat@.

Estamos felizes que você esteja participando do processo seletivo para a vaga de Desenvolvedor Full Stack PHP Júnior do Senai - Soluções Digitais.

A prova deverá utilizar as seguintes tecnologias:

- Linguagem de programação PHP para o backend
- Banco de dados PostgreSQL
- GIT para versionamento da aplicação.
- A utilização ou não de frameworks ficará a critério do candidato.

Na etapa da entrevista deverá ser apresentado a aplicação em funcionamento.

- Instruções para a execução da prova será enviada por e-mail no horário definido em edital.
- Todo código desenvolvido deverá ser commitado neste repositório, não sendo aceito o envio da prova por outros meios.


### Será avaliado
- Facilidade no entendimento do código.
- Complexidade ciclomática do código.
- Divisão de responsabilidades das classes.
- Reutilização de código.
- Organização do projeto;
- Desenvolvimento e funcionamento dos requisitos propostos.
- Criatividade e inovação na solução proposta.
- Usabilidade do usuário.

### Informações extras
- Descreva ao final deste documento (Readme.md) o detalhamento de funcionalidades implementadas, sejam elas já descritas na modelagem e / ou extras.
- Detalhar também as funcionalidades que não conseguiu implementar e o motivo.
- Caso tenha adicionado novas libs ou frameworks, descreva quais foram e porque dessa agregação.

__(Escreva aqui as instruções para que possamos corrigir sua prova, bem como qualquer outra observação sobre a prova que achar pertinente compartilhar)__

# Introdução
Projeto desenvolvido com Arquitetura MVC, que incorpora um mini-framework personalizado que criei para atender as necessidades específicas do projeto que utiliza o composer e autoload com padrões psr's. Eu escolhi utilizar o padrão de arquitetura MVC porque ele promove uma separação clara das responsabilidades entre os componentes do projeto. Além disso, com a divisão clara das responsabilidades, as alterações podem ser feitas sem afetar diretamente outras partes, facilitando na manutenção do código. O padrão MVC também permite uma melhor reutilização do código, promovendo também a modularidade do código.Também utilizei o composer, por ser uma ferramenta de gerenciamento de dependências para o PHP que simplifica a inclusão e atualização de bibliotecas em projetos PHP, caso eu utilizasse alguma no futuro. Por fim, utilizei o padrão de autoloading PSR-4 por que ele estabelece uma estrutura de diretórios e nomenclatura de classes que facilita com que o composer carregue automaticamente as classes necessárias sem necessidade de inclusão manual. Abaixo segue o detalhamento das funcionalidades implementadas:
 
# Detalhamento de classes de Estrutura do projeto - Arquitetura MVC
- Método render: O método render é utilizado para renderizar a página desejada. Ele recebe dois parâmetros: o nome da view ($view) e o nome do layout ($layout). A página da view é definida no objeto $this->view->page. Verifica se o arquivo do layout existe no caminho especificado ("../App/Views/{$layout}.phtml"). Se existir, ele é incluído na execução. Caso contrário, o método content é chamado.
- Classe HTTPResponse: A classe HTTPResponse fornece uma abstração para manipulação de respostas HTTP. Aqui estão as principais funcionalidades detalhadas:
- Classe Bootstrap: A classe abstrata Bootstrap é uma parte central do mini-framework e contém funcionalidades para inicializar e gerenciar as rotas da aplicação.
- Classe Route: A classe Route estende a classe abstrata Bootstrap e define as rotas da aplicação no método initRoutes().
- Classe Container: A classe Container faz parte do mini-framework e possui a responsabilidade de fornecer instâncias de modelos (classe de acesso a dados) para outras partes do código.
- Classe Model: A classe Model é uma classe abstrata que serve como base para os modelos específicos da aplicação. 
- Classe Connection: A classe Connection é responsável por realizar a conexão com o banco de dados PostgreSQL.

# Detalhamento de funcionalidades e requisitos que foram implementados no sistema:
## Aplicação
- Módulo de listagem colaboradores (Somente adm tem acesso);
- Módulo de cadastro de colaboradores (Somente adm tem acesso);
- Módulo de edição de colaboradores/alteração (Somente adm tem acesso);
- Módulo de remoção de colaboradores (Somente adm tem acesso);

## Requisitos não funcionais
- RQNF1 - O sistema deve ser desenvolvido utilizando a linguagem PHP e banco de dados postgreSQL no backend. O frontend o candidato tem liberdade para escolher a forma que achar mais conveniente. O uso de frameworks ou não é de livre escolha do candidato.
- RQNF2 - Todo retorno do backend deverá retornar um código HTTP de acordo com a resposta do servidor, é possível ver a relação dos códigos HTTP no link
- RQNF3 - O frontend deve tratar todos os “erros” retornados pelo backend. Ex.: para requisições que retornem erro 404 o frontend deve informar o usuário que o recurso não foi encontrado.
- RQNF4 - Todas as regras de negócio devem, obrigatoriamente, serem validadas no backend, ficando a critério do candidato replicá-las no front ou não. No entanto, toda ação realizada pelo usuário deverá possuir um feedback para o mesmo.
- RQNF9 - Todos os campos que possuírem um * na label são obrigatórios

## Requisitos funcionais
### RQF1 - Lista de colaboradores
- 1.1 - Ao clicar no botão “Inserir novo colaborador” o usuário deverá ser direcionado para a página de inserção de colaboradores (RQF2). 
- 1.2 - Na tabela deverá ser listado todos os colaboradores cadastrados. 
- 1.2.1 - Ao clicar no botão de editar o usuário deverá ser direcionado para a página de alteração do colaborador (RQF3) 
- 1.2.2 - Ao clicar no botão de excluir o usuário deverá receber uma mensagem para confirmar a exclusão. 
- 1.2.2.1 - Caso responda SIM, o registro deverá ser removido. 
- 1.2.2.2 - Caso responda NÃO, não deverá ser feito nada. 
- 1.2.2.3 - Independente da resposta, a modal de confirmação deve ser fechada após a ação. 
- 1.3 - Somente usuários com tipo “Administrador” poderão acessar esta tela. 

### RQF2 - Inserir de colaboradores 
- 2.1 - O campo CPF só deve aceitar números e deverá possuir uma máscara de CPF. 
- 2.1.1 - Caso seja digitado um CPF já existente na base de dados, o sistema deverá informar que o CPF já existe e bloquear os demais campos. 
- 2.1.2 - Caso o CPF não exista na base de dados, os demais campos devem ficar desbloqueados para que possam ser digitados.
- 2.2.1 - O campo “Ativo?” deve ser somente leitura. 
- 2.3 - O campo “Nome” deverá validar se o nome começa com letra maiúscula e se possui o formato Nome Sobrenome. 
- 2.4 - O campo “E-mail” deve validar se o valor é um formato de e-mail válido. 
- 2.5 - Os valores do campo “Cargo” devem vir do banco de dados. 
- 2.6 - Os valores do campo “Função” devem vir do banco de dados 
- 2.8 - O campo “Usuário” é criado automaticamente com base no nome e sobrenome do colaborador. 
- 2.8.1 - O “Usuário” é um valor único, caso já exista um usuário com o mesmo nome deverá ser adicionado um número com a quantidade de usuário com aquele login. Ex.: Se já existir o usuário john_doe, o sistema automaticamente criará o john_doe1 e assim sucessivamente. 
- 2.8.2 - O campo “Usuário” será somente leitura. 
- 2.8.3 - Por motivos de segurança, o nome de usuário deverá ser gerado no backend, sendo a exibição no front somente para fins informativos, o mesmo não deverá ser enviado no payload do back. 
- 2.10 - Quadro de horários 
- 2.11 - Somente usuários com tipo “Administrador” poderão acessar esta tela.

### RQF3 - Alterar colaborador 
- 3.1 - Os campos deverão vir preenchidos com os dados do banco de dados. 
- 3.2 - O campo “Matrícula” deverá exibir a chave primária do registro no banco de dados. 
- 3.3 - O campo “CPF” deverá ser somente leitura e não poderá ser alterado após o cadastro do usuário. 
- 3.4 - O campo “Usuário” deverá ser somente leitura. 
- 3.6 - Ver regra 2.3 
- 3.7 - Ver regra 2.4 
- 3.8 - Ver regra 2.5 
- 3.9 - Ver regra 2.6 
- 3.11 - Ver regras 2.8.* 
- 3.14 - Somente usuários com tipo “Administrador” poderão acessar esta tela. 

# Detalhamento de funcionalidades e requisitos que não foram implementados no sistema:

### RQF2 - Inserir de colaboradores 
- 2.2 - O campo “Ativo?” estará marcado somente se a data de rescisão não estiver preenchida OU se a data de rescisão estiver preenchida E a mesma seja menor que a data atual;
- 2.7 - A data de rescisão não pode ser anterior a data de admissão.
- 2.10 - Quadro de horários
- 2.9.1 - Os campos de entradas não podem ser maiores que suas respectivas saídas. O usuário deverá ser informado se digitar uma entrada maior que a saída.
- 2.9.2 - Os campos de saídas não podem ser menores que suas respectivas entradas. O usuário deverá ser informado se digitar uma saída menor que a entrada.
- 2.9.3 - Não deverá ser aceito um intervalo menor que 1 (uma) hora entre a primeira saída e a segunda entrada.
- 2.9.4 - Não deverá ser aceito uma primeira entrada com um intervalo menor de 11h desde a segunda saída do dia anterior.
- 2.9.5 - O total de horas semanais não podem somar mais que 44 horas.
- 2.10 - Ao clicar em salvar deverá ser feita todas as validações de regras e salvar os dados no banco de dados.

### RQF3 - Alterar colaborador 
- 3.5 - Ver regras 2.2.*;
- 3.10 - Ver regra 2.7;
- 3.12 - Ver regras 2.9.*;
- 3.13 - Ver regras 2.10;

### RQF4 - Registro Ponto 
- 10.1 - Deverá ser exibida a data atual. 
- 10.2 - Deverá ser exibida a hora e o minuto atual, o mesmo deve ser atualizado em tempo real. 
- 10.3 - Deverão ser listadas todas as entradas da data exibida acima. 
- 10.4 - Deverão ser listadas todas as saídas da data exibida acima. 
- 10.5 - Ao clicar no botão “Registrar” deverão ser registrados em banco de dados: 
- ● Data 
- ● Horário
- ● Matrícula do colaborador (id do colaborador) 
- 10.6 - Caso o colaborador tenha trabalhado mais que o total de horário cadastrado pra ele no quadro de horário, mostrar uma mensagem informando a ocorrência. 
- 10.7 - Caso o colaborador tenha feito mais de 10h de trabalho no dia, informar o mesmo que será gerado TAC¹. 
- 10.8 - Caso o usuário tenha feito um intervalo entre jornadas menor que 11h, informar o mesmo que será gerado TAC¹. 
- 10.9 - Caso o usuário tenha feito um intervalo inter jornada menor que 1h, informar o mesmo que será gerado TAC¹. 
- 10.10 - Independente do horário, sempre permitir que o ponto seja registrado, mostrando somente mensagens de alerta caso seja preciso.

### Motivo da não implementação:
As dificuldades na implementação de algumas funcionalidades se relacionam diretamente com o tempo de desenvolvimento da estrutura/base do projeto em uma arquitetura MVC um pouco mais robusta, o que trouxe uma complexidade técnica maior para o projeto. Isso acabou atrapalhando na organização e otimização de tempo para executar algumas tarefas e preencher todos os requisitos, visto que ao longo da construção houveram muitos imprevistos. Apesar de ter noção que o tempo seria curto para construir isso, decidi arriscar. Implementei o máximo de requisitos que pude.

