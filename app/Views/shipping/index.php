<?= $this->extend('layout/layouts') ?>

<?= $this->section('content') ?>

<div class="container mx-auto p-6">

    <div class="flex flex-col md:flex-row gap-6 items-start">

        <div class="w-full md:w-3/5 lg:col-span-2 bg-white p-4 rounded-lg shadow-md">
            
            <div class="flex justify-between">
                <h2 class="text-2xl font-semibold mb-4">My Orders</h2>
            </div>
            
            <?php foreach($products as $item): ?>
                <div class="divide-y divide-gray-200">
                    <div class="flex items-center py-4">
                        <img class="w-24 h-24 rounded-lg object-cover mr-4" src="<?= $item["img"] ?>" alt="Ikan Segar">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold"><?= $item["name"] ?> </h3>
                            <p>
                                x <?= $item["qty"] ?>
                            </p>
                        </div>
                        <div class="text-lg font-semibold"><?= formatRupiah($item["price"]) ?></div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <div class="w-full md:w-2/5 flex items-center justify-center">

            <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">

                <h2 class="text-2xl font-bold mb-6 text-center">For further processing, please fill in the data below.</h2>

                <form>
                    <div class="mb-4">
                        <label for="fullname" class="block text-gray-700 font-medium mb-2">Full Name *</label>
                        <input type="text" id="fullname" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="Enter your full name">
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 font-medium mb-2">Phone Number *</label>
                        <input type="tel" id="phone" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="Enter your phone number">
                    </div>


                    <div class="mb-4">
                        <label for="select-province" class="block text-gray-700 font-medum mb-2">Province *</label>
                        <select name="select-province" id="select-province" class="bg-white block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="null">Select Province</option>
                            <?php foreach ($provinces as $province): ?>
                                <option value="<?= $province["province_id"] ?>-<?= $province["province_name"] ?>"><?= $province["province_name"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="select-city" class="block text-gray-700 font-medum mb-2">City *</label>
                        <select name="select-city" id="select-city" class="bg-white block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
          
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="select-postal-code" class="block text-gray-700 font-medum mb-2">Postal Code *</label>
                        <select name="select-postal-code" id="select-postal-code" class="bg-white block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 font-medium mb-2">Address *</label>
                        <textarea id="address" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200" rows="5" placeholder="Enter your address"></textarea>
                    </div>

                    <div class="text-center">
                        <a href="javascript:void(0)" id="btn-submit" class="w-full inline-block text-white p-2 rounded-lg hover:bg-blue-600 focus:outline-none" style="background-color: #F46300;">Next</a>
                    </div>
                </form>

            </div>

        </div>

    </div>


</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

    <script>
        
        var getCityBaseUrl = '<?= base_url('shipping/get-city') ?>'
        var savePersonalInfoBaseUrl = '<?= base_url('shipping/save-personal-info') ?>'

        $("#select-province").on("change", function(e) {
            var provinceId = $(this).val().split('-')[0]
            var city = $("#select-city")
            var postalCode = $("#select-postal-code")

            city.html("")
            postalCode.html("")
            
            $.ajax({
                url: getCityBaseUrl, 
                type: "POST",
                data: {
                    province_id: provinceId,
                },
                success: function(response) {
                    var data = response.data

                    for (const i in data) {
                        var item = data[i]

                        var cityName = item.city_name 
                        var pc = item.postal_code

                        city.append(`<option value='${pc}-${cityName}'> ${cityName} </option>`)
                        postalCode.append(`<option readonly value='${pc}'> ${pc} </option>`)
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error)
                }
            })
        })

        $("#select-city").on("change", function(e) {
            var postalCode = $(this).val()
            var selectPostalCode = $("#select-postal-code")

            selectPostalCode.html("")
            selectPostalCode.append(`<option readonly value='${postalCode.split('-')[0]}'> ${postalCode.split('-')[0]} </option>`)
        })

        $("#btn-submit").click(function(e) {
            e.preventDefault()

            var fullname = $("#fullname").val()
            var phone = $("#phone").val()
            var address = $("#address").val()

            var province = $("#select-province").val().split('-')[1]
            var city = $("#select-city").val().split('-')[1]
            var postalCode = $("#select-postal-code").val()

            if(fullname.trim() == "") {
                alert("Field full name is required")
                return
            }

            if(phone.trim() == "") {
                alert("Field phone is required")
                return
            }

            if(address.trim() == "") {
                alert("Field address is required")
                return
            }

            if(province.trim() == "" || province.trim() == "null") {
                alert("Field province is required")
                return 
            }

            if(city.trim() == "") {
                alert("Field city is required")
                return
            }

            if(postalCode.trim() == "") {
                alert("Field postal code is required")
                return
            }

            $.ajax({
                url: savePersonalInfoBaseUrl, 
                type: "POST",
                data: {
                    fullname: fullname,
                    phone: phone,
                    address: address,
                    province: province, 
                    city: city, 
                    postal_code: postalCode
                },
                success: function(response) {
                    console.log(response)
                    location.href = "<?= base_url("checkout") ?> "
                },
                error: function(xhr, status, error) {
                    console.error(error)
                }
            })
        })

    </script>

<?= $this->endSection() ?>