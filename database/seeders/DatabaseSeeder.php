<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Certificate;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin Portfolio',
            'email' => 'admin@portfolio.com',
            'password' => Hash::make('password123'),
        ]);

        Profile::create([
            'user_id' => $user->id,
            'full_name' => 'Ahmad Rizki Pratama',
            'title' => 'Full Stack Web Developer',
            'tagline' => 'Crafting digital experiences with clean code & modern design',
            'bio' => 'Passionate Full Stack Developer with 5+ years of experience building scalable web applications. Specializing in Laravel, Vue.js, and React. I love turning complex problems into elegant solutions and am always eager to learn new technologies.',
            'email' => 'ahmad.rizki@example.com',
            'phone' => '+62 812-3456-7890',
            'location' => 'Jakarta, Indonesia',
            'website' => 'https://ahmadrizki.dev',
            'github' => 'https://github.com/ahmadrizki',
            'linkedin' => 'https://linkedin.com/in/ahmadrizki',
            'twitter' => 'https://twitter.com/ahmadrizki',
            'instagram' => 'https://instagram.com/ahmadrizki',
            'years_experience' => 5,
            'projects_completed' => 48,
            'clients_served' => 32,
            'available_for_hire' => true,
        ]);

        $skills = [
            ['name' => 'Laravel', 'category' => 'Backend', 'level' => 95, 'color' => '#FF2D20', 'is_featured' => true, 'sort_order' => 1],
            ['name' => 'PHP', 'category' => 'Backend', 'level' => 92, 'color' => '#777BB4', 'is_featured' => true, 'sort_order' => 2],
            ['name' => 'Vue.js', 'category' => 'Frontend', 'level' => 88, 'color' => '#4FC08D', 'is_featured' => true, 'sort_order' => 3],
            ['name' => 'React', 'category' => 'Frontend', 'level' => 82, 'color' => '#61DAFB', 'is_featured' => true, 'sort_order' => 4],
            ['name' => 'JavaScript', 'category' => 'Frontend', 'level' => 90, 'color' => '#F7DF1E', 'is_featured' => true, 'sort_order' => 5],
            ['name' => 'Tailwind CSS', 'category' => 'Frontend', 'level' => 93, 'color' => '#38BDF8', 'is_featured' => true, 'sort_order' => 6],
            ['name' => 'MySQL', 'category' => 'Database', 'level' => 88, 'color' => '#4479A1', 'is_featured' => false, 'sort_order' => 7],
            ['name' => 'PostgreSQL', 'category' => 'Database', 'level' => 80, 'color' => '#336791', 'is_featured' => false, 'sort_order' => 8],
            ['name' => 'Redis', 'category' => 'Database', 'level' => 75, 'color' => '#DC382D', 'is_featured' => false, 'sort_order' => 9],
            ['name' => 'Docker', 'category' => 'DevOps', 'level' => 78, 'color' => '#2496ED', 'is_featured' => false, 'sort_order' => 10],
            ['name' => 'Git', 'category' => 'Tools', 'level' => 92, 'color' => '#F05032', 'is_featured' => false, 'sort_order' => 11],
            ['name' => 'REST API', 'category' => 'Backend', 'level' => 95, 'color' => '#6C63FF', 'is_featured' => false, 'sort_order' => 12],
        ];

        foreach ($skills as $skill) {
            Skill::create(array_merge($skill, ['user_id' => $user->id]));
        }

        $projects = [
            [
                'title' => 'E-Commerce Platform',
                'slug' => 'e-commerce-platform',
                'description' => 'Full-featured e-commerce platform with multi-vendor support, payment gateway integration, and real-time inventory management.',
                'detail' => 'Built a comprehensive e-commerce solution supporting multiple vendors. Features include product management, shopping cart, Midtrans payment integration, order tracking, email notifications, and admin analytics dashboard.',
                'tech_stack' => 'Laravel,Vue.js,MySQL,Redis,Tailwind CSS,Midtrans',
                'demo_url' => 'https://demo.example.com',
                'github_url' => 'https://github.com/example',
                'status' => 'completed',
                'category' => 'Web',
                'is_featured' => true,
                'start_date' => '2023-01-01',
                'end_date' => '2023-06-30',
                'sort_order' => 1,
            ],
            [
                'title' => 'Hospital Management System',
                'slug' => 'hospital-management-system',
                'description' => 'Comprehensive hospital management system with patient records, appointment scheduling, billing, and pharmacy modules.',
                'detail' => 'Developed an end-to-end hospital management system. Modules include patient registration, doctor scheduling, appointment booking, medical records, prescription management, billing, and detailed reporting.',
                'tech_stack' => 'Laravel,React,MySQL,Bootstrap,Chart.js',
                'demo_url' => null,
                'github_url' => 'https://github.com/example/hms',
                'status' => 'completed',
                'category' => 'Web',
                'is_featured' => true,
                'start_date' => '2022-08-01',
                'end_date' => '2023-01-31',
                'sort_order' => 2,
            ],
            [
                'title' => 'Task Management App',
                'slug' => 'task-management-app',
                'description' => 'Collaborative task management application with real-time updates, team workspaces, and productivity analytics.',
                'detail' => 'A Trello-like task management app with drag-and-drop board interface, real-time collaboration via Laravel Echo and Pusher, team management, file attachments, and detailed productivity reports.',
                'tech_stack' => 'Laravel,Vue.js,Pusher,MySQL,Tailwind CSS',
                'demo_url' => 'https://tasks.example.com',
                'github_url' => 'https://github.com/example/tasks',
                'status' => 'completed',
                'category' => 'Web',
                'is_featured' => true,
                'start_date' => '2022-03-01',
                'end_date' => '2022-07-31',
                'sort_order' => 3,
            ],
            [
                'title' => 'REST API for Mobile Banking',
                'slug' => 'rest-api-mobile-banking',
                'description' => 'Secure and scalable REST API for mobile banking application with JWT authentication and transaction management.',
                'detail' => 'Designed and built a comprehensive REST API for a mobile banking app. Implemented JWT auth, account management, fund transfers, transaction history, notifications, and fraud detection algorithms.',
                'tech_stack' => 'Laravel,MySQL,JWT,Redis,Postman',
                'demo_url' => null,
                'github_url' => null,
                'status' => 'completed',
                'category' => 'API',
                'is_featured' => false,
                'start_date' => '2021-09-01',
                'end_date' => '2022-02-28',
                'sort_order' => 4,
            ],
            [
                'title' => 'Portfolio Website Builder',
                'slug' => 'portfolio-website-builder',
                'description' => 'SaaS platform allowing professionals to create beautiful portfolio websites with no coding required.',
                'detail' => 'Built a drag-and-drop portfolio builder SaaS. Users can choose from templates, customize sections, add projects/skills/certificates, connect custom domains, and publish their portfolios instantly.',
                'tech_stack' => 'Laravel,React,MySQL,Tailwind CSS,AWS S3',
                'demo_url' => 'https://portfoliobuilder.example.com',
                'github_url' => 'https://github.com/example/portfolio-builder',
                'status' => 'in_progress',
                'category' => 'SaaS',
                'is_featured' => false,
                'start_date' => '2023-07-01',
                'end_date' => null,
                'sort_order' => 5,
            ],
            [
                'title' => 'Inventory Management System',
                'slug' => 'inventory-management-system',
                'description' => 'Smart inventory management system with barcode scanning, automated reordering, and multi-warehouse support.',
                'detail' => 'Comprehensive inventory solution with barcode/QR scanning, stock level tracking, automated purchase orders, supplier management, multi-warehouse support, and advanced reporting.',
                'tech_stack' => 'Laravel,Vue.js,MySQL,Chart.js,Bootstrap',
                'demo_url' => null,
                'github_url' => 'https://github.com/example/inventory',
                'status' => 'completed',
                'category' => 'Web',
                'is_featured' => false,
                'start_date' => '2021-03-01',
                'end_date' => '2021-08-31',
                'sort_order' => 6,
            ],
        ];

        foreach ($projects as $project) {
            Project::create(array_merge($project, ['user_id' => $user->id]));
        }

        $certificates = [
            [
                'title' => 'Laravel Certified Developer',
                'issuer' => 'Laravel',
                'credential_id' => 'LCD-2023-001234',
                'credential_url' => 'https://laravel.com/verify',
                'issued_date' => '2023-03-15',
                'expiry_date' => null,
                'has_expiry' => false,
                'category' => 'Framework',
                'is_featured' => true,
            ],
            [
                'title' => 'AWS Solutions Architect Associate',
                'issuer' => 'Amazon Web Services',
                'credential_id' => 'AWS-SAA-C03-78901',
                'credential_url' => 'https://aws.amazon.com/verify',
                'issued_date' => '2022-11-20',
                'expiry_date' => '2025-11-20',
                'has_expiry' => true,
                'category' => 'Cloud',
                'is_featured' => true,
            ],
            [
                'title' => 'Google Professional Cloud Developer',
                'issuer' => 'Google Cloud',
                'credential_id' => 'GCP-PCD-2022-45678',
                'credential_url' => 'https://cloud.google.com/verify',
                'issued_date' => '2022-06-10',
                'expiry_date' => '2024-06-10',
                'has_expiry' => true,
                'category' => 'Cloud',
                'is_featured' => true,
            ],
            [
                'title' => 'Meta Frontend Developer Professional Certificate',
                'issuer' => 'Meta (Coursera)',
                'credential_id' => 'META-FE-2023-12345',
                'credential_url' => 'https://coursera.org/verify',
                'issued_date' => '2023-01-25',
                'expiry_date' => null,
                'has_expiry' => false,
                'category' => 'Frontend',
                'is_featured' => false,
            ],
            [
                'title' => 'Docker Certified Associate',
                'issuer' => 'Docker Inc.',
                'credential_id' => 'DCA-2022-56789',
                'credential_url' => 'https://docker.com/verify',
                'issued_date' => '2022-09-05',
                'expiry_date' => '2024-09-05',
                'has_expiry' => true,
                'category' => 'DevOps',
                'is_featured' => false,
            ],
            [
                'title' => 'Certified Kubernetes Application Developer',
                'issuer' => 'Cloud Native Computing Foundation',
                'credential_id' => 'CKAD-2023-98765',
                'credential_url' => 'https://cncf.io/verify',
                'issued_date' => '2023-07-18',
                'expiry_date' => '2026-07-18',
                'has_expiry' => true,
                'category' => 'DevOps',
                'is_featured' => false,
            ],
        ];

        foreach ($certificates as $cert) {
            Certificate::create(array_merge($cert, ['user_id' => $user->id]));
        }
    }
}