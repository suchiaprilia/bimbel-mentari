<?php

namespace App\Http\Controllers;

class ProgramController extends Controller
{
    public function show($slug)
    {
        $programs = [
            'sd' => [
                'nama' => 'Program SD',
                'kelas' => 'Kelas 4 - 6',
                'icon' => 'fas fa-child',
                'deskripsi' => 'Program SD dirancang untuk membantu siswa sekolah dasar memahami pelajaran utama dengan cara yang mudah, menyenangkan, dan terarah.',
                'materi' => [
                    'Matematika Dasar',
                    'Bahasa Indonesia',
                    'IPA Terpadu',
                    'Persiapan Ujian Sekolah',
                ],
                'keunggulan' => [
                    'Materi mudah dipahami',
                    'Pembelajaran sesuai jenjang SD',
                    'Membantu persiapan ujian sekolah',
                    'Latihan soal terarah',
                ],
            ],

            'smp' => [
                'nama' => 'Program SMP',
                'kelas' => 'Kelas 7 - 9',
                'icon' => 'fas fa-user-graduate',
                'deskripsi' => 'Program SMP membantu siswa memahami materi pelajaran yang lebih kompleks melalui pembelajaran terstruktur dan latihan soal.',
                'materi' => [
                    'Matematika & Statistika',
                    'IPA Fisika dan Biologi',
                    'Bahasa Inggris',
                    'Latihan Soal Terstruktur',
                ],
                'keunggulan' => [
                    'Materi sesuai pelajaran SMP',
                    'Latihan soal rutin',
                    'Membantu persiapan ujian',
                    'Belajar lebih terarah',
                ],
            ],

            'sma' => [
                'nama' => 'Program SMA',
                'kelas' => 'Kelas 10 - 12',
                'icon' => 'fas fa-university',
                'deskripsi' => 'Program SMA difokuskan untuk membantu siswa memahami materi lanjutan dan mempersiapkan diri menghadapi ujian serta seleksi masuk perguruan tinggi.',
                'materi' => [
                    'Matematika Peminatan',
                    'Fisika / Kimia / Biologi',
                    'Bahasa Inggris',
                    'Persiapan UTBK/SNBT',
                ],
                'keunggulan' => [
                    'Materi tingkat lanjut',
                    'Persiapan ujian sekolah',
                    'Persiapan UTBK/SNBT',
                    'Latihan soal lebih intensif',
                ],
            ],
        ];

        if (!array_key_exists($slug, $programs)) {
            abort(404);
        }

        $program = $programs[$slug];

        return view('program-detail', compact('program', 'slug'));
    }
}