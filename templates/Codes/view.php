<h1><?= h($code->title) ?></h1>
<p><?= h($code->name) ?></p>
<p><?= h($code->code) ?></p>
<p><?= h($code->result) ?></p>
<p><?= h($code->description) ?></p>

<p><?= $this->Html->link('Edit', ['action' => 'edit', $code->id]) ?></p>
