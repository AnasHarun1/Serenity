<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        // KITA KOSONGKAN DULU TABEL ARTIKEL AGAR TIDAK DOBEL
        Article::truncate();

        $articles = [
            // =============================================
            // KATEGORI 1: UNTUK MOOD SEDIH / CEMAS (Level 1-2)
            // =============================================
            [
                'title' => 'Teknik Grounding 5-4-3-2-1: Pertolongan Pertama Saat Panik',
                'category' => 'Anxiety',
                'mood_tag' => 'sad',
                'image_url' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&q=80',
                'content' => "Pernahkah Anda merasa tiba-tiba sesak napas, jantung berdebar, dan pikiran kacau tanpa alasan yang jelas? Itu mungkin tanda serangan kecemasan. Salah satu cara paling efektif untuk menghentikannya adalah dengan teknik 'Grounding' 5-4-3-2-1.\n\nTeknik ini bekerja dengan mengalihkan fokus otak dari pikiran yang menakutkan ke lingkungan fisik di sekitar Anda. Caranya sederhana: Mulailah dengan mencari 5 benda yang bisa Anda lihat. Perhatikan detailnya, warnanya, dan bentuknya. Kemudian, cari 4 benda yang bisa Anda sentuh (seperti kain baju atau meja).\n\nLanjutkan dengan 3 suara yang bisa Anda dengar (suara AC, burung, atau kendaraan). Lalu 2 hal yang bisa Anda cium aromanya. Terakhir, 1 hal yang bisa Anda rasakan (seperti rasa air putih di lidah). Lakukan ini perlahan sambil mengatur napas, dan Anda akan merasakan ketenangan kembali secara bertahap."
            ],
            [
                'title' => 'Validasi Emosi: Mengapa Tidak Apa-apa untuk Tidak Baik-baik Saja',
                'category' => 'Healing',
                'mood_tag' => 'sad',
                'image_url' => 'https://images.unsplash.com/photo-1516585427167-9f4af9627e6c?w=800&q=80',
                'content' => "Dalam dunia yang serba cepat ini, kita sering dipaksa untuk selalu terlihat kuat dan bahagia. Padahal, menyangkal rasa sedih justru bisa menjadi bom waktu bagi kesehatan mental kita. Validasi emosi adalah kunci pertama menuju pemulihan.\n\nKetika Anda merasa sedih, kecewa, atau marah, cobalah untuk tidak menghakiminya. Katakan pada diri sendiri, 'Saya sedang sedih, dan itu wajar karena saya baru saja mengalami hari yang berat.' Memberi label pada emosi ('Name it to tame it') terbukti dapat menurunkan aktivitas di amigdala, bagian otak yang merespons rasa takut.\n\nIngatlah bahwa emosi itu seperti cuaca. Badai pasti berlalu, hujan pasti reda. Anda tidak perlu memaksakan matahari untuk terbit di tengah malam. Istirahatlah, menangislah jika perlu, karena air mata mengandung hormon stres yang dikeluarkan tubuh secara alami."
            ],
            [
                'title' => 'Burnout Akademik: Tanda-tanda dan Cara Mengatasinya',
                'category' => 'Stress',
                'mood_tag' => 'sad',
                'image_url' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=800&q=80',
                'content' => "Merasa lelah sepanjang waktu bahkan setelah tidur cukup? Kehilangan motivasi untuk kuliah? Atau menjadi sinis terhadap dosen dan teman? Hati-hati, itu bukan sekadar malas, tapi tanda-tanda Burnout.\n\nBurnout akademik terjadi karena stres kronis yang tidak tertangani. Otak Anda kelelahan karena terus-menerus dipaksa bekerja tanpa istirahat yang berkualitas. Solusinya bukan 'belajar lebih keras', tapi 'istirahat lebih cerdas'.\n\nCobalah terapkan teknik Pomodoro (25 menit kerja, 5 menit istirahat). Prioritaskan tidur 7-8 jam sehari. Dan yang terpenting, temukan hobi kecil di luar akademik yang membuat Anda bahagia, entah itu memasak, melukis, atau sekadar jalan-jalan sore. Anda adalah manusia, bukan robot pengerja tugas."
            ],

            // =============================================
            // KATEGORI 2: UNTUK MOOD NETRAL / BIASA (Level 3)
            // =============================================
            [
                'title' => 'Sleep Hygiene: Cara Tidur Berkualitas untuk Otak yang Sehat',
                'category' => 'Sleep',
                'mood_tag' => 'neutral',
                'image_url' => 'https://images.unsplash.com/photo-1541781777621-af118a8b0d29?w=800&q=80',
                'content' => "Tahukah Anda bahwa kualitas tidur mempengaruhi 80% stabilitas emosi Anda keesokan harinya? Banyak dari kita tidur lama tapi bangun tetap lelah. Masalahnya mungkin ada pada 'Sleep Hygiene' atau kebersihan tidur Anda.\n\nUntuk memperbaikinya, mulailah dengan aturan 10-3-2-1. 10 jam sebelum tidur hindari kafein. 3 jam sebelum tidur hindari makan berat. 2 jam sebelum tidur berhenti bekerja. Dan 1 jam sebelum tidur, jauhkan layar gadget (Blue Light).\n\nCahaya biru dari HP menipu otak Anda untuk berpikir bahwa ini masih siang hari, sehingga menghambat produksi melatonin (hormon tidur). Ganti scrolling medsos dengan membaca buku fisik atau mendengarkan musik relaksasi agar tidur Anda lebih nyenyak dan bangun lebih segar."
            ],
            [
                'title' => 'Atomic Habits: Perubahan Besar dari Langkah Kecil',
                'category' => 'Self Dev',
                'mood_tag' => 'neutral',
                'image_url' => 'https://images.unsplash.com/photo-1484480974693-6ca0a78fb36b?w=800&q=80',
                'content' => "Banyak orang gagal membangun kebiasaan baru karena mereka terlalu ambisius di awal. 'Saya mau lari 10km setiap hari!' Hasilnya? Seminggu kemudian berhenti total karena kelelahan. Kuncinya adalah 'Atomic Habits'.\n\nMulailah dari hal yang sangat kecil sehingga mustahil untuk gagal. Ingin rajin membaca? Targetkan baca 1 halaman saja per hari. Ingin olahraga? Targetkan pakai sepatu lari saja dulu.\n\nKonsistensi jauh lebih penting daripada intensitas. Jika Anda bisa menjadi 1% lebih baik setiap hari, dalam setahun Anda akan menjadi 37 kali lipat lebih baik. Jangan remehkan kekuatan langkah kecil yang dilakukan terus-menerus."
            ],
            [
                'title' => 'Digital Detox: Mengembalikan Fokus yang Hilang',
                'category' => 'Lifestyle',
                'mood_tag' => 'neutral',
                'image_url' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=800&q=80',
                'content' => "Di era notifikasi yang tiada henti, kemampuan kita untuk fokus (Deep Work) semakin menurun. Kita menjadi mudah terdistraksi dan cemas jika tertinggal informasi (FOMO). Saatnya melakukan Digital Detox sederhana.\n\nCobalah mode 'Do Not Disturb' pada jam-jam produktif. Matikan notifikasi aplikasi yang tidak krusial seperti media sosial atau game. Tetapkan zona bebas HP, misalnya di meja makan atau di tempat tidur.\n\nDengan mengurangi kebisingan digital, otak Anda mendapatkan ruang untuk bernapas, berpikir jernih, dan menjadi lebih kreatif. Dunia tidak akan runtuh hanya karena Anda tidak membalas chat selama 1 jam."
            ],

            // =============================================
            // KATEGORI 3: UNTUK MOOD SENANG / HEBAT (Level 4-5)
            // =============================================
            [
                'title' => 'Memanfaatkan Momentum: Cara Produktif Saat Bahagia',
                'category' => 'Productivity',
                'mood_tag' => 'happy',
                'image_url' => 'https://images.unsplash.com/photo-1499209974431-9dddcece7f88?w=800&q=80',
                'content' => "Saat mood Anda sedang 'Hebat' seperti hari ini, otak Anda berada dalam kondisi prima. Dopamin sedang tinggi, kreativitas mengalir, dan energi melimpah. Jangan sia-siakan momen emas ini hanya untuk bersantai!\n\nIni adalah waktu terbaik untuk mengerjakan tugas tersulit yang selama ini Anda tunda (Eat the Frog). Gunakan energi positif ini untuk menyelesaikan proyek besar, brainstorming ide skripsi, atau mempelajari skill baru yang sulit.\n\nPenelitian menunjukkan bahwa orang yang bekerja saat mood positif cenderung 31% lebih produktif dan 3x lebih kreatif. Jadi, buka laptopmu sekarang dan selesaikan tantangan terbesar hari ini!"
            ],
            [
                'title' => 'The Art of Gratitude: Melipatgandakan Kebahagiaan',
                'category' => 'Mindfulness',
                'mood_tag' => 'happy',
                'image_url' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&q=80',
                'content' => "Kebahagiaan itu seperti otot, semakin dilatih semakin kuat. Cara terbaik melatihnya adalah dengan bersyukur. Hari ini Anda merasa hebat, tapi bagaimana cara menyimpannya agar tahan lama?\n\nTulislah 'Gratitude Journal'. Catat 3 hal spesifik yang membuat Anda tersenyum hari ini. Bukan sekadar 'Saya senang', tapi 'Saya senang karena kopi pagi ini enak sekali' atau 'Saya senang karena teman memuji baju saya'.\n\nDengan mencatat detail kecil, Anda melatih otak untuk selalu memindai hal-hal positif di sekitar Anda (Positive Scanning). Ini akan membuat mental Anda lebih tangguh saat menghadapi hari-hari buruk di masa depan."
            ],
            [
                'title' => 'Efek Domino Kebaikan: Berbagi Energi Positif',
                'category' => 'Social',
                'mood_tag' => 'happy',
                'image_url' => 'https://images.unsplash.com/photo-1529333166437-7750a6dd5a70?w=800&q=80',
                'content' => "Tahukah Anda bahwa kebahagiaan itu menular? Fenomena ini disebut 'Emotional Contagion'. Saat Anda tersenyum, orang yang melihat Anda secara tidak sadar akan meniru ekspresi tersebut.\n\nManfaatkan mood baik Anda hari ini untuk menjadi 'Matahari' bagi orang lain. Berikan pujian tulus pada teman, traktir seseorang makan siang, atau sekadar dengarkan curhatan mereka dengan sabar.\n\nKebaikan yang Anda berikan akan memicu pelepasan hormon Oksitosin (hormon cinta) baik bagi Anda maupun penerimanya. Ini menciptakan siklus kebahagiaan yang tidak putus. Mari buat dunia sedikit lebih cerah hari ini!"
            ],
        ];

        foreach ($articles as $data) {
            Article::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'category' => $data['category'],
                'image_url' => $data['image_url'],
                'content' => $data['content'],
                'mood_tag' => $data['mood_tag'],
            ]);
        }
    }
}