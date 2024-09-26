<?php

namespace Kanboard\Plugin\Kanboard_Plus;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;
use Kanboard\Plugin\Kanboard_Plus\Migrations\InitialMigration;


class Plugin extends Base
{
    public function initialize()
    {
        // Sobrescrever o controlador de criação de projetos
        $this->container['ProjectCreationController'] = function ($c) {
            return new \Kanboard\Plugin\Kanboard_Plus\Controller\ProjectCreationController($c);
        };


        // Anexar o novo campo ao template de criação de projeto
        $this->template->hook->attach('template:project:creation:form', 'kanboard_plus:project_creation/form_custom');
        
    }

    public function afterInstall()
    {
        // Executar migrações após a instalação do plugin
        $migration = new InitialMigration($this->container);
        $migration->up();
    }

    public function afterUninstall()
    {
        // Remover as migrações após a desinstalação do plugin
        $migration = new InitialMigration($this->container);
        $migration->down();
    }
    
    public function onStartup()
    {
        // Carregar as traduções (caso tenha suporte a múltiplos idiomas)
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
    }

    public function getPluginName()
    {
        return 'Kanboard Plus';
    }

    public function getPluginDescription()
    {
        return 'kanboard plus is a plugin that adds new features and expands existing ones';
    }

    public function getPluginAuthor()
    {
        return 'Luis Felipe Andrade';
    }

    public function getPluginVersion()
    {
        return '0.0.1';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/lfandrade/kanboard-plus';
    }

    public function getCompatibleVersion()
    {
        return '>=1.2.20'; // Versão mínima do Kanboard necessária
    }

    
    
}
