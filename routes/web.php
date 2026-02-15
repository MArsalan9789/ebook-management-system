<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\validrole;
use Illuminate\Support\Facades\Route;


// HOME / DASHBOARD
Route::get('/', [UserController::class, 'home'])->name('home');


// REGISTER
Route::get('registerpage', [AuthController::class, "showRegister"])->name('registerpage');
Route::post('register', [AuthController::class, "registerUser"])->name('registeruser');

// LOGIN
Route::get('loginpage', [AuthController::class, "showLogin"])->name('loginpage');
Route::post('login', [AuthController::class, "loginUser"])->name('loginuser');

// LOGOUT
Route::post('logout', [AuthController::class, "logout"])->name('logout');

// ADMIN DASHBOARD
Route::get('/admin/dashboard', [AdminController::class, "adminindex"])->name('admindashboard')->middleware(AdminMiddleware::class);

// USER DASHBOARD
Route::get('/user/dashboard', [UserController::class, "userindex"])->name('userdashboard')->middleware(UserMiddleware::class);
// USERS FATCH
Route::get('/alluser', [AdminController::class, "fatchuser"])->name('alluser')->middleware(AdminMiddleware::class);
// DELETE USER
Route::get('userdelete/{id}', [AdminController::class, "deleteuser"])->name('userdelete')->middleware(AdminMiddleware::class);

// ADMIN EDIT USER
Route::get('useredit/{id}', [AdminController::class, 'editUser'])->name('useredit')->middleware(AdminMiddleware::class);

// UPDATE USER
Route::post('userupdate/{id}', [AdminController::class, 'updateUser'])->name('userupdate')->middleware(AdminMiddleware::class);

// Admin book
Route::get('admin/book/creat', [AdminController::class, 'createBook'])->name('createbook')->middleware(AdminMiddleware::class);
Route::post('admin/book/store', [AdminController::class, 'storeBook'])->name('storebook')->middleware(AdminMiddleware::class);
Route::get('admin/book/list', [AdminController::class, 'bookList'])->name('booklist')->middleware(AdminMiddleware::class);
Route::get('admin/book/edit/{id}', [AdminController::class, 'editBook'])->name('bookedit')->middleware(AdminMiddleware::class);
Route::put('admin/book/update/{id}', [AdminController::class, 'updateBook'])->name('bookupdate')->middleware(AdminMiddleware::class);
Route::delete('admin/book/delete/{id}', [AdminController::class, 'deleteBook'])->name('bookdelete')->middleware(AdminMiddleware::class);
Route::get('/user/books', [UserController::class, 'myBooks'])->name('userbooks')->middleware(UserMiddleware::class);

// USER UI
Route::get('/shop', [BookController::class, 'index'])->name('shop');
Route::get('/book/{id}', [BookController::class, 'show'])->name('book.show');
Route::post('/subscribe/{id}', [BookController::class, 'subscribe'])->name('subscribe')->middleware(UserMiddleware::class);
Route::get('/book/free/download/{id}', [BookController::class, 'freeDownload'])->name('book.free.download');
Route::get('/bookshelf', [BookController::class, 'bookshelf'])->name('bookshelf');
// CART
Route::get('/cart', [CartController::class, 'index'])->name('cart')->middleware(UserMiddleware::class);
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add')->middleware(UserMiddleware::class);
Route::get('/cart/remove/{key}', [CartController::class, 'remove'])->name('cart.remove')->middleware(UserMiddleware::class);
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout')->middleware(UserMiddleware::class);
// CPMPETITION USER UI
Route::get('/competitions', [CompetitionController::class, 'index'])->name('competitions');
Route::post('/competitions/{id}', [CompetitionController::class, 'submit'])->name('competition.submit')->middleware(UserMiddleware::class);
Route::get('/search', [UserController::class, 'search'])->name('search');

// ORDER LIST
Route::get('admin/orders', [OrderController::class, 'index'])->name('orderlist')->middleware(AdminMiddleware::class);

// Book read
Route::get('/book/free/read/{id}', [BookController::class, 'readFree'])->name('book.free.read');


// CREATE ORDER FORM
Route::get('admin/orders/create', [OrderController::class, 'create'])->name('ordercreate')->middleware(AdminMiddleware::class);

// STORE ORDER
Route::post('admin/orders/store', [OrderController::class, 'store'])->name('orderstore')->middleware(AdminMiddleware::class);

// VIEW ORDER DETAILS
Route::get('admin/orders/view/{id}', [OrderController::class, 'show'])->name('orderview')->middleware(AdminMiddleware::class);

// EDIT ORDER
Route::get('admin/orders/edit/{id}', [OrderController::class, 'edit'])->name('orderedit')->middleware(AdminMiddleware::class);

// UPDATE ORDER
Route::post('admin/orders/update/{id}', [OrderController::class, 'update'])->name('orderupdate')->middleware(AdminMiddleware::class);

// DELETE ORDER
Route::delete('admin/orders/delete/{id}', [OrderController::class, 'destroy'])->name('orderdelete')->middleware(AdminMiddleware::class);

// ORDER STATUS UPDATE (QUICK)
Route::get('admin/orders/status/{id}/{status}', [OrderController::class, 'changeStatus'])->name('order.status')->middleware(AdminMiddleware::class);

// COMPETITIONS LIST
Route::get('admin/competitions', [CompetitionController::class, 'adminIndex'])->name('competitionlist')->middleware(AdminMiddleware::class);

// CREATE COMPETITION FORM
Route::get('admin/competitions/create', [CompetitionController::class, 'create'])->name('competitioncreate')->middleware(AdminMiddleware::class);

// STORE COMPETITION
Route::post('admin/competitions/store', [CompetitionController::class, 'store'])->name('competitionstore')->middleware(AdminMiddleware::class);

// VIEW COMPETITION
Route::get('admin/competitions/view/{id}', [CompetitionController::class, 'show'])->name('competitionview')->middleware(AdminMiddleware::class);

// EDIT COMPETITION FORM
Route::get('admin/competitions/edit/{id}', [CompetitionController::class, 'edit'])->name('competitionedit')->middleware(AdminMiddleware::class);

// UPDATE COMPETITION
Route::post('admin/competitions/update/{id}', [CompetitionController::class, 'update'])->name('competitionupdate')->middleware(AdminMiddleware::class);

// DELETE COMPETITION
Route::delete('admin/competitions/delete/{id}', [CompetitionController::class, 'destroy'])->name('competitiondelete')->middleware(AdminMiddleware::class);

// VIEW SUBMISSIONS FOR A COMPETITION
Route::get('admin/competitions/submissions/{id}', [CompetitionController::class, 'submissions'])->name('competitionsubmissions')->middleware(AdminMiddleware::class);

// WINNER FOR A SUBMISSION
Route::get('admin/competitions/submission/{id}/winner', [CompetitionController::class, 'selectWinner'])->name('competitionselectwinner')->middleware(AdminMiddleware::class);





