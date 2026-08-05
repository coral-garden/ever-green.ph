<?php

namespace Tests\Feature;

use Tests\TestCase;

class ServerlessSesPolicyTest extends TestCase
{
    public function test_the_lambda_can_send_from_and_to_the_configured_ses_identities(): void
    {
        $serverless = file_get_contents(base_path('serverless.yml'));

        $this->assertStringContainsString(
            'arn:aws:ses:${AWS::Region}:${AWS::AccountId}:identity/simonphconsult@gmail.com',
            $serverless,
        );
        $this->assertStringContainsString(
            'arn:aws:ses:${AWS::Region}:${AWS::AccountId}:identity/admin@coralgardensoftware.com',
            $serverless,
        );
        $this->assertStringContainsString('LEAD_MAIL_TO: simonphconsult@gmail.com', $serverless);
        $this->assertStringContainsString('LEAD_MAIL_BCC: admin@coralgardensoftware.com', $serverless);
    }
}
