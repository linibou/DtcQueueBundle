<?php

namespace Dtc\QueueBundle\Documents;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(db="queue", collection="job_archive")
 */
class JobArchive extends BaseJob
{
    /**
     * @ODM\Field(type="string")
     */
    protected $status;

    /**
     * @ODM\Field(type="date")
     * @ODM\Index(unique=false)
     */
    protected $updatedAt;

    /**
     * @ODM\Field(type="int", nullable=true)
     */
    protected $priority;

    /**
     * @ODM\Field(type="date", nullable=true)
     */
    protected $whenAt;
}
