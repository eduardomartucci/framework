<?php
 
class geradora {

    public function __construct() {
        
    }

    public function tabelas_geradas() {

        /*         * ***
         * TABELAS DO BANCO DE DADOS
         * *** */
        $pu = new PU();
        $pu->abreConexao();
        $stmt = $pu->query("show tables from " . BD_BANCO);
        $pu->fechaConexao();
        $tables = array();
        $aux = 0;
        while ($array = $stmt->fetch()) {
            if (!file_exists(PATH_ADMIN . 'inc/class/Class' . ($array[0]) . ".php") == false || !file_exists("inc/class/Class" . ucfirst($array[0]) . ".php") == false) {
                $tables[$aux]['table'] = $array[0];
                $tables[$aux]['implementado'] = '';
            } else {
                $tables[$aux]['table'] = $array[0];
                $tables[$aux]['implementado'] = '(Não Implementado)';
            }

            $aux++;
        }

        return $tables;
    }

    //RETORNAS AS COLUNAS DA TABELA
    public function pre_create($tabela_selecionada) {

        /**         * **
         * SELECIONA TABELAS DO BANCO DE DADOS
         * *** */
        $pu = new PU();
        $pu->abreConexao();
        $stmt = $pu->query("SELECT * FROM " . $tabela_selecionada);
        $total_column = $stmt->columnCount();
        $pu->fechaConexao();
        $column = array();
        //$column_nome = array();
        for ($counter = 0; $counter <= $total_column; $counter ++) {
            $meta = $stmt->getColumnMeta($counter);
            if ($meta['name'] != null) {
                array_push($column, $meta);
            }
        }

        return $column;
    }

    /*     * ***
     * CRIAR CLASSE DAO
     * *** */

    public function gerarDAO($tabela) {
        $relatorio_array = array();

        if (!file_exists(PATH_ADMIN . 'inc/dao/' . ucfirst($tabela) . 'DAO.php') == true) {
            $handle = fopen(PATH_ADMIN . 'inc/dao/' . ucfirst($tabela) . 'DAO.php', 'w');
            fwrite($handle, "<?php" . "\r\n");
            fwrite($handle, "class " . $tabela . "DAO {" . "\r\n");

            /* ATRIBUTOS */
            fwrite($handle, "\r\n");
            fwrite($handle, "  private \$dao;" . "\r\n");
            fwrite($handle, "  private \$pu;" . "\r\n");
            fwrite($handle, "\r\n");

            fwrite($handle, "  public function __construct() {" . "\r\n");
            fwrite($handle, "      \$this->dao  = new DAO('" . $tabela . "','id_" . $tabela . "');" . "\r\n");
            fwrite($handle, "      \$this->pu   = new PU();" . "\r\n");
            fwrite($handle, "  }" . "\r\n");

            /* ADICIONAR DADO */
            fwrite($handle, "\r\n");
            fwrite($handle, "  public function adicionar" . ucfirst($tabela) . "(\$objeto){" . "\r\n");
            fwrite($handle, "      return \$this->dao->adicionar(\$objeto);" . "\r\n");
            fwrite($handle, "  }" . "\r\n");
            fwrite($handle, "\r\n");

            /* EDITAR DADO */
            fwrite($handle, "  public function editar" . ucfirst($tabela) . "(\$objeto){" . "\r\n");
            fwrite($handle, "      return \$this->dao->editar(\$objeto);" . "\r\n");
            fwrite($handle, "  }" . "\r\n");
            fwrite($handle, "\r\n");

            /* SELECIONAR TODOS */
            fwrite($handle, "  public function selecionarTodos" . ucfirst($tabela) . "(\$orderBy){" . "\r\n");
            fwrite($handle, "      return \$this->dao->selecionarTodos(\$orderBy);" . "\r\n");
            fwrite($handle, "  }" . "\r\n");
            fwrite($handle, "\r\n");

            /* SELECIONAR POR ID */
            fwrite($handle, "  public function selecionar" . ucfirst($tabela) . "PorId(\$id){" . "\r\n");
            fwrite($handle, "      return \$this->dao->selecionarPorId(\$id);" . "\r\n");
            fwrite($handle, "  }" . "\r\n");
            fwrite($handle, "\r\n");

            /* APAGAR */
            fwrite($handle, "  public function apagar" . ucfirst($tabela) . "(\$id){" . "\r\n");
            fwrite($handle, "      return \$this->dao->apagar(\$id);" . "\r\n");
            fwrite($handle, "  }" . "\r\n");
            fwrite($handle, "\r\n");

            fwrite($handle, "}" . "\r\n");
            fwrite($handle, "?>");
            fclose($handle);

            /* OK! */
            $aux_relatorio_array++;
            array_push($relatorio_array, array("tipo" => "DAO", "path" => PATH_ADMIN . 'inc/dao/' . ucfirst($tabela) . 'DAO.php', "status" => "sucesso"));
        } else {
            array_push($relatorio_array, array("status" => "erro"));
        }
        return $relatorio_array;
    }

    /**     * **
     * CRIAR CLASS
     * *** */
    public function gerarClass($tabela) {
        $relatorio_array = array();
        if (!file_exists(PATH_ADMIN . 'inc/class/Class' . ucfirst($tabela) . ".php") == true) {
            $handle = fopen(PATH_ADMIN . 'inc/class/Class' . ucfirst($tabela) . '.php', 'w');
            fwrite($handle, "<?php" . "\r\n");
            fwrite($handle, "class " . $tabela . " {" . "\r\n");
            fwrite($handle, "\r\n");
            /* DAO */
            fwrite($handle, "   private \$" . $tabela . "DAO;" . "\r\n");
            fwrite($handle, "\r\n");
            /* ATRIBUTOS */

            //CARREGA AS COLUNAS (APENAS O NOME)
            $pu = new PU();
            $pu->abreConexao();
            $stmt = $pu->query("SELECT * FROM " . $tabela);
            $total_column = $stmt->columnCount();
            $pu->fechaConexao();
            $column = array();
            for ($counter = 0; $counter <= $total_column; $counter ++) {

                $meta = $stmt->getColumnMeta($counter);
                if ($meta['name'] != null) {
                    array_push($column, $meta['name']);
                }
            }


            foreach ($column as $coluna) {
                fwrite($handle, "   public $" . $coluna . ";" . "\r\n");
            }
            fwrite($handle, "\r\n");

            //CONSTRUCTOR
            fwrite($handle, "   function __construct(){ " . "\r\n");
            fwrite($handle, "       \$this->" . $tabela . "DAO =  new " . $tabela . "DAO();" . "\r\n");
            fwrite($handle, "   }" . "\r\n");
            fwrite($handle, "\r\n");

            //SETS AND GETS  
            fwrite($handle, "   public function setAll(\$array){" . "\r\n");
            foreach ($column as $coluna) {
                fwrite($handle, "       \$this->set" . ucfirst($coluna) . "(\$array['" . $coluna . "']); " . "\r\n");
            }
            fwrite($handle, "   }" . "\r\n");
            fwrite($handle, "\r\n");

            fwrite($handle, "   public function getAll(){" . "\r\n");
            fwrite($handle, '       return get_object_vars(get_class($this));' . "\r\n");
            fwrite($handle, "   }" . "\r\n");
            fwrite($handle, "\r\n");


            //GETS AND SETERS
            $aux = 1;
            foreach ($column as $coluna) {
                if ($aux == 1) {
                    fwrite($handle, "   public function getId() { return \$this->" . $coluna . ";} " . "\r\n");
                    fwrite($handle, "   public function setId(\$" . $coluna . ") { \$this->" . $coluna . " = \$" . $coluna . ";} " . "\r\n");
                }
                fwrite($handle, "   public function get" . ucfirst($coluna) . "() { return \$this->" . $coluna . ";} " . "\r\n");
                fwrite($handle, "   public function set" . ucfirst($coluna) . "(\$" . $coluna . ") { \$this->" . $coluna . " = \$" . $coluna . ";} " . "\r\n");
                $aux++;
            }
            fwrite($handle, "\r\n");

            /* METODOS CRUD */

            /* SELECIONAR POR ID */
            fwrite($handle, '//METODOS - PADRAO - CRUD' . "\r\n");
            fwrite($handle, '   public function selecionar' . ucfirst($tabela) . 'PorId($id){ $this->setAll($this->' . $tabela . 'DAO->selecionar' . ucfirst($tabela) . 'PorId($id));}' . "\r\n");
            /* ADICIONAR */
            fwrite($handle, '   public function adicionar' . ucfirst($tabela) . '($'.$tabela.'){ return $this->' . $tabela . 'DAO->adicionar' . ucfirst($tabela) . '($'.$tabela.'); }' . "\r\n");
            /* SELECIONAR TODOS */
            fwrite($handle, '   public function selecionarTodos' . ucfirst($tabela) . '($orderBy){ return $this->' . $tabela . 'DAO->selecionarTodos' . ucfirst($tabela) . '($orderBy); }' . "\r\n");
            /* EDITA */
            fwrite($handle, '   public function editar' . ucfirst($tabela) . '($'.$tabela.'){ return $this->' . $tabela . 'DAO->editar' . ucfirst($tabela) . '($'.$tabela.'); }' . "\r\n");
            /* APAGAR */
            fwrite($handle, '   public function apagar' . ucfirst($tabela) . '($id){ return $this->' . $tabela . 'DAO->apagar' . ucfirst($tabela) . '($id); }' . "\r\n");

            fwrite($handle, "}" . "\r\n");
            fwrite($handle, "?>");
            fclose($handle);
            /* OK! */

            array_push($relatorio_array, array("tipo" => "Class", "path" => PATH_ADMIN . 'inc/class/Class' . $tabela . ".php", "status" => "sucesso"));
        } else {
            array_push($relatorio_array, array("status" => "erro"));
        }
        return $relatorio_array;
    }

    /**     * **
     * Incluir dao e classes no config
     * *** */
    public function incluirDaoEClasses($tabela) {
        $relatorio_array = array();
        $lines = file(PATH_ADMIN . 'inc/config.inc.php');

        if ($lines != NULL) {
            $handle = fopen(PATH_ADMIN . 'inc/config.inc.php', 'w+');
            foreach ($lines as $linha) {

                fwrite($handle, $linha);

                if (strstr($linha, 'INCLUDECLASS') != false) {
                    //echo 'teste INCLUDE CLASS';
                    fwrite($handle, ''
                            . 'require_once(PATH_ADMIN . "inc/class/Class' . ucfirst($tabela) . '.php");' . "\r\n");
                }

                if (strstr($linha, 'INCLUDEDAO') != false) {
                    //echo 'teste INCLUDE DAO';
                    fwrite($handle, ''
                            . 'require_once(PATH_ADMIN . "inc/dao/' . ucfirst($tabela) . 'DAO.php");' . "\r\n");
                }
?><?

                $aux++;
            }
            fclose($handle);
        }
        /* OK! */
        array_push($relatorio_array, array("tipo" => "CONFIG", "path" => PATH_ADMIN . 'inc/config.inc.php', "status" => "sucesso"));

        return $relatorio_array;
    }

    /*     * ***
     * CRIAR CONTROLE
     * *** */

    public function gerarControle($tabela) {
        $relatorio_array = array();







        if (!file_exists(PATH_ADMIN . 'ctrl/' . ucfirst($tabela) . "Request.php") == true) {
            $handle = fopen(PATH_ADMIN . 'ctrl/' . ucfirst($tabela) . "Request.php", 'w');
            fwrite($handle, "<?php" . "\r\n");
            fwrite($handle, 'include("../inc/header.php");' . "\r\n");

            fwrite($handle, '// INSTACIA AS ENTIDADES' . "\r\n");
            fwrite($handle, '$utils  = new Utils();' . "\r\n");
            fwrite($handle, '$data   = new Data();' . "\r\n");
            fwrite($handle, '$' . $tabela . '   = new ' . $tabela . '();' . "\r\n");

            //VERIFICA A AÇÃO
            fwrite($handle, 'switch($_POST["acao"]) {' . "\r\n");

            //ADICIONAR
            fwrite($handle, ' 
                            case "Adicionar":' . "\r\n" . '
                            $' . $tabela . '->setAll($_POST["' . $tabela . '"]);
                            ');

            $colunas = $this->pre_create($tabela);

            if ($colunas != NULL) {
                foreach ($colunas as $coluna) {
                    $tipo_dado = "NAO SETADO";
                    $nome_coluna = "NAO SETADO";
                    $nome_coluna = $coluna["name"];
                    //SEPARAR OS TIPOS        
                    //$tipo_dado UTILIZADO PARA TRATAR DATAS E VALORES
                    if ($coluna["native_type"] == 'DATE'  || $coluna["native_type"] == 'TIMESTAMP') {
                        $tipo_dado = "DATE";
                        fwrite($handle, '$' . $tabela . '->set' . ucfirst($nome_coluna) . '($data->formatarData($_POST["' . $tabela . '"]["' . $nome_coluna . '"],"I"));
                            ');
                    }

                    if ($coluna["native_type"] == 'FLOAT') {
                        $tipo_dado = "FLOAT";
                        fwrite($handle, '$' . $tabela . '->set' . ucfirst($nome_coluna) . '($utils->formataValor($_POST["' . $tabela . '"]["' . $nome_coluna . '"],"I"));
                            ');
                    }
                }
            }


            fwrite($handle, ''
                    . '$' . $tabela . '->adicionar' . ucfirst($tabela) . '($' . $tabela . ');
                            $utils->mensagem("' . ucfirst($tabela) . ' adicionado com sucesso!");
                            $utils->direciona("../' . ucfirst($tabela) . 'Listar.php");
                            break;' . "\r\n\r\n" . '
                            ');

            //EDITAR
            fwrite($handle, ' 
                            case "Editar":' . "\r\n" . '
                            $' . $tabela . '->setAll($_POST["' . $tabela . '"]);');

            $colunas = $this->pre_create($tabela);

            if ($colunas != NULL) {
                foreach ($colunas as $coluna) {
                    $tipo_dado = "NAO SETADO";
                    $nome_coluna = "NAO SETADO";
                    $nome_coluna = $coluna["name"];
                    //SEPARAR OS TIPOS        
                    //$tipo_dado UTILIZADO PARA TRATAR DATAS E VALORES
                    if ($coluna["native_type"] == 'DATE'  || $coluna["native_type"] == 'TIMESTAMP') {
                        $tipo_dado = "DATE";
                        fwrite($handle, '$' . $tabela . '->set' . ucfirst($nome_coluna) . '($data->formatarData($_POST["' . $tabela . '"]["' . $nome_coluna . '"],"I"));
                            ');
                    }

                    if ($coluna["native_type"] == 'FLOAT') {
                        $tipo_dado = "FLOAT";
                        fwrite($handle, '$' . $tabela . '->set' . ucfirst($nome_coluna) . '($utils->formataValor($_POST["' . $tabela . '"]["' . $nome_coluna . '"],"I"));
                            ');
                    }
                }
            }

            fwrite($handle, ' 
                            $' . $tabela . '->editar' . ucfirst($tabela) . '($' . $tabela . ');
                            $utils->mensagem("' . ucfirst($tabela) . ' editado com sucesso!");
                            $utils->direciona("../' . ucfirst($tabela) . 'Listar.php");
                            break;' . "\r\n\r\n" . '
                            ');

            //APAGAR VÁRIOS
            fwrite($handle, ' 
                            case "ApagarVarios":' . "\r\n" . '
                            if(isset($_POST["' . $tabela . '"])) {
                                foreach ($_POST["' . $tabela . '"] as $id) {
                                    $' . $tabela . '->setId($id);
                                    if( !$' . $tabela . '->apagar' . ucfirst($tabela) . '($' . $tabela . '->getId()) ) {
                                        $utils->msg ("Request Error:  ' . ucfirst($tabela) . ' não apagado!");
                                    }
                                    $' . $tabela . ' = new ' . $tabela . '();
                                }
                            $utils->mensagem("' . ucfirst($tabela) . '(s) apagado(s) com sucesso!");
                            }
                            $utils->direciona("../' . ucfirst($tabela) . 'Listar.php");
                            break;' . "\r\n\r\n" . '
                            ');


            fwrite($handle, '}' . "\r\n\r\n");

            fwrite($handle, 'include("../inc/footer.php");' . "\r\n");
            fwrite($handle, "?>");



            array_push($relatorio_array, array("tipo" => "Ctrl", "path" => PATH_ADMIN . 'ctrl/' . ucfirst($tabela) . "Request.php", "status" => "sucesso"));
        } else {
            array_push($relatorio_array, array("status" => "erro"));
        }
        return $relatorio_array;
    }

    //PAGINA DE LISTAGEM
    public function gerarPaginasListar($tabela, $dados_tabela) {


//        echo 'gerar PAGINAS LISTAR <br />';
//        echo $tabela . '<br />';
//        var_dump($dados_tabela);



        $relatorio_array = array();
        if (!file_exists(PATH_ADMIN . ucfirst($tabela) . "Listar.php") == true) {
            $handle = fopen(PATH_ADMIN . ucfirst($tabela) . "Listar.php", 'w');
            fwrite($handle, "<?php" . "\r\n");
            fwrite($handle, "include('inc/header.php');" . "\r\n");
            fwrite($handle, '$' . $tabela . '   = new ' . $tabela . '();' . '?>' . "\r\n");


            fwrite($handle, '
            <section id="corpo" class="containers wrap">
                <header class="border-n1">
                    <h3 class="display-inline-block">Listagem de ' . ucfirst($tabela) . '</h3><a href="' . ucfirst($tabela) . 'Adicionar.php" class="float-right btn bg-color-n2">Adicionar ' . ucfirst($tabela) . '</a>
                </header>
                <form name="form" method="post" action="ctrl/' . ucfirst($tabela) . 'Request.php" onsubmit="return confirmacao()">
                    <div class="cont_conteudo">
                        <div class="coluna-1-1">
                            <table class="datatables tabela">
                                <thead class="table-header border-n1">
                                    <tr role="row" class="text-color-n1">
                                    ');

            //TRATANDO O HEADER DA TABLE 
            $colunas = $this->pre_create($tabela);

            if ($colunas != NULL) {
                foreach ($colunas as $coluna) {
                    $tipo = "NAO SETADO";
                    $nome_coluna = "NAO SETADO";
                    $nome_coluna = $coluna["name"];

                    if ($dados_tabela["$nome_coluna"]['listar'] != NULL) {
                        fwrite($handle, '<th class="coluna-' . $dados_tabela["$nome_coluna"]['tamanho_coluna'] . '-16">' . $dados_tabela["$nome_coluna"]['label_header_tabela'] . '</th>');
                    }
                }
            }
            //TRATANDO O HEADER DA TABLE 
            
            fwrite($handle, '<th class="coluna-1-16 text-center"></th>
                            <th class="coluna-1-16 text-right text-right text-underline todos listar-link"><a href="javascript://" id="seleciona"  class="text-color-n1" data-tooltip title="Selecionar todos os itens para apagar">Todos</a></th></tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $' . $tabela . 's = $' . $tabela . '->selecionarTodos' . ucfirst($tabela) . '("id_' . $tabela . '");
                                    if ($' . $tabela . 's != null) {
                                        foreach ($' . $tabela . 's as $' . $tabela . ') {
                                            ?>
                                            <tr class="border-n2">
                                            ');

            //GERA AS LINHAS DA TABELA
            $colunas = $this->pre_create($tabela);

            if ($colunas != NULL) {
                foreach ($colunas as $coluna) {
                    $tipo = "NAO SETADO";
                    $nome_coluna = "NAO SETADO";
                    $nome_coluna = $coluna["name"];

                    if ($dados_tabela["$nome_coluna"]['listar'] != NULL) {
                        fwrite($handle, '<td class="coluna-' . $dados_tabela["$nome_coluna"]['tamanho_coluna'] . '-16 "><?=$' . $tabela . '->get' . ucfirst($nome_coluna) . '()?></td>'
                                . '');
                    }
                }
            }
            //GERA AS LINHAS DA TABELA

            /*
              <td class="coluna-14-16"><?= $' . $tabela . '->getId() ?></td>
              <td class="coluna-1-16 text-center"><a href="' . ucfirst($tabela) . 'Editar.php?' . $tabela . '_id=<?= $' . $tabela . '->getId() ?>" class="icon-edit" data-tooltip title="Clique para editar"></a></td>
              <td class="coluna-1-16 text-center"><input name="' . $tabela . '[<?= $' . $tabela . '->getId() ?>]" type="checkbox" value="<?= $' . $tabela . '->getId() ?>" data-tooltip title="Selecione para apagar este campo"></td>
             */

            fwrite($handle, '<td class="coluna-1-16 text-center"><a href="' . ucfirst($tabela) . 'Editar.php?' . $tabela . '_id=<?= $' . $tabela . '->getId() ?>" class="icon-edit" data-tooltip title="Clique para editar"></a></td>
                                                <td class="coluna-1-16 text-center"><input name="' . $tabela . '[<?= $' . $tabela . '->getId() ?>]" type="checkbox" value="<?= $' . $tabela . '->getId() ?>" data-tooltip title="Selecione para apagar este campo"></td>
                                             </tr>
                                            <?
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="coluna-1-1">
                                <input type="hidden" name="acao" value="ApagarVarios">
                                <input type="submit" name="botao" class="btn-degrade-cinza float-right" value="Apagar" />
                            </div>
                        </div>
                    </div>
                </form>
            </section>
            <!-- INIT JAVASCRIPT -->
            <script type="text/javascript">
            js.checkAll.init();
            </script>' . "\r\n" .
                    '');

            fwrite($handle, '<?'
                    . 'include("inc/footer.php");'
                    . '?>' . "\r\n");

            array_push($relatorio_array, array("tipo" => "Listar", "path" => PATH_ADMIN . ucfirst($tabela) . "Listar.php", "status" => "sucesso"));
        } else {
            array_push($relatorio_array, array("status" => "erro"));
        }
        return $relatorio_array;
    }

    //PAGINAS PARA ADICAO
    public function gerarPaginasAdicionar($tabela, $dados_tabela) {

//        echo 'gerar PAGINAS ADD <br />';
//        echo $tabela . '<br />';
//        var_dump($dados_tabela);
//        die();

        $relatorio_array = array();
        if (!file_exists(PATH_ADMIN . ucfirst($tabela) . "Adicionar.php") == true) {


            $handle = fopen(PATH_ADMIN . ucfirst($tabela) . "Adicionar.php", 'w');
            fwrite($handle, "<?php" . "\r\n");
            fwrite($handle, "include('inc/header.php');"
                    . "?>" . "\r\n");

            fwrite($handle, '
              <section id="corpo" class="containers wrap border-n1">
              <header class="border-n1">
              <h3 class="display-inline-block">Adicionar ' . ucfirst($tabela) . '</h3>
              </header>
              <div class="cont_conteudo">
              <form id="form" action="ctrl/' . ucfirst($tabela) . 'Request.php" method="post" class="form form-horizontal center">

              <div class="form-row">
              <p><span>Os campos com * são obrigatórios.</span></p>
              </div>
              ' . "\r\n");


            $colunas = $this->pre_create($tabela);

            if ($colunas != NULL) {
                foreach ($colunas as $coluna) {
                    $tipo = "NAO SETADO";
                    $detalhes = "";
                    $nome_coluna = "NAO SETADO";
                    $nome_coluna = $coluna["name"];



                    if ($dados_tabela["$nome_coluna"]['visivel'] != NULL) {

                        if ($dados_tabela["$nome_coluna"]['required'] != NULL) {
                            $required = 'required';
                            $required_label = '<span>*</span> ';
                        } else {
                            $required = '';
                            $required_label = '';
                        }

                        //TIPO = TEXT
                        if ($dados_tabela["$nome_coluna"]['tipo'] == 'text') {
                            fwrite($handle, '
                            <div class="form-row">
                                <label class="form-label" for="' . $dados_tabela["$nome_coluna"]['id'] . '">' . $required_label . '' . $dados_tabela["$nome_coluna"]['label'] . ': </label>
                                <div class="form-controls">
                                    <input type="text" ' . $required . ' name="' . $tabela . '[' . $nome_coluna . ']" id="' . $dados_tabela["$nome_coluna"]['id'] . '" class="coluna-1-1 ' . $dados_tabela["$nome_coluna"]['class'] . '" title="Digite o ' . $dados_tabela["$nome_coluna"]['label'] . '"/>  
                                </div>
                            </div>
                    ' . "\r\n");
                        }


                        //TIPO = TEXTAREA
                        if ($dados_tabela["$nome_coluna"]['tipo'] == 'textarea') {
                            fwrite($handle, '
                      <div class="form-row">
                      <label class="form-label" for="' . $dados_tabela["$nome_coluna"]['id'] . '">' . $required_label . '' . $dados_tabela["$nome_coluna"]['label'] . ': </label>
                      <br /><br />
                      <div class="coluna">
                      <textarea id="' . $dados_tabela["$nome_coluna"]['id'] . '" name="' . $tabela . '[' . $nome_coluna . ']" class="coluna-1-1 ' . $dados_tabela["$nome_coluna"]['class'] . '" ></textarea>
                      </div>
                      </div>
                      ' . "\r\n");
                        }


                        //TIPO = ENUM

                        if ($dados_tabela["$nome_coluna"]['tipo'] == 'enum') {
                            //PEGANDO OS VALORES DO ENUM
                            $array = NULL;
                            $pu = new PU();
                            $pu->abreConexao();
                            $stmt = $pu->query("SHOW COLUMNS FROM `" . $tabela . "` WHERE Field = '" . $nome_coluna . "'");
                            $pu->fechaConexao();
                            $array = $stmt->fetch();
                            // TRATANTO O ARRAY COM OS VALORES DO ENUM
                            $regex = "/'(.*?)'/";
                            preg_match_all($regex, $array['Type'], $enum_array);
                            $enum_fields = $enum_array[1];
                            // TRATANTO O ARRAY COM OS VALORES DO ENUM
                            //var_dump($enum_fields);


                            fwrite($handle, ' 
                               <div class="form-row">
                                <label class="form-label" for="' . $dados_tabela["$nome_coluna"]['id'] . '">' . $required_label . '' . $dados_tabela["$nome_coluna"]['label'] . ': </label>'
                                    . '<div class="form-controls">');
                            foreach ($enum_fields as $enum_option) {
                                fwrite($handle, '
                                    <input type="radio" ' . $required . ' name="' . $tabela . '[' . $nome_coluna . ']" id="' . $dados_tabela["$nome_coluna"]['id'] . '" value="' . $enum_option . '">' . ucfirst($enum_option) . '&nbsp;&nbsp;&nbsp;'
                                );
                            }

                            fwrite($handle, '</div>
                               </div>'
                                    . "\r\n"
                            );
                        }



                        //TIPO = SELECT
                        if ($dados_tabela["$nome_coluna"]['tipo'] == 'select') {
                            $array = NULL;
                            //PDO NAO TEM SUPORTE A SCHEMA DO MYSQL
                            mysql_connect(BD_HOST, BD_USUARIO, BD_SENHA);
                            mysql_select_db('INFORMATION_SCHEMA');
                            $array = mysql_query('
                                                select TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME,
                                                REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME from KEY_COLUMN_USAGE
                                                where TABLE_SCHEMA = "' . BD_BANCO . '" AND TABLE_NAME = "' . $tabela . '" AND COLUMN_NAME = "' . $nome_coluna . '"  
                                                and referenced_column_name is not NULL;') or die(mysql_error());

                            $schema = mysql_fetch_array($array);

                            //SETA NA VARIAVEL O NOME DA TABELA ESTRANGEIRA
                            $fk_table = $schema['REFERENCED_TABLE_NAME'];
                            $id_fk_table = $schema['REFERENCED_COLUMN_NAME'];

                            fwrite($handle, '<div class="form-row">
                                <label class="form-label" for="' . $dados_tabela["$nome_coluna"]['id'] . '">' . $required_label . '' . $dados_tabela["$nome_coluna"]['label'] . ': </label>
                                <div class="form-controls">
                                    <select required name="' . $tabela . '[' . $nome_coluna . ']" class="coluna-1-1 ' . $dados_tabela["$nome_coluna"]['class'] . '" id="' . $dados_tabela["$nome_coluna"]['id'] . '">
                                        <option value="">Selecione uma opção</option>
                                        <?
                                        $' . $fk_table . ' = new ' . $fk_table . '();
                                        $all_' . $fk_table . 's = $' . $fk_table . '->selecionarTodos' . ucfirst($fk_table) . '("' . $id_fk_table . '");

                                        if ($all_' . $fk_table . 's != NULL) {
                                            foreach ($all_' . $fk_table . 's as $' . $fk_table . ') {
                                                ?><option value="<?= $' . $fk_table . '->getId() ?>"><?= $' . $fk_table . '->getId() ?></option><?
                                            }
                                        }
                                        ?>  
                                    </select>
                                </div>
                            </div>'
                                    . "\r\n"
                            );
                        }
                    }
                }
            }


            fwrite($handle, '
              <div class="form-row">
              <span class="form-label"></span>
              <div class="form-controls">
              <input type="hidden" name="acao" value="Adicionar">
              <input type="submit" name="botao" value="Adicionar" id="botao" class="btn btn-primary" />
              </div>
              </div>
              </form>
              </div>
              </section>
              <!-- INIT JAVASCRIPT -->
              <script type="text/javascript">
              js.corner.init();
              js.dataPicker.init();
              js.tiny.init();
              js.money.init();
              </script>
              ');

            fwrite($handle, '<?'
                    . 'include("inc/footer.php");'
                    . '?>' . "\r\n");

            array_push($relatorio_array, array("tipo" => "Adicionar", "path" => PATH_ADMIN . ucfirst($tabela) . "Adicionar.php", "status" => "sucesso"));
        } else {
            array_push($relatorio_array, array("status" => "erro"));
        }
        return $relatorio_array;
    }

    public function gerarPaginasEditar($tabela, $dados_tabela) {

//        echo 'gerar PAGINAS EDIT <br />';
//        echo $tabela . '<br />';
//        var_dump($dados_tabela);
//        die();


        $relatorio_array = array();
        if (!file_exists(PATH_ADMIN . ucfirst($tabela) . "Editar.php") == true) {

            $handle = fopen(PATH_ADMIN . ucfirst($tabela) . "Editar.php", 'w');
            fwrite($handle, "<?php" . "\r\n");
            fwrite($handle, "include('inc/header.php');"
                    . '$' . $tabela . ' =   new ' . $tabela . '();
                       $' . $tabela . '->selecionar' . ucfirst($tabela) . 'PorId($_GET["' . $tabela . '_id"]);
                       $utils 	    = new Utils();
                       $data       = new Data();
                       ?>'
                    . "\r\n");

            fwrite($handle, '
                <section id="corpo" class="containers wrap border-n1">
                    <header class="border-n1">
                        <h3 class="display-inline-block">Editar ' . ucfirst($tabela) . '</h3>
                    </header>
                    <div class="cont_conteudo">
                        <form id="form" action="ctrl/' . ucfirst($tabela) . 'Request.php" method="post" class="form form-horizontal center">

                            <div class="form-row">
                                    <p><span>Os campos com * são obrigatórios.</span></p>
                            </div>
                            ' . "\r\n");

            $colunas = $this->pre_create($tabela);

            if ($colunas != NULL) {
                foreach ($colunas as $coluna) {
                    $tipo_dado = "NAO SETADO";
                    $detalhes = "";
                    $nome_coluna = "NAO SETADO";
                    $nome_coluna = $coluna["name"];


                    //SEPARAR OS TIPOS        
                    //$tipo_dado UTILIZADO PARA TRATAR DATAS E VALORES
                    if ($coluna["native_type"] == 'DATE'  || $coluna["native_type"] == 'TIMESTAMP') {
                        $tipo_dado = "DATE";
                    }

                    if ($coluna["native_type"] == 'FLOAT') {
                        $tipo_dado = "FLOAT";
                    }


                    if ($dados_tabela["$nome_coluna"]['visivel'] != NULL) {

                        if ($dados_tabela["$nome_coluna"]['required'] != NULL) {
                            $required = 'required';
                            $required_label = '<span>*</span> ';
                        } else {
                            $required = '';
                            $required_label = '';
                        }

                        //TIPO = TEXT
                        if ($dados_tabela["$nome_coluna"]['tipo'] == 'text') {
                            if ($tipo_dado != 'DATE' && $tipo_dado != 'FLOAT') {
                                fwrite($handle, '
                            <div class="form-row">
                                <label class="form-label" for="' . $dados_tabela["$nome_coluna"]['id'] . '">' . $required_label . '' . $dados_tabela["$nome_coluna"]['label'] . ': </label>
                                <div class="form-controls">
                                    <input type="text" ' . $required . ' value="<?=$' . $tabela . '->get' . ucfirst($nome_coluna) . '()?>" name="' . $tabela . '[' . $nome_coluna . ']" id="' . $dados_tabela["$nome_coluna"]['id'] . '" class="coluna-1-1 ' . $dados_tabela["$nome_coluna"]['class'] . '" title="Digite o ' . $dados_tabela["$nome_coluna"]['label'] . '"/>  
                                </div>
                            </div>
                    ' . "\r\n");
                            } else {

                                if ($tipo_dado == 'DATE') {
                                    fwrite($handle, '
                            <div class="form-row">
                                <label class="form-label" for="' . $dados_tabela["$nome_coluna"]['id'] . '">' . $required_label . '' . $dados_tabela["$nome_coluna"]['label'] . ': </label>
                                <div class="form-controls">
                                    <input type="text" ' . $required . ' value="<?=$data->formatarData($' . $tabela . '->get' . ucfirst($nome_coluna) . '(),"P")?>" name="' . $tabela . '[' . $nome_coluna . ']" id="' . $dados_tabela["$nome_coluna"]['id'] . '" class="coluna-1-1 ' . $dados_tabela["$nome_coluna"]['class'] . '" title="Digite o ' . $dados_tabela["$nome_coluna"]['label'] . '"/>  
                                </div>
                            </div>
                    ' . "\r\n");
                                }

                                if ($tipo_dado == 'FLOAT') {
                                    fwrite($handle, '
                            <div class="form-row">
                                <label class="form-label" for="' . $dados_tabela["$nome_coluna"]['id'] . '">' . $required_label . '' . $dados_tabela["$nome_coluna"]['label'] . ': </label>
                                <div class="form-controls">
                                    <input type="text" ' . $required . ' value="<?=$utils->formataValor($' . $tabela . '->get' . ucfirst($nome_coluna) . '(),"P")?>" name="' . $tabela . '[' . $nome_coluna . ']" id="' . $dados_tabela["$nome_coluna"]['id'] . '" class="coluna-1-1 ' . $dados_tabela["$nome_coluna"]['class'] . '" title="Digite o ' . $dados_tabela["$nome_coluna"]['label'] . '"/>  
                                </div>
                            </div>
                    ' . "\r\n");
                                }
                            }
                        }

                        //TIPO = TEXTAREA
                        if ($dados_tabela["$nome_coluna"]['tipo'] == 'textarea') {
                            fwrite($handle, '
                      <div class="form-row">
                      <label class="form-label" for="' . $dados_tabela["$nome_coluna"]['id'] . '">' . $required_label . '' . $dados_tabela["$nome_coluna"]['label'] . ': </label>
                      <br /><br />
                      <div class="coluna">
                      <textarea id="' . $dados_tabela["$nome_coluna"]['id'] . '" name="' . $tabela . '[' . $nome_coluna . ']" class="coluna-1-1 ' . $dados_tabela["$nome_coluna"]['class'] . '" ><?=$' . $tabela . '->get' . ucfirst($nome_coluna) . '()?></textarea>
                      </div>
                      </div>
                      ' . "\r\n");
                        }


                        //TIPO = ENUM
                        if ($dados_tabela["$nome_coluna"]['tipo'] == 'enum') {
                            //PEGANDO OS VALORES DO ENUM
                            $array = NULL;
                            $pu = new PU();
                            $pu->abreConexao();
                            $stmt = $pu->query("SHOW COLUMNS FROM `" . $tabela . "` WHERE Field = '" . $nome_coluna . "'");
                            $pu->fechaConexao();
                            $array = $stmt->fetch();
                            // TRATANTO O ARRAY COM OS VALORES DO ENUM
                            $regex = "/'(.*?)'/";
                            preg_match_all($regex, $array['Type'], $enum_array);
                            $enum_fields = $enum_array[1];
                            // TRATANTO O ARRAY COM OS VALORES DO ENUM
                            //var_dump($enum_fields);


                            fwrite($handle, ' 
                               <div class="form-row">
                                <label class="form-label" for="' . $dados_tabela["$nome_coluna"]['id'] . '">' . $required_label . '' . $dados_tabela["$nome_coluna"]['label'] . ': </label>'
                                    . '<div class="form-controls">');
                            foreach ($enum_fields as $enum_option) {
                                //tratando a string checked="checked"
                                $checked = "checked='checked'";

                                fwrite($handle, '
                                    <input type="radio" ' . $required . ' <?=($' . $tabela . '->get' . ucfirst($nome_coluna) . '() == "' . $enum_option . '")? "' . $checked . '" : "" ?>  name="' . $tabela . '[' . $nome_coluna . ']" id="' . $dados_tabela["$nome_coluna"]['id'] . '" value="' . $enum_option . '">' . ucfirst($enum_option) . '&nbsp;&nbsp;&nbsp;'
                                );
                            }

                            fwrite($handle, '</div>
                               </div>'
                                    . "\r\n"
                            );
                        }



                        //TIPO = SELECT
                        if ($dados_tabela["$nome_coluna"]['tipo'] == 'select') {
                            $array = NULL;
                            //PDO NAO TEM SUPORTE A SCHEMA DO MYSQL
                            mysql_connect(BD_HOST, BD_USUARIO, BD_SENHA);
                            mysql_select_db('INFORMATION_SCHEMA');
                            $array = mysql_query('
                                                select TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME,
                                                REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME from KEY_COLUMN_USAGE
                                                where TABLE_SCHEMA = "' . BD_BANCO . '" AND TABLE_NAME = "' . $tabela . '" AND COLUMN_NAME = "' . $nome_coluna . '"  
                                                and referenced_column_name is not NULL;') or die(mysql_error());

                            $schema = mysql_fetch_array($array);

                            //SETA NA VARIAVEL O NOME DA TABELA ESTRANGEIRA
                            $fk_table = $schema['REFERENCED_TABLE_NAME'];
                            $id_fk_table = $schema['REFERENCED_COLUMN_NAME'];

                            //TRATANDO A STRINT selected='selected'
                            $selected = "selected='selected'";

                            fwrite($handle, '<div class="form-row">
                                <label class="form-label" for="' . $dados_tabela["$nome_coluna"]['id'] . '">' . $required_label . '' . $dados_tabela["$nome_coluna"]['label'] . ': </label>
                                <div class="form-controls">
                                    <select required name="' . $tabela . '[' . $nome_coluna . ']" class="coluna-1-1 ' . $dados_tabela["$nome_coluna"]['class'] . '" id="' . $dados_tabela["$nome_coluna"]['id'] . '">
                                        <option value="">Selecione uma opção</option>
                                        <?
                                        $' . $fk_table . ' = new ' . $fk_table . '();
                                        $all_' . $fk_table . 's = $' . $fk_table . '->selecionarTodos' . ucfirst($fk_table) . '("' . $id_fk_table . '");

                                        if ($all_' . $fk_table . 's != NULL) {
                                            foreach ($all_' . $fk_table . 's as $' . $fk_table . ') {
                                                ?><option value="<?= $' . $fk_table . '->getId() ?>" <?=($' . $fk_table . '->getId() == $' . $tabela . '->get' . ucfirst($nome_coluna) . '())? "' . $selected . '" : ""?> ><?= $' . $fk_table . '->getId() ?></option><?
                                            }
                                        }
                                        ?>  
                                    </select>
                                </div>
                            </div>'
                                    . "\r\n"
                            );
                        }
                    }
                }
            }

            fwrite($handle, '
                            <div class="form-row">
                                <span class="form-label"></span>
                                <div class="form-controls">
                                    <input type="hidden" name="acao" value="Editar">
                                    <input type="hidden" name="' . $tabela . '[id_' . $tabela . ']" value="<?= $' . $tabela . '->getId() ?>">
                                    <input type="submit" name="botao" value="Salvar" id="botao" class="btn btn-primary" />
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
                <!-- INIT JAVASCRIPT -->
                <script type="text/javascript">
                 js.corner.init();
                 js.dataPicker.init();
                 js.tiny.init();
                 js.money.init();
                </script>
                ');

            fwrite($handle, '<?'
                    . 'include("inc/footer.php");'
                    . '?>' . "\r\n");

            array_push($relatorio_array, array("tipo" => "Editar", "path" => PATH_ADMIN . ucfirst($tabela) . "Editar.php", "status" => "sucesso"));
        } else {
            array_push($relatorio_array, array("status" => "erro"));
        }
        return $relatorio_array;
    }

    public function create($dados_tabela) {

        $tabela = $dados_tabela['tabela'];
        //GERA CLASSES E INCLUI NO CONFIG
        $classe = $this->gerarClass($tabela);
        $dao = $this->gerarDAO($tabela);
        $inclusao =$this->incluirDaoEClasses($tabela);
        //GERA CONTROLE
        $controle = $this->gerarControle($tabela);
        //GERAR PAGINAS
        //$listar = $this->gerarPaginasListar($tabela, $dados_tabela);
        //$adicionar = $this->gerarPaginasAdicionar($tabela, $dados_tabela);
        //$editar = $this->gerarPaginasEditar($tabela, $dados_tabela);

        $relatorio_array = array();

        if ($classe['status'] == 'erro') {
            array_push($relatorio_array, array("class" => "erro"));
        } else {
            array_push($relatorio_array, array("class" => "sucesso"));
        }

        if ($dao['status'] == 'erro') {
            array_push($relatorio_array, array("dao" => "erro"));
        } else {
            array_push($relatorio_array, array("dao" => "sucesso"));
        }

        if ($inclusao['status'] == 'erro') {
            array_push($relatorio_array, array("inclusao" => "erro"));
        } else {
            array_push($relatorio_array, array("inclusao" => "sucesso"));
        }

        if ($controle['status'] == 'erro') {
            array_push($relatorio_array, array("ctrl" => "erro"));
        } else {
            array_push($relatorio_array, array("ctrl" => "sucesso"));
        }

        if ($listar['status'] == 'erro') {
            array_push($relatorio_array, array("listar" => "erro"));
        } else {
            array_push($relatorio_array, array("listar" => "sucesso"));
        }

        if ($adicionar['status'] == 'erro') {
            array_push($relatorio_array, array("adicionar" => "erro"));
        } else {
            array_push($relatorio_array, array("adicionar" => "sucesso"));
        }

        if ($editar['status'] == 'erro') {
            array_push($relatorio_array, array("editar" => "erro"));
        } else {
            array_push($relatorio_array, array("editar" => "sucesso"));
        }

        return $relatorio_array;
    }

}

?>
