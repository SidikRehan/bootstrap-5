<?php
session_start();
session_destroy();
?>
<script type="text/javascript">
    alert('Selamat anda berhasil Logout.');
    location.href='login.php';
</script>