<?php

namespace Hcode;

use Rain\tpl;

class Page{

	private $tpl;
	private $options = [];
	private $defaults = [
		"header"=>true,
		"footer"=>true,
		"data"=>[]
	];

	public function __construct($opts = array()){

		$this->options = array_merge($this->defaults, $opts);

		$config = array(
			"base_url"      => null,
			"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/views/",
			"cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
			"debug"         => false 
	    );

		Tpl::configure( $config );

		$this->tpl = new Tpl;

		$this->setData($this->options["data"]);
		
		foreach ($this->options["data"] as $key => $value) {
			$this->tpl->assign($key, $value);
		}

		$this->tpl->draw("header");

	}

	private function setData($data = array())
	{

		foreach ($data as $key => $value) {
			$this->tpl->assign($key, $value);
		}
	}


	public function setTpl($nome, $data = array(), $returnHTML = false)
	{

		$this->setData($data);

		return $this->tpl->draw($nome, $returnHTML);

	}

	public function __destruct(){

		$this->tpl->draw("footer");

	}
}

?>