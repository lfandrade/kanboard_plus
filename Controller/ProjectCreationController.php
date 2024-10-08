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
        // Chamar o comportamento padrão para criar o projeto e obter o ID
        $projectId = parent::save();

        // Obter os valores dos campos personalizados
        $customFields = [
            'justification' => $this->request->getStringParam('justify'),
            'objective' => $this->request->getStringParam('objective'),
        ];

        // Salvar os campos personalizados no banco de dados
        if ($projectId) {
            $this->customFieldsModel->saveCustomField($projectId, $customFields);
            $this->flash->success(t('Saved'));
        } else {
            $this->flash->failure(t('Error on save.'));
        }

        return $projectId;
    }
}
