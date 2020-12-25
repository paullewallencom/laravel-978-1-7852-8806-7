<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Deploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploy {branch} {environment}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deploy this Laravel Application';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $cf = '[cf_bash_path] ';

        $commands = Array(
            'cd [project_path]',
            'git checkout ' . $this->argument('branch'),
            $cf . 'login -a https://api.ng.bluemix.net -u [username] -p ' . env('bluemix-password') . ' -o [organization] -s [space]',
            $cf . 'push ' . $this->argument('environment'),
            $cf . 'logout'
        );
        $commands = implode(';', $commands);

        exec($commands, $output);

        $this->line($output);
    }
}
