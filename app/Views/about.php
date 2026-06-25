<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h1><?= esc($title) ?></h1>
<p><?= esc($content) ?></p>

<?= $this->endSection() ?>
