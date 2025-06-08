@extends('admin_layout')
@section('admin_content')
<div class="form-w3layouts">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">Chỉnh sửa giá vận chuyển</header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{ route('update.delivery', $feeship->fee_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="city">Thành Phố</label>
                                <select class="form-control input-sm m-bot15 choose city" name="fee_matp" id="city">
                                    <option value="0">Chọn tỉnh thành phố</option>
                                    @foreach($cityData as $city)
                                        <option value="{{ $city->matp }}" 
                                            {{ $feeship->fee_matp == $city->matp ? 'selected' : '' }}>
                                            {{ $city->nameCity }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="province">Quận Huyện</label>
                                <select class="form-control input-sm m-bot15 choose province" name="fee_maqh" id="province">
                                    @foreach($provinceData as $province)
                                        <option value="{{ $province->maqh }}" 
                                            {{ $feeship->fee_maqh == $province->maqh ? 'selected' : '' }}>
                                            {{ $province->name_quanhuyen }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ward">Xã Phường</label>
                                <select class="form-control input-sm m-bot15 ward" name="fee_xaid" id="ward">
                                    @foreach($wardData as $ward)
                                        <option value="{{ $ward->xaid }}" 
                                            {{ $feeship->fee_xaid == $ward->xaid ? 'selected' : '' }}>
                                            {{ $ward->name_xaphuong }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="feeship">Phí vận chuyển</label>
                                <input type="text" name="fee_feeship" class="form-control" id="feeship" 
                                    value="{{ $feeship->fee_feeship }}">
                            </div>
                            <button type="submit" class="btn btn-info">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
