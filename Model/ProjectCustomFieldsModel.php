<?php

namespace Kanboard\Plugin\Kanboard_Plus\Model;

use Kanboard\Core\Base;

class ProjectCustomFieldsModel extends Base
{
    const TABLE = 'project_custom_fields';

    public function saveCustomField($projectId, array $customFields)
    {
        // Inserir ou atualizar os campos personalizados
        foreach ($customFields as $field => $value) {
            $this->db->table(self::TABLE)->insert(array(
                'project_id' => $projectId,
                'field_name' => $field,
                'field_value' => $value,
            ));
        }
    }
}
