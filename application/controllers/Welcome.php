<?php
 defined("\x42\101\123\105\120\x41\x54\x48") or die("\116\x6f\40\x64\151\162\145\143\164\x20\x73\143\162\x69\x70\x74\40\x61\x63\143\145\x73\163\x20\141\154\x6c\x6f\x77\145\x64"); class Welcome extends CI_Controller { public function __construct() { parent::__construct(); $this->load->library("\x70\x61\x72\163\145\x72"); $this->load->helper("\165\162\154"); $this->load->helper("\x66\157\162\x6d"); } public function index() { $data = array("\164\x69\164\x6c\x65" => "\x75\x6a\156\55\145\x2d\163\171\x73\164\145\x6d", "\154\157\147\x6f" => base_url("\146\141\x76\151\x63\157\x6e\56\x70\x6e\147")); $this->parser->parse("\x34\60\x34", $data); } }