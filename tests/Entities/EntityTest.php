<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class EntityTest extends TestCase
{    
    /**
     * @test
     */
    public function Generic_entity_instanced_with_valid_data_validates_itself(): void
    {
        /* Given */
        $entity =  \Entities\Entity::fromData(
            [
                'user_id' => 1,
                'name' => 'El Guapo',
                'created_at' =>  '2020',
                'ip' => '127.0.0.1',
            ]
        );
        /* When  */

        /* Then */
        $this->assertTrue($entity->isValid());
    }

    /**
     * @test
     */
    public function Generic_entity_instanced_with_invalid_data_invalidates_itself(): void
    {
        /* Given */
        $entity =  \Entities\Entity::fromData(
            [
                'user_id' => 1,
                'name' => 'El Guapo',
                'invalid_entry' =>  '20:20',
                'ip' => '127.0.0.1',
            ]
        );
        /* When  */

        /* Then */
        $this->assertFalse($entity->isValid());
    }
}
