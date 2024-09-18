<?php

use App\Models\Certification;

use function Livewire\Volt\{with, usesPagination};

usesPagination(theme: 'bootstrap');

with(fn () => ['certifications' => Certification::paginate(10)]);

$deleteCertification = function (Certification $certification) {
    $certification->delete();

    $this->resetPage();
}

?>

<div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($certifications as $k => $certification)
                <tr>
                    <th scope="row">{{ $k+1 }}</th>
                    <td>{{ $certification->title }}</td>
                    <td>{{ $certification->code }}</td>
                    <td>{{ $certification->price }}</td>
                    <td>{{ $certification->exam->name }}</td>
                    <td>
                        <a href="{{ route('admin.certifications.view', $certification->id) }}" class="square--30 circle text-light bg-seegreen d-inline-flex">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <button wire:click="deleteCertification({{$certification->id}})" wire:confirm="Are you sure you want to delete {{ $certification->title }}?" class="square--30 circle text-light bg-danger d-inline-flex ms-2">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $certifications->links('components.pagination-links') }}
    </div>
</div>
