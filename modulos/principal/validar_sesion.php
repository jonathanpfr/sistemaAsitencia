<?php 
@session_start();
if (($_SESSION['id_user']== true))
{
    //echo "correcto";
}
else
{
echo "
<script>
alert('NO SE DETECTO SU SESSION, VUELVA A LOGUEARCE');
location.href='salir.php'
</script>";
}
?>