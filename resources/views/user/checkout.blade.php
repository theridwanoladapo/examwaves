<x-app-layout>
    <!-- Checkout Start -->
    <section>
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-xl-6 col-lg-6">
                    <div class="gray-simple rounded-2 py-3 px-3">
                        <h1 class="fs-2 pb-3">Checkout</h1>

                        <h3 class="d-flex align-items-center fs-6 lh-base font--bold">Payment Method</h3>
                        <div class="form-check bg-white rounded-2 p-3 mb-4">
                            <input class="form-check-input ms-1" type="radio" name="payment" id="card" checked>
                            <label class="form-check-label ms-3" for="card">
                                <span>
                                    <span class="d-block fs-base text-dark fw-medium mb-1">Paypal</span>
                                    {{-- <span class="text-body">Mastercard, Maestro, American Express, Visa are accepted</span> --}}
                                </span>
                            </label>
                        </div>
                        <div class="form-check bg-white rounded-2 p-3 mb-4">
                            <input class="form-check-input ms-1" type="radio" name="payment" id="cash">
                            <label class="form-check-label ms-3" for="cash">
                                <span>
                                    <span class="d-block fs-base text-dark fw-medium mb-1">Stripe</span>
                                    {{-- <span class="text-body">Pay with cash upon the delivery</span> --}}
                                </span>
                            </label>
                        </div>

                        <div class="d-none d-lg-block pt-5 mt-n3">
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="save-info" checked>
                                <label class="form-check-label ms-2" for="save-info">
                                    <span class="text-muted">Your personal information will be used to process your order, to support your experience on this site and for other purposes described in the </span>
                                    <a class="fw-medium" href="#">privacy policy</a>
                                </label>
                            </div>
                            <button class="btn btn-lg btn-primary px-xl-5" type="submit">Place An Order</button>
                        </div>

                    </div>
                </div>

                <div class="col-lg-5 offset-lg-1 pt-1 pt-md-4">

                    <livewire:components.cart-list />

                </div>
            </div>

            <div class="d-lg-none pb-2 mt-2 mt-lg-0 pt-4 pt-lg-5 row">
                <div class="col-xl-12 col-lg-12">
                    <div class="d-lg-none pb-2 mt-2 mt-lg-0 pt-4 pt-lg-5">
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" checked="" id="save-info2">
                            <label class="form-check-label" for="save-info2"><span class="text-muted">Your personal information will be used to process your order, to support your experience on this site and for other purposes described in the </span><a class="fw-medium" href="#">privacy policy</a></label>
                        </div>
                        <button class="btn btn-lg btn-primary w-100 w-sm-auto" type="submit">Place an order</button>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Checkout End -->
</x-app-layout>
