<x-app-layout>
    <!-- Checkout Start -->
    <section>
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-xl-5 col-lg-5 order-lg-last order-first">

                    <div class="gray-simple rounded-2 py-3 px-4 mt-5 mt-lg-2 ">
                        <h1 class="fs-2 pb-3">Checkout</h1>

                        <div class="p-3 border rounded bg-white">
                            {{-- <span class="h6 font--bold">Your cart is empty</span> --}}
                            {{-- <div id="paypal-button-container"></div>
                            <p id="result-message"></p> --}}
                            <script src="https://www.paypal.com/sdk/js?client-id=BAAKwwabOehWBbX527CK1hM-qZ6G4z4fu8NN6BfA9ZZN85TNBcIl1dpqvJqKGoYeM2akNZli7tplQNCsRQ&components=hosted-buttons&disable-funding=venmo&currency=USD"></script>
                            <div id="paypal-container-GXL86YHT8TQSQ"></div>
                            <script>
                            paypal.HostedButtons({
                                hostedButtonId: "GXL86YHT8TQSQ",
                            }).render("#paypal-container-GXL86YHT8TQSQ")
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
    {{-- <script
        src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&buyer-country=US&currency=USD&components=buttons&enable-funding=card&disable-funding=venmo,paylater"
        data-sdk-integration-source="developer-studio"
    ></script> --}}

    <script>
       /*  window.paypal
        .Buttons({
            style: {
                shape: "rect",
                layout: "vertical",
                color: "gold",
                label: "paypal",
            },
            message: {
                amount: {{ number_format($item->price, 2) }},
            } ,

            async createOrder() {
                try {
                    const response = await fetch("{{ route('paypal.create') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        // use the "body" param to optionally pass additional order information
                        // like product ids and quantities
                        body: JSON.stringify({
                            cart: [
                                {
                                    id: "111",
                                    quantity: 1,
                                },
                            ],
                        }),
                    });

                    const orderData = await response.json();

                    if (orderData.id) {
                        return orderData.id;
                    }
                    const errorDetail = orderData?.details?.[0];
                    const errorMessage = errorDetail
                        ? `${errorDetail.issue} ${errorDetail.description} (${orderData.debug_id})`
                        : JSON.stringify(orderData);

                    throw new Error(errorMessage);
                } catch (error) {
                    console.error(error);
                    // resultMessage(`Could not initiate PayPal Checkout...<br><br>${error}`);
                }
            } ,

            async onApprove(data, actions) {
                try {
                    const response = await fetch(
                        `/api/orders/${data.orderID}/capture`,
                        {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                            },
                        }
                    );

                    const orderData = await response.json();
                    // Three cases to handle:
                    //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                    //   (2) Other non-recoverable errors -> Show a failure message
                    //   (3) Successful transaction -> Show confirmation or thank you message

                    const errorDetail = orderData?.details?.[0];

                    if (errorDetail?.issue === "INSTRUMENT_DECLINED") {
                        // (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                        // recoverable state, per
                        // https://developer.paypal.com/docs/checkout/standard/customize/handle-funding-failures/
                        return actions.restart();
                    } else if (errorDetail) {
                        // (2) Other non-recoverable errors -> Show a failure message
                        throw new Error(
                            `${errorDetail.description} (${orderData.debug_id})`
                        );
                    } else if (!orderData.purchase_units) {
                        throw new Error(JSON.stringify(orderData));
                    } else {
                        // (3) Successful transaction -> Show confirmation or thank you message
                        // Or go to another URL:  actions.redirect('thank_you.html');
                        const transaction =
                            orderData?.purchase_units?.[0]?.payments
                                ?.captures?.[0] ||
                            orderData?.purchase_units?.[0]?.payments
                                ?.authorizations?.[0];
                        resultMessage(
                            `Transaction ${transaction.status}: ${transaction.id}<br>
            <br>See console for all available details`
                        );
                        console.log(
                            "Capture result",
                            orderData,
                            JSON.stringify(orderData, null, 2)
                        );
                    }
                } catch (error) {
                    console.error(error);
                    resultMessage(
                        `Sorry, your transaction could not be processed...<br><br>${error}`
                    );
                }
            } ,
        })
        .render("#paypal-button-container"); */

        /* paypal.Buttons({
            createOrder: function(data, actions) {
                return fetch("{{ route('paypal.create') }}", {
                    method: "GET",
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    return orderData.id;
                });
            },
            onApprove: function(data, actions) {
                return fetch("{{ route('paypal.success') }}?paymentId=" + data.paymentID + "&PayerID=" + data.payerID, {
                    method: "GET",
                }).then(function(res) {
                    window.location.href = "{{ route('order-success') }}";
                });
            },
            fundingSource: paypal.FUNDING.CARD
        }).render("#paypal-button-container"); */
    </script>

</x-app-layout>
