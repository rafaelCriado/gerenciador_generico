<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PapelSeeds::class);
        $this->call(PermissaoSeeds::class);
        $this->call(UsuariosSeeds::class);
        $this->call(EstadoSeed::class);
    }
}
