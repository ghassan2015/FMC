<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConstantDbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $constants = [
            [
                'id' => 1,
                'group_name' => 'status',
                'key' => 'pendding',
                'value_name' => json_encode(['ar' => ' انتظار التنفيذ', 'en' => 'Pending Execution'], JSON_UNESCAPED_UNICODE),
                'sort_order' => 1,
                'is_active' => 1,
                'is_manage' => 0
            ],
            [
                'id' => 2,
                'group_name' => 'status',
                'key' => 'processing',
                'value_name' => json_encode(['ar' => 'مكتمل', 'en' => 'Completed'], JSON_UNESCAPED_UNICODE),
                'sort_order' => 2,
                'is_active' => 1,
                'is_manage' => 0
            ],

            [
                'id' => 3,
                'group_name' => 'payment_type',
                'key' => 'visa',
                'value_name' => json_encode(['ar' => 'فيزا', 'en' => 'Visa'], JSON_UNESCAPED_UNICODE),
                'sort_order' => 2,
                'is_active' => 1,
                'is_manage' => 0
            ],

            [
                'id' => 4,
                'group_name' => 'payment_type',
                'key' => 'cash',
                'value_name' => json_encode(['ar' => 'كاش', 'en' => 'Cash'], JSON_UNESCAPED_UNICODE),
                'sort_order' => 2,
                'is_active' => 1,
                'is_manage' => 0
            ],



            [
                'id' => 5,
                'group_name' => 'appointment_status',
                'key' => 'new',
                'value_name' => json_encode(['ar' => 'جديد', 'en' => 'New'], JSON_UNESCAPED_UNICODE),
                'sort_order' => 2,
                'is_active' => 1,
                'is_manage' => 0
            ],


            [
                'id' => 6,
                'group_name' => 'appointment_status',
                'key' => 'new',
                'value_name' => json_encode(['ar' => 'قيد الانتظار', 'en' => 'Pendding'], JSON_UNESCAPED_UNICODE),
                'sort_order' => 2,
                'is_active' => 1,
                'is_manage' => 0
            ],

            [
                'id' => 7,
                'group_name' => 'appointment_status',
                'key' => 'new',
                'value_name' => json_encode(['ar' => 'قيد التنفيذ', 'en' => 'Proccessing'], JSON_UNESCAPED_UNICODE),
                'sort_order' => 2,
                'is_active' => 1,
                'is_manage' => 0
            ],



            [
                'id' => 8,
                'group_name' => 'appointment_status',
                'key' => 'new',
                'value_name' => json_encode(['ar' => 'مكتمل', 'en' => 'Completed'], JSON_UNESCAPED_UNICODE),
                'sort_order' => 2,
                'is_active' => 1,
                'is_manage' => 0
            ],


            [
                'id' => 9,
                'group_name' => 'appointment_status',
                'key' => 'new',
                'value_name' => json_encode(['ar' => 'ملغي', 'en' => 'Cancel'], JSON_UNESCAPED_UNICODE),
                'sort_order' => 2,
                'is_active' => 1,
                'is_manage' => 0
            ],


            [
                'id' => 10,
                'group_name' => 'payment_status',
                'key' => 'new',
                'value_name' => json_encode(['ar' => 'مدفوع', 'en' => 'Paid'], JSON_UNESCAPED_UNICODE),
                'sort_order' => 2,
                'is_active' => 1,
                'is_manage' => 0
            ],

              [
                'id' => 10,
                'group_name' => 'payment_status',
                'key' => 'new',
                'value_name' => json_encode(['ar' => 'غير مدفوع', 'en' => 'Not Paid'], JSON_UNESCAPED_UNICODE),
                'sort_order' => 2,
                'is_active' => 1,
                'is_manage' => 0
            ],

               [
                'id' => 11,
                'group_name' => 'gender',
                'key' => 'new',
                'value_name' => json_encode(['ar' => 'ذكر', 'en' => 'Male'], JSON_UNESCAPED_UNICODE),
                'sort_order' => 2,
                'is_active' => 1,
                'is_manage' => 0
            ],


               [
                'id' => 12,
                'group_name' => 'gender',
                'key' => 'new',
                'value_name' => json_encode(['ar' => 'انتى', 'en' => 'Female'], JSON_UNESCAPED_UNICODE),
                'sort_order' => 2,
                'is_active' => 1,
                'is_manage' => 0
            ],

        ];





        foreach ($constants as $constant) {
            DB::table('constants')->updateOrInsert(
                ['id' => $constant['id']],
                $constant
            );
        }
    }
}
