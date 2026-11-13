<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class EmailTest extends TestCase
{
    public function testCanBeCreatedFromValidEmail(): void
    {
        $address = 'user@example.com';

        $email = Email::fromString($address);

        $this->assertInstanceOf(Email::class, $email);
        $this->assertEquals($address, $email->asString());
        $this->assertStringContainsString('@', $email->asString());
    }

    #[DataProvider('validEmailProvider')]
    public function testValidEmailsAreReturnedUnchanged(string $address): void
    {
        $email = Email::fromString($address);

        $this->assertSame($address, $email->asString());
    }

    public static function validEmailProvider(): array
    {
        return [
            'email dengan titik'      => ['user.name@example.com'],
            'email dengan angka'      => ['user123@example.com'],
            'email dengan subdomain'  => ['user@mail.example.com'],
            'email dengan tanda plus' => ['user+test@example.com'],
        ];
    }
}
