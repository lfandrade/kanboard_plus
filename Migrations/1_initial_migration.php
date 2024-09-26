<?php

namespace Kanboard\Plugin\Kanboard_Plus\Migrations;

use Kanboard\Core\Migration;

class InitialMigration extends Migration
{
    public function up()
    {
        // Criar tabela para armazenar campos personalizados de projetos
        $this->db->exec("CREATE TABLE IF NOT EXISTS project_custom_fields (
            id INT PRIMARY KEY AUTO_INCREMENT,
            project_id INT NOT NULL,
            field_name VARCHAR(255) NOT NULL,
            field_value TEXT NOT NULL,
            FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
        ) ENGINE=InnoDB");
    }

    public function down()
    {
        // Remover tabela se o plugin for desativado
        $this->db->exec("DROP TABLE IF EXISTS project_custom_fields");
    }
}
