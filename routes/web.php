<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SalaryController;

Route::get('/', fn() => redirect()->route('employees.index'));

Route::resources([
    'departments' => DepartmentController::class,
    'positions'   => PositionController::class,
    'employees'   => EmployeeController::class,
    'attendances' => AttendanceController::class,
    'salaries'    => SalaryController::class,
]);
