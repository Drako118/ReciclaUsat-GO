<?php

use App\Http\Controllers\Admin\ActivitiesController;
use App\Http\Controllers\Admin\BrandmodelsController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\MaintenancesController;
use App\Http\Controllers\Admin\RoutesController;
use App\Http\Controllers\Admin\RoutestatusController;
use App\Http\Controllers\Admin\SchedulesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\UsertypeController;
use App\Http\Controllers\Admin\VehiclecolorController;
use App\Http\Controllers\Admin\VehicleImagesController;
use App\Http\Controllers\Admin\VehicleoccupantsController;
use App\Http\Controllers\Admin\VehicleroutesController;
use App\Http\Controllers\Admin\VehiclesController;
use App\Http\Controllers\Admin\VehicletypesController;
use App\Http\Controllers\Admin\ZonecoordsController;
use App\Http\Controllers\Admin\ZonesController;
use App\Models\Brandmodel;
use Illuminate\Support\Facades\Route;

Route::resource('brands', BrandsController::class)->names('admin.brands');
Route::resource('models', BrandmodelsController::class)->names('admin.models');
Route::resource('vehicles', VehiclesController::class)->names('admin.vehicles');
Route::get('modelsbybrand/{id}', [BrandmodelsController::class, 'modelsbybrand'])->name('admin.modelsbybrand');
Route::resource('zones', ZonesController::class)->names('admin.zones');
Route::resource('zonecoords', ZonecoordsController::class)->names('admin.zonecoords');
Route::resource('vehicletypes', VehicletypesController::class)->names('admin.vehicletypes');
Route::resource('vehiclecolors', VehiclecolorController::class)->names('admin.vehiclecolors');
Route::resource('usertypes', UsertypeController::class)->names('admin.usertypes');
Route::get('vehicleimages/{id}', [VehicleImagesController::class, 'index'])->name('admin.vehicleimages.index');
Route::get('vehicleimages/create/{id}', [VehicleImagesController::class, 'create'])->name('admin.vehicleimages.create');
Route::post('vehicleimages/store/{vehicleId}', [VehicleImagesController::class, 'store'])->name('admin.vehicleimages.store');
Route::delete('vehicleimages/destroy/{id}', [VehicleImagesController::class, 'destroy'])->name('admin.vehicleimages.destroy');
Route::resource('users', UsersController::class)->names('admin.users');
Route::get('vehicleoccupants/{id}', [VehicleoccupantsController::class, 'index'])->name('admin.vehicleoccupants.index');
Route::get('vehicleoccupants/create/{id}', [VehicleoccupantsController::class, 'create'])->name('admin.vehicleoccupants.create');
Route::post('vehicleoccupants/store/{vehicleId}', [VehicleoccupantsController::class, 'store'])->name('admin.vehicleoccupants.store');
Route::get('vehicleoccupants/usersByType/{typeId}', [VehicleoccupantsController::class, 'usersByType'])->name('admin.vehicleoccupants.usersByType');
Route::delete('vehicleoccupants/destroy/{id}', [VehicleoccupantsController::class, 'destroy'])->name('admin.vehicleoccupants.destroy');
Route::resource('routestatuses', RoutestatusController::class)->names('admin.routestatuses');
Route::resource('routes', RoutesController::class)->names('admin.routes');
Route::resource('vehicleroutes', VehicleroutesController::class)->names('admin.vehicleroutes');
Route::resource('maintenances', MaintenancesController::class)->names('admin.maintenances');
Route::get('maintenances/{maintenance}/schedules', [SchedulesController::class, 'index'])->name('admin.schedules.index');
Route::get('schedules/{maintenanceId}', [SchedulesController::class, 'create'])->name('admin.schedules.create');
Route::post('maintenances/{maintenance}/schedules', [SchedulesController::class, 'store'])->name('admin.schedules.store');
Route::get('schedules/edit/{maintenanceId}/{schedule}', [SchedulesController::class, 'edit'])->name('admin.schedules.edit');
Route::put('maintenances/{maintenance}/schedules/{schedule}', [SchedulesController::class, 'update'])->name('admin.schedules.update');
Route::delete('maintenances/{maintenance}/schedules/{schedule}', [SchedulesController::class, 'destroy'])->name('admin.schedules.destroy');
Route::get('activities/{scheduleId}', [ActivitiesController::class, 'index'])->name('admin.activities.index');
Route::get('activities/create/{scheduleId}', [ActivitiesController::class, 'create'])->name('admin.activities.create');
Route::post('activities/store/{scheduleId}', [ActivitiesController::class, 'store'])->name('admin.activities.store');
Route::get('activities/edit/{scheduleId}/{activity}', [ActivitiesController::class, 'edit'])->name('admin.activities.edit');
Route::put('activities/update/{scheduleId}/{activity}', [ActivitiesController::class, 'update'])->name('admin.activities.update');
Route::delete('activities/destroy/{scheduleId}/{activity}', [ActivitiesController::class, 'destroy'])->name('admin.activities.destroy');
