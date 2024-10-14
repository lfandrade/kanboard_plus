<!-- kanboard_plus:template/project_creation/form_custom.php -->
<div>
    <?= $this->form->label(t('Justification'), 'justify') ?>
    <?= $this->form->text('justify', array(), array(), array('placeholder' => t('Enter justification here'))) ?>
</div>

<div>
    <?= $this->form->label(t('Objective'), 'objective') ?>
    <?= $this->form->text('objective', array(), array(), array('placeholder' => t('Enter the project objective'))) ?>
</div>

<div>
    <?= $this->form->label(t('Target Audience'), 'Target Audience') ?>
    <?= $this->form->text('objective', array(), array(), array('placeholder' => t('Enter the project objective'))) ?>
</div>

<div>
    <?= $this->form->label(t('Requirements'), 'Requirements') ?>
    <?= $this->form->text('Requirements', array(), array(), array('placeholder' => t('Enter the project Requirements'))) ?>
</div>

<div>
    <?= $this->form->label(t('Assumptions and restrictions'), 'Assumptions and restrictions') ?>
    <?= $this->form->text('Assumptions and restrictions', array(), array(), array('placeholder' => t('Enter the project Assumptions and restrictions'))) ?>
</div>

<div>
    <?= $this->form->label(t('Stakeholders'), 'Stakeholders') ?>
    <?= $this->form->text('Stakeholders', array(), array(), array('placeholder' => t('Enter the project Stakeholders'))) ?>
</div>