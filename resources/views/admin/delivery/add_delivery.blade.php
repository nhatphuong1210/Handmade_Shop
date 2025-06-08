@extends('admin_layout')
@section('admin_content')
<div class="form-w3layouts">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm giá vận chuyển
                </header>
                <?php 
                use Illuminate\Support\Facades\Session;
                $message = Session::get('message');
                if ($message) {
                    echo "<span class='text-alert'>".$message."</span>";
                    Session::put('message', null);
                }
                ?>
                <div class="panel-body">
                    <form role="form" action="{{ route('save.delivery') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Thành Phố</label>
                            <select class="form-control input-sm m-bot15 choose city" name="nameCity" id="nameCity">
                                <option value="0">Chọn tỉnh thành phố</option>
                                @foreach($cityData as $ci)
                                    <option value="{{ $ci->matp }}">{{ $ci->nameCity }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Quận Huyện</label>
                            <select class="form-control input-sm m-bot15 choose province" name="nameProvince" id="nameProvince">
                                <option value="0">Chọn quận huyện</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Xã Phường</label>
                            <select class="form-control input-sm m-bot15 ward" name="nameWards" id="nameWards">
                                <option value="0">Chọn xã phường</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Phí vận chuyển</label>
                            <input type="text" name="feeship" class="form-control" id="feeship">
                        </div>
                        <button type="submit" class="btn btn-info">Thêm phí vận chuyển</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
