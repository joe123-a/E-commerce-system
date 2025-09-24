<?php
namespace app\assets;
use yii\web\AssetBundle;
class CustomerAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap',
        'https://use.fontawesome.com/releases/v5.15.4/css/all.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css',
        'lib/animate/animate.min.css',
        'lib/owlcarousel/assets/owl.carousel.min.css',
        'css/bootstrap.min.css',
        'css/style.css',
    ];
    public $js = [
        'https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js',
        'lib/wow/wow.min.js',
        'lib/owlcarousel/owl.carousel.min.js',
        'js/main.js',
    ];
    public $depends = [];
}
?>