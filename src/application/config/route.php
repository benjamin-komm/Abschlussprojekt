<?php declare(strict_types=1);

$map = [
    "/"                             => app\Controller\HomepageController::class,
    "/employees/"                   => \app\Controller\EmployeesController::class,
    "/employees/add-employee/"      => [
        'controller'    => \app\Controller\EmployeesController::class,
        'action'        => 'addEmployeeAction'
    ],
    "/employees/edit-employee/"     => [
        'controller'    => \app\Controller\EmployeesController::class,
        'action'        => 'editEmployeeAction'
    ],
    "/employees/delete-employee/"   => [
        'controller'    => \app\Controller\EmployeesController::class,
        'action'        => 'deleteEmployeeAction'
    ],
    "/projects/add-project/"        => [
        'controller'    => \app\Controller\ProjectsController::class,
        'action'        => 'addProjectAction'
    ],
    "/projects/show-project/"        => [
        'controller'    => \app\Controller\ProjectsController::class,
        'action'        => 'showProjectAction'
    ],
    "/projects/show-project/add-task/"  => [
        'controller'    => \app\Controller\ProjectsController::class,
        'action'        => 'addProjectTaskAction'
    ],
    '/login/'                       => \app\Controller\LoginController::class,
    '/projects/'                    => \app\Controller\ProjectsController::class,
];
