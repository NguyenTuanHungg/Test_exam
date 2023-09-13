<!DOCTYPE html>
<html>

<head>
    <title>Biểu mẫu chủ đề</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
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
    </div>
</body>