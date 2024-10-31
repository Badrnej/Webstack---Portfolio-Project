<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (Role::count() == 0) {
            $adminRole = Role::create([
                "name" => "admin",
                "guard_name" => "web",
            ]);
            $userRole = Role::create(["name" => "user", "guard_name" => "web"]);

            $GererProduitPermission = Permission::create([
                "name" => "gere les produit",
            ]);
            $GererCategoriPermission = Permission::create([
                "name" => "gere les Categories",
            ]);
            $GererFournisseurPermission = Permission::create([
                "name" => "gere les Fournisseurs",
            ]);
            $GererClientPermission = Permission::create([
                "name" => "gere les Clients",
            ]);
            $GererCommandePermission = Permission::create([
                "name" => "gere les Commandes",
            ]);
            $EnvoyerEmailPermission = Permission::create([
                "name" => "Envoyer des Emails",
            ]);
            $GererFactursPermission = Permission::create([
                "name" => "gere les Factures",
            ]);
            $GererUsersPermission = Permission::create([
                "name" => "gere les Users",
            ]);
            $GererPermission = Permission::create([
                "name" => "gere les Permission",
            ]);

            $adminRole->givePermissionTo([
                $GererProduitPermission,
                $GererCategoriPermission,
                $GererFournisseurPermission,
                $GererClientPermission,
                $GererCommandePermission,
                $EnvoyerEmailPermission,
                $GererFactursPermission,
                $GererUsersPermission,
                $GererPermission,
            ]);
            $userRole->givePermissionTo([
                $GererProduitPermission,
                $GererCategoriPermission,
                $GererCommandePermission,
                $GererFactursPermission,
                $GererClientPermission,
            ]);
        }
    }
}
