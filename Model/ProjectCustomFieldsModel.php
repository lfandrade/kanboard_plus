<?php

namespace Kanboard\Plugin\Kanboard_Plus\Model;

use Kanboard\Core\Base;

class ProjectCustomFieldsModel extends Base
{
    // Método para salvar campos personalizados do projeto
    public function saveCustomField($projectId, array $fields)
    {
        foreach ($fields as $key => $value) {
            // Aqui você deve implementar a lógica para salvar cada campo no banco de dados
            // Exemplo de SQL para inserir os campos personalizados em uma tabela:
            $sql = 'INSERT INTO project_custom_fields (project_id, field_name, field_value) VALUES (?, ?, ?)';
            $this->db->execute($sql, [$projectId, $key, $value]);
        }
    }

    // Método para obter campos personalizados de um projeto
    public function getCustomFields($projectId)
    {
        // Exemplo de SQL para buscar todos os campos personalizados associados ao projeto
        $sql = 'SELECT field_name, field_value FROM project_custom_fields WHERE project_id = ?';
        return $this->db->fetchAll($sql, [$projectId]);
    }
}
