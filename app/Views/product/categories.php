<?= $this->extend('layout/layouts') ?>

<?= $this->section('content') ?>

<div class="container mx-auto p-6">
    
    <div class="flex flex-col md:flex-row items-start">
        <div class="w-full bg-white p-4 rounded-lg shadow-md">

            <h2 class="text-2xl font-semibold mb-4"><?= $data["category"] ?> </h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-6">

                <?php foreach($data["catalogs"] as $catalog): ?>
                    <div class="item divide-y divide-gray-200" data-price="<?= $catalog["price"] ?>">
                        <div class="flex flex-col items-start py-4 row-span-1">
                            <img class="w-32 h-32 rounded-lg mr-4" src="<?= $catalog["img"] ?>" alt="<?= $catalog["name"] ?>">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold my-2"><?= $catalog["name"] ?></h3>
                                <h4 class="text-sm my-2"><?= $catalog["desc"] ?> </h4>
                                <div class="my-2">
                                    <button aria-label="Decrease quantity" class="decrement-qty text-gray-500 hover:text-gray-700 mr-2">-</button>
                                    <span class="text-gray-700 qty">1</span>
                                    <button aria-label="Increase quantity" class="increment-qty text-gray-500 hover:text-gray-700 ml-2">+</button>
                                </div>
                            </div>
                            <div class="text-lg my-2 font-semibold price-per-item"><?= formatRupiah($catalog["price"]) ?></div>
                        </div>
                        <div class="row-span-1">
                            <a href="javascript:void(0)" data-id="<?= $catalog["id"] ?>" class="w-full add-cart-btn text-center inline-block text-white py-2 rounded-lg mt-4" style="background-color: #F46300;">
                                Add to Cart
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

  <script>

    $(".add-cart-btn").click(function(e) {
        var catId = $(this).attr('data-id')
        
        var item = $(this).closest(".item")
        var qty = parseInt(item.find(".qty").text())

        $.ajax({
            url: '<?= base_url("checkout/add-to-cart") ?>', 
            type: "POST",
            data: {
                cat_id: catId,
                qty: qty
            },
            success: function(response) {
                console.log(response)
                location.reload()
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        })
    })

    $(".increment-qty").click(function(e) {
      var item = $(this).closest(".item")
      var plus = parseInt(item.find(".qty").text()) + 1
      item.find(".qty").text(plus)
    })

    $(".decrement-qty").click(function(e) {
      var item = $(this).closest(".item")
      var currentQty = parseInt(item.find(".qty").text())
      if (currentQty != 1) { 
        var minus = currentQty - 1
        item.find(".qty").text(minus)
      }
    })

  </script>


<?= $this->endSection() ?>