<?php

class mvtSeoDataHomeManagerController extends modExtraManagerController
{
    public $mvtSeoData;
    public $version = '1.0.6';


    public function initialize()
    {
        $path = $this->modx->getOption('mvtseodata_core_path', null,
                $this->modx->getOption('core_path') . 'components/mvtseodata/') . 'model/mvtseodata/';
        $this->mvtSeoData = $this->modx->getService('mvtseodata', 'mvtSeoData', $path);
        parent::initialize();
    }



    public function getLanguageTopics()
    {
        return array('mvtseodata:default');
    }



    public function checkPermissions()
    {
        return true;
    }



    public function getPageTitle()
    {
        return $this->modx->lexicon('mvtseodata');
    }


    public function loadCustomCssJs()
    {
        $this->addCss($this->mvtSeoData->config['cssUrl'] . 'mgr/main.css');
        $this->addCss($this->mvtSeoData->config['cssUrl'] . 'mgr/bootstrap.buttons.css');
        $this->addJavascript($this->mvtSeoData->config['jsUrl'] . 'mgr/mvtseodata.js?v='.$this->version);
        $this->addJavascript($this->mvtSeoData->config['jsUrl'] . 'mgr/misc/utils.js?v='.$this->version);
        $this->addJavascript($this->mvtSeoData->config['jsUrl'] . 'mgr/misc/combo.js?v='.$this->version);
        $this->addJavascript($this->mvtSeoData->config['jsUrl'] . 'mgr/widgets/common-templates.grid.js?v='.$this->version);
		$this->addJavascript($this->mvtSeoData->config['jsUrl'] . 'mgr/widgets/resource-templates.grid.js?v='.$this->version);
        $this->addJavascript($this->mvtSeoData->config['jsUrl'] . 'mgr/widgets/common-template.windows.js?v='.$this->version);
        $this->addJavascript($this->mvtSeoData->config['jsUrl'] . 'mgr/widgets/resource-template.windows.js?v='.$this->version);	
		$this->addJavascript($this->mvtSeoData->config['jsUrl'] . 'mgr/widgets/index.form.js?v='.$this->version);				
        $this->addJavascript($this->mvtSeoData->config['jsUrl'] . 'mgr/widgets/home.panel.js?v='.$this->version);
        $this->addJavascript($this->mvtSeoData->config['jsUrl'] . 'mgr/sections/home.js?v='.$this->version);

        $this->loadRichTextEditor();
		
		$this->addHtml('<script type="text/javascript">
        mvtSeoData.config = ' . json_encode($this->mvtSeoData->config) . ';
        mvtSeoData.config.connector_url = "' . $this->mvtSeoData->config['connectorUrl'] . '";
        Ext.onReady(function() {
            MODx.load({ xtype: "mvtseodata-page-home"});
        });
        </script>
        ');
    }

	
	public function loadRichTextEditor()   
	{
        $content_xtype = 'textarea';
        $useEditor = $this->modx->getOption('use_editor');
        $whichEditor = $this->modx->getOption('which_editor');

        if ($useEditor && !empty($whichEditor))       {
            $redactor_name = strtolower(str_replace(' ','',$whichEditor));
            $config = array();
            foreach($this->modx->config as $param=>$value) {
                if(strpos($param,$redactor_name) === 0) {
                    $new_param = trim(trim(substr($param,strlen($redactor_name)),'.'),'_');
                    $config[$new_param] = $value;
                    $config[$param] = $value;
                }
            }

            switch ($whichEditor) {
                case 'CKEditor':
                    $content_xtype = 'ckeditor';
                    break;
                default:
                    $content_xtype = 'textarea';
            }

            $textEditors = $this->modx->invokeEvent('OnRichTextEditorRegister');
            $onRichTextEditorInit = $this->modx->invokeEvent('OnRichTextEditorInit',array_merge($config,array(
                'editor' => $whichEditor, 
                'mode' =>  modSystemEvent::MODE_UPD
            )));

						
            if (is_array($onRichTextEditorInit))  {
                $onRichTextEditorInit = implode('', $onRichTextEditorInit);
            }
            if($onRichTextEditorInit) {
                $this->addHtml($onRichTextEditorInit);
            }
            $this->setPlaceholder('onRichTextEditorInit', $onRichTextEditorInit);
        }
    }
	
	
    /**
     * @return string
     */
    public function getTemplateFile()
    {
        return $this->mvtSeoData->config['templatesPath'] . 'home.tpl';
    }
}