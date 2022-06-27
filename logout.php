<?php
session_start();
session_destroy();
session_unset();
$_SESSION = [];

echo "
<script>
window.location = 'login.php';s
</script>
";
