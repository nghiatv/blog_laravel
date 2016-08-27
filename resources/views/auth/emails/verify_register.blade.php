<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Verify Email ở Blog.app</h2>

<div>
    Cảm ơn em vì đã đăng kí tài khoản ở chỗ anh. Vui lòng bấm vào link bên dưới để anh hoàn tất đăng kí cho em nhé
    {{ url('register/verify/' . $confirmation_code) }}.<br/>

</div>

</body>
</html>