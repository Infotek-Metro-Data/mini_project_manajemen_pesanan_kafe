use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
            ->middleware('guest')
            ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
            ->middleware('guest')
            ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
            ->middleware('guest')
            ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
            ->middleware('guest')
            ->name('password.update');
