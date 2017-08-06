<?php defined('SITE_URL') OR exit('Acesso não permitido');
class View
{
    private function __construct()
    {
        //
    }

    /**
    * Exibe conteudo do $templateFile na pasta view
    * @param  string $templateFile Nome do arquivo, sem a extensão ".php", da 
    *                              pasta app/views/ que se deseja exibir.
    * @param  array  $vars         Array com as variáveis que se deseja enviar 
    *                              para a view. Opcional.
    * @param  bool   $show         True para exibir o conteudo e retornar e 
    *                              false para apenas retornar. Default: True.
    * @return string               Retorna o conteúdo do buffer de saída da 
    *                              view.
    */
    public static function render($templateFile, array $vars = array(), 
        $show = true)
    {
        ob_start();
        extract($vars);

        require(__DIR__.'/../app/views/'.$templateFile.'.php');

        $retorno = ob_get_clean();
        if ($show) {
            echo $retorno;
        }
        return $retorno;
    }

    /**
    * Exibe conteudo do header.php, seguido pelo $templateFile , seguido pelo 
    * footer.php, todos na pasta view;
    * @param  string $templateFile Nome do arquivo, sem a extensão ".php", da 
    *                              pasta app/views/ que se deseja exibir.
    * @param  array  $vars         Array com as variáveis que se deseja enviar 
    *                              para a view. Opcional.
    * @param  bool   $show         True para exibir o conteudo e retornar e 
    *                              false para apenas retornar. Default: True.
    * @return string               Retorna o conteúdo do buffer de saída da 
    *                              view.
    */
    public static function show($templateFile, array $vars = array(), 
        $show = true){
        $retorno = self::render('header', $vars, $show);
        $retorno .= self::render($templateFile, $vars, $show);
        $retorno .= self::render('footer', $vars, $show);
        return $retorno;
    }
}
