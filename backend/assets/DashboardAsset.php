<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'font-awesome/css/font-awesome.css',
        'css/plugins/toastr/toastr.min.css',
        'css/animate.css',
        'js/plugins/gritter/jquery.gritter.css',
        'css/style.css',
        //'css/site.css',
    ];
    public $js = [
        //<!-- Mainly scripts -->
        'js/jquery-2.1.1.js',
        'js/bootstrap.min.js',
        'js/plugins/metisMenu/jquery.metisMenu.js',
        'js/plugins/slimscroll/jquery.slimscroll.min.js',
        
        //<!-- Flot -->
        'js/plugins/flot/jquery.flot.js',
        'js/plugins/flot/jquery.flot.tooltip.min.js',
        'js/plugins/flot/jquery.flot.spline.js',
        'js/plugins/flot/jquery.flot.resize.js',
        'js/plugins/flot/jquery.flot.pie.js',
        
        //<!-- Peity -->
        'js/plugins/peity/jquery.peity.min.js',
        'js/demo/peity-demo.js',
        
        //<!-- Custom and plugin javascript -->
        'js/inspinia.js',
        'js/plugins/pace/pace.min.js',
        
        //<!-- jQuery UI -->
        'js/plugins/jquery-ui/jquery-ui.min.js',
        
        //<!-- GITTER -->
        'js/plugins/gritter/jquery.gritter.min.js',
        
        //<!-- Sparkline -->
        'js/plugins/sparkline/jquery.sparkline.min.js',
        
        //<!-- Sparkline demo data  -->
        'js/demo/sparkline-demo.js',
        
        //<!-- ChartJS-->
        'js/plugins/chartJs/Chart.min.js',
        
        //<!-- Toastr -->
        'js/plugins/toastr/toastr.min.js',
        
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
