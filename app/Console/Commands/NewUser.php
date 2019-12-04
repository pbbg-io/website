<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class NewUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new user';

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
        $name = $this->ask('What is the username?');
        $password = $this->ask('What password would you like?');
        $email = $this->ask('What is your email?');

        $user =  new User();
        $user->name = $name;
        $user->password = bcrypt($password);
        $user->email = $email;
        $user->save();
    }
}
