<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
    class template 
    {
        protected $ci;
        protected $css_data = array();
        protected $js_data = array();
        protected $assets_path = "assets/";
        protected $template_path = "template/";
        protected $header_view = [
            	"template" => array(),
            	"data" => array(),
            ];
        protected  $left_view = [
        	"template" => array(),
        	"data" => array(),
        ];
        protected  $center_view = [
        	"template" => array(),
        	"data" => array(),
        ];
        protected  $right_view = [
        	"template" => array(),
        	"data" => array(),
        ];
        protected  $footer_view = [
        	"template" => array(),
        	"data" => array(),
        ];
         
        function __construct() 
        {
            $this->ci =& get_instance();
        }

        function setAssetsFolder($new_folder)
        {
            $this -> assets_path = $new_folder;
        }

        function addStylesheet($sheet_name)
        {
        	$this->css_data[] = $sheet_name;
        }

        function addScript($script_name)
        {
        	$this->js_data[] = $script_name;
        }

        protected function addGeneralSection($viewname, &$section,  $data)
        {
            $this->ci->load->helper('url');
                if (file_exists(realpath(APPPATH . '/views/' . $viewname . '.php'))) {
                        array_push($section["template"], $viewname);
                        array_push($section["data"], $data);
                }
                else
                    {
                        show_error('Unable to load the requested file: '. realpath('views/'.$viewname.'.php'));
                    }
        }

        function addSection($localview, $location, $data = null)
        {
            // head section
            if ($location === "header") {
                $this->addGeneralSection($localview, $this -> header_view, $data);
            }

            // left section
            elseif ($location === "left") {
                $this->addGeneralSection($localview, $this -> left_view, $data);
            }

            // center section
            elseif ($location === "center") {
                $this->addGeneralSection($localview, $this -> center_view, $data);
            }

            // right section
            elseif ($location === "right") {
                    $this->addGeneralSection($localview, $this -> right_view, $data);
            }

            // footer section
            elseif ($location === "footer") {
                    $this->addGeneralSection($localview, $this -> footer_view, $data);
            }
            else {
                show_error('Unknown location parameter for addSection(view, location, data). Viable options are "header", "left", "center", "right", "footer"');
            }
        }

        protected function renderSection(&$section){
            $result = "";
            if (count($section["template"]) > 0) {
                for ($i=0; $i < count($section["template"]); $i++) { 
                    $result .= $this->ci->load->view($section["template"][$i], $section["data"][$i], true);
                }  
            }
            return $result;
        }

        function render($title) 
        {
        	$this->ci->load->helper('url');

            $css_string = "";

            $css_string .=  "<link rel=\"stylesheet\" href=\"" . base_url($this->ci->config->item('bs_style')) . "\" />";

            foreach ($this->css_data as $sheet) 
            {
               $css_string .=  "<link rel=\"stylesheet\" href=\"" . base_url($this->assets_path . "css/". $sheet) .  "\" />";
            }

            $js_string = "";

            $js_string .= "<script type=\"text/javascript\" src=\" " . base_url($this->ci->config->item('jquery_path')) . "\"></script>";

            $js_string .= "<script type=\"text/javascript\" src=\" " . base_url($this->ci->config->item('bs_script')) . "\"></script>";

            foreach ($this->js_data as $script) {
                $js_string .= "<script type=\"text/javascript\" src=\" " . base_url($this->assets_path . "js/". $script) . ".js\"></script>";
            }

            $template_data["title"] = $title;
            $template_data["css_files"] = $css_string;
            $template_data["js_files"] = $js_string;
            $template_data["header_section"] = $this->renderSection($this->header_view);
            $template_data["left_section"] = $this->renderSection($this->left_view);
            $template_data["center_section"] = $this->renderSection($this->center_view);
            $template_data["right_section"] = $this->renderSection($this->right_view);
            $template_data["footer_section"] = $this->renderSection($this->footer_view);

            $this->ci->load->view($this->template_path . "template", $template_data);
        }
    }