<?php
class CustomView extends \Slim\View
{
    public function render($template)
    {
        /*
	        extract($this->data);
	        $templatePath = $this->getTemplatesDirectory() . '/' . ltrim($template, '/');
	        if ( !file_exists($templatePath) ) {
	            throw new RuntimeException('View cannot render template `' . $templatePath . '`. Template does not exist.');
	        }
	        ob_start();
	        require $templatePath;
	        $html = ob_get_clean();
        */
        
        return parent::render($template);

    }
}

