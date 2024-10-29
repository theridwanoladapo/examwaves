<?php

use App\Models\Certification;

use function Livewire\Volt\{state, mount, on};

state(['certification', 'cart', 'cartCount', 'cartTotal']);

mount(function ($certification) {
    $this->certification = $certification;
    // Initialize the cart, cartCount & cartTotal retrieved from session
    $this->cart = session()->get('cart', []);
    $this->cartCount = session()->get('cartCount', 0);
    $this->cartTotal = session()->get('cartTotal', 0);
});

on(['cartUpdated' => function () {
    $this->cart = session()->get('cart', []);
    $this->cartCount = session()->get('cartCount', 0);
    $this->cartTotal = session()->get('cartTotal', 0);
}]);

$addToCart = function (int $id) {
    $cert = Certification::find($id);

    $this->cart = session()->get('cart', []);

    if (!array_key_exists($id, $this->cart)) {
        // add item to cart array
        $this->cart[$id] = [
            'id' => $id,
            'title' => $cert->title,
            'code' => $cert->code,
            'price' => $cert->price,
            'exam_id' => $cert->exam_id
        ];

        $this->cartCount++;
        $this->cartTotal += $cert->price;
    }

    session()->put('cart', $this->cart);
    session()->put('cartCount', $this->cartCount);
    session()->put('cartTotal', $this->cartTotal);

    $this->dispatch('cartUpdated');
};

$removeFromCart = function (int $id) {
    $cert = Certification::find($id);

    $this->cart = session()->get('cart', []);

    if (array_key_exists($id, $this->cart)) {
        unset($this->cart[$id]);    // remove item from cart array

        $this->cartCount--;
        $this->cartTotal -= $cert->price;
    }

    session()->put('cart', $this->cart);
    session()->put('cartCount', $this->cartCount);
    session()->put('cartTotal', $this->cartTotal);

    $this->dispatch('cartUpdated');
};

$buyNow = function () {
    $this->addToCart($this->certification->id);

    $this->redirectRoute('cart', navigate: true);
};

?>

<div>
    <section>
        <div class="container">

            <div class="row justify-content-between">
                <div class="col-xl-8 col-lg-8 col-md-12">
                    @if (is_null($certification->image_path) || empty($certification->image_path))
                    {{-- <img src="{{ asset('assets/img/icon.png') }}" class="w-100" /> --}}
                    @else
                    <div class="p-1 bg-white w-40 w-min-40 h-40 me-2 d-flex align-items-center mb-3">
                        <img src="{{ asset($certification->image_path) }}" class="w-100" />
                    </div>
                    @endif
                    <!-- Exam Title -->
                    <h4 class="pb-2 pb-lg-3">{{ $certification->title }}
                        {{ $certification->code ? '('.$certification->code.')' : null }}
                    </h4>
                    <div class="d-flex flex-wrap align-items-center justify-content-between border-bottom mb-4">
                        <div class="d-flex align-items-center mb-4 me-4">
                            <span class="fs-sm me-2">Exam Provider:</span>
                            <a class="text-primary position-relative fw-semibold p-0" href="{{ route('providers.view', $certification->exam->id) }}" data-scroll=""
                                data-scroll-offset="80">
                                {{ $certification->exam->name }}
                                <span class="d-block position-absolute start-0 bottom-0 w-100"
                                    style="background-color: currentColor; height: 1px;"></span>
                            </a>
                        </div>
                        <div class="d-flex align-items-baseline mb-4 me-4">
                            <span class="fs-sm me-2">Rating:</span>
                            <span class="fs-sm me-1 h5 text-dark font--bold mb-0">
                                {{-- {{ $certification->averageRating() }} --}}
                                <div class="rateyo"
                                data-rateyo-rating="{{ $certification->averageRating() ?? 0 }}"
                                data-rateyo-num-stars="5"
                                data-rateyo-score="{{ $certification->averageRating() ?? 0 }}"></div>
                            </span>
                            <span class="fs-sm me-2">by {{ $certification->countComments() }} users</span>
                        </div>
                        <div>{!! $certification->description !!}</div>
                    </div>

                    <!-- Exam Content -->
                    <h4 class="font--bold">Included in the Exam</h4>
                    <p>{{ exam_question_count($certification->id) }} questions</p>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Practice Exams
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <table class="table">
                                        <tbody>
                                            @foreach ($certification->tests as $k => $test)
                                            <tr>
                                                <th scope="row">{{ $test->name }}</th>
                                                <td>{{ test_question_count($test->id) }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-xl-4 col-lg-4 col-md-12">
                    <div class="detail-side-block border overflow-hidden rounded-3 mt-md-0 mt-4">
                        <div class="detail-side-head d-flex align-items-center gray-simple p-3">
                            <div class="side-flex-thumb">
                                <img src="assets/img/l-12.png" class="img-fluid" width="55" alt="">
                            </div>
                            <div class="side-flex-caption ps-3">
                                <div class="jbs-title-iop"><h4 class="m-0">${{ $certification->price }}</h4></div>
                                {{-- <div class="jbs-locat-oiu text-sm-muted">
                                    <span><i class="fa-solid fa-location-dot me-1"></i>California, USA</span>
                                </div> --}}
                            </div>
                        </div>
                        <div class="detail-side-middle py-3 px-3">
                            <div class="form-group">
                                @if (array_key_exists($certification->id, $this->cart))
                                <button wire:click="removeFromCart({{$certification->id}})"
                                type="button" class="btn btn-outline-danger full-width font-sm">Remove from cart</button>
                                @else
                                <button wire:click="addToCart({{$certification->id}})"
                                type="button" class="btn btn-outline-dark full-width font-sm">Add to cart</button>
                                @endif
                            </div>
                            <div class="form-group">
                                <button wire:click="buyNow()" type="button" class="btn btn-primary full-width font-sm">Buy Now</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
    <div class="clearfix"></div>
</div>


@script
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
@endscript
