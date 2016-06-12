<?php

class ViewDescriptor {
 
    private $titolo;
    private $menu;
    private $leftBar;
    private $rightBar;
    private $nav;
    private $content;
    private $pagina; 
    private $sottoPagina;   
    private $impostaToken;
    private $js;
    const get = 'get';   
    const post = 'post'; 
 
    public function __construct() {
        $this->js = array();
    }
    
    public function getTitolo() {
        return $this->titolo;
    }
    
    public function setTitolo($titolo) {
        $this->titolo = $titolo;
    }
    
    public function getMenu() {
        return $this->menu;
    }
    
    public function setMenu($menu) {
        $this->menu = $menu;
    }
    
    public function getRightBar() {
        return $this->rightBar;
    }
    
    public function setRightBar($rightBar) {
        $this->rightBar = $rightBar;
    }
    
     public function getNav() {
        return $this->nav;
    }
    
    public function setNav($nav) {
        $this->nav = $nav;
    }
    
    public function getLeftBar() {
        return $this->leftBar;
    }

    public function setLeftBar($leftBar) {
        $this->leftBar = $leftBar;
    }
    
    public function setContent($content) {
        $this->content = $content;
    }

    public function getContent() {
        return $this->content;
    }

    public function getSottoPagina() {
        return $this->sottoPagina;
    }
    
    public function setSottoPagina($pagina) {
        $this->sottoPagina = $pagina;
    }
    
    public function getPagina() {
        return $this->pagina;
    }
    
    public function setPagina($pagina) {
        $this->pagina = $pagina;
    }
    
    public function addScript($nome){
        $this->js[] = $nome;
    }

    public function &getScripts(){
        return $this->js;
    }

    public function setImpostaToken($token) {
        $this->impostaToken = $token;
    }
    
    public function scriviToken($pre = '', $method = self::get) {
        $nessuno = BaseController::nessuno;
        switch ($method) {
            case self::get:
                if (isset($this->impostaToken)) {
                    return $pre . "$nessuno=$this->impostaToken";
                }
                break;

            case self::post:
                if (isset($this->impostaToken)) {
                    return "<input type=\"hidden\" name=\"$nessuno\" value=\"$this->impostaToken\"/>";
                }
                break;
        }

        return '';
    }

}

?>

