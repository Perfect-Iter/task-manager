<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now()->toDateTimeString();
        TaskStatus::insert([
            [
                'name' => 'new',
                'created_at'=>$now,
                'updated_at'=>$now,
            ],
            [
                'name' => 'completed',
                'created_at'=>$now,
                'updated_at'=>$now,
            ],
            [
                'name' => 'cancelled',
                'created_at'=>$now,
                'updated_at'=>$now,
            ],
            [
                'name' => 'ongoing',
                'created_at'=>$now,
                'updated_at'=>$now,
            ],
        ]);
    }
}
