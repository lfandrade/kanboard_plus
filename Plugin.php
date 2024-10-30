<?php

namespace Kanboard\Plugin\kanboard_plus;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;
use Kanboard\Plugin\kanboard_plus\Migrations\InitialMigration;
use Kanboard\Plugin\kanboard_plus\Model\ProjectCustomFieldsModel;

class Plugin extends Base
{
    public function initialize()
    {
        // Sobrescrever o controlador de criação de projetos
        $this->container['ProjectCreationController'] = function ($c) {
            $this->logger->info('Custom ProjectCreationController instantiated.'); // Log para verificar instância
            return new \Kanboard\Plugin\kanboard_plus\Controller\ProjectCreationController($c);
        };

        // Adicionar a rota após a sobrescrita
       // $this->route->add('POST', '/projects/create', 'kanboard_plus:ProjectCreationController:save');
        $this->logger->info('Route registered: /projects/create'); // Log para verificar a rota

        // Executar migração inicial
        $migration = new InitialMigration($this->container);
        $migration->up();

        // Registrar o modelo de campos personalizados
        $this->container['ProjectCustomFieldsModel'] = function ($c) {
            return new ProjectCustomFieldsModel($c);
        };

        // Anexar os novos campos aos templates de criação e edição de projetos
        $this->template->hook->attach('template:project:creation:form', 'kanboard_plus:project_creation/create');
        $this->template->hook->attach('template:project:edit:form', 'kanboard_plus:project_edit/show');
        $this->template->hook->attach('template:project:view:form', 'kanboard_plus:project_view/show');
    }

    public function onStartup()
    {
        // Carregar as traduções
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__ . '/Locale');
    }

    public function afterInstall()
    {
        // Executar migração após a instalação
        $migration = new InitialMigration($this->container);
        $migration->up();
    }

    public function afterUninstall()
    {
        // Reverter migração após a desinstalação
        $migration = new InitialMigration($this->container);
        $migration->down();
    }

    public function getClasses()
    {
        return [
            'Plugin\kanboard_plus\Model' => [
                'ProjectCustomFieldsModel',
            ],
        ];
    }

    public function getPluginName()
    {
        return 'Kanboard Plus';
    }

    public function getPluginDescription()
    {
        return 'Kanboard Plus adds new fields to project creation';
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
