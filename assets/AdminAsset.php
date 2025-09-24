<?php

namespace app\assets;

use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $css = [
        'https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css',
        'admini/css/styles.css', // Make sure folder exists in web/admin/css
    ];
    
    public $js = [
        'https://use.fontawesome.com/releases/v6.3.0/js/all.js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js',
        'https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js',
        'admini/js/scripts.js',
        'admini/assets/demo/chart-area-demo.js',
        'admini/assets/demo/chart-bar-demo.js',
        'admini/js/datatables-simple-demo.js',
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
