<?php

use App\Mail\SendItemWasRequestedMail;
use App\Http\Controllers\Main\{AttributeController,
    BrandController,
    CategoryController,
    HelpCenterController,
    HomeController,
    PostController,
    ProductController,
    Profile\AddressBookController,
    Profile\ChatController,
    Profile\ExportCsvController,
    Profile\LenderController,
    Profile\OrderController,
    Profile\PaymentController,
    Profile\RatingController,
    Profile\UserController,
    Profile\WardrobeController,
    Profile\NotificationController,
    RentController,
    SecurityController,
    StripeController,
    TagController,
    VerificationController,
    ForgotPasswordController
};
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::name('main.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/categories', [CategoryController::class, 'index'])->name('category.list');
    Route::post('/products/previous-page', [ProductController::class, 'previousPage'])->name('product.previous-page');
    Route::get('/products/{category:slug}', [CategoryController::class, 'productsByCategory'])->name('category.products');
    Route::get('/product/{product}', [ProductController::class, 'detail'])->name('product.detail')->middleware('product_view');
    Route::get('/user-products/{lender}', [ProductController::class, 'lenderProducts'])->name('product.lender');
    Route::get('/new-products', [ProductController::class, 'newProducts'])->name('product.new');
    Route::get('/search-products', [ProductController::class, 'search'])->name('product.search');
    Route::get('/trend-products', [ProductController::class, 'trendProducts'])->name('product.trend');
    Route::get('/brand-list', [BrandController::class, 'index'])->name('brand.index');
    Route::get('/brand-products/{brand}', [BrandController::class, 'productsByBrand'])->name('brand.product');
    Route::get('/brand/search', [BrandController::class, 'search'])->name('brand.search');
    Route::get('/tag/search', [TagController::class, 'search'])->name('tag.search');
    Route::get('/attribute-value/{attribute}/search', [AttributeController::class, 'search'])->name('attribute.search');
    Route::get('/reviews/{productId}', [ReviewController::class, 'index'])->name('reviews.index');
    Route::post('review-store', [ReviewController::class, 'reviewstore'])->name('review.store');

    Route::middleware('auth')->group(function () {
        Route::name('profile.')->prefix('/profile')->group(function () {
            Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
            Route::get('/notifications', [NotificationController::class, 'index'])->name('notification.index');
            Route::get('/notification/{notification}', [NotificationController::class, 'isRead'])->name('notification.is_read');
            Route::get('/chat/{order}/search', [ChatController::class, 'search'])->name('chat.search');
            Route::get('/chat/dispute-search', [ChatController::class, 'disputeSearch'])->name('chat.dispute-search');
            Route::get('/chat/{order}', [ChatController::class, 'edit'])->name('chat.edit');
            Route::post('/chat/{order}', [ChatController::class, 'store'])->name('chat.store');
            Route::get('/chat/{order}/messages-read', [ChatController::class, 'messageRead'])->name('chat.message-read');
            Route::get('/chat/{order}/delete', [ChatController::class, 'delete'])->name('chat.delete');
            Route::name('user.')->prefix('/user')->group(function () {
                Route::get('/send-back/{order}', [UserController::class, 'sendBack'])->name('send-back');
                Route::get('/likes', [UserController::class, 'likes'])->name('likes');
                Route::get('/rentals', [UserController::class, 'rentals'])->name('rentals');
                Route::get('/lending', [UserController::class, 'lending'])->name('lending');
                Route::get('/detail', [UserController::class, 'detail'])->name('detail');
                Route::post('/detail-update', [UserController::class, 'updateDetail'])->name('update.detail');
                Route::post('/password-update', [UserController::class, 'updatePassword'])->name('update.password');
                Route::resource('address', AddressBookController::class)->except(['show']);
                Route::resource('payment-method', PaymentController::class)->only(['index', 'store', 'destroy']);
                Route::post('/order/{order}/change-status', [OrderController::class, 'changeStatus'])->name('order.change-status');
                Route::get('/lender/{order}', [OrderController::class, 'lenderByOrder'])->name('lender-by-order');
                Route::post('/todo', [LenderController::class, 'addTodo'])->name('lender.add-todo');
                Route::put('/todo/{todo}/update-status', [LenderController::class, 'updateTodoStatus'])->name('lender.update-status');
                Route::post('/rating-add/{order}', [RatingController::class, 'add'])->name('rating-add');
                Route::get('/remove/todo/{todo}', [LenderController::class, 'removeTodo'])->name('lender.remove-todo');

            });
            Route::name('lender.')->prefix('/lender')->group(function () {
                Route::get('category-search/{product?}',[CategoryController::class,'search'])->name('category-search');
                Route::get('/export', [ExportCsvController::class, 'export'])->name('export');
                Route::get('/complete/{order}', [LenderController::class, 'orderCompleted'])->name('completed');
                Route::get('/confirm-ship/{order}', [LenderController::class, 'confirmShipped'])->name('confirm-ship');
                Route::get('/overview', [LenderController::class, 'overview'])->name('overview');
                Route::get('/stats', [LenderController::class, 'stats'])->name('stats');
                Route::get('/finance', [LenderController::class, 'finance'])->name('finance');
                Route::get('/requests', [LenderController::class, 'requests'])->name('requests');
                Route::get('/order/{order}/detail', [LenderController::class, 'orderDetail'])->name('order-detail');
                Route::get('/order/{order}/print', [LenderController::class, 'orderPrint'])->name('order-print');
                Route::get('/lending', [LenderController::class, 'lending'])->name('lending');
                Route::get('/wardrobe/{product}/update-status', [WardrobeController::class, 'updateStatus'])->name('wardrobe.update-status');
                Route::get('/wardrobe/{product}/edit', [WardrobeController::class, 'edit'])->name('wardrobe.edit');
                Route::post('/wardrobe/{product}/update', [WardrobeController::class, 'update'])->name('wardrobe.update');
                Route::delete('/wardrobe/{product}/delete', [WardrobeController::class, 'destroy'])->name('wardrobe.destroy');
                Route::get('/wardrobe', [WardrobeController::class, 'index'])->name('wardrobe.index');
                Route::get('/wardrobe/{product}/is-not-available', [WardrobeController::class, 'isNotAvailableProduct'])->name('wardrobe.is-not-available');
            });
            Route::get('changing-sidebar/{role}', [UserController::class, 'changeSideBar'])->name('sidebar-change');
        });

        Route::get('/order/{order}/popup-detail', [OrderController::class, 'popUpDetail'])->name('order.popup-detail');
        Route::get('/rent/{rent}/shipping', [RentController::class, 'shippingForm'])->name('rent.shipping-form');
        Route::post('/rent/{rent}/shipping', [RentController::class, 'shipping'])->name('rent.shipping');
        Route::get('/rent/{rent}/payment-init', [RentController::class, 'paymentInit'])->name('rent.payment-init');
        Route::post('/rent/{rent}/payment-init', [RentController::class, 'paymentIntent'])->name('rent.payment-intent');
        Route::get('/rent/{rent}/payment-success', [RentController::class, 'paymentSuccess'])->name('rent.payment-success');
        Route::get('/like/{product}', [ProductController::class, 'like'])->name('product.like');
        Route::get('post/list', [PostController::class, 'list'])->name('post.list');
        Route::post('post/list', [PostController::class, 'store'])->name('post.store');
        Route::delete('post/image/{image}', [PostController::class, 'deleteImage'])->name('post.delete-image');
        Route::get('/stripe/connect',         [StripeController::class, 'connect'])->name('stripe.connect');
        Route::get('/stripe/redirect', [StripeController::class, 'redirect'])->name('stripe.redirect');
        Route::post('/stripe/withdraw',         [StripeController::class, 'withdraw'])->name('stripe.withdraw');
    });

    Route::name('security.')->group(function () {
        Route::middleware('guest')->group(function () {
            Route::get('/registration', [SecurityController::class, 'registrationForm'])
                ->name('registration.form');
            Route::post('/registration', [SecurityController::class, 'registration'])
                ->name('registration');
            Route::get('/login', [SecurityController::class, 'loginForm'])
                ->name('login.form');
            Route::post('/login', [SecurityController::class, 'login'])
                ->name('login');

            Route::get('/google/login', [SecurityController::class, 'googleLogin'])
                ->name('google-login');
            Route::get('/google/callback', [SecurityController::class, 'googleCallBack'])
                ->name('google-callback');
        });


        Route::get('/logout', [SecurityController::class, 'logout'])
            ->name('logout')->middleware('auth');
    });
    Route::get('/help-center', [HelpCenterController::class, 'index'])->name('help-center.index');
    Route::get('/help-center/category-search', [HelpCenterController::class, 'categorySearch'])->name('help-center.category.search');
    Route::get('/help-center/{category}/question-search', [HelpCenterController::class, 'questionSearch'])->name('help-center.question.search');
    Route::get('/help-center/{category}', [HelpCenterController::class, 'byCategory'])->name('help-center.category');
    Route::get('/help-center/question/{question}', [HelpCenterController::class, 'question'])->name('help-center.question');
    Route::get('/{static_page:link}', [\App\Http\Controllers\Main\PageController::class, 'page'])->name('page');
});
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify')->middleware(['signed']);
    Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
});

Route::middleware('auth')->group(function () {
    Route::post('dispute/chat/{chat}/store', [ChatController::class, 'dispute'])->name('dispute.chat');
});

Route::middleware('support_agent')->group(function () {
    Route::get('support-agent/my-status-job', [UserController::class, 'supportAgentStatus'])->name('support.supportAgentStatus');
    Route::get('chats-with-problems/support-agent/{chat?}', [ChatController::class, 'chatsProblems'])->name('support.chatsProblems');
});
