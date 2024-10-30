<?php

namespace Kanboard\Plugin\kanboard_plus\Controller;

use Kanboard\Controller\ProjectEditController as BaseProjectEditController;

class ProjectEditController extends BaseProjectEditController
{
    public function edit(array $values = [], array $errors = [])
    {
        // Carregar o projeto padrão se não houver valores fornecidos
        if (empty($values)) {
            $values = $this->projectModel->getById($this->request->getIntegerParam('project_id'));
        }

        // Carregar campos personalizados do banco de dados
        $customFields = $this->projectCustomFieldsModel->getCustomFields($values['id']);
        
        // Mesclar campos personalizados aos valores para o formulário de edição
        foreach ($customFields as $field) {
            $values[$field['field_name']] = $field['field_value'];
        }

        // Renderizar a view de edição com os campos personalizados
        $this->response->html($this->helper->layout->project('project_edit/edit', array(
            'values' => $values,
            'errors' => $errors,
            'project' => $values,
            'title' => t('Edit Project'),
        )));
    }

    public function update()
    {
        $values = $this->request->getValues();
        
        // Captura os valores dos campos personalizados
        $customFields = [
            'justify' => $this->request->getStringParam('justify'),
            'objective' => $this->request->getStringParam('objective'),
            // Outros campos personalizados podem ser adicionados aqui
        ];

        list($valid, $errors) = $this->projectValidator->validateModification($values);

        if ($valid) {
            if ($this->projectModel->update($values)) {
                // Salvar campos personalizados na tabela correta
                $this->projectCustomFieldsModel->saveCustomField($values['id'], $customFields);

                $this->flash->success(t('Project updated successfully.'));
                return $this->response->redirect($this->helper->url->to('ProjectViewController', 'show', array('project_id' => $values['id'])), true);
            }

            $this->flash->failure(t('Unable to update your project.'));
        }

        return $this->edit($values, $errors);
    }
}
