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

        if (empty($senderIds)) {
            return redirect()->back()->with('error', "No users found. Cannot seed messages.");
        }

        $messageCount = $request->integer('message_count', 50);
        $messageCount = min(max($messageCount, 0), 500); // Ensure 0 ≤ messageCount ≤ 500

        if ($messageCount <= 0) {
            return redirect()->back()->with('info', "No messages seeded (count was 0).");
        }

        DB::beginTransaction();
        try {
            $messages = [];
            foreach (range(1, $messageCount) as $index) {
                $messages[] = [
                    'user_id' => $faker->randomElement($senderIds),
                    'message' => $faker->realText(rand(10, 200)),
                    'created_at' => $faker->dateTimeThisYear(),
                    'updated_at' => $faker->dateTimeThisMonth(),
                ];
            }
            DB::table('chat_messages')->insert($messages);
            DB::commit();
            return redirect()->back()->with('success', "$messageCount messages seeded successfully!");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', "Failed to seed messages: " . $e->getMessage());
        }
    }
}

