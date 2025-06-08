@extends('admin_layout')
@section('admin_content')
<style>
  /* CSS cho các nút nằm ngang */
  .btn-container {
    display: flex; /* Sử dụng Flexbox để căn chỉnh các nút theo chiều ngang */
    gap: 10px; /* Khoảng cách giữa các nút */
  }

  .btn {
    padding: 10px 20px; /* Đảm bảo nút có chiều cao và chiều rộng đồng đều */
    text-align: center; /* Căn giữa chữ trong nút */
  }
  
  .btn-sm {
    padding: 8px 15px; /* Điều chỉnh kích thước nút nhỏ */
  }
  .style-img-all-product {
  width: 100px;
  height: 100px;
  object-fit: cover; /* Giúp ảnh không bị méo */
  border-radius: 5px; /* Tùy chọn: bo tròn góc ảnh */
}

</style>

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ SẢN PHẨM
    </div>
    <?php
    use Illuminate\Support\Facades\Session;
      $message = Session::get('message');
      if($message) {
        echo "<span class='text-alert'>".$message."</span>";
        Session::put('message',null);
      }
    ?>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên sản phẩm</th>
            <th>SL sản phẩm</th>
            <th>Giá sản phẩm</th>
            <th>Hình ảnh sản phẩm</th>
            <th>Danh mục</th> 
            <th>Thương hiệu</th>
            <th>Hiển thị</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_product as $key =>$product)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $product->product_name}}</td>
            <td>{{ $product->product_quantity}}</td>
            <td>{{ $product->product_price }}</td>
            <td><img src='public/upload/product/{{ $product->product_image }}' class="img-thumbnail style-img-all-product" alt='Lỗi ảnh'></td>
            <td>{{ $product->category_name }}</td>
            <td>{{ $product->branch_name }}</td>
            <td><span class="text-ellipsis">
              <?php
                if($product->product_status == 0) {
              ?>
                <a href='{{URL::to("/active-product/"."$product->product_id")}}'>
                  <i class='fa fa-thumbs-down'></i>
                </a>
              <?php } else { ?>
                <a href='{{URL::to("/unactive-product/"."$product->product_id")}}'>
                  <i class='fa fa-thumbs-up'></i>
                </a>
              <?php 
                }
              ?>
            </span></td>
            
            <td>
  <!-- Thêm div để chứa cả hai nút và căn chỉnh chúng ngang -->
  <div class="btn-container">
    <!-- Nút Sửa -->
    <a href="{{URL::to('edit-product/'.$product->product_id)}}" class="btn btn-primary btn-sm" ui-toggle-class="">
      <i class="fa fa-pencil-square-o"></i> Sửa
    </a>
    
    <!-- Nút Xóa -->
    <a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này không?')" href="{{URL::to('delete-product/'.$product->product_id)}}" class="btn btn-danger btn-sm" ui-toggle-class=""/>
      <i class="fa fa-times"></i> Xóa
    </a>
  </div>
</td>


          </tr>
          @endforeach
          
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection