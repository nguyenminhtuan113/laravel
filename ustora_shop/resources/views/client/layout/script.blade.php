<!-- Latest jQuery form server -->
<script src="https://code.jquery.com/jquery.min.js"></script>

<!-- Bootstrap JS form CDN -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<!-- jQuery sticky menu -->
{{-- <script src="{{asset('fe/js/owl.carousel.min.js')}}"></script> --}}
{{-- <script src="{{asset('fe/js/jquery.sticky.js')}}"></script> --}}

<!-- jQuery easing -->
{{-- <script src="{{asset('fe/js/jquery.easing.1.3.min.js')}}"></script> --}}

<!-- Main Script -->
{{-- <script src="{{asset('fe/js/main.js')}}"></script> --}}

<!-- Slider -->
{{-- <script type="text/javascript" src="{{asset('fe/js/bxslider.min.js')}}"></script> --}}
{{-- <script type="text/javascript" src="{{asset('fe/js/script.slider.js')}}"></script> --}}
<script>
    $(function() {
        $(".minus").on("click", function() {
            $(this).closest('form').submit();
        });

        $(".plus").on("click", function() {
            $(this).closest('form').submit();
        });

        $(".remove").on("click", function() {
            $(this).closest('form').submit();
        });
        $(".remove-cart").on("click", function() {
            $(this).closest('form').submit();
        });

    });
</script>
