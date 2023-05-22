# TP3DPBO2023
Saya Muhammad Fikri Kafilli NIM 2107264 mengerjakan TP3 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## Deskripsi Tugas
Buatlah program menggunakan bahasa pemrograman PHP dengan spesifikasi sebagai berikut:
* Program bebas, kecuali program Ormawa
* Menggunakan minimal 3 buah tabel
* Terdapat proses Create, Read, Update, dan Delete data
* Memiliki fungsi pencarian dan pengurutan data (kata kunci bebas)
* Menggunakan template/skin form tambah data dan ubah data yang sama
* 1 tabel pada database ditampilkan dalam bentuk bukan tabel, 2 tabel sisanya ditampilkan dalam bentuk tabel (seperti contoh saat praktikum)
* Menggunakan template/skin tabel yang sama untuk menampilkan tabel

## Desaign Program
![image](https://github.com/Kafilli/TP3DPBO2023/assets/100756191/cf14c916-1e53-4c8c-817f-6cad4614e3e7)


Pada program ini terdapat 3 tabel yaitu:
1. Tabel Game yang berisi 7 atribut dengan atribut `game_id` sebagai primary keynya. Tabel ini memiliki relasi many to one dengan tabel Developer dimana foreign keynya ada pada atribut`developer_id` dan juga berelasi many to one dengan tabel Engine dimana foreign keynya ada pada atribut `engine_id`.
2. Tabel Developer berisi 3 atribut dengan atribut `developer_id` sebagai primary keynya. Tabel ini memiliki relasi one to many dengan tabel Game
3. Tabel Engine berisi 3 atribut dengan atribut `engine_id` sebagai primary keynya. Tabel ini memiliki relasi one to many dengan tabel Game.

Dokumentasi Video

https://github.com/Kafilli/TP3DPBO2023/assets/100756191/d768c277-5eba-4bf0-b1c1-5e90c7249e2d




