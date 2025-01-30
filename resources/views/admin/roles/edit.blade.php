@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('edit peran')}}</h1>
        <a href="{{ route('admin.permissions.index') }}" class="btn btn-primary btn-sm shadow-sm">{{ __('Kembali') }}</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<!-- Content Row -->
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="title">Titel</label>
                        <input type="text" class="form-control" id="title" placeholder="Titel" name="title" value="{{ old('title', $role->title) }}" />
                    </div>
                    <div class="form-group">
                        <label for="permissions">{{ __('Izin') }}</label>
                        <select name="permissions[]" id="permissions" class="form-control select2" multiple="multiple" required>
                            @foreach($permissions as $id => $permissions)
                                <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || isset($role) && $role->permissions->contains($id)) ? 'selected' : '' }}>{{ $permissions }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Simpan')}}</button>
                </form>
            </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection