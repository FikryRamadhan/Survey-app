<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Data survei
        $surveys = [
            [
                'title' => 'DPMPTSP',
                'description' => 'Layanan DPMPTSP Kabupaten Kuningan.',
                'status' => 'active',
                'questions' => [
                    'Apakah informasi pelayanan DPMPTSP mudah dipahami?',
                    'Bagaimana tingkat keramahan staf pelayanan DPMPTSP?',
                    'Apakah proses pengajuan izin sudah efisien?',
                    'Bagaimana pendapat Anda tentang waktu tunggu pelayanan?',
                    'Apakah Anda puas dengan kualitas fasilitas di DPMPTSP?',
                    'Bagaimana tingkat kecepatan respons terhadap keluhan?',
                    'Apakah layanan daring (online) DPMPTSP sudah memadai?',
                    'Seberapa mudah mengakses layanan DPMPTSP secara langsung?',
                    'Bagaimana pengalaman Anda dalam memproses dokumen?',
                    'Apakah Anda akan merekomendasikan layanan DPMPTSP kepada orang lain?',
                ],
            ],
            [
                'title' => 'IMIGRASI',
                'description' => 'Layanan Keimigrasian.',
                'status' => 'active',
                'questions' => [
                    'Seberapa mudah proses pengajuan paspor di kantor imigrasi?',
                    'Bagaimana sikap dan pelayanan staf imigrasi?',
                    'Apakah fasilitas ruang tunggu di kantor imigrasi memadai?',
                    'Bagaimana pendapat Anda tentang kejelasan informasi terkait dokumen?',
                    'Apakah Anda puas dengan waktu proses penerbitan paspor?',
                    'Apakah layanan online keimigrasian sudah sesuai harapan?',
                    'Seberapa baik respons staf terhadap keluhan atau pertanyaan Anda?',
                    'Apakah alur pelayanan imigrasi sudah jelas dan terstruktur?',
                    'Apakah lokasi kantor imigrasi mudah dijangkau?',
                    'Bagaimana pengalaman Anda secara keseluruhan dengan layanan keimigrasian?',
                ],
            ],
            [
                'title' => 'DISDUKCAPIL',
                'description' => 'Layanan Kependudukan dan Pencatatan Sipil.',
                'status' => 'active',
                'questions' => [
                    'Apakah proses pembuatan KTP berjalan dengan lancar?',
                    'Seberapa cepat Anda menerima dokumen kependudukan?',
                    'Bagaimana keramahan staf DISDUKCAPIL saat melayani Anda?',
                    'Apakah fasilitas di kantor DISDUKCAPIL memadai?',
                    'Bagaimana pendapat Anda tentang waktu tunggu pelayanan?',
                    'Seberapa jelas informasi yang diberikan terkait prosedur administrasi?',
                    'Apakah Anda puas dengan layanan online DISDUKCAPIL?',
                    'Bagaimana pengalaman Anda dalam pengurusan akta kelahiran?',
                    'Seberapa mudah mengakses layanan di kantor DISDUKCAPIL?',
                    'Apakah Anda puas dengan penyelesaian masalah administrasi kependudukan Anda?',
                ],
            ],
            // Tambahkan data survei lainnya di sini
        ];

        // Proses insert data survei dan pertanyaan
        foreach ($surveys as $surveyData) {
            // Insert data survey ke tabel 'surveys'
            $surveyId = DB::table('surveys')->insertGetId([
                'title' => $surveyData['title'],
                'description' => $surveyData['description'],
                'status' => $surveyData['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insert pertanyaan untuk setiap survei ke tabel 'survey_questions'
            $questions = [];
            foreach ($surveyData['questions'] as $question) {
                $questions[] = [
                    'survey_id' => $surveyId,
                    'question' => $question,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('survey_questions')->insert($questions);
        }

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin', // Tambahkan kolom 'role' jika ada
        ]);

        // Regular User
        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'users', // Tambahkan kolom 'role' jika ada
        ]);
    }
}
