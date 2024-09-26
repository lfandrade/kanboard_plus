<?php

namespace Kanboard\Plugin\Kanboard_Plus\Controller;

use Kanboard\Controller\ProjectCreationController as BaseProjectCreationController;
use Kanboard\Plugin\Kanboard_Plus\Model\ProjectCustomFieldsModel;

class ProjectCreationController extends BaseProjectCreationController
{
    private $customFieldsModel;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->customFieldsModel = new ProjectCustomFieldsModel($container);
    }

    public function save()
    {
        // Obter os valores dos campos personalizados
        $customFields = [
            'justification' => $this->request->getStringParam('justify'),
            'objective' => $this->request->getStringParam('objective'), // Adicione outros campos conforme necessário
        ];

        // Salvar os campos personalizados no banco de dados
        $projectId = $this->projectModel->getLastId(); // Obter o ID do último projeto criado
        $this->customFieldsModel->saveCustomField($projectId, $customFields);

        // Mensagem de sucesso
        $this->flash->success(t('Saved'));

        // Continuar com o comportamento padrão do controller
        return parent::save();
    }
}
