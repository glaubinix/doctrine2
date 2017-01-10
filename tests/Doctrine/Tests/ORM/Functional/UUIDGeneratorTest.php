<?php
namespace Doctrine\Tests\ORM\Functional;
use Doctrine\Tests\OrmFunctionalTestCase;

/**
 * @group DDC-451
 */
class UUIDGeneratorTest extends OrmFunctionalTestCase
{
    public function setUp()
    {
        parent::setUp();

        if ($this->em->getConnection()->getDatabasePlatform()->getName() != 'mysql') {
            $this->markTestSkipped('Currently restricted to MySQL platform.');
        }

        $this->schemaTool->createSchema(
            [
            $this->em->getClassMetadata(UUIDEntity::class)
            ]
        );
    }

    public function testGenerateUUID()
    {
        $entity = new UUIDEntity();

        $this->em->persist($entity);
        self::assertNotNull($entity->getId());
        self::assertTrue(strlen($entity->getId()) > 0);
    }
}

/**
 * @Entity
 */
class UUIDEntity
{
    /** @Id @Column(type="string") @GeneratedValue(strategy="UUID") */
    private $id;
    /**
     * Get id.
     *
     * @return id.
     */
    public function getId()
    {
        return $this->id;
    }
}
