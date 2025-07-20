@extends('layouts.adminlte')

@section('title', 'VIP Subscriptions List')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">VIP Subscriptions List</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.vip_users.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Add New VIP Subscription
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
                                        <th>User</th>
                                        <th>Level</th>
                                        <th>Credits remaining</th>
                                        <th>Amount (VND)</th>
                                        <th>Expires At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($uservips as $uservip)
                                        {{-- @php
                                            print_r($uservip->toArray()); // Debugging line to check the structure of $uservip
                                        @endphp --}}
                                        <tr>
                                            <td>{{ $uservip->user_vip_id }}</td>
                                            <td>{{ $uservip->user->username ?? 'N/A' }}</td>
                                            <td>{{ $uservip->vipLevel->level_name ?? 'N/A' }}</td>
                                            <td>{{ $uservip->credits_remaining ?? '0' }}</td>
                                            {{-- <td>{{ $uservip->level->fee ? number_format($uservip->level->fee, 2) : 'N/A' }}
                                            </td> --}}
                                            <td>{{ $uservip->vipLevel->fee ?? 'N/A' }}
                                            </td>
                                            <td>{{ $uservip->end_date ? $uservip->end_date : 'N/A' }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.vip_users.edit', $uservip->user_vip_id) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form
                                                    action="{{ route('admin.vip_users.destroy', $uservip->user_vip_id) }}"
                                                    method="POST" style="display:inline;"
                                                    onsubmit="return confirm('Are you sure you want to delete this VIP subscription?');">
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
                                            <td colspan="8" class="text-center">No VIP subscriptions found.</td>
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
