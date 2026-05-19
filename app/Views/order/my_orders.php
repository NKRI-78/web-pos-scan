<?= $this->extend('layout/layouts') ?>

<?= $this->section('content') ?>

<div class="container mx-auto p-6">
    <div class="w-full flex flex-col items-center justify-center">
        <div class="bg-white shadow-lg rounded-lg py-8 max-w-md w-full">
            <div class="p-8">
                <div class="flex flex-row items-center justify-between mb-4">
                    <p class="text-1xl" style="color: #808080;">Payment Method</p>
                    <p><?= esc($payment ?: '-') ?></p>
                </div>

                <h3 class="text-2xl font-bold">Detail Order</h3>

                <?php foreach ($products as $product): ?>
                    <div class="flex flex-row items-center justify-between mt-4">
                        <p class="text-1xl" style="color: #808080;"><?= esc($product['name']) ?> x <?= esc($product['qty']) ?></p>
                        <p><?= formatRupiah($product['price']) ?></p>
                    </div>
                <?php endforeach; ?>

                <div class="flex flex-row items-center justify-between mt-4">
                    <p class="text-1xl" style="color: #808080;">Courier</p>
                    <p><?= esc($courier ?: '-') ?></p>
                </div>

                <div class="flex flex-row items-center justify-between">
                    <h3 class="text-2xl mt-4 font-bold">Total</h3>
                    <h3 class="text-2xl mt-4 font-bold"><?= formatRupiah($total_price) ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
