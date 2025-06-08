@extends('admin_layout')
@section('admin_content')
<style>
  .btn-container {
    display: flex; 
    gap: 10px;
  }

  .btn {
    padding: 10px 20px; 
    text-align: center; 
  }
  
  .btn-sm {
    padding: 8px 15px; 
  }
</style>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      QUẢN LÍ ĐƠN HÀNG
    </div>
    <?php
      use Illuminate\Support\Facades\Session;
      $message = Session::get('message');
      if($message) {
        echo "<span class='text-alert'>".$message."</span>";
        Session::put('message', null);
      }
    ?>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Thứ tự</th>
            <th>Mã đơn hàng</th>
            <th>Ngày tháng đặt hàng</th>
            <th>Tình trạng đơn hàng</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php $i = 0; @endphp

          @foreach($order as $key => $ord)
          @php $i++; @endphp
          <tr>
            <td>{{ $i }}</td>
            <td>{{ $ord->order_code }}</td>
            <td>{{ $ord->created_at }}</td>
            <td>
              @if($ord->order_status == 1)
                Đơn hàng mới
              @else
                Đã xử lí
              @endif
            </td>
            <td>
              <div class="btn-container">
                <!-- Nút Sửa -->
                <a href="{{ URL::to('/view-order/' . $ord->order_code) }}" class="btn btn-primary btn-sm" ui-toggle-class="">
                </i> Xem
                </a>
                <!-- Nút Xóa -->
                <a onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này không?')" href="{{ URL::to('/delete-order/' . $ord->order_code) }}" class="btn btn-danger btn-sm" ui-toggle-class="">
                  <i class="fa fa-times"></i> Xóa
                </a>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
