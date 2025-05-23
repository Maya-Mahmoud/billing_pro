@extends('layouts.master')

@section('css')
<!-- Internal Font Awesome -->
<link href="{{ URL::asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
<!-- Internal treeview -->
<link href="{{ URL::asset('assets/plugins/treeview/treeview-rtl.css') }}" rel="stylesheet" type="text/css" />
@section('title')
edit permission
@stop
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">permission</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/edit permission</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')

@if (count($errors) > 0)
<div class="alert alert-danger">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>error</strong>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('roles.update', $role->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        <div class="form-group">
                            <p>:name permission</p>
                            <input type="text" name="name" value="{{ old('name', $role->name) }}" class="form-control" placeholder="اسم الصلاحية">
                        </div>
                    </div>
                    <div class="row">
                        <!-- col -->
                        <div class="col-lg-4">
                            <ul id="treeview1">
                                <li><a href="#">permissions</a>
                                    <ul>
                                        <li>
                                            @foreach($permission as $value)
                                            <label>
                                                <input type="checkbox" name="permission[]" value="{{ $value->name }}"
                                                    {{ in_array($value->name, $rolePermissions) ? 'checked' : '' }} class="name">
                                                {{ $value->name }}
                                            </label>
                                            <br />
                                            @endforeach
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
                            <button type="submit" class="btn btn-main-primary">update</button>
                        </div>
                        <!-- /col -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
</form>
@endsection

@section('js')
<!-- Internal Treeview js -->
<script src="{{ URL::asset('assets/plugins/treeview/treeview.js') }}"></script>
@endsection
