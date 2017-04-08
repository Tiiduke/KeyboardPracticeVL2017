<?php
class LanguageLoader {
    
	function initialize() {
        $ci =& get_instance();
        $site_lang = $ci->session->userdata('site_lang');
        if ($site_lang) {
            $ci->lang->load('myappl', $ci->session->userdata('site_lang'));
			$ci->config->set_item('language', $site_lang);
		} else {
            $ci->lang->load('myappl', 'english');
			$ci->config->set_item('language', 'english');
		}
    }
	
}