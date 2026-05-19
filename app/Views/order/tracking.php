<?php 
    $uri = current_url(true);
    $currentStatus = $id ?: 'process';

    $timeline = [
        ['key' => 'process', 'time' => '10:10', 'label' => 'Order Received', 'icon' => '✅'],
        ['key' => 'process', 'time' => '10:20', 'label' => 'Payment Verified', 'icon' => '✅'],
        ['key' => 'delivery', 'time' => '10:35', 'label' => 'Packed', 'icon' => '📦'],
        ['key' => 'delivery', 'time' => '11:15', 'label' => 'On Delivery', 'icon' => '🚚'],
        ['key' => 'finish', 'time' => '12:05', 'label' => 'Delivered', 'icon' => '🎉'],
    ];

    $statusRank = ['process' => 1, 'delivery' => 2, 'finish' => 3];
    $currentRank = $statusRank[$currentStatus] ?? 1;
?>

<?= $this->extend('layout/layouts') ?>

<?= $this->section('content') ?>

<div class="max-w-xl mx-auto p-4">

    <?php if($uri->getSegment(2) == 'tracking'): ?>
        <div class="flex flex-row justify-center my-8 items-center gap-4">
            <div class="flex flex-row items-center gap-3">

                <a href="<?= base_url('/tracking?id=process') ?>">
                    <img src="<?= $currentStatus === 'process' ? base_url('public/assets/image/tracking/on-process-active.png') : base_url('public/assets/image/tracking/on-process.png') ?>" class="h-5" alt="On Process">
                </a>

                <img src="<?= base_url('public/assets/image/divider.png') ?>" class="h-1" alt="Divider">

                <a href="<?= base_url('/tracking?id=delivery') ?>">
                    <img src="<?= $currentStatus === 'delivery' ? base_url('public/assets/image/tracking/delivery-active.png') : base_url('public/assets/image/tracking/delivery.png') ?>" class="h-5" alt="Delivery">
                </a>

                <img src="<?= base_url('public/assets/image/divider.png') ?>" class="h-1" alt="Divider">

                <a href="<?= base_url('/tracking?id=finish') ?>">
                    <img src="<?= $currentStatus === 'finish' ? base_url('public/assets/image/tracking/finish-active.png') : base_url('public/assets/image/tracking/finish.png') ?>" class="h-5" alt="Finish">
                </a>

            </div>
        </div>
    <?php endif; ?>

    <div class="p-6 bg-white rounded-lg shadow-md">
        <h3 class="text-xl font-bold mb-4">Tracking Timeline</h3>
        <div class="space-y-3 text-sm">
            <?php foreach ($timeline as $item): ?>
                <?php
                    $itemRank = $statusRank[$item['key']] ?? 1;
                    $isDone = $itemRank <= $currentRank;
                ?>
                <div class="flex gap-3 <?= $isDone ? '' : 'opacity-40' ?>">
                    <span class="text-slate-500 w-14"><?= $item['time'] ?></span>
                    <span><?= $item['icon'] ?> <?= $item['label'] ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
