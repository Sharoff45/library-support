<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support\Tests\Util;

use Sharoff45\Library\Support\Util\UuidGenerator;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class UuidGeneratorTest extends TestCase
{
    /**
     * @dataProvider getUuidDataProvider
     */
    public function testGetUuid(string $idOrUuid, string $expected): void
    {
        $result = UuidGenerator::getUuid($idOrUuid);

        self::assertEquals($expected, $result);
    }

    /**
     * @return array<int, array<int, string>>
     */
    public function getUuidDataProvider(): array
    {
        return [
            ['12345', 'f0199e08-7188-36e4-90d4-75a855b806ed'],
            ['caccae6e-687c-4115-83cb-06ee48f2ecb0', 'caccae6e-687c-4115-83cb-06ee48f2ecb0'],
        ];
    }

    public function testGenerateUuid(): void
    {
        $result = UuidGenerator::generateUuid();

        self::assertMatchesRegularExpression(
            '/[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}/',
            $result
        );
    }

    /**
     * @dataProvider generateUuidByIdDataProvider
     */
    public function testGenerateUuidById(string $number, string $expected): void
    {
        $result = UuidGenerator::generateUuidById($number);

        self::assertEquals($expected, $result);
    }

    /**
     * @return array<int, array<int, string>>
     */
    public function generateUuidByIdDataProvider(): array
    {
        return [
            ['12345', 'f0199e08-7188-36e4-90d4-75a855b806ed'],
            ['A4321', '7f23ab07-e111-3a07-9634-5d4dcc678032'],
        ];
    }
}
