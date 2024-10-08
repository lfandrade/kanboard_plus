<!-- kanboard_plus:template/project_creation/form_custom.php -->
<?php
echo "Custom form is loaded"; // Adicione esta linha para teste
?>
<div>
    <?= $this->form->label(t('Justification'), 'justify') ?>
    <?= $this->form->text('justify', array(), array(), array('placeholder' => t('Enter justification here'))) ?>
</div>

<div>
    <?= $this->form->label(t('Objective'), 'objective') ?>
    <?= $this->form->text('objective', array(), array(), array('placeholder' => t('Enter the project objective'))) ?>
</div>