<form action="{{ route('admin.topic.store') }}" method="post">
    @csrf
    <h1 class="text-center">Add Topic</h1>
    <div class="container">
        <div class="row g-3">
            <div class="col-md-12 mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input
                    type="text"
                    id="name"
                    class="form-control"
                    name="name"
                    value="{{ old('name') }}"
                    required
                />
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12 mb-3">
                <label for="sort_order" class="form-label">Sort Order</label>
                <select name="sort_order" id="sort_order" class="form-control">
                    <option value="0">Sort order</option>
                    {!! $htmlsortorder !!}
                </select>
                @error('sort_order')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea 
                    name="description" 
                    id="description" 
                    class="form-control"
                    rows="3"
                    required
                >{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12 mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="2">Chưa xuất bản</option>
                    <option value="1">Xuất bản</option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12 mb-3">
                <button class="btn btn-primary w-100" type="submit">
                    Add
                </button>
            </div>
        </div>
    </div>
</form>