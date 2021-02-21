<?php
return [
    '~^hello/(.*)$~' => [\testtask\Controllers\MainController::class, 'sayHello'],
//    '~^$~' => [\testtask\Controllers\MainController::class, 'main'],
    '~^casino/add$~' => [\testtask\Controllers\CasinosController::class, 'add'],
    '~^casino/(\d+)$~' => [\testask\Controllers\CasinosController::class, 'view'],
    '~^casino/(\d+)/edit$~' => [\testask\Controllers\CasinosController::class, 'edit'],
    '~^casino/(\d+)/delete$~' => [\testask\Controllers\CasinosController::class, 'del'],
    '~^casino$~' => [\testtask\Controllers\MainController::class, 'main'],
];





