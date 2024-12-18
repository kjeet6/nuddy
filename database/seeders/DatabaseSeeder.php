<?php

namespace Database\Seeders;

use App\Models\Producte;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
            
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password123'),
                'is_admin' => true
            ]);
        }
  // Categories
  DB::table('categories')->insert(['nom' => ""]);
  DB::table('categories')->insert(['nom' => "Sudaderas"]);
  DB::table('categories')->insert(['nom' => "Pantalo"]);
  DB::table('categories')->insert(['nom' => "Camisetas"]);
  DB::table('categories')->insert(['nom' => "Jaquetas"]);
  DB::table('categories')->insert(['nom' => "Ascesoris"]);
  DB::table('categories')->insert(['nom' => "Sabates"]);

  // Comandas
  $comandes = [];
  for ($i = 0; $i < 5; $i++) {
      $comandes[] = DB::table('comandes')->insertGetId([
          'users_id' => rand(1, 10), 
          'data' => fake()->dateTime()
      ]);
  }

  // Productes
  for ($i = 1; $i <= 20; $i++) {
    Producte::factory()->create([
      'nom' => fake()->word(). ' ' . fake()->randomElement(['Sudaderas', 'Pantalo', 'Camisetas', 'Jaquetas', 'Ascesoris', 'Sabates']),
      'descripcio' => fake()->sentence(6),
      'preu' =>fake()->randomFloat(2, 5, 100),
      'quantitat_stock' => fake()->numberBetween(1, 50), 
      'categoria_id' => rand(1, 6),
  ]);
}

  // Detall de comandes
  DB::table('detall_comandes')->insert([
      ['comanda_id' => $comandes[0], 'producte_id' => 1, 'quantitat' => 2],
      ['comanda_id' => $comandes[0], 'producte_id' => 2, 'quantitat' => 1],
      ['comanda_id' => $comandes[1], 'producte_id' => 3, 'quantitat' => 3],
  ]);
  //carret
  DB::table('carrets')->insert([
    ['users_id' => 1, 'created_at' => now(), 'updated_at' => now()],
    ['users_id' => 2, 'created_at' => now(), 'updated_at' => now()],
]);
//detall_carret
DB::table('detall_carrets')->insert([
    ['carret_id' => 1, 'producte_id' => 1, 'quantitat' => 2],
    ['carret_id' => 1, 'producte_id' => 2, 'quantitat' => 1],
    ['carret_id' => 2, 'producte_id' => 3, 'quantitat' => 3],
]);
//Usuari_producte
 DB::table('usuari_producte')->insert([
            ['users_id' => 1, 'producte_id' => 1, 'data' => fake()->dateTime()],
            ['users_id' => 1, 'producte_id' => 2, 'data' => fake()->dateTime()],
            ['users_id' => 2, 'producte_id' => 3, 'data' => fake()->dateTime()],
        ]);

}
    
}
