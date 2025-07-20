@extends('layouts.adminlte')

@section('title', 'VIP List')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">VIP List</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.vip_subscriptions.create') }}" class="btn btn-primary btn-sm">
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
                                        <th>Level name</th>
                                        <th>Fee (VND)</th>
                                        <th>Credit card number</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($viplevels as $viplevel)
                                        <tr>
                                            <td>{{ $viplevel->level_name }}</td>
                                            <td>{{ $viplevel->fee }}</td>
                                            <td>{{ $viplevel->credit_card_num }}</td>
                                            <td>{{ $viplevel->description }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No VIP found.</td>
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
