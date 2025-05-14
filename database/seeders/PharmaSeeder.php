<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PharmaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pharma')->insert([
            [
                'category_id' => 1, // افتراضياً فئة الأدوية
                'name' => 'أقراص الأسبرين',
                'description' => 'أقراص مسكنة للألم.',
                'price' => 5.50,
                'quantity' => 100,
                'image' => 'aspirin.jpg', // افترض أن هناك صورة بالاسم هذا
            ],
            [
                'category_id' => 2, // افتراضياً فئة المكملات الغذائية
                'name' => 'مكمل فيتامين سي',
                'description' => 'مكمل غذائي يحتوي على فيتامين سي.',
                'price' => 10.00,
                'quantity' => 200,
                'image' => 'vitamin_c.jpg', // افترض أن هناك صورة بالاسم هذا
            ],
            // يمكنك إضافة المزيد من المنتجات هنا حسب الحاجة.
        ]);
    }
}
