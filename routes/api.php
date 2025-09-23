<?php


// use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
// use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');





// Route::get('/events', function () {
//     return ['msg' => 'Hello from API'];
// });

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('events', EventController::class);
});


Route::apiResource('events', EventController::class);
Route::post('/api/events', [EventController::class, 'store']);

Route::get('/api/events', [EventController::class, 'index']);
Route::post('/api/events', [EventController::class, 'store']);

// // مسار عام للجميع
Route::apiResource('events', EventController::class);
Route::apiResource('orders', OrderController::class);
Route::post('/api/events', [EventController::class, 'store']);


// مجموعة المسارات التي تتطلب المصادقة
Route::middleware('auth:sanctum')->group(function () {

    // إدارة الأحداث والتذاكر
    Route::apiResource('events', EventController::class);
    Route::apiResource('tickets', TicketController::class);

    // الطلبات
    Route::post('/orders', [OrderController::class, 'store']);

    // إحصائيات لوحة التحكم
    Route::get('/dashboard-stats', [DashboardController::class, 'stats']);

    // رفع الملفات الخاصة بالفعاليات
    Route::post('/events/{event}/files', [FileController::class, 'store']);
});
