<?php namespace App\Console\Commands;

use App\Models\User;
use DB;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Init extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rekuovers:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install or upgrade Rekuovers';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            DB::connection();
        } catch (Exception $e) {
            $this->error('Unable to connect to database.');
            $this->error('Please fill valid database credentials into .env and rerun this command.');
            return;
        }

        $this->comment('Attempting to install or upgrade Rekuovers.');

        if (!config('app.key')) {
            $this->info('Generating app key');
            Artisan::call('key:generate');
        } else {
            $this->comment('App key exists -- skipping');
        }

        $this->info('Migrating database');
        Artisan::call('migrate', ['--force' => true]);

        if (!User::count()) {
            $this->info('Seeding initial data');
            Artisan::call('db:seed', ['--force' => true]);
        } else {
            $this->comment('Data seeded -- skipping');
        }
    }
}
