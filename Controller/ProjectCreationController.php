<?php

namespace Kanboard\Plugin\kanboard_plus\Controller;

use Kanboard\Controller\ProjectCreationController as BaseProjectCreationController;
use Kanboard\Model\ProjectModel;

class ProjectCreationController extends BaseProjectCreationController
{
    public function save()
    {
        $values = $this->request->getValues();

        // Captura os novos campos
        $customFields = [
            'justify' => $this->request->getStringParam('justify'),
            'objective' => $this->request->getStringParam('objective'),
            // Adicione outros campos aqui conforme necessário
        ];

        // Debug: Verifique os valores
        $this->logger->info("Custom Fields: " . json_encode($customFields));

        // Valida e salva o projeto
        list($valid, $errors) = $this->projectValidator->validateCreation($values);

        $this->logger->info("Projeto criado?: $valid");

        if ($valid) {
            $project_id = $this->projectModel->create($values);

            if ($project_id !== false) {
                // Log para verificar se a função é chamada
                $this->logger->info("Saving custom fields for project ID: $project_id");
                
                // Salvar campos personalizados
                $success = $this->saveCustomFields($project_id, $customFields);

                if ($success) {
                    $this->flash->success(t('Your project has been created successfully.'));
                } else {
                    $this->flash->failure(t('Project created, but custom fields could not be saved.'));
                }

                return $this->response->redirect($this->helper->url->to('ProjectViewController', 'show', array('project_id' => $project_id)), true);
            }
        }

        $this->flash->failure(t('Unable to create your project.'));
        //return $this->create($values, $errors);
    }

    // Método para salvar múltiplos campos personalizados
    protected function saveCustomFields($project_id, array $customFields)
    {
        $allSuccessful = true;
        foreach ($customFields as $field_name => $field_value) {
            $result = $this->db->table('project_custom_fields')->insert(array(
                'project_id'  => $project_id,
                'field_name'  => $field_name,
                'field_value' => $field_value,
            ));

            if (!$result) {
                $allSuccessful = false;
                $this->logger->error("Failed to insert custom field $field_name for project ID $project_id.");
            }
        }
        return $allSuccessful;
    }
}
