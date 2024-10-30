<?php

namespace Kanboard\Plugin\kanboard_plus\Model;

use Kanboard\Core\Base;

class ProjectCustomFieldsModel extends Base
{
    const TABLE = 'project_custom_fields';

    public function getCustomFields($projectId)
    {
        return $this->db->table(self::TABLE)
            ->eq('project_id', $projectId)
            ->findAll();
    }

    public function saveCustomField($projectId, array $customFields)
    {
        foreach ($customFields as $field => $value) {
            // Remover registros antigos para esse campo personalizado
            $this->db->table(self::TABLE)
                ->eq('project_id', $projectId)
                ->eq('field_name', $field)
                ->remove();

            // Inserir novo valor
            $this->db->table(self::TABLE)->insert(array(
                'project_id' => $projectId,
                'field_name' => $field,
                'field_value' => $value,
            ));
        }
    }
}
