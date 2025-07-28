@extends('layouts.adminlte')

@section('title', 'Typical Business List')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Property List</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.typical_business.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Add New Property
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    {{ session('error') }}
                                </div>
                            @endif

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($businesses as $business)
                                        <tr>
                                            <td>{{ $business->id }}</td>
                                            <td>
                                                <img src="{{ asset($business->image_url) }}" alt="Business Image"
                                                    style="max-width: 100px;">
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.typical_business.edit', $business->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('admin.typical_business.destroy', $business->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No records found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
