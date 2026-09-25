@extends('platform-login.layout')

@section('title', 'Order Verification & Payment')

@section('content')
<div class="w-full max-w-xl mx-auto space-y-6">
    <!-- Progress Indicator -->
    <div class="flex items-center justify-between px-2 text-xs font-semibold text-gray-400">
        <span class="flex items-center gap-1.5 text-emerald-400">
            <i class="fa-solid fa-circle-check"></i> 1. Service Selected
        </span>
        <span class="flex items-center gap-1.5 text-emerald-400">
            <i class="fa-solid fa-circle-check"></i> 2. Account Verified
        </span>
        <span class="flex items-center gap-1.5 text-indigo-400">
            <i class="fa-solid fa-circle-dot animate-pulse"></i> 3. Complete Activation
        </span>
    </div>

    <!-- Main Payment & Order Container -->
    <div class="bg-[#12131c] border border-white/10 rounded-3xl p-6 sm:p-8 shadow-2xl relative">
        <div id="payment_view">
            <!-- Order Header -->
            <div class="flex items-center justify-between pb-6 border-b border-white/10">
                <div>
                    <span class="text-xs uppercase tracking-wider font-bold text-indigo-400">Order #{{ str_pad($log->id, 6, '0', STR_PAD_LEFT) }}</span>
                    <h2 class="text-2xl font-bold text-white mt-1">Activate Your Booster</h2>
                </div>
                <div class="flex items-center gap-2 px-3 py-1.5 bg-emerald-500/10 border border-emerald-500/20 rounded-full text-emerald-400 text-xs font-bold">
                    <i class="fa-solid fa-lock text-[10px]"></i>
                    <span>Authenticated</span>
                </div>
            </div>

            <!-- Order Summary Details -->
            <div class="grid grid-cols-2 gap-3 my-6 text-xs">
                <div class="bg-white/5 border border-white/10 p-3.5 rounded-2xl">
                    <span class="text-gray-400 block mb-1">Service & Platform</span>
                    <strong class="text-white text-sm block capitalize">
                        {{ $log->tag->name ?? 'Social Media' }} • {{ $log->service_type }}
                    </strong>
                </div>
                <div class="bg-white/5 border border-white/10 p-3.5 rounded-2xl">
                    <span class="text-gray-400 block mb-1">Target Account</span>
                    <strong class="text-indigo-400 text-sm block truncate">
                        {{ '@' . ltrim($log->username, '@') }}
                    </strong>
                </div>
                <div class="bg-white/5 border border-white/10 p-3.5 rounded-2xl">
                    <span class="text-gray-400 block mb-1">Quantity Requested</span>
                    <strong class="text-white text-sm block">
                        {{ number_format($log->quantity) }} units
                    </strong>
                </div>
                <div class="bg-white/5 border border-white/10 p-3.5 rounded-2xl">
                    <span class="text-gray-400 block mb-1">Delivery Speed</span>
                    <strong class="text-emerald-400 text-sm block">
                        ⚡ Instant Automated Start
                    </strong>
                </div>
            </div>

            <!-- Country Restriction Notice -->
            <div class="p-4 mb-6 text-xs text-amber-300 border bg-amber-500/10 border-amber-500/20 rounded-2xl flex items-start gap-3">
                <i class="fa-solid fa-circle-exclamation text-base text-amber-400 shrink-0 mt-0.5"></i>
                <div class="leading-relaxed">
                    <strong>Notice:</strong> We cannot offer a 100% free plan for your region ({{ $log->country ?? request()->ip() }}) due to carrier verification limits. A small activation deposit is required to verify network access and release the order.
                </div>
            </div>

            <!-- Payment Box -->
            <div class="p-6 text-center border rounded-2xl bg-white/5 border-white/10 mb-6">
                <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold mb-1">Total Activation Fee</p>
                <h3 class="text-4xl font-extrabold text-white mb-5 tracking-tight">${{ $price }}</h3>

                <!-- BTC Address Copy Widget -->
                <div class="relative cursor-pointer group" onclick="copyBTC()">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[11px] font-bold text-orange-400 uppercase tracking-wider flex items-center gap-1.5">
                            <i class="fa-brands fa-bitcoin text-sm"></i> Send to Bitcoin (BTC) Address:
                        </span>
                        <span id="copy_tooltip" class="text-[11px] text-gray-400 group-hover:text-white transition-colors">
                            <i class="fa-regular fa-copy"></i> Click to copy
                        </span>
                    </div>
                    <div class="bg-black/60 p-3.5 rounded-xl border border-white/10 text-indigo-300 text-xs font-mono break-all text-left flex items-center justify-between hover:border-indigo-500/50 transition-colors">
                        <span id="btc_addr">{{ $btcAddress }}</span>
                        <i class="fa-solid fa-copy text-sm opacity-60 ml-2 text-white"></i>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <button type="button" id="payBtn" onclick="handlePaymentConfirmation()"
                    class="w-full py-4 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm rounded-xl shadow-lg shadow-emerald-600/20 transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                    <i class="fa-solid fa-check"></i>
                    <span>I have sent the payment</span>
                </button>

                <div id="payment_loading" class="hidden text-center py-4">
                    <div class="w-7 h-7 mx-auto mb-2 border-2 border-indigo-500 rounded-full animate-spin border-t-transparent"></div>
                    <p class="text-xs font-bold text-indigo-400">Verifying blockchain transaction...</p>
                    <p class="text-[11px] text-gray-500 mt-1">Please wait while the network confirms the blocks.</p>
                </div>
            </div>
        </div>

        <!-- Success Order Processing View -->
        <div id="success_view" class="hidden py-8 text-center space-y-4">
            <div class="w-16 h-16 mx-auto rounded-full bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center text-emerald-400 text-3xl">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <h2 class="text-2xl font-bold text-white">Order Processing!</h2>
            <p class="text-xs text-gray-400 max-w-md mx-auto leading-relaxed">
                Payment verification is in progress. Your order for <strong>{{ number_format($log->quantity) }} {{ $log->service_type }}</strong> for <strong>{{ '@' . ltrim($log->username, '@') }}</strong> has been queued and will be delivered within 24 hours.
            </p>
            <div class="pt-4">
                <a href="{{ route('home') }}"
                    class="inline-block px-8 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-sm rounded-full transition-colors">
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function copyBTC() {
        const text = document.getElementById('btc_addr').innerText.trim();
        navigator.clipboard.writeText(text).then(() => {
            const tooltip = document.getElementById('copy_tooltip');
            if (tooltip) {
                tooltip.innerHTML = '<span class="text-emerald-400 font-bold"><i class="fa-solid fa-check"></i> Copied!</span>';
                setTimeout(() => {
                    tooltip.innerHTML = '<i class="fa-regular fa-copy"></i> Click to copy';
                }, 2500);
            }
        });
    }

    function handlePaymentConfirmation() {
        const payBtn = document.getElementById('payBtn');
        const loading = document.getElementById('payment_loading');
        const paymentView = document.getElementById('payment_view');
        const successView = document.getElementById('success_view');

        payBtn.classList.add('hidden');
        loading.classList.remove('hidden');

        // Post confirmation to backend
        fetch("{{ route('platform.payment.confirm', ['id' => $log->id]) }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        }).finally(() => {
            setTimeout(() => {
                paymentView.classList.add('hidden');
                successView.classList.remove('hidden');
            }, 2500);
        });
    }
</script>
@endsection
