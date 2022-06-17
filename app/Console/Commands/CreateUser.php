<?php
 
namespace App\Console\Commands;
 
use App\Models\User;
use Illuminate\Console\Command;
 
class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user {email=demo@user.com} {name=rahman} {token=123456}';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create single user';
 
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $email = $this->argument('email');
        $token = $this->argument('token');
        $name = $this->argument('name');
        $password = bin2hex(random_bytes(10));

        $checker = array('email' => $email);
        $new = array(
            'token' => $token, 
            'name' => $name,
            'password' => $password,
        );

        User::updateOrCreate($checker, $new);

        $user = User::where('email', $email)->first();
        
        echo sprintf("\r\nSuccess! Your token is: %s\r\n\r\n", $user->token);

    }
}