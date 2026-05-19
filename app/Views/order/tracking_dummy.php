<?php 
    $uri = current_url(true);
?>

<?= $this->extend('layout/layouts') ?>

<?= $this->section('content') ?>

<div class="max-w-xl mx-auto">

    <?php if($uri->getSegment(2) == 'tracking-dummy'): ?>
        <div class="flex flex-row justify-center my-8 items-center gap-4">
            <div class="flex flex-row items-center gap-3">

                <?php if($id == ""): ?>
                    <a id="tab1" href="javascript:void(0)">
                        <img src="<?= base_url("public/assets/image/tracking/package-active.png") ?>" class="h-5" alt="Package">
                    </a>
                <?php else: ?>
                    <a id="tab1" href="javascript:void(0)">
                        <img src="<?= base_url("public/assets/image/tracking/package.png") ?>" class="h-5" alt="Package">
                    </a>
                <?php endif; ?>

                <img src="<?= base_url("public/assets/image/divider.png") ?>" class="h-1" alt="Divider">
                
                <?php if($id == "process"): ?>
                    <a id="tab2" href="javascript:void(0)">
                        <img src="<?= base_url("public/assets/image/tracking/on-process-active.png") ?>" class="h-5" alt="On Process">
                    </a>
                <?php else: ?>
                    <a id="tab2" href="javascript:void(0)">
                        <img src="<?= base_url("public/assets/image/tracking/on-process.png") ?>" class="h-5" alt="On Process">
                    </a>
                <?php endif; ?>
                
                <img src="<?= base_url("public/assets/image/divider.png") ?>" class="h-1" alt="Divider">
                
                <?php if($id == "delivery"): ?>
                    <a id="tab3" href="javascript:void(0)">
                        <img src="<?= base_url("public/assets/image/tracking/delivery-active.png") ?>" class="h-5" alt="Delivery">
                    </a>
                <?php else: ?>
                    <a id="tab3" href="javascript:void(0)">
                        <img src="<?= base_url("public/assets/image/tracking/delivery.png") ?>" class="h-5" alt="Delivery">
                    </a>
                <?php endif; ?>

                <img src="<?= base_url("public/assets/image/divider.png") ?>" class="h-1" alt="Divider">
                
                <?php if($id == "finish"): ?>
                    <a id="tab4" href="javascript:void(0)">
                        <img src="<?= base_url("public/assets/image/tracking/finish-active.png") ?>" class="h-5" alt="Finish">
                    </a>
                <?php else: ?>
                    <a id="tab4" href="javascript:void(0)">
                        <img src="<?= base_url("public/assets/image/tracking/finish.png") ?>" class="h-5" alt="Finish">
                    </a>
                <?php endif; ?>

            </div>
        </div>
    <?php endif; ?>

    <?php
      $timeline = [
        ['time' => '10:10', 'label' => 'Order Received', 'desc' => 'Order sudah masuk dan menunggu verifikasi pembayaran.'],
        ['time' => '10:20', 'label' => 'Payment Verified', 'desc' => 'Pembayaran berhasil diverifikasi oleh sistem.'],
        ['time' => '10:35', 'label' => 'Packed', 'desc' => 'Pesanan sedang dipacking di gudang.'],
        ['time' => '11:15', 'label' => 'On Delivery', 'desc' => 'Kurir membawa paket ke alamat tujuan.'],
        ['time' => '12:05', 'label' => 'Delivered', 'desc' => 'Pesanan diterima dengan baik.'],
      ];
    ?>

    <div id="tab-content1" class="p-4 bg-white rounded-lg shadow-md">
      <div class="mb-3 text-sm text-slate-600">Order received. Waiting for payment confirmation.</div>
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
          <div><p><?= formatRupiah($product["price"]) ?></p></div>
        </div>
      <?php endforeach; ?>
      <div class="flex justify-between items-center py-4"><p class="text-gray-700 font-bold">Total</p><p><?= formatRupiah($total_price) ?></p></div>
    </div>

    <div id="tab-content2" class="hidden p-4 bg-white rounded-lg shadow-md">
      <h3 class="font-semibold mb-3">Timeline - On Process</h3>
      <div class="space-y-3">
        <?php foreach (array_slice($timeline, 0, 3) as $item): ?>
          <div class="flex gap-3">
            <div class="text-xs text-slate-500 w-12"><?= $item['time'] ?></div>
            <div class="w-2 h-2 mt-1.5 bg-orange-500 rounded-full"></div>
            <div>
              <p class="text-sm font-semibold"><?= $item['label'] ?></p>
              <p class="text-xs text-slate-600"><?= $item['desc'] ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div id="tab-content3" class="hidden p-4 bg-white rounded-lg shadow-md">
      <h3 class="font-semibold mb-3">Timeline - Delivery</h3>
      <div class="space-y-3">
        <?php foreach (array_slice($timeline, 0, 4) as $item): ?>
          <div class="flex gap-3">
            <div class="text-xs text-slate-500 w-12"><?= $item['time'] ?></div>
            <div class="w-2 h-2 mt-1.5 bg-orange-500 rounded-full"></div>
            <div>
              <p class="text-sm font-semibold"><?= $item['label'] ?></p>
              <p class="text-xs text-slate-600"><?= $item['desc'] ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div id="tab-content4" class="hidden p-4 bg-white rounded-lg shadow-md">
      <h3 class="font-semibold mb-3">Timeline - Finished</h3>
      <div class="space-y-3">
        <?php foreach ($timeline as $item): ?>
          <div class="flex gap-3">
            <div class="text-xs text-slate-500 w-12"><?= $item['time'] ?></div>
            <div class="w-2 h-2 mt-1.5 bg-orange-500 rounded-full"></div>
            <div>
              <p class="text-sm font-semibold"><?= $item['label'] ?></p>
              <p class="text-xs text-slate-600"><?= $item['desc'] ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="relative h-64">
        <div class="absolute bottom-20 left-1/2 transform -translate-x-1/2 flex gap-3">
            <a href="<?= base_url() ?>" class="text-center px-8 inline-block text-white py-2 rounded-lg mt-4" style="background-color: #F46300;">
                Next Order
            </a>
            <a href="<?= base_url('/tracking-dummy') ?>" class="text-center px-8 inline-block text-white py-2 rounded-lg mt-4" style="background-color: #F46300;">
                Tracking
            </a>
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
      contents.forEach(c => c.classList.add('hidden'))
      document.querySelector(`#tab-content${tab.id.slice(-1)}`).classList.remove('hidden')
    })
  })
</script>
<?= $this->endSection() ?>
