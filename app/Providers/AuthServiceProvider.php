<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\CompanyPage' => 'App\Policies\CompanyPagePolicy',
        'App\Models\ProductPage' => 'App\Policies\ProductPagePolicy',
        'App\Models\TopicPage' => 'App\Policies\TopicPagePolicy',
        'App\Models\Contributor' => 'App\Policies\ContributorPolicy',
        'App\Models\Article' => 'App\Policies\ArticlePolicy',
        'App\Models\Bookmark' => 'App\Policies\BookmarkPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Review' => 'App\Policies\ReviewPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('is-admin', function($user) {
            return $user->isAdmin();
        });

        Gate::define('can-view-page', function($user, $approved) {
            return ($approved > 0 && !$user->isBlocked()) || $user->isAdmin();
        });
    }
}
