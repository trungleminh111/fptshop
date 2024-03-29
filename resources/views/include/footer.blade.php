<footer>
    <div class="bottom">
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <ul class="row bottom--ul">
                        <li class="col-md-12">
                            <a href="">Giới thiệu về công ty</a>
                        </li>
                        <li class="col-md-12">
                            <a href="">Chính sách bảo mật</a>
                        </li>
                        <li class="col-md-12">
                            <a href="">Quy chế hoạt động</a>
                        </li>
                        <li class="col-md-12">
                            <a href="">Kiểm tra hoá đơn điện tử</a>
                        </li>
                        <li class="col-md-12">
                            <a href="">Tra cứu thông tin bảo hành</a>
                        </li>
                        <li class="col-md-12">
                            <a href="">Câu hỏi thường gặp</a>
                        </li>
                        <li class="col-md-12">
                            <img src="./image/xacminh.png" alt="">
                        </li>
                    </ul>
                </div>
                <div class="col-md">
                    <ul class="row bottom--ul">
                        <li class="col-md-12">
                            <a href="">Tin tuyển dụng</a>
                        </li>
                        <li class="col-md-12">
                            <a href="">Tin khuyến mãi</a>
                        </li>
                        <li class="col-md-12">
                            <a href="">Hướng dẫn mua online</a>
                        </li>
                        <li class="col-md-12">
                            <a href="">Hướng dẫn mua trả góp</a>
                        </li>
                        <li class="col-md-12">
                            <a href="">Chính sách trả góp</a>
                        </li>
                        <li class="col-md-12">
                            <a href="">Chính sách thu nhập và xử lý dữ liệu cá nhân</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md">
                    <ul class="row bottom--ul">
                        <li class="col-md-12">
                            <a href="">Hệ thống của hàng</a>
                        </li>
                        <li class="col-md-12">
                            <a href="">Chính sách đổi trả</a>
                        </li>
                        <li class="col-md-12">
                            <a href="">Hệ thống bảo hành</a>
                        </li>
                        <li class="col-md-12">
                            <a href="">Giới thiệu máy đổi trả</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="support">Tư vấn mua hàng (Miễn Phí)</span> <br>
                            <span class="support"><span class="bottomPhone">1800 6601</span> (Nhánh 1)</span>
                        </div>
                        <div class="col-md-12">
                            <span class="support">Hỗ trợ kỹ thuật</span> <br>
                            <span class="support"><span class="bottomPhone">1800 6601</span> (Nhánh 2)</span>
                        </div>
                        <div class="col-md-12">
                            <span class="support">Gợi ý, khiêu nại (8h00 - 22h00)</span> <br>
                            <span class="bottomPhone">1800 6616</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footerBot">
            <span>Copy Right HieuTrung</span>
        </div>
    </div>

</footer>

<script type="text/javascript">
    $(document).ready(function () {

        $('#test').click(function (e) {
            e.preventDefault();
            var ele = $(this);
            console.log(ele);
            $.ajax({
                url: '{{ route('update_cart') }}',
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    cart_id: 3,
                    //quantity update cart
                    quantity:10
                    //delete bỏ quantity
                },
                success: function (response) {
                    window.location.reload();
                }
            });

        });
    })
</script>

<div class="loader-box">
    <span class="loader"></span>
</div>

@if (Session::has('authsuccess'))
<script>
    Swal.fire({
        icon: 'success',
        text: "{{Session::get('authsuccess')}}",
        background: 'white',
    })
</script>
@endif
@if (Session::has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            text: "{{ Session::get('success') }}",
            background: 'white',
            onClose: function () {
                {!! Session::forget('success') !!}
            }
        });
    </script>
@endif

@if (Session::has('error'))
<script>

    Swal.fire({
        icon: 'error',
        text: "{{Session::get('error')}}",
        background: 'white',
    })
</script>
@endif
@if (Session::has('authloginsuccess'))
<script>
    Swal.fire({
        icon: 'success',
        text: "{{Session::get('authloginsuccess')}}",
        background: 'white',
    })
</script>
@endif
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>

<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('OwlCarousel/dist/owl.carousel.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>