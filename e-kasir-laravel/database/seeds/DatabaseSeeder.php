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
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'name' => 'Pradana Poet',
            'username' => 'pemilik',
            'role' => 'pemilik',
            'password' => Hash::make('12345678')
        ],[
            'name' => 'Alfin Khoiri',
            'username' => 'kasir',
            'role' => 'kasir',
            'password' => Hash::make('12345678')
        ]);

        DB::table('kategori')->insert([
            'nama_kategori' => 'Makanan Berat',
        ],[
            'nama_kategori' => 'Makanan Ringan',
        ]);

        DB::table('barang')->insert([
            'id_kategori' => '1',
            'nama_barang' => 'Indomie Original',
            'keterangan' => 'PT Indofood'
        ],[
            'id_kategori' => '2',
            'nama_barang' => 'So Nice',
            'keterangan' => 'PT Japfa'
        ],[
            'id_kategori' => '2',
            'nama_barang' => 'Oreo',
            'keterangan' => 'PT Nabisco'
        ]);
    }
}
