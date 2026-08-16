<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // حساب الأدمن الأول: بما إن فورم التسجيل العام بقى ميسمحش
        // باختيار role=admin (لأسباب أمنية)، ده هو الطريق الوحيد
        // لإنشاء أدمن. الإيميل والباسورد بييجوا من .env عشان محدش
        // يحط بيانات دخول ثابتة (hardcoded) في الكود.
        User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@sanaa.test')],
            [
                'name'     => 'Admin',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'ChangeMe123!')),
                'role'     => 'admin',
            ]
        );

        // تصنيفات الخدمات الأساسية
        // slug مكتوب يدوي بالإنجليزي عشان Str::slug مش بتترجم العربي كويس
        $categories = [
            'سباكة'         => 'plumbing',
            'كهرباء'        => 'electricity',
            'نجارة'         => 'carpentry',
            'دهانات'        => 'painting',
            'تكييف وتبريد'  => 'ac-cooling',
            'تسليك مواسير'  => 'drain-cleaning',
            'نقل عفش'       => 'moving',
            'تنظيف منازل'   => 'cleaning',
            'حاجة تانية'    => 'other',
        ];

        foreach ($categories as $name => $slug) {
            Category::updateOrCreate(
                ['slug' => $slug],
                ['name' => $name]
            );
        }
    }
}