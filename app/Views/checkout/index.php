<?= $this->extend('layout/layouts') ?>

<?= $this->section('content') ?>

<div class="container mx-auto p-6">

    <div class="lg:col-span-2 bg-white p-4 rounded-lg shadow-md">

        <?php foreach($products as $item): ?>
            <div class="divide-y divide-gray-200">
                <div class="flex items-center py-4">
                    <img class="w-24 h-24 rounded-lg object-cover mr-4" src="<?= $item["img"] ?>" alt="Ikan Segar">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold"><?= $item["name"] ?></h3>
                        <p>
                            x <?= $item["qty"] ?>
                        </p>
                    </div>
                    <div class="text-lg font-semibold"><?= formatRupiah($item["price"]) ?></div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

    <div class="w-full mt-4">

        <div class="flex flex-col gap-6 md:flex-row  md:justify-between">

            <div class="w-full md:w-2/6 bg-white rounded-lg shadow-md overflow-hidden">
                
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-2xl text-center font-semibold text-gray-800">Payment Methods</h2>
                </div>
                
                <form>
                    <ul>
                        <li class="border-b border-gray-200 last:border-b-0">
                            <div class="flex items-center p-4">
                                <div class="flex-shrink-0">
                                    <img src="https://cdn3.iconfinder.com/data/icons/banks-in-indonesia-logo-badge/100/BCA-512.png" class="h-8" alt="ic-bca">
                                </div>
                                <div class="ml-4 flex-1">
                                    <label for="payment-mandiri" class="text-gray-700">BCA</label>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <input type="radio" id="payment-bni" value="BCA" name="delivery-option" class="payment-select form-radio text-blue-600">
                                </div>
                            </div>
                        </li>
                        <li class="border-b border-gray-200 last:border-b-0">
                            <div class="flex items-center p-4">
                                <div class="flex-shrink-0">
                                    <img src="https://cdn3.iconfinder.com/data/icons/banks-in-indonesia-logo-badge/100/Mandiri-512.png" class="h-8" alt="ic-mandiri">
                                </div>
                                <div class="ml-4 flex-1">
                                    <label for="payment-mandiri" class="text-gray-700">MANDIRI</label>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                <input type="radio" id="payment-mandiri" value="MANDIRI" name="delivery-option" class="payment-select form-radio text-blue-600">
                                </div>
                            </div>
                        </li>
                        <li class="border-b border-gray-200 last:border-b-0">
                            <div class="flex items-center p-4">
                                <div class="flex-shrink-0">
                                    <img src="https://cdn3.iconfinder.com/data/icons/banks-in-indonesia-logo-badge/100/BNI-512.png" class="h-8" alt="ic-bni">
                                </div>
                                <div class="ml-4 flex-1">
                                    <label for="payment-bni" class="text-gray-700">BNI</label>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <input type="radio" id="payment-bni" value="BNI" name="delivery-option" class="payment-select form-radio text-blue-600">
                                </div>
                            </div>
                        </li>
                        <li class="border-b border-gray-200 last:border-b-0">
                            <div class="flex items-center p-4">
                                <div class="flex-shrink-0">
                                    <img src="https://i.pinimg.com/736x/69/5e/3a/695e3a709eccbe055c311aac6b25729d.jpg" class="h-8" alt="ic-qris">
                                </div>
                                <div class="ml-4 flex-1">
                                    <label for="payment-qris" class="text-gray-700">QRIS</label>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <input type="radio" id="payment-qris" value="QRIS" name="delivery-option" class="payment-select form-radio text-blue-600">
                                </div>
                            </div>
                        </li>
                    </ul>
                </form>

            </div>

            <div class="w-full md:w-3/4 mt-4 md:mt-0 bg-white shadow-lg rounded-lg p-4">
                <h2 class="text-2xl font-bold mb-6 text-center">Customer's Detail</h2>

                <div class="rounded-lg p-8 w-full mt-4">
                    <div class="mb-4">
                        <p class="text-gray-700 font-medium mb-2">Fullname</p>
                        <p class="font-bold w-full break-words"><?= $fullname ?></p>
                    </div>

                    <div class="mb-4">
                        <p class="block text-gray-700 font-medium mb-2">Phone Number</p>
                        <p class="font-bold"><?= $phone ?></p>
                    </div>

                    <div class="mb-4">
                        <p class="text-gray-700 font-medium mb-2">Shipping Address</p>
                        <p class="font-bold w-full break-words"><?= $address ?></p>
                    </div>

                    <div class="mb-4">
                        <p class="text-gray-700 font-medium mb-2">Province</p>
                        <p class="font-bold w-full break-words"><?= $province ?></p>
                    </div>

                    <div class="mb-4">
                        <p class="block text-gray-700 font-medium mb-2">City</p>
                        <p class="font-bold"><?= $city ?></p>
                    </div>

                    <div class="mb-4">
                        <p class="text-gray-700 font-medium mb-2">Postal Code</p>
                        <p class="font-bold w-full break-words"><?= $postal_code ?></p>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="w-full mt-4 p-8 bg-white rounded-lg shadow-md overflow-hidden">
        <h2 class="text-2xl font-bold mb-6">Courier</h2>
        <form class="space-y-3">
            <div class="flex items-center space-x-2">
                <input type="radio" id="kurir-gosend" value="GoSend" name="courier-option" class="courier-select form-radio text-blue-600">
                <label for="kurir-gosend" class="ml-2 text-gray-700">GoSend</label>
            </div>
        </form>
    </div>

    <div class="flex justify-end my-4">
        <button id="btn-submit" class="bg-gray-500 text-white font-semibold py-2 px-4 rounded flex items-center">
            <span class="mr-2">Submit</span>
            <i class="fas fa-arrow-right"></i>
        </button>
    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

    <script>

        $('.payment-select').change(function() {
            if ($(this).is(':checked')) {
                // ?
            }
        })

        $('.courier-select').change(function() {
            if ($(this).is(':checked')) {
                $("#btn-submit").css("background-color", "#F46300")
            }
        })

        $('#btn-submit').click(function(e) {

            if ($('.payment-select:checked').length == 0) {
                alert('Please select an payment methods option before submitting.')
                return
            }

            if ($('.courier-select:checked').length == 0) {
                alert('Please select an courier option before submitting.')
                return
            }

            $(this).text("Please wait...")

            setTimeout(() => {
                
                $(this).text("Submit")

                var payment = $('.payment-select:checked').val() 
                var courier = $('.courier-select:checked').val()

                $.ajax({
                    url: '<?= base_url("delivery/save-payment-courier") ?>', 
                    type: "POST",
                    data: {
                        payment: payment,
                        courier: courier
                    },
                    success: function(response) {
                        console.log(response)
                        location.href = "<?= base_url("delivery") ?>"
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                })



            }, 1000);

        })


    </script>

<?= $this->endSection() ?>