<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanDuplicateLikes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'likes:clean-duplicates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Elimina likes duplicados, dejando solo uno por usuario y blog';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Buscando y eliminando likes duplicados...');

        $sql = "DELETE l1 FROM likes l1
                INNER JOIN likes l2
                WHERE l1.id > l2.id
                AND l1.user_id = l2.user_id
                AND l1.blog_id = l2.blog_id";

        $deleted = DB::delete($sql);

        $this->info("Likes duplicados eliminados correctamente.");
    }
}
