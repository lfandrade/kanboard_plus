<?php

use Kanboard\Plugin\kanboard_plus\Controller\ProjectCreationController;

// Adicionar rota para criar projetos
$route->add('POST', '/projects/create', 'kanboard_plus:ProjectCreationController:save');

// Adicionar outras rotas conforme necessário
$route->add('GET', '/projects/{id}', 'kanboard_plus:ProjectViewController:show');
$route->add('GET', '/projects/edit/{id}', 'kanboard_plus:ProjectEditController:show');
