<?= $this->extend('layout/layouts') ?>

<?= $this->section('content') ?>

<div class="container mx-auto p-6">

    <div class="flex flex-col md:flex-row gap-6 items-start">

      <div class="w-full bg-white p-4 rounded-lg shadow-md">
        <div class="flex justify-between">
          <h2 class="text-2xl font-semibold mb-4"></h2>
        </div>

        <div class="item divide-y divide-gray-200" data-price="<?= $data["price"] ?>">
            <div class="flex items-center py-4">
              <img class="w-24 h-24 rounded-lg object-cover mr-4" src="<?= $data["img"] ?>" alt="<?= $data["name"] ?>">
              <div class="flex-1">
                <h3 class="text-lg font-semibold"><?= $data["name"] ?></h3>
                <h4 class="text-sm"><?= $data["desc"] ?> </h4>
                <div class="mt-2">
                  <button aria-label="Decrease quantity" class="decrement-qty text-gray-500 hover:text-gray-700 mr-2">-</button>
                    <span class="text-gray-700 qty">1</span>
                  <button aria-label="Increase quantity" class="increment-qty text-gray-500 hover:text-gray-700 ml-2">+</button>
                </div>
              </div>
              <div class="text-lg font-semibold price-per-item"><?= formatRupiah($data["price"]) ?></div>
            </div>
             <a href="javascript:void(0)" id="add-cart-btn" class="w-full text-center inline-block text-white py-2 rounded-lg mt-4" style="background-color: #F46300;">
              Add to Cart
            </a>
        </div>

      </div>

    </div>
  </div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

  <script>

    $("#add-cart-btn").click(function(e) {

      var catId = '<?= $data['id'] ?>'
      var qty = parseInt($(".qty").text())

      $.ajax({
        url: '<?= base_url("checkout/add-to-cart") ?>', 
        type: "POST",
        data: {
          cat_id: catId,
          qty: qty
        },
        success: function(response) {
          console.log(response)
          location.href = "<?= base_url() ?>"
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