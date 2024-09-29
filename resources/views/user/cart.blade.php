<x-app-layout>
    <!-- Checkout Start -->
    <section>
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-xl-6 col-lg-6 order-lg-first order-last">

                    <livewire:pages.frontend.cart.checkout />

                </div>

                <div class="col-lg-5 offset-lg-1 order-lg-last order-first">

                    <livewire:components.cart-list />

                </div>
            </div>

        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Checkout End -->
</x-app-layout>
