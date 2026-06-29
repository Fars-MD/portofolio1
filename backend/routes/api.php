<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/profile', function () {
    return response()->json([
        'name' => 'Nama Anda',
        'role' => 'Full Stack Developer',
        'tagline' => 'Membangun solusi digital yang berdampak',
        'bio' => 'Saya adalah seorang pengembang web yang bersemangat dalam menciptakan aplikasi yang indah dan fungsional.',
        'email' => 'email@example.com',
        'phone' => '+62 812-3456-7890',
        'location' => 'Jakarta, Indonesia',
        'social' => [
            'github' => 'https://github.com/username',
            'linkedin' => 'https://linkedin.com/in/username',
            'twitter' => 'https://twitter.com/username',
        ],
    ]);
});

Route::get('/skills', function () {
    return response()->json([
        ['name' => 'Vue.js', 'level' => 90, 'category' => 'frontend'],
        ['name' => 'React', 'level' => 85, 'category' => 'frontend'],
        ['name' => 'JavaScript', 'level' => 90, 'category' => 'frontend'],
        ['name' => 'Laravel', 'level' => 88, 'category' => 'backend'],
        ['name' => 'PHP', 'level' => 85, 'category' => 'backend'],
        ['name' => 'MySQL', 'level' => 80, 'category' => 'backend'],
        ['name' => 'Git', 'level' => 85, 'category' => 'tools'],
        ['name' => 'Docker', 'level' => 70, 'category' => 'tools'],
    ]);
});

Route::get('/projects', function () {
    return response()->json([
        [
            'id' => 1,
            'title' => 'E-Commerce App',
            'description' => 'Aplikasi e-commerce full stack dengan fitur keranjang belanja dan pembayaran.',
            'image' => 'https://placehold.co/600x400/1a1a2e/e94560?text=E-Commerce',
            'tags' => ['Vue.js', 'Laravel', 'MySQL'],
            'demo_url' => '#',
            'source_url' => '#',
        ],
        [
            'id' => 2,
            'title' => 'Task Management',
            'description' => 'Aplikasi manajemen tugas kolaboratif dengan drag-and-drop.',
            'image' => 'https://placehold.co/600x400/16213e/0f3460?text=Task+Manager',
            'tags' => ['Vue 3', 'Node.js', 'MongoDB'],
            'demo_url' => '#',
            'source_url' => '#',
        ],
        [
            'id' => 3,
            'title' => 'Weather Dashboard',
            'description' => 'Dashboard cuaca interaktif dengan visualisasi data.',
            'image' => 'https://placehold.co/600x400/1b1b2f/e43f5a?text=Weather',
            'tags' => ['React', 'Chart.js', 'REST API'],
            'demo_url' => '#',
            'source_url' => '#',
        ],
    ]);
});

Route::post('/contact', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    return response()->json([
        'message' => 'Pesan berhasil dikirim. Terima kasih!',
        'data' => $validated,
    ]);
});
