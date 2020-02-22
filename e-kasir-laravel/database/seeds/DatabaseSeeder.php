<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Str;

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
        $users = [
        [
            'name' => 'Pradana Poet',
            'username' => 'pemilik',
            'role' => 'pemilik',
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(16),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'name' => 'Alfin Khoiri',
            'username' => 'kasir',
            'role' => 'kasir',
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(16),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]
        ];
        foreach($users as $user){
            DB::table('users')->insert($user);
        }


        $kategori = [
        [
            'nama_kategori' => 'Makanan Berat',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'nama_kategori' => 'Makanan Ringan',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'nama_kategori' => 'Minuman',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'nama_kategori' => 'Alat Kecantikan',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'nama_kategori' => 'Obat-obatan',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'nama_kategori' => 'Pembersih Lantai',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'nama_kategori' => 'Deterjen',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'nama_kategori' => 'Alat Tulis Kantor',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'nama_kategori' => 'Alat Kebersihan',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'nama_kategori' => 'Rokok',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'nama_kategori' => 'Roti',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'nama_kategori' => 'Minuman Siap Saji',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'nama_kategori' => 'Bumbu Masak',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]
        ];
        foreach($kategori as $kat){
            DB::table('kategori')->insert($kat);
        }


        $barang = [
        [
            'id_kategori' => '1',
            'nama_barang' => 'Indomie Original',
            'keterangan' => 'PT Indofood',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'id_kategori' => '2',
            'nama_barang' => 'So Nice : Sapi',
            'keterangan' => 'PT Japfa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'id_kategori' => '2',
            'nama_barang' => 'Oreo Taro',
            'keterangan' => 'PT Nabisco',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'id_kategori' => '3',
            'nama_barang' => 'Tebs',
            'keterangan' => 'PT Sosro',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'id_kategori' => '4',
            'nama_barang' => 'Bedak Iritasi Marks',
            'keterangan' => 'PT Maersk',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'id_kategori' => '5',
            'nama_barang' => 'Larutan Cap Kaki Tiga Original',
            'keterangan' => 'PT Kaki Tiga',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'id_kategori' => '5',
            'nama_barang' => 'Ultraflu',
            'keterangan' => 'PT Kimia Farma',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'id_kategori' => '6',
            'nama_barang' => 'So Klin Pembersih Lantai Aroma:Pinus',
            'keterangan' => 'PT Unilever',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'id_kategori' => '7',
            'nama_barang' => 'Rinso',
            'keterangan' => 'PT Unilever',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'id_kategori' => '8',
            'nama_barang' => 'Penghapus Putih Joyko',
            'keterangan' => 'PT Joyko',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'id_kategori' => '8',
            'nama_barang' => 'Faber Castle : Pensil Warna 36 pcs',
            'keterangan' => 'PT Fabercastle',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'id_kategori' => '9',
            'nama_barang' => 'Sapu Ijuk',
            'keterangan' => 'PT Tiga Macan',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'id_kategori' => '10',
            'nama_barang' => 'Gudang Garam Filter',
            'keterangan' => 'PT Gudang Garam',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'id_kategori' => '11',
            'nama_barang' => 'Sari Roti : Roti Sobek',
            'keterangan' => 'PT Sari Roti',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'id_kategori' => '12',
            'nama_barang' => 'ABV Kopi Susu',
            'keterangan' => 'PT Wings Food',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            'id_kategori' => '13',
            'nama_barang' => 'Kara Santan',
            'keterangan' => 'PT Kara',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]
        ];
        foreach($barang as $brg){
            DB::table('barang')->insert($brg);
        }
    }
}
