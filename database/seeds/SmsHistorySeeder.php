<?php

use App\Models\SmsHistory;
use App\Models\Clients;
use Illuminate\Database\Seeder;

class SmsHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table( 'clients')->truncate();
        DB::table('sms_histories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        
        $client = Clients::create([
            'name' => 'Client',
            'email' => 'mail@mail.com',
            'credits' => 100.1,
            'token' => md5(str_random(6)),
            'status' => 1,
           
        ]);
        $sms=SmsHistory::create([
            'phone_number' => '069 32 543',
            'sms_text' => 'message text',
            'send_status' => 1,
            'send_message' => "send message",
            'send_desc' => "desc",
            'phone_sender' => "03912 301 93",
            'provider' => "provider1",
            'tag1' => "tag11",
            'tag2' => "tag22", 
        ]);

        $sms->client()->associate($client)->save();



    }
}
