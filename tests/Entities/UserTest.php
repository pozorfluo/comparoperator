<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{    
    /**
     * @test
     */
    public function User_instanced_with_valid_data_validates_itself(): void
    {
        /* Given */
        $entity =  \Entities\User::fromData(
            [
                'user_id' => 1,
                'name' => 'El Guapo',
                'created_at' => date('Y-m-d H:i:s'),
                'ip' => inet_pton('127.0.0.1'),
            ]
        );
        /* When  */
        // echo '<pre>'.var_export($entity, true).'</pre><hr />';
        /* Then */
        $this->assertTrue($entity->isValid());
    }

    /**
     * @test
     */
    public function User_instanced_with_invalid_ip_invalidates_itself(): void
    {
        /* Given */
        $entity =  \Entities\User::fromData(
            [
                'user_id' => 1,
                'name' => 'El Guapo',
                'created_at' => date('Y-m-d H:i:s'),
                'ip' => '127.0.01',
            ]
        );
        /* When  */

        /* Then */
        $this->assertFalse($entity->isValid());
    }
    /**
     * @test
     */
    public function User_instanced_with_invalid_user_id_invalidates_itself(): void
    {
        /* Given */
        $entity =  \Entities\User::fromData(
            [
                'user_id' => 0,
                'name' => 'El Guapo',
                'created_at' =>  date('Y-m-d H:i:s'),
                'ip' => inet_pton('127.0.0.1'),
            ]
        );
        /* When  */

        /* Then */
        $this->assertFalse($entity->isValid());
    }
    
    /**
     * @test
     */
    public function User_instanced_with_invalid_name_invalidates_itself(): void
    {
        /* Given */
        $entity =  \Entities\User::fromData(
            [
                'user_id' => 1,
                'name' => 'El%Guapo',
                'created_at' => date('Y-m-d H:i:s'),
                'ip' => inet_pton('127.0.0.1'),
            ]
        );
        /* When  */

        /* Then */
        $this->assertFalse($entity->isValid());
    }

    /**
     * @test
     */
    public function User_instanced_with_invalid_created_at_invalidates_itself(): void
    {
        /* Given */
        $entity =  \Entities\User::fromData(
            [
                'user_id' => 1,
                'name' => 'El Guapo',
                'created_at' => date('Y-m-d i:s'),
                'ip' => inet_pton('127.0.0.1'),
            ]
        );
        /* When  */

        /* Then */
        $this->assertFalse($entity->isValid());
    }
    /**
     * @test
     */
    public function User_instanced_with_valid_data_validates_its_required_fields(): void
    {
        /* Given */
        $entity =  \Entities\User::fromData(
            [
                'user_id' => 1,
                'name' => 'El Guapo',
                'created_at' => date('Y-m-d H:i:s'),
                'ip' => inet_pton('127.0.0.1'),
            ]
        );
        /* When  */

        /* Then */
        $this->assertTrue($entity->hasValidRequiredFields());
    }
    /**
     * @test
     */
    public function User_instanced_with_valid_required_fields_and_other_invalid_fields_validates_its_required_fields(): void
    {
        /* Given */
        $entity =  \Entities\User::fromData(
            [
                'user_id' => 0,
                'name' => 'El Guapo',
                'created_at' => date('Y-m-d H:i:s'),
                'ip' => inet_pton('127.0.0.1'),
            ]
        );
        /* When  */

        /* Then */
        $this->assertTrue($entity->hasValidRequiredFields());
    }
    /**
     * @test
     */
    public function User_instanced_with_invalid_required_fields_invalidates_its_required_fields(): void
    {
        /* Given */
        $entity =  \Entities\User::fromData(
            [
                'user_id' => 1,
                'name' => 'El :Guapo',
                'created_at' => date('Y-m-d H:i:s'),
                'ip' => inet_pton('127.0.0.1'),
            ]
        );
        /* When  */

        /* Then */
        $this->assertFalse($entity->hasValidRequiredFields());
    }
}
