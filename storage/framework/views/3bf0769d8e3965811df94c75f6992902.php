<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(config('adminlte.title', 'News Portal')); ?></title>
    @adminlte_css
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>
</div>
@adminlte_js
<?php echo $__env->yieldContent('js'); ?>
</body>
</html><?php /**PATH C:\Users\Naufal\Documents\UAS_WEBLANJUT\news-portal\resources\views/layouts/app.blade.php ENDPATH**/ ?>