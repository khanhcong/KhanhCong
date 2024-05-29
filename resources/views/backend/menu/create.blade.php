@extends('layouts.admin')
@section('title', 'Thêm mới Menu')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="d-inline">Thêm mới Menu</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header text-right">
                <a href="{{ route('admin.menu.index') }}" class="btn btn-sm btn-info">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    Về danh sách
                </a>
                <button type="submit" form="menuForm" class="btn btn-sm btn-success">
                    <i class="fa fa-save" aria-hidden="true"></i>
                    Thêm Menu
                </button>
            </div>
            <div class="card-body">
                <form id="menuForm" action="{{ route('admin.menu.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-9">
                            <div class="mb-3">
                                <label>Tên Menu (*)</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Note</label>
                                <textarea name="note" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label>Trạng thái</label>
                                <select name="status" class="form-control">
                                    <option value="1">Xuất bản</option>
                                    <option value="0">Chưa xuất bản</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
