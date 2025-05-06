<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Laporan;
use App\Models\Mitra;
use App\Models\User;
use Carbon\Carbon;

class LaporanSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua mitra yang sudah disetujui
        $mitras = Mitra::where('status', 'disetujui')->get();
        
        // Ambil beberapa pegawai
        $pegawais = User::where('role', 'pegawai')->take(3)->get();

        if ($mitras->isEmpty() || $pegawais->isEmpty()) {
            $this->command->info('Tidak ada mitra yang disetujui atau pegawai yang tersedia.');
            return;
        }

        $metodes = ['Kunjungan Langsung', 'Video Call'];
        $juduls = [
            'Evaluasi Kinerja dan Pembahasan Program Bulanan',
            'Diskusi Strategi Digital Marketing dan Pengembangan Produk',
            'Inspeksi dan Pembinaan Operasional Mitra',
            'Evaluasi Komprehensif Operasional dan Manajemen Risiko',
            'Program Pembinaan dan Pengembangan SDM Mitra',
            'Analisis Pasar dan Strategi Ekspansi Bisnis',
            'Pelatihan Teknis dan Konsultasi Operasional',
            'Monitoring Implementasi Program dan Evaluasi Hasil',
            'Pembahasan Inovasi Produk dan Strategi Pemasaran',
            'Evaluasi Keuangan dan Perencanaan Strategis'
        ];
        $keterangans = [
            "Kunjungan rutin bulanan ke mitra dilakukan pada tanggal ini. Selama kunjungan, kami melakukan beberapa hal penting:

1. Evaluasi Kinerja:
- Melakukan pengecekan terhadap target penjualan bulanan
- Menganalisis tren penjualan produk
- Mengevaluasi efektivitas strategi pemasaran yang dijalankan

2. Pembahasan Program:
- Mendiskusikan program promosi untuk bulan depan
- Merencanakan event khusus untuk meningkatkan penjualan
- Membahas strategi untuk mengatasi persaingan di pasar

3. Pelatihan dan Pengembangan:
- Memberikan pelatihan tentang produk terbaru
- Berbagi best practices dalam penjualan
- Mendiskusikan teknik pemasaran yang efektif

4. Masalah dan Solusi:
- Mengidentifikasi kendala yang dihadapi mitra
- Memberikan solusi untuk masalah operasional
- Membahas cara meningkatkan efisiensi bisnis

5. Rencana Ke Depan:
- Menetapkan target penjualan untuk bulan berikutnya
- Merencanakan strategi ekspansi pasar
- Membahas potensi pengembangan bisnis baru

Hasil kunjungan menunjukkan bahwa mitra mengalami peningkatan penjualan sebesar 15% dibandingkan bulan sebelumnya. Beberapa program baru yang direncanakan diharapkan dapat meningkatkan performa penjualan lebih lanjut.",

            "Melakukan video call dengan mitra untuk membahas perkembangan bisnis terkini. Berikut adalah ringkasan diskusi:

1. Analisis Pasar:
- Membahas kondisi pasar saat ini
- Menganalisis tren konsumen
- Mengevaluasi posisi kompetitif

2. Strategi Digital:
- Merencanakan kampanye digital marketing
- Membahas optimasi media sosial
- Mendiskusikan strategi content marketing

3. Pengembangan Produk:
- Membahas feedback dari konsumen
- Merencanakan inovasi produk
- Mendiskusikan packaging dan branding

4. Operasional:
- Mengevaluasi efisiensi supply chain
- Membahas manajemen inventory
- Merencanakan optimasi proses bisnis

5. Peluang Bisnis:
- Mengidentifikasi peluang pasar baru
- Membahas potensi kolaborasi
- Merencanakan ekspansi bisnis

Diskusi berjalan sangat produktif dengan beberapa kesepakatan penting untuk pengembangan bisnis ke depan.",

            "Melakukan kunjungan ke lokasi mitra untuk melakukan inspeksi dan pembinaan. Berikut adalah temuan dan tindak lanjut:

1. Kondisi Operasional:
- Melakukan pengecekan fasilitas
- Mengevaluasi standar operasional
- Memeriksa kelengkapan peralatan

2. Kualitas Layanan:
- Mengobservasi proses layanan
- Mengevaluasi kepuasan pelanggan
- Memeriksa standar pelayanan

3. Manajemen SDM:
- Membahas pengembangan tim
- Mengevaluasi performa karyawan
- Merencanakan program pelatihan

4. Keuangan:
- Membahas laporan keuangan
- Mengevaluasi efisiensi biaya
- Merencanakan strategi keuangan

5. Pengembangan:
- Membahas rencana ekspansi
- Mengevaluasi potensi pasar
- Merencanakan strategi pertumbuhan

Kunjungan ini menghasilkan beberapa rekomendasi penting untuk peningkatan performa bisnis mitra.",

            "Melakukan evaluasi komprehensif terhadap operasional mitra. Berikut adalah hasil evaluasi:

1. Analisis Performa:
- Mengevaluasi pencapaian target
- Menganalisis tren penjualan
- Memeriksa efisiensi operasional

2. Manajemen Risiko:
- Mengidentifikasi potensi risiko
- Mengevaluasi sistem kontrol
- Merencanakan mitigasi risiko

3. Pengembangan Bisnis:
- Membahas strategi pertumbuhan
- Mengevaluasi peluang pasar
- Merencanakan ekspansi bisnis

4. Teknologi:
- Mengevaluasi sistem informasi
- Membahas digitalisasi proses
- Merencanakan upgrade teknologi

5. Sustainability:
- Membahas program ramah lingkungan
- Mengevaluasi dampak sosial
- Merencanakan inisiatif CSR

Evaluasi ini memberikan gambaran komprehensif tentang kondisi bisnis mitra dan rekomendasi untuk pengembangan ke depan.",

            "Melakukan pembinaan dan pendampingan kepada mitra. Berikut adalah aktivitas yang dilakukan:

1. Pelatihan:
- Memberikan pelatihan manajemen
- Membahas teknik penjualan
- Melatih customer service

2. Konsultasi:
- Membahas strategi bisnis
- Memberikan saran operasional
- Mendiskusikan pengembangan

3. Monitoring:
- Memeriksa implementasi program
- Mengevaluasi hasil pelatihan
- Memantau perkembangan

4. Problem Solving:
- Mengidentifikasi masalah
- Mencari solusi bersama
- Merencanakan tindak lanjut

5. Pengembangan:
- Membahas rencana jangka panjang
- Merencanakan strategi pertumbuhan
- Mendiskusikan inovasi

Pembinaan ini memberikan dampak positif terhadap pengembangan bisnis mitra."
        ];

        // Buat 10 laporan
        for ($i = 0; $i < 10; $i++) {
            $mitra = $mitras->random();
            $pegawai = $pegawais->random();
            $metode = $metodes[array_rand($metodes)];
            $judul = $juduls[$i];
            $keterangan = $keterangans[array_rand($keterangans)];
            
            // Buat tanggal acak dalam 3 bulan terakhir
            $tanggal = Carbon::now()->subDays(rand(0, 90));

            Laporan::create([
                'mitra_id' => $mitra->id,
                'pegawai_id' => $pegawai->id,
                'judul' => $judul,
                'tanggal_laporan' => $tanggal,
                'keterangan' => $keterangan,
                'metode' => $metode,
                'media_foto' => null, // Bisa ditambahkan nanti jika diperlukan
                'media_video' => null, // Bisa ditambahkan nanti jika diperlukan
            ]);
        }

        $this->command->info('Seeder Laporan berhasil dijalankan!');
    }
} 