<?= $this->extend('layout/layouts') ?>

<?= $this->section('content') ?>

<div class="max-w-xl mx-auto p-4">
    <div class="p-5 bg-white rounded-2xl shadow-md border border-slate-100">
        <div class="flex items-start justify-between gap-3 mb-4">
            <div>
                <h3 class="text-xl font-bold">Live Tracking</h3>
                <p class="text-xs text-slate-500">Powered by Biteship-style dummy</p>
            </div>
            <span class="text-xs font-semibold px-2 py-1 rounded-full bg-blue-100 text-blue-700">Dummy Live</span>
        </div>

        <div class="bg-slate-50 rounded-xl p-3 mb-4 border border-slate-200">
            <div class="flex items-center justify-between text-sm">
                <div>
                    <p class="text-slate-500 text-xs">Courier</p>
                    <p id="courier-name" class="font-semibold">GoSend - Instant</p>
                </div>
                <div class="text-right">
                    <p class="text-slate-500 text-xs">Tracking ID</p>
                    <div class="flex items-center justify-end gap-2">
                      <p id="tracking-id" class="font-semibold">BTS-DUMMY-24001</p>
                      <button id="copy-tracking" class="text-xs px-2 py-1 rounded bg-slate-200 hover:bg-slate-300">Copy</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                <div id="tracking-progress" class="bg-green-500 h-2 rounded-full transition-all duration-700" style="width: 0%"></div>
            </div>
            <p id="tracking-current" class="text-sm text-gray-600 mt-2">Menunggu update...</p>
        </div>

        <div class="rounded-xl overflow-hidden border border-slate-200 mb-4">
            <iframe
              title="Dummy live map"
              class="w-full h-52"
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
              src="https://maps.google.com/maps?q=-6.200000,106.816666&z=13&output=embed">
            </iframe>
        </div>

        <div id="timeline-list" class="space-y-3 text-sm"></div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  const trackingSteps = [
    { key: 'received',  label: 'Order received by merchant',   icon: '✅', note: 'Pesanan masuk ke sistem.' },
    { key: 'verified',  label: 'Payment verified', icon: '✅', note: 'Pembayaran sukses diverifikasi.' },
    { key: 'packed',    label: 'Package prepared', icon: '📦', note: 'Paket selesai dipacking.' },
    { key: 'delivery',  label: 'Courier on the way', icon: '🚚', note: 'Kurir menuju alamat tujuan.' },
    { key: 'delivered', label: 'Package delivered', icon: '🎉', note: 'Pesanan diterima customer.' }
  ]

  let currentStep = 0
  const startTime = new Date()

  function fmtTime(date) {
    return date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })
  }

  function renderTimeline() {
    const list = document.getElementById('timeline-list')
    const progress = document.getElementById('tracking-progress')
    const current = document.getElementById('tracking-current')

    const percent = ((currentStep + 1) / trackingSteps.length) * 100
    progress.style.width = `${percent}%`

    current.textContent = `Status sekarang: ${trackingSteps[currentStep].label}`

    list.innerHTML = trackingSteps.map((step, index) => {
      const done = index <= currentStep
      const time = new Date(startTime.getTime() + index * 3 * 60 * 1000)

      return `
        <div class="flex gap-3 ${done ? '' : 'opacity-40'} items-start border-b border-slate-100 pb-2">
          <span class="text-slate-500 w-14 mt-0.5">${fmtTime(time)}</span>
          <div>
            <p class="font-medium">${step.icon} ${step.label}</p>
            <p class="text-xs text-slate-500">${step.note}</p>
          </div>
        </div>
      `
    }).join('')
  }

  document.getElementById('copy-tracking').addEventListener('click', async () => {
    try {
      await navigator.clipboard.writeText(document.getElementById('tracking-id').textContent || '')
      document.getElementById('copy-tracking').textContent = 'Copied'
      setTimeout(() => { document.getElementById('copy-tracking').textContent = 'Copy' }, 1200)
    } catch (e) {}
  })

  renderTimeline()

  const interval = setInterval(() => {
    if (currentStep < trackingSteps.length - 1) {
      currentStep += 1
      renderTimeline()
    } else {
      clearInterval(interval)
    }
  }, 5000)
</script>
<?= $this->endSection() ?>
