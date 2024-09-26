<?php

use App\Models\User;

use function Livewire\Volt\{with, usesPagination};

usesPagination(theme: 'bootstrap');

with(fn () => ['users' => User::where('role', 0)->paginate(10)]);

?>

<div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $k => $user)
                <tr>
                    <th scope="row">{{ $k+1 }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        {{-- <a href="{{ route('admin.users.view', $user->id) }}" class="square--30 circle text-light bg-seegreen d-inline-flex">
                            <i class="fa-solid fa-eye"></i>
                        </a> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $users->links('components.pagination-links') }}
    </div>
</div>
