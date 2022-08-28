
<!-- 
<?=$this->Form->input('contacts', array(
    'type'    => 'select',
    'class'   => 'form-control',
    'options' => $contacts,
    'empty'   => false
)); ?> -->


<?=$this->Form->input('contacts', [

   'type'    => 'select',
    'class'   => 'form-control',
    'options' => $contacts,
    'empty'   => 'Select Contact'
]); ?>