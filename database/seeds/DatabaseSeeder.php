<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $prefix = env('DB_PREFIX');
        //$password = bcrypt('123456');
        $array = [
            "insert  into `".$prefix."admin_users`(`id`,`name`,`nickname`,`email`,`password`,`is_super`,`remember_token`,`created_at`,`updated_at`) values (1,'admin','管理员','admin@admin.com','\$2y\$10\$dunZeG22ZPwu.lmDJy9ZWOu7qiudT5iQ5VnGJmmPVp9387y7WU5HC',1,'C5jQ2NmD8UgYFviG5UGGCHMwJWJC82N3AU18GSoyAMMXMjT0MB01bSLsm1Id','2016-06-02 07:33:41','2016-06-15 06:21:29');",
            ];

        foreach ($array as $key => $value) {
            DB::insert($value);
        }
    }
}
