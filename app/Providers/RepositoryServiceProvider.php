<?php

namespace App\Providers;

use App\Infra\Contracts\BookInterface;
use App\Infra\Contracts\BookOutputInterface;
use App\Infra\Contracts\BrandInterface;
use App\Infra\Contracts\GenderInterface;
use App\Infra\Contracts\UserInterface;
use App\Infra\Repositories\BookOutputRepository;
use App\Infra\Repositories\BookRepository;
use App\Infra\Repositories\BrandRepository;
use App\Infra\Repositories\GenderRepository;
use App\Infra\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->app->bind(BrandInterface::class, BrandRepository::class);
        $this->app->bind(GenderInterface::class, GenderRepository::class);
        $this->app->bind(BookInterface::class, BookRepository::class);
        $this->app->bind(BookOutputInterface::class, BookOutputRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
    }
}
