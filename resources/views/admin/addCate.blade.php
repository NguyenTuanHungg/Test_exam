<!DOCTYPE html>
<html>

<head>
    <title>Biểu mẫu chủ đề</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body >
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Thêm chủ đề mới</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('insert_cate') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên chủ đề</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên chủ đề" required>
                            </div>
                            <button type="submit" class="btn btn-success">Thêm chủ đề</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <!-- Danh sách chủ đề -->
        <div class="row mt-4  justify-content-center"  >
            <div class="col-md-6">
                <h3>Danh sách chủ đề</h3>
                <div class="table-responsive">
                    <table class="table w-100" >
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên chủ đề</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $key => $category)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <form action="{{ route('deleteCate', ['id' => $category->id]) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" style="height:40px;">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $categories->links('pagination::bootstrap-4') }}

                </div>
            </div>
        </div>
    </div>
</body>