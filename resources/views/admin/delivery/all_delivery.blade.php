@extends('admin_layout')
@section('admin_content')
<style>
  /* Căn chỉnh các nút nằm ngang với khoảng cách */
  .btn-container {
    display: flex;
    gap: 10px; /* Khoảng cách giữa các nút */
  }

  .btn-sm {
    padding: 8px 15px; /* Điều chỉnh kích thước nút nhỏ */
  }

  .fa {
    margin-right: 5px; /* Khoảng cách giữa icon và chữ */
  }
</style>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách phí vận chuyển
        </div>
        <?php 
        use Illuminate\Support\Facades\Session;
        $message = Session::get('message');
        if ($message) {
            echo "<span class='text-alert'>".$message."</span>";
            Session::put('message', null);
        }
        ?>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Thành phố</th>
                        <th>Quận huyện</th>
                        <th>Xã phường</th>
                        <th>Phí vận chuyển</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($feeships as $fee)
                    <tr>
                        <td>{{ $fee->city->nameCity }}</td>
                        <td>{{ $fee->district->name_quanhuyen }}</td>
                        <td>{{ $fee->ward->name_xaphuong }}</td>
                        <td>{{ number_format($fee->fee_feeship, 0, ',', '.') }} VND</td>
                        <td>
  <!-- Nút Sửa với icon -->
  <a href="{{ route('edit.delivery', $fee->fee_id) }}" class="btn btn-primary btn-sm">
    <i class="fa fa-pencil-square-o"></i> Sửa
  </a>

  <!-- Nút Xóa với icon -->
  <a href="{{ route('delete.delivery', $fee->fee_id) }}" 
     class="btn btn-danger btn-sm"
     onclick="return confirm('Bạn có chắc chắn muốn xóa phí vận chuyển này không?')">
    <i class="fa fa-trash"></i> Xóa
  </a>
</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection