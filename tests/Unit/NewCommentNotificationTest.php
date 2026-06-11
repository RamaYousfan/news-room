<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Notifications\NewCommentNotification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewCommentNotificationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_uses_mail_channel_for_non_admin_users()
    {
        $user = new class {
            public function hasRole($role)
            {
                return false;
            }
        };

        $notification = new NewCommentNotification('Test Comment');

        $this->assertEquals(
            ['mail'],
            $notification->via($user)
        );
    }

    /** @test */
    public function it_uses_database_channel_for_admin_users()
    {
        $user = new class {
            public function hasRole($role)
            {
                return true;
            }
        };

        $notification = new NewCommentNotification('Test Comment');

        $this->assertEquals(
            ['database'],
            $notification->via($user)
        );
    }

    /** @test */
    public function it_builds_mail_notification_correctly()
    {
        $user = new class {
            public function hasRole($role)
            {
                return false;
            }
        };

        $notification = new NewCommentNotification('Test Comment');

        $mailMessage = $notification->toMail($user);

        $this->assertInstanceOf(
            MailMessage::class,
            $mailMessage
        );
    }

    /** @test */
    public function it_returns_expected_database_payload()
    {
        $user = new class {
            public function hasRole($role)
            {
                return true;
            }
        };

        $notification = new NewCommentNotification('Test Comment');

        $this->assertEquals(
            [
                'message' => 'New Comment'
            ],
            $notification->toArray($user)
        );
    }
}