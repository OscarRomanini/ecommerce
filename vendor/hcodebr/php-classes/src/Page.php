<?php


namespace Hcode;
use Rain\Tpl;

class Page
{
    private $tpl;
    private $options = [];
    private $defaults = [
      "data" => []
    ];

    public function __construct($opts = array())
    {
        $this->options = array_merge($this->defaults, $opts);
        // O que a pessoa informar no construct, sobrescreverá o default

        $config = array(
          "tpl_dir" => $_SERVER['DOCUMENT_ROOT']."/views/",
          "cache_dir" => $_SERVER['DOCUMENT_ROOT']."/views/views-cache/",
          "debug" => false
        );
        Tpl::configure($config);
        $this->tpl = new Tpl();

        $this->setData($this->options['data']);

        $this->tpl->draw("header");

    }

    //BODY
    public function setTpl($name, $data = array(), $returnHTML = false){
        $this->setData($data);
        $this->tpl->draw($name, $returnHTML);
    }

    public function setData($data = array())
    {
        foreach ($this->options["data"] as $key => $value) {
            $this->tpl->assign($key, $value);
        }
    }

    public function __destruct()
    {
        $this->tpl->draw("footer");
    }
}