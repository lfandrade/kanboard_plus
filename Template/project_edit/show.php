<!-- kanboard_plus:template/project_creation/form_custom.php -->
<div>
    <?= $this->form->label(t('Justification'), 'justify') ?>
    <?= $this->form->textEditor('justify', $values, $errors, array('required' => true, 'aria-label' => t('Enter justification here'))) ?>
</div>

<div>
    <?= $this->form->label(t('Objective'), 'objective') ?>
    <?= $this->form->textEditor('objective', $values, $errors, array('required' => true, 'aria-label' => t('Enter the project objective'))) ?>
</div>

<div>
    <?= $this->form->label(t('Target Audience'), 'Target Audience') ?>
    <?= $this->form->textEditor('target_audience', $values, $errors, array('required' => true, 'aria-label' => t('Enter the project objective'))) ?>
</div>

<div>
    <?= $this->form->label(t('Requirements'), 'Requirements') ?>
    <?= $this->form->textEditor('requirements', $values, $errors, array('required' => true, 'aria-label' => t('Enter the project Requirements'))) ?>
</div>

<div>
    <?= $this->form->label(t('Assumptions and restrictions'), 'Assumptions and restrictions') ?>
    <?= $this->form->textEditor('assumptions_restrictions', $values, $errors, array('required' => true, 'aria-label' => t('Enter the project Assumptions and restrictions'))) ?>
</div>

<div>
    <?= $this->form->label(t('Stakeholders'), 'Stakeholders') ?>
    <?= $this->form->textEditor('stakeholders', $values, $errors, array('required' => true, 'aria-label' => t('Enter the project Stakeholders'))) ?>
</div>