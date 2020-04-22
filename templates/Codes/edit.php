<h1>編集</h1>
<?php
    echo $this->Form->create($code);
    echo $this->Form->control('title');
    echo $this->Form->control('name');
    echo $this->Form->control('description', ['rows' => '3']);
    //hidden
    echo $this->Form->control('code', ['type' => 'hidden', 'value' => 'void main']);
    echo $this->Form->control('result', ['type' => 'hidden', 'value' => 'Hello, world']);
    echo $this->Form->button(__('Save Codes'));
    echo $this->Form->end();
?>
