@extends('layouts.adminlte')

@section('title', 'Property List')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Property List</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.properties.create') }}" class="btn btn-primary btn-sm">
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

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>User</th>
                                        <th>Type</th>
                                        <th>Location</th>
                                        <th>Project</th>
                                        <th>Images</th>
                                        <th>Price</th>
                                        <th>Area</th>
                                        <th>For Sale</th>
                                        <th>Verified</th>
                                        <th>VIP Status</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($properties as $property)
                                        <tr>
                                            <td>{{ $property->property_id }}</td>
                                            <td>{{ $property->title }}</td>
                                            <td>{{ $property->user->username ?? 'N/A' }}</td>
                                            <td>{{ $property->propertyType->type_name ?? 'N/A' }}</td>
                                            <td>{{ $property->location->province ?? 'N/A' }} -
                                                {{ $property->location->district ?? '' }}</td>
                                            <td>{{ $property->project->project_name ?? 'N/A' }}</td>
                                            <td>
                                                <div class="flex flex-wrap gap-2">
                                                    @if ($property->images->isNotEmpty())
                                                        @foreach ($property->images as $image)
                                                            <a href="{{ asset($image->image_url) }}" target="_blank"
                                                                title="View full image">
                                                                <img src="{{ asset($image->image_url) }}"
                                                                    class="w-8 object-cover rounded hover:scale-105 transition-transform duration-200"
                                                                    alt="Property Image" width="64px">
                                                            </a>
                                                        @endforeach
                                                    @else
                                                        <span class="text-gray-500">No images available</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{{ $property->price ? number_format($property->price, 2) : 'N/A' }}</td>
                                            <td>{{ $property->area ? number_format($property->area, 2) : 'N/A' }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $property->is_for_sale ? 'bg-success' : 'bg-warning' }}">
                                                    {{ $property->is_for_sale ? 'Yes' : 'No' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge {{ $property->is_verified ? 'bg-success' : 'bg-warning' }}">
                                                    {{ $property->is_verified ? 'Yes' : 'No' }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($property->isVipActive())
                                                    <span class="badge bg-primary">VIP (Expires:
                                                        {{ $property->vip_expires_at->format('Y-m-d') }})</span>
                                                @else
                                                    <form action="#" {{-- action="{{ route('admin.properties.markAsVip', $property->property_id) }}" --}} method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary btn-sm">Mark as
                                                            VIP</button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>{{ $property->created_at->format('Y-m-d H:i:s') }}</td>
                                            <td>
                                                <a href="{{ route('admin.properties.edit', $property->property_id) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form
                                                    action="{{ route('admin.properties.destroy', $property->property_id) }}"
                                                    method="POST" style="display:inline;"
                                                    onsubmit="return confirm('Are you sure you want to delete this property?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="13" class="text-center">No properties found.</td>
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

    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
