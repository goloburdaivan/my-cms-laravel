<?php

namespace App\Console\Commands;

use App\Repository\AdminRepository;
use Illuminate\Console\Command;

class MakeAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make system administrator';

    /**
     * Execute the console command.
     */
    public function handle(
        AdminRepository $adminRepository,
    ) {
        $name = $this->ask('Enter login', 'Admin');
        $email = $this->ask('Enter Email', 'admin@admin.com');
        $password = $this->secret('Enter Password');

        $adminRepository->create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        $this->info('Admin successfully created.');
    }
}
