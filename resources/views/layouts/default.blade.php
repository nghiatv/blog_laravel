<!DOCTYPE html>
<html>

@include('vendor.head')

<body>
@include('vendor.header')

        <!-- Main Content -->
<div class="container">
    @yield('content')
</div>

<hr>
@include('vendor.footer')

        <!-- jQuery -->
<script src="vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Contact Form JavaScript -->
<script src="js/jqBootstrapValidation.js"></script>
<script src="js/contact_me.js"></script>

<!-- Theme JavaScript -->
<script src="js/clean-blog.min.js"></script>

</body>

</html>
