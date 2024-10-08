<?php

namespace Kanboard\Plugin\Kanboard_Plus\Migrations;

class InitialMigration
{
    protected $db;

    public function __construct($container)
    {
        $this->db = $container['db']; // Acesso ao banco de dados através do container do Kanboard
    }

    public function up()
    {
        // Criar a tabela para campos personalizados de projetos
        $this->db->execute("
            CREATE TABLE IF NOT EXISTS project_custom_fields (
                id SERIAL PRIMARY KEY,
                project_id INTEGER NOT NULL,
                field_name VARCHAR(255) NOT NULL,
                field_value TEXT
            );
        ");
    }

    public function down()
    {
        // Deletar a tabela na desinstalação
        $this->db->execute("DROP TABLE IF EXISTS project_custom_fields;");
    }
}
