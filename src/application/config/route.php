<?php declare(strict_types=1);

$map = [
    "/"                         => app\Controller\HomepageController::class,
    "/employees/"               => \app\Controller\EmployeesController::class,
    "/employees/add-employee/"  => [
        'controller' => \app\Controller\EmployeesController::class,
        'action' => 'addEmployeeAction'
    ],
    "/employees/edit-employee/" => [
        'controller' => \app\Controller\EmployeesController::class,
        'action' => 'editEmployeeAction'
    ],
    '/projects/'                => \app\Controller\ProjectsController::class,
];
