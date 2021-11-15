<h1>Article</h1>
<?= $this->html->link('Add Article', ['action' => 'add']) ?>
<table>
    <tr>
        <th>Titre</th>
        <th>created</th>
        <th>action</th>
        <?php foreach ($articles as $article) : ?>
    <tr>
        <td>
            <?= $this->html->link($article->title, ['action' => 'view', $article->slug]) ?>
        </td>
        <td>
            <?= $article->created ?>
        </td>
        <td>
            <?= $this->html->link('Edit', ['action' => 'edit', $article->slug]) ?>
            <?= $this->Form->postLink(
                'Delete',
                ['action' => 'delete', $article->slug],
                ['confirm' => 'Are you sure?']
            )
            ?>
        </td>
    </tr>
<?php endforeach ?>
</tr>
</table>