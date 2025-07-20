@extends('layouts.adminlte')

@section('title', 'Edit VIP Subscription')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit VIP Subscription</h3>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                                    role="alert">
                                    <button type="button" class="absolute top-0 right-0 mt-2 mr-2 text-green-700"
                                        data-dismiss="alert" aria-label="Close">×</button>
                                    <span class="block sm:inline">{{ session('success') }}</span>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                                    role="alert">
                                    <button type="button" class="absolute top-0 right-0 mt-2 mr-2 text-red-700"
                                        data-dismiss="alert" aria-label="Close">×</button>
                                    <span class="block sm:inline">{{ session('error') }}</span>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                                    role="alert">
                                    <button type="button" class="absolute top-0 right-0 mt-2 mr-2 text-red-700"
                                        data-dismiss="alert" aria-label="Close">×</button>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admin.vip_users.update', $uservip->user_vip_id) }}" method="POST"
                                class="space-y-4">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="user_id" class="block text-sm font-medium text-gray-700">User <span
                                            class="text-red-500">*</span></label>
                                    <select name="user_id" id="user_id"
                                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md @error('user_id') border-red-500 @enderror"
                                        required>
                                        <option value="">Select User</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->user_id }}"
                                                {{ old('user_id', $uservip->user_id) == $user->user_id ? 'selected' : '' }}>
                                                {{ $user->username }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="vip_level_id" class="block text-sm font-medium text-gray-700">Level <span
                                            class="text-red-500">*</span></label>
                                    <select name="vip_level_id" id="vip_level_id"
                                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md @error('vip_level_id') border-red-500 @enderror"
                                        required>
                                        <option value="">Select Level</option>
                                        @foreach ($vipLevels as $level)
                                            <option value="{{ $level->vip_level_id }}"
                                                {{ old('vip_level_id', $uservip->vip_level_id) == $level->vip_level_id ? 'selected' : '' }}>
                                                {{ $level->level_name }} ({{ $level->fee }} VND -
                                                {{ $level->credit_card_num }} Credits)
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('vip_level_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date <span
                                            class="text-red-500">*</span></label>
                                    <input type="datetime-local" name="start_date" id="start_date"
                                        value="{{ old('start_date', $uservip->start_date->format('Y-m-d\TH:i')) }}"
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
                                        value="{{ old('end_date', $uservip->end_date->format('Y-m-d\TH:i')) }}"
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
                                        <option value="active"
                                            {{ old('status', $uservip->status) == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="pending"
                                            {{ old('status', $uservip->status) == 'pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="expired"
                                            {{ old('status', $uservip->status) == 'expired' ? 'selected' : '' }}>Expired
                                        </option>
                                    </select>
                                    @error('status')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="card-footer flex justify-end space-x-2">
                                    <button type="submit"
                                        class="btn btn-primary bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Update
                                        VIP Subscription</button>
                                    <a href="{{ route('admin.vip_users.index') }}"
                                        class="btn btn-secondary bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
