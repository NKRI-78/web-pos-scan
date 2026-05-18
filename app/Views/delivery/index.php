<?= $this->extend('layout/layouts') ?>

<?= $this->section('content') ?>

<div class="container mx-auto p-6">

    <div class="flex flex-col gap-6 items-start">

        <div class="w-full flex flex-col items-center justify-center">
            <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
                <h2 class="text-2xl font-bold mb-2 text-center"><?= $payment ?></h2>
                <h3 class="text-1xl font-bold text-center" style="color: #2563E0;">VA - 7654567890987654563422</h3>
            </div>
        </div>

        <div class="w-full flex flex-col items-center justify-center">
            <div class="bg-white shadow-lg rounded-lg py-8 max-w-md w-full">
                <h2 class="text-2xl font-bold mb-6 text-center" style="color: #F46300;">SUCCESSFULLY</h2>
                <div style="height: 0.5px; background-color: #000000;"> </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold">Detail Order</h3>
                    <?php foreach ($products as $product): ?>
                        <div class="flex flex-row items-center justify-between mt-4">
                            <p class="text-1xl" style="color: #808080;"><?= $product["name"] ?> x <?= $product["qty"] ?></p>
                            <p><?= formatRupiah($product["price"]) ?></p>
                        </div>
                    <?php endforeach; ?>

                    <div class="flex flex-row items-center justify-between mt-4">
                            <p class="text-1xl" style="color: #808080;">Courier</p>
                            <p><?= $courier ?></p>
                        </div>

                    <div class="flex flex-row items-center justify-between">
                        <h3 class="text-2xl mt-4 font-bold">Total</h3>
                        <h3 class="text-2xl mt-4 font-bold"><?= formatRupiah($total_price) ?></h3>
                    </div>
                </div>
                <div style="height: 0.5px; background-color: #000000;"> </div>
            </div>
        </div>

    </div>

    <div class="relative h-64">
        <div class="absolute bottom-20 left-1/2 transform -translate-x-1/2">
            <a href="<?= base_url() ?>" class="w-full text-center px-10 md:px-20 inline-block text-white py-2 rounded-lg mt-4" style="background-color: #F46300;">
                Next Order
            </a>
        </div>
    </div>



</div>

<?= $this->endSection() ?>