<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\Artisan;

use App\Enums\PolicyTypeEnum;
use App\Enums\LoginTypeEnum;
use App\Enums\OperatingSystemEnum;

use App\Models\User;
use App\Models\Policy;
use App\Models\SubscriptionPlan;
use App\Models\Notification;
use App\Models\LoginActivity;

class DefaultSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();

        // CLEAR CALL TABLES
        $this->command->info('Clear all tables on database.');
        Artisan::call('migrate:fresh');

        // USER SEEDER
        $this->command->info('Create Users.');
        $users = [
            [
                'f_name' => 'Manger',
                'l_name' => 'A',
                'email' => 'managera@keyndex.in',
                'password' => 'managera@123'
            ],
            [
                'f_name' => 'User',
                'l_name' => 'A',
                'email' => 'usera@keyndex.in',
                'password' => 'usera@123',
                'phone' => '1234567890',
            ],
            [
                'f_name' => 'User',
                'l_name' => 'B',
                'email' => 'userb@keyndex.in',
                'password' => 'userb@123',
                'phone' => '1234567890',
            ],
            [
                'f_name' => 'User',
                'l_name' => 'C',
                'email' => 'userc@keyndex.in',
                'password' => 'userc@123',
                'phone' => '1234567890',
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
        $this->command->info('Create Users Done.');

            // POLICY SEEDER
        $this->command->info('Create Policy.');
        $policies = [PolicyTypeEnum::PRIVACY, PolicyTypeEnum::TERMS, PolicyTypeEnum::REFUND, PolicyTypeEnum::CANCELLATION];

        foreach ($policies as $policyIndex => $policy) {
            Policy::create([
                'title' => $policy,
                'content' => $faker->paragraphs(10, true),
                'type' => $policy,
                'status' => true,
            ]);
        }
        $this->command->info('Create Policy Done.');

        // SUBSCRIPTION PLAN SEEDER
        $this->command->info('Create Subscription Plan.');
        $plans = [
            [
                'image' => 'logo-free.png',
                'plan_name' => 'Free',
                'price' => 0,
                'status' => true,
            ],
            [
                'image' => 'logo-basic.png',
                'plan_name' => 'Basic',
                'price' => 299,
                'status' => true,
            ],
            [
                'image' => 'logo-premium.png',
                'plan_name' => 'Premium',
                'price' => 499,
                'status' => true,
            ],
        ];

        foreach ($plans as $planIndex => $plan) {
            SubscriptionPlan::create($plan);
        }
        $this->command->info('Create Subscription Plan Done.');

        // NOTIFICATIONS SEEDER
        $this->command->info('Create Notification.');
        Notification::create([
            'image' => null,
            'title' => 'Welcome to Keyndex',
            'message' => 'Easy management of your projects and tasks. Get started with Keyndex today!',
            'status' => true,
        ]);
        $this->command->info('Create Notification Done.');

        // PROJECT SEEDER

        // TASK SEEDER

        // SUBSCRIPTION HISTORY SEEDER

        // NOTIFICATION SEEDER
        Notification::create([
            'image' => null,
            'title' => 'Welcome to Keyndex',
            'message' => 'Easy management of your projects and tasks. Get started with Keyndex today!',
            'status' => true,
        ]);

        // LOGIN ACTIVITY SEEDER
        LoginActivity::create([
            'ip_address' => '0.0.0.0',
            'user_agent' => null,
            'operating_system' => OperatingSystemEnum::LINUX,
            'login_type' => LoginTypeEnum::EMAIL,

            // REFERENCES
            'user_id' => 1,
        ]);
    }
}
