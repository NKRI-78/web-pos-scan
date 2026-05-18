<?php 
    use GuzzleHttp\Client;

    $uri = current_url(true);
?>

<?= $this->extend('layout/layouts') ?>

<?= $this->section('content') ?>

<div class="max-w-xl mx-auto">

    <?php if($uri->getSegment(2) == 'tracking'): ?>
        <div class="flex flex-row justify-center my-8 items-center gap-4">
            <div class="flex flex-row items-center gap-3">

                <?php if($id == ""): ?>
                    <a href="<?= base_url('/tracking') ?>">
                        <img src="<?= base_url("public/assets/image/tracking/package-active.png") ?>" class="h-5" alt="Package">
                    </a>
                <?php else: ?>
                    <a href="<?= base_url('/tracking') ?>">
                        <img src="<?= base_url("public/assets/image/tracking/package.png") ?>" class="h-5" alt="Package">
                    </a>
                <?php endif; ?>

                <img src="<?= base_url("public/assets/image/divider.png") ?>" class="h-1" alt="Divider">
                
                <?php if($id == "process"): ?>
                    <a href="<?= base_url('/tracking?id=process') ?>">
                        <img src="<?= base_url("public/assets/image/tracking/on-process-active.png") ?>" class="h-5" alt="On Process">
                    </a>
                <?php else: ?>
                    <a href="<?= base_url('/tracking?id=process') ?>">
                        <img src="<?= base_url("public/assets/image/tracking/on-process.png") ?>" class="h-5" alt="Package">
                    </a>
                <?php endif; ?>
                
                <img src="<?= base_url("public/assets/image/divider.png") ?>" class="h-1" alt="Divider">
                
                <?php if($id == "delivery"): ?>
                    <a href="<?= base_url('/tracking?id=delivery') ?>">
                        <img src="<?= base_url("public/assets/image/tracking/delivery-active.png") ?>" class="h-5" alt="Delivery">
                    </a>
                <?php else: ?>
                    <a href="<?= base_url('/tracking?id=delivery') ?>">
                        <img src="<?= base_url("public/assets/image/tracking/delivery.png") ?>" class="h-5" alt="Delivery">
                    </a>
                <?php endif; ?>

                <img src="<?= base_url("public/assets/image/divider.png") ?>" class="h-1" alt="Divider">
                
                <?php if($id == "finish"): ?>
                    <a href="<?= base_url('/tracking?id=finish') ?>">
                        <img src="<?= base_url("public/assets/image/tracking/finish-active.png") ?>" class="h-5" alt="Finish">
                    </a>
                <?php else: ?>
                    <a href="<?= base_url('/tracking?id=finish') ?>">
                        <img src="<?= base_url("public/assets/image/tracking/finish.png") ?>" class="h-5" alt="Finish">
                    </a>
                <?php endif; ?>

            </div>
        </div>
    <?php endif; ?>

    <div id="tab-content1" class="p-4 bg-white rounded-lg shadow-md">
        <div class="flex items-center justify-between">
            <p class="text-gray-700">Method Payment - <?= $payment ?></p>
            <p class="text-gray-700"><?= $courier ?></p>
        </div>
        <?php foreach($products as $product): ?>
            <div class="flex justify-between items-center py-4">   
                <div class="flex items-center">
                    <img class="w-10 h-10 rounded-lg object-cover mr-4" src="<?= $product["img"] ?>" alt="<?= $product["name"] ?>">
                    <p class="text-gray-700"><?= $product["name"] ?> x <?= $product["qty"] ?></p>
                </div>
                <div>
                    <p><?= formatRupiah($product["price"]) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="flex justify-between items-center py-4">   
            <div class="flex items-center">
                <p class="text-gray-700 font-bold">Total</p>
            </div>
            <div>
                <p><?= formatRupiah($total_price) ?></p>
            </div>
        </div>
    </div>

    <div id="tab-content2" class="hidden p-4 bg-white rounded-lg shadow-md">
        <div class="flex items-center justify-between">
            <p class="text-gray-700">Method Payment - <?= $payment ?></p>
            <p class="text-gray-700"><?= $courier ?></p>
        </div>
        <?php foreach($products as $product): ?>
            <div class="flex justify-between items-center py-4">   
                <div class="flex items-center">
                    <img class="w-10 h-10 rounded-lg object-cover mr-4" src="<?= $product["img"] ?>" alt="<?= $product["name"] ?>">
                    <p class="text-gray-700"><?= $product["name"] ?> x <?= $product["qty"] ?></p>
                </div>
                <div>
                    <p><?= formatRupiah($product["price"]) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="flex justify-between items-center py-4">   
            <div class="flex items-center">
                <p class="text-gray-700 font-bold">Total</p>
            </div>
            <div>
                <p><?= formatRupiah($total_price) ?></p>
            </div>
        </div>
    </div>

    <div id="tab-content3" class="hidden p-4 bg-white rounded-lg shadow-md">
        <div class="flex items-center justify-between">
            <p class="text-gray-700">Method Payment - <?= $payment ?></p>
            <p class="text-gray-700"><?= $courier ?></p>
        </div>
        <?php foreach($products as $product): ?>
            <div class="flex justify-between items-center py-4">   
                <div class="flex items-center">
                    <img class="w-10 h-10 rounded-lg object-cover mr-4" src="<?= $product["img"] ?>" alt="<?= $product["name"] ?>">
                    <p class="text-gray-700"><?= $product["name"] ?> x <?= $product["qty"] ?></p>
                </div>
                <div>
                    <p><?= formatRupiah($product["price"]) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="flex justify-between items-center py-4">   
            <div class="flex items-center">
                <p class="text-gray-700 font-bold">Total</p>
            </div>
            <div>
                <p><?= formatRupiah($total_price) ?></p>
            </div>
        </div>
    </div>

    <div id="tab-content4" class="hidden p-4 bg-white rounded-lg shadow-md">
        <div class="flex items-center justify-between">
            <p class="text-gray-700">Method Payment - <?= $payment ?></p>
            <p class="text-gray-700"><?= $courier ?></p>
        </div>
        <?php foreach($products as $product): ?>
            <div class="flex justify-between items-center py-4">   
                <div class="flex items-center">
                    <img class="w-10 h-10 rounded-lg object-cover mr-4" src="<?= $product["img"] ?>" alt="<?= $product["name"] ?>">
                    <p class="text-gray-700"><?= $product["name"] ?> x <?= $product["qty"] ?></p>
                </div>
                <div>
                    <p><?= formatRupiah($product["price"]) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="flex justify-between items-center py-4">   
            <div class="flex items-center">
                <p class="text-gray-700 font-bold">Total</p>
            </div>
            <div>
                <p><?= formatRupiah($total_price) ?></p>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

  <script>
    const tabs = document.querySelectorAll('[id^="tab"]')
    const contents = document.querySelectorAll('[id^="tab-content"]')

    tabs.forEach(tab => {
        tab.addEventListener('click', (e) => {
            e.preventDefault()
            tabs.forEach(t => t.classList.remove('border-indigo-500', 'text-indigo-600'))
            contents.forEach(c => c.classList.add('hidden'))

            tab.classList.add('border-indigo-500', 'text-indigo-600')
            document.querySelector(`#tab-content${tab.id.slice(-1)}`).classList.remove('hidden')
        })
    })
  </script>

<?= $this->endSection() ?>