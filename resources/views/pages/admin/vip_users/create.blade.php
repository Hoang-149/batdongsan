@extends('layouts.adminlte')

@section('title', 'Create VIP Subscription')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create New VIP Subscription</h3>
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

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admin.vip_users.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="user_id">User <span class="text-danger">*</span></label>
                                    <select name="user_id" id="user_id"
                                        class="form-control @error('user_id') is-invalid @enderror" required>
                                        <option value="">Select User</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->user_id }}"
                                                {{ old('user_id') == $user->user_id ? 'selected' : '' }}>
                                                {{ $user->username }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="vip_level_id">Level <span class="text-danger">*</span></label>
                                    <select name="vip_level_id" id="vip_level_id"
                                        class="form-control @error('vip_level_id') is-invalid @enderror" required>
                                        <option value="">Select Level</option>
                                        @foreach ($vipLevels as $level)
                                            <option value="{{ $level->vip_level_id }}"
                                                {{ old('vip_level_id') == $level->vip_level_id ? 'selected' : '' }}>
                                                {{ $level->level_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('vip_level_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date <span
                                            class="text-red-500">*</span></label>
                                    <input type="datetime-local" name="start_date" id="start_date"
                                        value="{{ old('start_date') }}"
                                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md @error('start_date') border-red-500 @enderror"
                                        required>
                                    @error('start_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="end_date" class="block text-sm font-medium text-gray-700">End Date <span
                                            class="text-red-500">*</span></label>
                                    <input type="datetime-local" name="end_date" id="end_date"
                                        value="{{ old('end_date') }}"
                                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md @error('end_date') border-red-500 @enderror"
                                        required>
                                    @error('end_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status <span
                                            class="text-red-500">*</span></label>
                                    <select name="status" id="status"
                                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md @error('status') border-red-500 @enderror"
                                        required>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="expired" {{ old('status') == 'expired' ? 'selected' : '' }}>Expired
                                        </option>
                                    </select>
                                    @error('status')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create VIP Subscription</button>
                                    <a href="{{ route('admin.vip_users.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
