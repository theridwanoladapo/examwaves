<x-app-layout>
    <!-- Checkout Start -->
    <section>
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-xl-5 col-lg-5 order-lg-last order-first">

                    <div class="gray-simple rounded-2 py-3 px-4 mt-5 mt-lg-2 ">
                        <h1 class="fs-2 pb-3">Checkout</h1>

                        <div class="p-3 border rounded bg-white">
                            <script src="https://www.paypal.com/sdk/js?client-id=BAAKwwabOehWBbX527CK1hM-qZ6G4z4fu8NN6BfA9ZZN85TNBcIl1dpqvJqKGoYeM2akNZli7tplQNCsRQ&components=hosted-buttons&disable-funding=venmo&currency=USD"></script>
                            <div id="paypal-container-RTFP9Q9DUQDWC"></div>
                            <script>
                            paypal.HostedButtons({
                                hostedButtonId: "RTFP9Q9DUQDWC",
                            }).render("#paypal-container-RTFP9Q9DUQDWC")
                            </script>
                        </div>

                    </div>

                </div>

                <div class="col-xl-7 col-lg-7 order-lg-first order-last">

                    <div class="py-3 py-md-3 px-3">
                        <div class="d-sm-flex align-items-center pb-4">
                            <div class="w-100 pt-1">
                                <div class="">
                                    <div class="d-flex justify-content-between">
                                        <div class="me-3">
                                            <h3 class="">
                                                <a href="{{ route('certifications.view', $item->id) }}">
                                                    {{ $item->title }} {{ $item->code ? '('.$item->code.')' : null }}</a>
                                            </h3>
                                            <div class="d-flex flex-wrap align-items-center justify-content-between border-bottom mb-4">
                                                <div class="d-flex align-items-center mb-4 me-4">
                                                    <span class="fs-sm me-2">Exam Provider:</span>
                                                    <a class="text-primary position-relative fw-semibold p-0" href="{{ route('providers.view', $item->exam->id) }}" data-scroll=""
                                                        data-scroll-offset="80">
                                                        {{ $item->exam->name }}
                                                        <span class="d-block position-absolute start-0 bottom-0 w-100"
                                                            style="background-color: currentColor; height: 1px;"></span>
                                                    </a>
                                                </div>
                                                <div class="d-flex align-items-baseline mb-4 me-4">
                                                    <span class="fs-sm me-2">Rating:</span>
                                                    <span class="fs-sm me-1 h5 text-dark font--bold mb-0">
                                                        {{-- {{ $item->averageRating() }} --}}
                                                        <div class="rateyo"
                                                        data-rateyo-rating="{{ $item->averageRating() ?? 0 }}"
                                                        data-rateyo-num-stars="5"
                                                        data-rateyo-score="{{ $item->averageRating() ?? 0 }}"></div>
                                                    </span>
                                                    <span class="fs-sm me-2">by {{ $item->countComments() }} users</span>
                                                </div>
                                            </div>
                                            <div class="text-end ms-auto">
                                                <p class="font--bold h6 mb-2">Price:</p>
                                                <h5 class="font--bold">${{ number_format($item->price, 2) }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Checkout End -->


    <script>
        $(function () {
            $(".rateyo").each(function () {
                const $rateYo = $(this);

                $rateYo.rateYo({
                    starWidth: "20px",
                    readOnly: true, // Disable editing for display purposes
                    fullStar: true
                });
            });
        });
    </script>

</x-app-layout>
