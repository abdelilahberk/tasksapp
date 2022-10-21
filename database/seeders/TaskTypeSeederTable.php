<?php

namespace Database\Seeders;

use App\Models\TaskType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskTypeSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $collection = collect(["Gestion","fix error","c"]);

        $collection->each(function($item){
            $tasksType = new TaskType();
            $tasksType->name= $item;
            $tasksType->save();
        });
    }
}
