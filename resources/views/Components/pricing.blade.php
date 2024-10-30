<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Pricing</title>
    <style>
        .hidden { display: none; }
        /* Adicione qualquer estilo adicional conforme necessário */
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body>
<!-- Default Mobile Version -->
<div id="mobile-version" class="hidden">
    <!-- Mobile Pricing Section Code Here -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mt-8 mb-10">
            <h1 class="text-4xl sm:text-4xl font-bold">Get started for free or pick a plan</h1>
            <p class="text-base sm:text-lg text-gray-600 mt-4">Pick the most suitable plan for your project's«</p>
        </div>

        <div class="flex justify-center mb-4">
            <div class="mx-4 text-gray-700 font-medium">Monthly</div>
            <label class="relative inline-flex items-center cursor-pointer">
                <input class="sr-only peer" value="" id="toggle-mobile" type="checkbox">
                <div class="group peer ring-2 bg-gradient-to-bl from-neutral-800 via-neutral-700 to-neutral-600 rounded-full outline-none duration-1000 after:duration-300 w-12 h-6 shadow-md peer-focus:outline-none after:content-[''] after:rounded-full after:absolute after:[background:#0D2B39] peer-checked:after:rotate-180 after:[background:conic-gradient(from_135deg,_#b2a9a9,_#b2a8a8,_#ffffff,_#d7dbd9_,_#ffffff,_#b2a8a8)] after:outline-none after:h-5 after:w-5 after:top-0.5 after:left-0.5 peer-checked:after:translate-x-6 peer-hover:after:scale-125"></div>
            </label>
            <div class="ml-3 text-gray-700 font-medium">Yearly</div>
        </div>

        <form action="/payment" method="POST" id="form" class="sm:w-full ml-10 md:w-3/4 lg:w-2/3 xl:w-1/2 mx-auto">
            <div class="flex flex-wrap gap-4">
                @csrf
                <input type="hidden" name="plano" id="plano">

                <!-- Cartão de Plano Free -->
                <div id="planoFree" class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 max-w-xs bg-white shadow-lg rounded-lg overflow-hidden mb-4 cursor-pointer" onclick="capturarConteudo('planoFree')">
                    <div class="px-6 py-4">
                        <h2 class="text-center font-bold text-xl mb-2">Plano Free</h2>
                        <div class="text-center mb-2">
                            <span id="precoFree" class="text-2xl font-bold">$0</span>
                            <span class="text-gray-500" id="durationFree">/ Monthly</span>
                        </div>
                        <p class="text-gray-500 mt-2 text-sm">Try for free with 30 images/month. We collect credit cards to prevent abuse.</p>
                    </div>
                    <div class="px-6 pt-4 pb-2">
                        <x-selecionar-button />
                    </div>
                </div>

                <!-- Cartão de Plano Normal -->
                <div id="planoNormal" class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 max-w-xs bg-white shadow-lg rounded-lg overflow-hidden mb-4 cursor-pointer" onclick="capturarConteudo('planoNormal')">
                    <div class="px-6 py-4">
                        <h2 class="text-center font-bold text-xl mb-2">Plano Normal</h2>
                        <div class="text-center mb-2">
                            <span id="precoNormal" class="text-2xl font-bold">$9.99</span>
                            <span class="text-gray-500" id="durationNormal">/ Monthly</span>
                        </div>
                        <p class="text-gray-500 text-sm mt-2 mb-5">300 images/month</p>
                    </div>
                    <div class="px-6 pt-4 pb-2">
                        <x-selecionar-button />
                    </div>
                </div>

                <!-- Cartão de Plano Básico -->
                <div id="planoBasico" class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 max-w-xs bg-white shadow-lg rounded-lg overflow-hidden mb-4 cursor-pointer" onclick="capturarConteudo('planoBasico')">
                    <div class="px-6 py-4">
                        <h2 class="text-center font-bold text-xl mb-2">Plano Básico</h2>
                        <div class="text-center mb-2">
                            <span id="precoBasico" class="text-2xl font-bold">$19.99</span>
                            <span class="text-gray-500" id="durationBasico">/ Monthly</span>
                        </div>
                        <p class="text-gray-500 text-sm mt-2 mb-5">3,000 images/month</p>
                    </div>
                    <div class="px-6 pt-4 pb-2">
                        <x-selecionar-button />
                    </div>
                </div>

                <!-- Cartão de Plano Premium -->
                <div id="planoPremium" class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 max-w-xs bg-white shadow-lg rounded-lg overflow-hidden mb-4 cursor-pointer" onclick="capturarConteudo('planoPremium')">
                    <div class="px-6 py-4">
                        <h2 class="text-center font-bold text-xl mb-2">Plano Premium</h2>
                        <div class="text-center mb-2">
                            <span id="precoPremium" class="text-2xl font-bold">$29.99</span>
                            <span class="text-gray-500" id="durationPremium">/ Monthly</span>
                        </div>
                        <p class="text-gray-500 text-sm mt-2 mb-5">30,000 images/month</p>
                    </div>
                    <div class="px-6 pt-4 pb-2 mb-2">
                        <x-selecionar-button />
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function capturarConteudo(plano) {
        document.getElementById('plano').value = plano;
    }

    document.getElementById('toggle-mobile').addEventListener('change', function() {
        const prices = {
            'precoFree': { monthly: '$0', yearly: '$0' },
            'precoNormal': { monthly: '$9.99', yearly: '$99.99' },
            'precoBasico': { monthly: '$19.99', yearly: '$199.99' },
            'precoPremium': { monthly: '$29.99', yearly: '$299.99' }
        };

        const durations = {
            'durationFree': { monthly: '/ Monthly', yearly: '/ Yearly' },
            'durationNormal': { monthly: '/ Monthly', yearly: '/ Yearly' },
            'durationBasico': { monthly: '/ Monthly', yearly: '/ Yearly' },
            'durationPremium': { monthly: '/ Monthly', yearly: '/ Yearly' }
        };

        Object.keys(prices).forEach(priceId => {
            document.getElementById(priceId).innerText = this.checked ? prices[priceId].yearly : prices[priceId].monthly;
        });

        Object.keys(durations).forEach(durationId => {
            document.getElementById(durationId).innerText = this.checked ? durations[durationId].yearly : durations[durationId].monthly;
        });

        if (this.checked) {
            document.getElementById('plano').value = 'planoPremiumAnual';
        } else {
            document.getElementById('plano').value = 'planoPremium';
        }
    });
</script>
</div>

<!-- PC Version (Hidden by Default, Shown with Media Query) -->
<div id="pc-version" class="hidden">


    <!-- PC Pricing Section Code Here -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mt-8 mb-20">
            <h1 class="text-3xl font-bold">Get started for free or pick a plan</h1>
            <p class="text-lg text-gray-600 mt-2">Cached images are not counted toward your usage, see the FAQs below for more details.</p>
        </div>

        <div class="mb-8">
            <div class="flex justify-center mb-4">
                <div class="mx-4 text-gray-700 font-medium">Monthly</div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input class="sr-only peer" value="" id="toggle-pc" type="checkbox">
                    <div class="group peer ring-2 bg-gradient-to-bl from-neutral-800 via-neutral-700 to-neutral-600 rounded-full outline-none duration-1000 after:duration-300 w-12 h-6 shadow-md peer-focus:outline-none after:content-[''] after:rounded-full after:absolute after:[background:#0D2B39] peer-checked:after:rotate-180 after:[background:conic-gradient(from_135deg,_#b2a9a9,_#b2a8a8,_#ffffff,_#d7dbd9_,_#ffffff,_#b2a8a8)] after:outline-none after:h-5 after:w-5 after:top-0.5 after:left-0.5 peer-checked:after:translate-x-6 peer-hover:after:scale-125"></div>
                </label>
                <div class="ml-3 text-gray-700 font-medium">Yearly</div>
            </div>

            <form action="/payment" method="POST" id="form" class="flex gap-4">
                @csrf
                <input type="hidden" name="plano" id="plano">

                <!-- Cartão de Plano Free -->
                <div id="planoFree" class="w-full sm:w-1/4 max-w-xs bg-white shadow-lg rounded-lg overflow-hidden mb-4 cursor-pointer" onclick="capturarConteudo('planoFree')">
                    <div class="px-6 py-4">
                        <h2 class="text-center font-bold text-xl mb-2">Plano Free</h2>
                        <div class="text-center mb-2">
                            <span id="precoFreePC" class="text-2xl font-bold">$0</span>
                            <span class="text-gray-500" id="durationFreePC">/ Monthly</span>
                        </div>
                        <p class="text-gray-500 mt-2 text-sm">Try for free with 30 images/month. We collect credit cards to prevent abuse.</p>
                    </div>
                    <div class="px-6 pt-4 pb-2">
                        <x-selecionar-button />
                    </div>
                </div>

                <!-- Cartão de Plano Normal -->
                <div id="planoNormal" class="w-full sm:w-1/4 max-w-xs bg-white shadow-lg rounded-lg overflow-hidden mb-4 cursor-pointer" onclick="capturarConteudo('planoNormal')">
                    <div class="px-6 py-4">
                        <h2 class="text-center font-bold text-xl mb-2">Plano Normal</h2>
                        <div class="text-center mb-2">
                            <span id="precoNormalPC" class="text-2xl font-bold">$9.99</span>
                            <span class="text-gray-500" id="durationNormalPC">/ Monthly</span>
                        </div>
                        <p class="text-gray-500 text-sm mt-2 mb-5">300 images/month</p>
                    </div>
                    <div class="px-6 pt-4 pb-2">
                        <x-selecionar-button />
                    </div>
                </div>

                <!-- Cartão de Plano Básico -->
                <div id="planoBasico" class="w-full sm:w-1/4 max-w-xs bg-white shadow-lg rounded-lg overflow-hidden mb-4 cursor-pointer" onclick="capturarConteudo('planoBasico')">
                    <div class="px-6 py-4">
                        <h2 class="text-center font-bold text-xl mb-2">Plano Básico</h2>
                        <div class="text-center mb-2">
                            <span id="precoBasicoPC" class="text-2xl font-bold">$19.99</span>
                            <span class="text-gray-500" id="durationBasicoPC">/ Monthly</span>
                        </div>
                        <p class="text-gray-500 text-sm mt-2 mb-5">3,000 images/month</p>
                    </div>
                    <div class="px-6 pt-4 pb-2">
                        <x-selecionar-button />
                    </div>
                </div>

                <!-- Cartão de Plano Premium -->
                <div id="planoPremium" class="w-full sm:w-1/4 max-w-xs bg-white shadow-lg rounded-lg overflow-hidden mb-4 cursor-pointer" onclick="capturarConteudo('planoPremium')">
                    <div class="px-6 py-4">
                        <h2 class="text-center font-bold text-xl mb-2">Plano Premium</h2>
                        <div class="text-center mb-2">
                            <span id="precoPremiumPC" class="text-2xl font-bold">$29.99</span>
                            <span class="text-gray-500" id="durationPremiumPC">/ Monthly</span>
                        </div>
                        <p class="text-gray-500 text-sm mt-2 mb-5">30,000 images/month</p>
                    </div>
                    <div class="px-6 pt-4 pb-2 mb-2">
                        <x-selecionar-button />
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function capturarConteudo(plano) {
            document.getElementById('plano').value = plano;
        }

        document.getElementById('toggle-pc').addEventListener('change', function() {
            console.log('toggle-pc change event');
            const prices = {
                'precoFreePC': { monthly: '$0', yearly: '$0' },
                'precoNormalPC': { monthly: '$9.99', yearly: '$99.99' },
                'precoBasicoPC': { monthly: '$19.99', yearly: '$199.99' },
                'precoPremiumPC': { monthly: '$29.99', yearly: '$299.99' }
            };

            const durations = {
                'durationFreePC': { monthly: '/ Monthly', yearly: '/ Yearly' },
                'durationNormalPC': { monthly: '/ Monthly', yearly: '/ Yearly' },
                'durationBasicoPC': { monthly: '/ Monthly', yearly: '/ Yearly' },
                'durationPremiumPC': { monthly: '/ Monthly', yearly: '/ Yearly' }
            };

            Object.keys(prices).forEach(priceId => {
                document.getElementById(priceId).innerText = this.checked ? prices[priceId].yearly : prices[priceId].monthly;
            });

            Object.keys(durations).forEach(durationId => {
                document.getElementById(durationId).innerText = this.checked ? durations[durationId].yearly : durations[durationId].monthly;
            });

            if (this.checked) {
                document.getElementById('plano').value = 'planoPremiumAnual';
            } else {
                document.getElementById('plano').value = 'planoPremium';
            }
        });
    </script>
</div>

<script>
    // JavaScript to switch between mobile and PC versions based on screen size
    function toggleVersion() {
        const mobileVersion = document.getElementById('mobile-version');
        const pcVersion = document.getElementById('pc-version');
        const isMobile = window.innerWidth <= 1024; // Ajuste este breakpoint conforme necessário

        if (isMobile) {
            mobileVersion.classList.remove('hidden');
            pcVersion.classList.add('hidden');
        } else {
            mobileVersion.classList.add('hidden');
            pcVersion.classList.remove('hidden');
        }
    }

    // Initial check and toggle on page load
    toggleVersion();

    // Listen for window resize events to toggle between versions
    window.addEventListener('resize', toggleVersion);

</script>
</body>
</html>
