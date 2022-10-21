<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskStatusSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collection = collect(["open","to dispatch","a valider","completed"]);

        $collection->each(function($item){
            $taskstatus = new TaskStatus();
            $taskstatus->name= $item;
            $taskstatus->save();
        });
    }
}
