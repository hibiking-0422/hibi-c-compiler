<h1>INDEX</h1>
<p><?= $this->Html->link("let's cording!", ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>TITLE</th>
        <th>NAME</th>
        <th></th>
        <th></th>
    </tr>

<?php foreach ($codes as $code): ?>
    <tr>
        <td>
            <?= $this->Html->link($code->title, ['action' => 'view', $code->id]) ?>
        </td>
        <td>
            <?= $code->name ?>
        </td>
        <td>
            <?= $this->Html->link('edit', ['action' => 'edit', $code->id]) ?>
        </td>
        <td>
            <?= $this->Form->postLink(
                'delete',
                ['action' => 'delete', $code->id],
                ['confirm' => 'Is it really okay?'])
            ?>
        </td>
    </tr>
<?php endforeach; ?>
