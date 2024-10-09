<?php

namespace Tests\Feature;

use App\Mail\InfoMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;

class InfoMailTest extends TestCase
{
    use WithFaker;

    public function test_info_mail_can_be_sent()
    {
        Mail::fake();

        $subject = $this->faker->sentence;
        $content = $this->faker->paragraph;
        $details = [
            'key1' => $this->faker->word,
            'key2' => $this->faker->numberBetween(1, 100),
        ];

        $mail = new InfoMail($subject, $content, $details);

        Mail::to('test@example.com')->send($mail);

        Mail::assertSent(InfoMail::class, function ($mail) use ($subject, $content, $details) {
            return $mail->subject == $subject
                && $mail->content == $content
                && $mail->details == $details;
        });
    }

    public function test_info_mail_view_content()
    {
        $subject = $this->faker->sentence;
        $content = $this->faker->paragraph;
        $details = [
            'key1' => $this->faker->word,
            'key2' => $this->faker->numberBetween(1, 100),
        ];

        $mail = new InfoMail($subject, $content, $details);

        $this->assertEquals('emails.info_simple', $mail->build()->view);
        $this->assertEquals($content, $mail->build()->viewData['content']);
        $this->assertEquals($details, $mail->build()->viewData['details']);
    }

    public function test_info_mail_with_empty_details()
    {
        $subject = $this->faker->sentence;
        $content = $this->faker->paragraph;

        $mail = new InfoMail($subject, $content);

        $this->assertEmpty($mail->details);
    }
}
