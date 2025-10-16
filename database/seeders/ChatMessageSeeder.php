<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatMessageSeeder extends Seeder
{
    public function run(Request $request)
    {
        $faker = Faker::create();
        $senderIds = User::pluck('id')->toArray();
        $messageCount = $request->integer('message_count', 50);
        // dd($messageCount);
        $messageCount = min($messageCount, 500);

        foreach (range(1, $messageCount) as $index) {
            $senderId = $faker->randomElement($senderIds);
            $messageLength = rand(10, 200);

            DB::table('chat_messages')->insert([
                'user_id' => $senderId,
                'message' => $faker->realText($messageLength),
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisMonth(),
            ]);
        }
    }
}
