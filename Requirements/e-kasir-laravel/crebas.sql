/*==============================================================*/
/* dbms name:      mysql 5.0                                    */
/* created on:     1/15/2020 16:32:06                           */
/*==============================================================*/


drop table if exists barang;

drop table if exists detail_transaksi;

drop table if exists kategori;

drop table if exists stok;

drop table if exists transaksi;

/*==============================================================*/
/* table: barang                                                */
/*==============================================================*/
create table barang
(
   id_barang            int not null,
   id_kategori          int,
   nama_barang          varchar(100),
   keterangan           text,
   primary key (id_barang)
);

/*==============================================================*/
/* table: detail_transaksi                                      */
/*==============================================================*/
create table detail_transaksi
(
   id_detail            int not null,
   id_transaksi         int not null,
   id_stok              int not null,
   jumlah               int,
   total                int,
   primary key (id_detail, id_transaksi, id_stok)
);

/*==============================================================*/
/* table: kategori                                              */
/*==============================================================*/
create table kategori
(
   id_kategori          int not null,
   id_barang            int,
   nama_kategori        varchar(100),
   primary key (id_kategori)
);

/*==============================================================*/
/* table: stok                                                  */
/*==============================================================*/
create table stok
(
   id_stok              int not null,
   id_barang            int,
   nama_stok            varchar(100),
   jumlah_stok_masuk    int,
   tanggal_masuk        date,
   tanggal_kadaluarsa   date,
   sisa_stok            int,
   harga                int,
   primary key (id_stok)
);

/*==============================================================*/
/* table: transaksi                                             */
/*==============================================================*/
create table transaksi
(
   id_transaksi         int not null,
   id_user              int,
   tgl                  date,
   total                int,
   primary key (id_transaksi)
);

