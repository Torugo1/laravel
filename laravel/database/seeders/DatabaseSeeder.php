<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
 
class DatabaseSeeder extends Seeder
{
    /**
     */
  public function run(): void{DB::table('users')->insert(['nome' => Str::random(10),'email' => Str::random(10).'@example.com','cidade' => Str::random(10),'idade' => 10]);}
}