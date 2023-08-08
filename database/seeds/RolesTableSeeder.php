<?php

namespace Database\Seeders;

use App\Models\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'doctor-list',
            'doctor-create',
            'doctor-edit',
            'doctor-delete',

            'category-list',
            'category-create',
            'category-edit',
            'category-delete',

            'slot-list',
            'slot-create',
            'slot-edit',
            'slot-delete',

            'patient-list',
            'patient-create',
            'patient-edit',
            'patient-delete',

            'appointment-list',
            'appointment-create',
            'appointment-edit',
            'appointment-delete',

            'earning-list',
            'earning-edit',

            'news-list',
            'news-create',
            'news-edit',
            'news-delete',

            'news-category-list',
            'news-category-create',
            'news-category-edit',
            'news-category-delete',

            'menu-list',
            'menu-create',
            'menu-edit',
            'menu-delete',

            'comment-list',
            'comment-approve',
            'comment-delete',

            'social-list',
            'social-create',
            'social-edit',
            'social-delete',

            'service-list',
            'service-create',
            'service-edit',
            'service-delete',

            'gallery-list',
            'gallery-create',
            'gallery-edit',
            'gallery-delete',

            'page-list',
            'page-create',
            'page-edit',
            'page-delete',

            'contact-list',
            'contact-delete',

            'language-list',
            'language-create',
            'language-edit',
            'language-delete',

            'site-setting',
            'smtp-setting',
            'zoom-setting',
            'payment-method',
            'subscriber',


            'slider-list',
            'slider-create',
            'slider-edit',
            'slider-delete',

            'testimonial-list',
            'testimonial-create',
            'testimonial-edit',
            'testimonial-delete',

            'brand-list',
            'brand-create',
            'brand-edit',
            'brand-delete',

            'faq-list',
            'faq-create',
            'faq-edit',
            'faq-delete',

            // section
            'notice-section',
            'about-section',
            'counter-section',
            'gallery-section',
            'doctor-section',

            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role_create = Role::create(['name' => 'Super Admin', 'guard_name' => 'web']);
        $pers = Permission::all();
        foreach ($pers as $p) {
            DB::table('role_has_permissions')->insert(['permission_id' => $p->id, 'role_id' => $role_create->id]);
        }

        DB::table('model_has_roles')->insert([
            'role_id' => $role_create->id,
            'model_type' => 'App\Models\Role',
            'model_id' => 1
        ]);
        $user = User::first();
        $user->syncRoles($role_create->name);
    }
}
