# Leitor-XML---VBA-PHP
Aplicação para realizar leitura de um arquivo xml de Cte,listar e exibir as tags identificadas.

-----------------------

**APLICAÇÃO EM PHP**

Ao executar o index.php (localhost), selecione o arquivo xml e clieque em ler o arquivo. (Na pasta raíz do repositório, há 2 arquivos xml para utilizar em testes). 

![img1](https://user-images.githubusercontent.com/49642934/95817173-34f72680-0cf7-11eb-8a1a-87317124999e.JPG)

Após ser carregado, será exibido uma tabela com os seguintes dados :
*  **Nome Tag:** Nome da tag Mapeada.
*  **Tipo:** Para cada tag, foi atribuído um tipo dentro da hierarquia do documento xml.
*  **Valor:** Valor da tag correspondente.

Além dos dados já mapeado, será exibido a caixa de pesquisa para localizar a tag, seu tipo e valor. (Para pesquisar, pode utilizar maiúsculas ou minusculas).

![2](https://user-images.githubusercontent.com/49642934/95817332-856e8400-0cf7-11eb-937d-6ca317a2ddb1.JPG).

Ao consultar uma Tag, a listagem será modificado exibindo somente os dados das tags que antecedem a pesquisada.
Caso tenha outras tags "filhos" da tag pesquisada, será exibido uma caixa de opções com todas essas tags, disponibilizando uma nova consulta ao qual realizada conforme uma tag seja selecionada.

![3](https://user-images.githubusercontent.com/49642934/95817351-96b79080-0cf7-11eb-8677-fd597815b7f5.JPG)

-----------------------

**APLICAÇÃO EM VBA**

Para executar em vba, o processo é semelhante ao já realizado em PHP.  Selecione o arquivo e realize a leituraXML. 

![image](https://user-images.githubusercontent.com/49642934/95818872-3aef0680-0cfb-11eb-9879-2480b11b223c.png)

