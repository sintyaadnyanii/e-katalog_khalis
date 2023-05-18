<?php 
if (!function_exists('asset')) {
    function asset($path)
    {
        return env('APP_URL') . $path;
    }
} ?>

<?php 
if(!function_exists('pricing')){
    function pricing($price){
        return 'Rp ' . number_format($price, 0, ',', '.');
    }
}
?>