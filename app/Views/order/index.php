<?= $this->extend('layout/layouts') ?>

<?= $this->section('content') ?>

<div class="container mx-auto p-6">

    <div class="flex flex-col md:flex-row gap-6 items-start">

      <div class="w-full md:w-3/5 bg-white p-4 rounded-lg shadow-md">
        <div class="flex justify-between">
          <h2 class="text-2xl font-semibold mb-4">My Orders</h2>
          <img src="<?= base_url("/assets/image/ic-scan.png") ?>" id="start-scan" class="h-12 cursor-pointer" alt="ic-scan">
        </div>

        <?php foreach($data as $item): ?>
          <div class="item divide-y divide-gray-200" data-price="<?= $item["price"] ?>">
            <div class="py-4">
              <div class="flex items-start gap-3">
                <img class="w-20 h-20 md:w-24 md:h-24 rounded-lg object-cover flex-shrink-0" src="<?= $item["img"] ?>" alt="<?= $item["name"] ?>">

                <div class="flex-1 min-w-0">
                  <input id="item-id" type="hidden" name="id" value="<?= $item["id"] ?>">
                  <h3 class="text-base md:text-lg font-semibold leading-snug break-words" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                    <?= $item["name"] ?>
                  </h3>

                  <div class="mt-3 inline-flex items-center gap-3 rounded-lg border border-gray-200 px-3 py-1">
                    <button aria-label="Decrease quantity" class="decrement-qty text-gray-500 hover:text-gray-700 text-lg leading-none">-</button>
                    <span class="text-gray-700 qty min-w-[14px] text-center"><?= $item["qty"] ?></span>
                    <button aria-label="Increase quantity" class="increment-qty text-gray-500 hover:text-gray-700 text-lg leading-none">+</button>
                  </div>
                </div>

                <div class="flex flex-col items-end gap-3 flex-shrink-0">
                  <div class="text-base md:text-lg font-semibold price-per-item text-right"><?= formatRupiah($item["price"]) ?></div>
                  <button class="text-red-500 hover:text-red-700 remove-cart" data-id="<?= $item["id"] ?>" aria-label="Hapus item" title="Hapus item">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h8" />
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>

      </div>

      <div class="w-full md:w-2/5 bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Summary</h2>
        <div class="flex justify-between mb-2">
          <span class="text-gray-500">Subtotal</span>
          <span class="text-gray-700 total-price"><?= formatRupiah($totalprice) ?></span>
        </div>
        <div class="border-t border-gray-200 my-2"></div>
        <div class="flex justify-between font-bold text-lg">
          <span>Total</span>
          <span class="total-price"><?= formatRupiah($totalprice) ?></span>
        </div>
        <a href="javascript:void(0)" id="checkout-btn" class="w-full text-center inline-block text-white py-2 rounded-lg mt-4" style="background-color: #F46300;">
          Checkout
        </a>
      </div>

    </div>
  </div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

  <script>

    var dataArr = []

    function formatCurrencyIDR(amount) {
      return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
      }).format(amount);
    }

    // function updateTotalPrice(item) {
    //   var pricePerItem = parseInt(item.data("price"))
    //   var quantity = parseInt(item.find(".qty").text())
    //   var totalPrice = pricePerItem * quantity
      
    //   $(".total-price").text(totalPrice);
    // }

    function updateSummary() {
      var totalQuantity = 0
      var totalPrice = 0

      $(".item").each(function() {
        var item = $(this)
        var quantity = parseInt(item.find(".qty").text())
        var pricePerItem = parseInt(item.data("price"))
        var itemTotalPrice = quantity * pricePerItem

        totalQuantity += quantity
        totalPrice += itemTotalPrice
      })

      $(".total-price").text(formatCurrencyIDR(totalPrice))
    }

    $("#checkout-btn").click(function(e) {
      var totalQuantity = 0
      var totalPrice = 0
      
      $(".item").each(function() {
        var item = $(this)
        var id = item.find("#item-id").val()
        var pricePerItem = parseInt(item.data("price"));
        var quantity = parseInt(item.find(".qty").text())

        var itemTotalPrice = quantity * pricePerItem

        totalQuantity += quantity
        totalPrice += itemTotalPrice

        dataArr.push({
          "id": parseInt(id),
          "qty": parseInt(quantity)
        })
      })

      $.ajax({
        url: '<?= base_url("checkout/checkout-order") ?>', 
        type: "POST",
        data: {
          total_qty: parseInt(totalQuantity),
          total_price: parseInt(totalPrice),
          data: dataArr
        },
        success: function(response) {
          console.log(response)
          location.href = "<?= base_url("/shipping") ?>"
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
      updateSummary()
      // updateTotalPrice(item)
    })

    $(".decrement-qty").click(function(e) {
      var item = $(this).closest(".item")
      var currentQty = parseInt(item.find(".qty").text())
      if (currentQty != 1) { 
        var minus = currentQty - 1
        item.find(".qty").text(minus)
        updateSummary()
        // updateTotalPrice(item)
      }
    })

    $(".remove-cart").click(function(e) {
        var id = $(this).data('id')

        $.ajax({
          url: '<?= base_url("/remove-cart") ?>', 
          type: "POST",
          data: {
            cat_id: id,
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

      document.getElementById('start-scan').addEventListener('click', function() {
        document.getElementById('reader').style.display = 'block'

        const html5QrCode = new Html5Qrcode("reader")

        html5QrCode.start({ facingMode: "environment" }, {
          fps: 10, 
          qrbox: {
            width: 250, 
            height: 250 
          } 
        },
        qrCodeMessage => {
          location.href = qrCodeMessage
          html5QrCode.stop()
          document.getElementById('reader').style.display = 'none'
        },
        errorMessage => {
          console.log(`Scan error: ${errorMessage}`)
        }
        ).catch(err => {
        console.error(`Unable to start scanning: ${err}`)
      })
    })
            
  </script>


<?= $this->endSection() ?>









