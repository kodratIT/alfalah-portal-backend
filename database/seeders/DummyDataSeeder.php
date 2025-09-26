<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Profile
        DB::table('profiles')->insert([
            'judul' => 'Pondok Pesantren Miftahul Amanah',
            'deskripsi' => 'Pondok Pesantren Miftahul Amanah adalah lembaga pendidikan Islam modern yang menggabungkan nilai-nilai tradisional dengan teknologi terkini. Didirikan untuk membentuk generasi muslim yang berakhlak mulia, berilmu, dan siap menghadapi tantangan zaman.',
            'sejarah' => 'Pondok Pesantren Miftahul Amanah didirikan pada tahun 2010 oleh KH. Ahmad Fauzi sebagai respon terhadap kebutuhan masyarakat akan pendidikan Islam yang berkualitas. Berawal dari sebuah musholla kecil dengan 15 santri, kini pesantren telah berkembang menjadi lembaga pendidikan yang menampung lebih dari 500 santri dari berbagai daerah.

Seiring berjalannya waktu, pesantren terus melakukan pembenahan dan modernisasi tanpa meninggalkan nilai-nilai tradisional. Pada tahun 2015, pesantren membangun gedung asrama baru dan menambah fasilitas pembelajaran modern. Tahun 2018, pesantren mulai mengintegrasikan teknologi dalam pembelajaran dengan menyediakan laboratorium komputer dan perpustakaan digital.

Kini, Pondok Pesantren Miftahul Amanah telah menjadi salah satu pesantren terkemuka di wilayahnya, dengan alumni yang tersebar di berbagai bidang profesi dan tetap memegang teguh nilai-nilai Islam.',
            'visi' => 'Menjadi lembaga pendidikan Islam terkemuka yang menghasilkan generasi Qurani, berakhlak mulia, menguasai ilmu pengetahuan dan teknologi, serta mampu berkontribusi positif bagi umat dan bangsa.',
            'misi' => json_encode([
                ['misi_item' => 'Menyelenggarakan pendidikan Islam yang komprehensif dengan menggabungkan kurikulum pesantren tradisional dan pendidikan formal'],
                ['misi_item' => 'Membentuk santri yang memiliki pemahaman Islam yang mendalam dan mampu mengamalkannya dalam kehidupan sehari-hari'],
                ['misi_item' => 'Mengembangkan potensi santri dalam bidang akademik, keterampilan, dan kepemimpinan'],
                ['misi_item' => 'Membangun lingkungan pendidikan yang kondusif, islami, dan berbasis teknologi'],
                ['misi_item' => 'Menjalin kerjasama dengan berbagai pihak untuk meningkatkan kualitas pendidikan dan dakwah']
            ]),
            'fasilitas' => json_encode([
                ['nama' => 'Masjid'],
                ['nama' => 'Asrama Putra'],
                ['nama' => 'Asrama Putri'],
                ['nama' => 'Ruang Kelas'],
                ['nama' => 'Laboratorium Komputer'],
                ['nama' => 'Perpustakaan'],
                ['nama' => 'Lapangan Olahraga'],
                ['nama' => 'Klinik Kesehatan'],
                ['nama' => 'Kantin'],
                ['nama' => 'Aula Serbaguna']
            ]),
            'pimpinan' => json_encode([
                [
                    'nama' => 'KH. Ahmad Fauzi, M.Pd.I',
                    'jabatan' => 'Pengasuh Pesantren',
                    'foto' => 'https://picsum.photos/200/200?random=1',
                    'deskripsi' => 'Pendiri dan pengasuh Pondok Pesantren Miftahul Amanah dengan pengalaman lebih dari 20 tahun dalam dunia pendidikan Islam.'
                ],
                [
                    'nama' => 'Ustadz Muhammad Ridwan, S.Pd.I',
                    'jabatan' => 'Kepala Madrasah Aliyah',
                    'foto' => 'https://picsum.photos/200/200?random=2',
                    'deskripsi' => 'Memimpin Madrasah Aliyah dengan fokus pada peningkatan kualitas akademik dan pembentukan karakter santri.'
                ],
                [
                    'nama' => 'Ustadzah Siti Aminah, S.Ag',
                    'jabatan' => 'Kepala Asrama Putri',
                    'foto' => 'https://picsum.photos/200/200?random=3',
                    'deskripsi' => 'Bertanggung jawab atas pembinaan dan pengasuhan santriwati di asrama putri.'
                ]
            ]),
            'tahun_berdiri' => '2010',
            'gambar_sejarah' => 'https://picsum.photos/600/400?random=4',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // 2. Create Programs
        $programs = [
            [
                'judul' => 'Program Tahfidz Al-Quran',
                'deskripsi' => 'Program unggulan untuk menghafal Al-Quran 30 juz dengan metode modern dan pembinaan intensif.',
                'gambar' => 'https://picsum.photos/400/300?random=5',
                'kategori' => 'tahfidz',
                'kategori_usia' => 'Usia 12-18 tahun',
                'jumlah_santri' => '150 santri',
                'keunggulan' => json_encode([
                    'Metode hafalan modern dan efektif',
                    'Pembimbing hafidz berpengalaman',
                    'Target hafalan 30 juz dalam 3 tahun',
                    'Sanad bersambung'
                ]),
                'jadwal' => json_encode([
                    ['waktu' => '04:00 - 05:00', 'kegiatan' => 'Tahajud dan Setoran'],
                    ['waktu' => '05:00 - 06:30', 'kegiatan' => 'Subuh dan Murojaah'],
                    ['waktu' => '07:00 - 12:00', 'kegiatan' => 'Sekolah Formal'],
                    ['waktu' => '14:00 - 16:00', 'kegiatan' => 'Hafalan Baru'],
                    ['waktu' => '19:30 - 21:00', 'kegiatan' => 'Takrir Malam']
                ]),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'judul' => 'Madrasah Tsanawiyah',
                'deskripsi' => 'Pendidikan formal setingkat SMP dengan kurikulum nasional dan pesantren.',
                'gambar' => 'https://picsum.photos/400/300?random=6',
                'kategori' => 'formal',
                'kategori_usia' => 'Usia 13-15 tahun',
                'jumlah_santri' => '200 santri',
                'keunggulan' => json_encode([
                    'Kurikulum Kemenag dan Pesantren',
                    'Pembelajaran bahasa Arab dan Inggris intensif',
                    'Ekstrakurikuler beragam',
                    'Persiapan ujian nasional'
                ]),
                'jadwal' => json_encode([
                    ['waktu' => '07:00 - 14:00', 'kegiatan' => 'KBM Formal'],
                    ['waktu' => '14:30 - 16:00', 'kegiatan' => 'Ekstrakurikuler'],
                    ['waktu' => '16:00 - 17:30', 'kegiatan' => 'Diniyah'],
                    ['waktu' => '19:30 - 21:00', 'kegiatan' => 'Belajar Malam']
                ]),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'judul' => 'Madrasah Aliyah',
                'deskripsi' => 'Pendidikan formal setingkat SMA dengan jurusan IPA, IPS, dan Keagamaan.',
                'gambar' => 'https://picsum.photos/400/300?random=7',
                'kategori' => 'formal',
                'kategori_usia' => 'Usia 16-18 tahun',
                'jumlah_santri' => '180 santri',
                'keunggulan' => json_encode([
                    'Jurusan IPA, IPS, dan Keagamaan',
                    'Persiapan UTBK dan ujian masuk PTN',
                    'Program keterampilan dan entrepreneurship',
                    'Bimbingan karir dan melanjutkan studi'
                ]),
                'jadwal' => json_encode([
                    ['waktu' => '07:00 - 14:30', 'kegiatan' => 'KBM Formal'],
                    ['waktu' => '15:00 - 16:30', 'kegiatan' => 'Les Tambahan'],
                    ['waktu' => '16:30 - 18:00', 'kegiatan' => 'Diniyah Lanjutan'],
                    ['waktu' => '19:30 - 22:00', 'kegiatan' => 'Belajar Mandiri']
                ]),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'judul' => 'Program Kitab Kuning',
                'deskripsi' => 'Pembelajaran kitab-kitab klasik dengan metode sorogan dan bandongan.',
                'gambar' => 'https://picsum.photos/400/300?random=8',
                'kategori' => 'diniyah',
                'kategori_usia' => 'Usia 15 tahun ke atas',
                'jumlah_santri' => '100 santri',
                'keunggulan' => json_encode([
                    'Kajian kitab kuning klasik',
                    'Metode sorogan dan bandongan',
                    'Bahasa Arab aktif',
                    'Ilmu alat (Nahwu, Shorof, Balaghah)'
                ]),
                'jadwal' => json_encode([
                    ['waktu' => '05:30 - 07:00', 'kegiatan' => 'Sorogan Pagi'],
                    ['waktu' => '08:00 - 10:00', 'kegiatan' => 'Bandongan'],
                    ['waktu' => '14:00 - 16:00', 'kegiatan' => 'Mudzakarah'],
                    ['waktu' => '19:30 - 21:00', 'kegiatan' => 'Kitab Malam']
                ]),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('programs')->insert($programs);

        // 3. Create Testimonials
        $testimonials = [
            [
                'nama' => 'Ahmad Rizki',
                'peran' => 'Alumni 2020',
                'angkatan' => '2017',
                'testimoni' => 'Miftahul Amanah telah membentuk saya menjadi pribadi yang lebih baik. Ilmu yang saya dapat sangat bermanfaat untuk kehidupan saya sekarang.',
                'foto' => 'https://picsum.photos/150/150?random=9',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Fatimah Zahra',
                'peran' => 'Alumni 2019',
                'angkatan' => '2016',
                'testimoni' => 'Pesantren ini mengajarkan keseimbangan antara ilmu agama dan umum. Saya bangga menjadi bagian dari keluarga besar Miftahul Amanah.',
                'foto' => 'https://picsum.photos/150/150?random=10',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Muhammad Iqbal',
                'peran' => 'Wali Santri',
                'angkatan' => null,
                'testimoni' => 'Perubahan positif pada anak saya sangat terlihat. Akhlaknya semakin baik dan prestasinya meningkat. Terima kasih Miftahul Amanah.',
                'foto' => 'https://picsum.photos/150/150?random=11',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('testimonials')->insert($testimonials);

        // 4. Create Galleries
        $galleries = [
            [
                'title' => 'Upacara Hari Santri Nasional',
                'description' => 'Peringatan Hari Santri Nasional dengan berbagai kegiatan dan lomba.',
                'thumbnail' => 'https://picsum.photos/800/600?random=12',
                'category' => 'Kegiatan',
                'type' => 'Foto',
                'is_featured' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Gedung Asrama Baru',
                'description' => 'Fasilitas asrama baru dengan kapasitas 200 santri.',
                'thumbnail' => 'https://picsum.photos/800/600?random=13',
                'category' => 'Fasilitas',
                'type' => 'Foto',
                'is_featured' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Wisuda Tahfidz',
                'description' => 'Wisuda santri yang telah menyelesaikan hafalan 30 juz.',
                'thumbnail' => 'https://picsum.photos/800/600?random=14',
                'category' => 'Prestasi',
                'type' => 'Foto',
                'is_featured' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Kegiatan Pembelajaran',
                'description' => 'Suasana pembelajaran di kelas dengan metode interaktif.',
                'thumbnail' => 'https://picsum.photos/800/600?random=15',
                'category' => 'Pembelajaran',
                'type' => 'Foto',
                'is_featured' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('galleries')->insert($galleries);

        // 5. Create Berita
        $beritas = [
            [
                'judul' => 'Pesantren Miftahul Amanah Raih Akreditasi A',
                'konten' => 'Alhamdulillah, Pondok Pesantren Miftahul Amanah berhasil meraih akreditasi A dari Badan Akreditasi Nasional. Pencapaian ini merupakan hasil kerja keras seluruh civitas pesantren dalam meningkatkan kualitas pendidikan. Dengan akreditasi ini, pesantren semakin dipercaya masyarakat sebagai lembaga pendidikan Islam yang berkualitas.',
                'gambar' => 'https://picsum.photos/800/400?random=16',
                'penulis' => 'Admin Pesantren',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5)
            ],
            [
                'judul' => 'Santri Miftahul Amanah Juara MTQ Tingkat Provinsi',
                'konten' => 'Muhammad Fadil, santri kelas XI Madrasah Aliyah berhasil meraih juara 1 dalam Musabaqah Tilawatil Quran (MTQ) tingkat provinsi. Prestasi ini membuktikan kualitas program tahfidz di pesantren kami. Fadil akan mewakili provinsi di MTQ tingkat nasional bulan depan.',
                'gambar' => 'https://picsum.photos/800/400?random=17',
                'penulis' => 'Tim Media',
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(10)
            ],
            [
                'judul' => 'Pembukaan Pendaftaran Santri Baru TA 2025/2026',
                'konten' => 'Pendaftaran santri baru untuk tahun ajaran 2025/2026 telah dibuka. Tersedia kuota 150 santri putra dan 100 santri putri. Pendaftaran dapat dilakukan secara online melalui website resmi pesantren atau datang langsung ke sekretariat. Jangan lewatkan kesempatan untuk bergabung dengan keluarga besar Miftahul Amanah.',
                'gambar' => 'https://picsum.photos/800/400?random=18',
                'penulis' => 'Panitia PSB',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2)
            ]
        ];
        DB::table('beritas')->insert($beritas);

        // 6. Create Contact Info
        DB::table('contact_infos')->insert([
            'alamat' => 'Jl. Pesantren No. 123, Desa Sukamaju, Kec. Cigugur, Kab. Kuningan, Jawa Barat 45552',
            'telepon' => '(0232) 123456',
            'email' => 'info@miftahulamanah.sch.id',
            'whatsapp' => '081234567890',
            'facebook' => 'https://facebook.com/miftahulamanah',
            'instagram' => 'https://instagram.com/miftahulamanah',
            'youtube' => 'https://youtube.com/@miftahulamanah',
            'maps_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.3075748803517!2d108.48259921431737!3d-6.973007170237454!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f1428c3e3c3c3%3A0x3c3c3c3c3c3c3c3c!2sPondok%20Pesantren!5e0!3m2!1sen!2sid!4v1234567890" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // 7. Create some Gurus
        $gurus = [
            [
                'nama' => 'Ustadz Abdul Rahman, S.Pd.I',
                'mata_pelajaran' => 'Fiqih',
                'pendidikan' => 'S1 Pendidikan Agama Islam',
                'pengalaman' => '10 tahun',
                'foto' => 'https://picsum.photos/200/200?random=19',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Ustadzah Nur Hidayah, S.Ag',
                'mata_pelajaran' => 'Al-Quran Hadits',
                'pendidikan' => 'S1 Ilmu Al-Quran dan Tafsir',
                'pengalaman' => '8 tahun',
                'foto' => 'https://picsum.photos/200/200?random=20',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Ustadz Imam Syafii, M.Pd',
                'mata_pelajaran' => 'Bahasa Arab',
                'pendidikan' => 'S2 Pendidikan Bahasa Arab',
                'pengalaman' => '12 tahun',
                'foto' => 'https://picsum.photos/200/200?random=21',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('gurus')->insert($gurus);

        // 8. Create some Santris
        $santris = [
            [
                'nama' => 'Ahmad Fadil',
                'nis' => '2024001',
                'kelas' => 'XI MA',
                'asrama' => 'Asrama Putra A',
                'tanggal_lahir' => '2007-05-15',
                'alamat' => 'Jl. Merdeka No. 45, Bandung',
                'nama_wali' => 'Bapak Suparman',
                'kontak_wali' => '081234567891',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Siti Aisyah',
                'nis' => '2024002',
                'kelas' => 'IX MTs',
                'asrama' => 'Asrama Putri B',
                'tanggal_lahir' => '2009-08-20',
                'alamat' => 'Jl. Sudirman No. 78, Jakarta',
                'nama_wali' => 'Ibu Fatimah',
                'kontak_wali' => '081234567892',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('santris')->insert($santris);

        // 9. Create some Donasis
        $donasis = [
            [
                'nama_donatur' => 'Haji Abdullah',
                'jumlah' => 5000000,
                'tanggal' => now()->subDays(15),
                'keterangan' => 'Donasi untuk pembangunan masjid',
                'bukti_transfer' => 'https://picsum.photos/400/200?random=22',
                'status' => 'verified',
                'created_at' => now()->subDays(15),
                'updated_at' => now()->subDays(15)
            ],
            [
                'nama_donatur' => 'Ibu Khadijah',
                'jumlah' => 2000000,
                'tanggal' => now()->subDays(7),
                'keterangan' => 'Wakaf untuk perpustakaan',
                'bukti_transfer' => 'https://picsum.photos/400/200?random=23',
                'status' => 'verified',
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7)
            ]
        ];
        DB::table('donasis')->insert($donasis);

        // 10. Create Admin User
        DB::table('users')->insert([
            'name' => 'Admin Pesantren',
            'email' => 'admin@miftahulamanah.sch.id',
            'password' => Hash::make('password123'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        echo "Dummy data has been successfully seeded!\n";
    }
}
