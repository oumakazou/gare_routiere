<?php                                           
namespace Database\Seeders;     
use App\Models\User;        
use Illuminate\Database\Seeder;                                 




class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the specific admin account requested
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'nom' => 'Admin User',          
                'mot_de_passe' => Hash::make('admin123'), // Use mot_de_passe                                       
                'role' => 'admin',                                                  
            ]                                                           
        );  


        // Ensure other test users have a 'user' role
        User::updateOrCreate(                   
                ['email' =>'                                                                                                                                                                                                                                                                                                                                                                                                               
                '                                                                       
                                
                


                                        

