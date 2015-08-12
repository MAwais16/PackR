<?php namespace PackR;

/** @var \Herbert\Framework\Enqueue $enqueue */

$enqueue->front([
    'as'  => 'progress-wizard-css',
    'src' => Helper::assetUrl('/css-progress-wizard-master/css/progress-wizard.min.css')
]);

$enqueue->front([
    'as'  => 'custom-css',
    'src' => Helper::assetUrl('/css/custom.css')
]);

$enqueue->front([
    'as'  => 'custom-js',
    'src' => Helper::assetUrl('/js/custom.js'),
    'filter' => [ 'hook' => 'FormController.php' ]
]);