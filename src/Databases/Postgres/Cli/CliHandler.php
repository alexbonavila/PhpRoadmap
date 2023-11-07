<?php

namespace Postgres\Cli;

use Postgres\Cli\Association\AssociateTeacherClass;
use Postgres\Cli\Association\DissociateTeacherClass;
use Postgres\Cli\Association\GetAssociations;

use Postgres\Cli\Class\CreateClass;
use Postgres\Cli\Class\DeleteClass;
use Postgres\Cli\Class\ReadClass;
use Postgres\Cli\Class\UpdateClass;

use Postgres\Cli\Teacher\CreateTeacher;
use Postgres\Cli\Teacher\DeleteTeacher;
use Postgres\Cli\Teacher\ReadTeacher;
use Postgres\Cli\Teacher\UpdateTeacher;


/**
 * The CliHandler class orchestrates a series of CLI operations for managing
 * teachers, classes, and their associations in a database.
 */
class CliHandler
{
    /**
     * @var AssociateTeacherClass
     */
    private AssociateTeacherClass $associate;
    /**
     * @var DissociateTeacherClass
     */
    private DissociateTeacherClass $disassociate;
    /**
     * @var GetAssociations
     */
    private GetAssociations $listAssociations;
    /**
     * @var CreateClass
     */
    private CreateClass $createClass;
    /**
     * @var ReadClass
     */
    private ReadClass $readClass;
    /**
     * @var UpdateClass
     */
    private UpdateClass $updateClass;
    /**
     * @var DeleteClass
     */
    private DeleteClass $deleteClass;
    /**
     * @var CreateTeacher
     */
    private CreateTeacher $createTeacher;
    /**
     * @var ReadTeacher
     */
    private ReadTeacher $readTeacher;
    /**
     * @var UpdateTeacher
     */
    private UpdateTeacher $updateTeacher;
    /**
     * @var DeleteTeacher
     */
    private DeleteTeacher $deleteTeacher;


    /**
     * Initializes the handler with all necessary action instances, each provided with a database connection.
     *
     * @param mixed $connection The database connection object or resource.
     */
    public function __construct(mixed $connection)
    {
        $this->associate = new AssociateTeacherClass($connection);
        $this->disassociate = new DissociateTeacherClass($connection);
        $this->listAssociations = new GetAssociations($connection);
        $this->createClass = new CreateClass($connection);
        $this->readClass = new ReadClass($connection);
        $this->updateClass = new UpdateClass($connection);
        $this->deleteClass = new DeleteClass($connection);
        $this->createTeacher = new CreateTeacher($connection);
        $this->readTeacher = new ReadTeacher($connection);
        $this->updateTeacher = new UpdateTeacher($connection);
        $this->deleteTeacher = new DeleteTeacher($connection);
    }


    /**
     * Executes a sequence of operations including creating, reading, updating, associating,
     * disassociating, and deleting records for classes and teachers.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->createClass->run();
        $this->createTeacher->run();
        $this->associate->run();

        $this->readClass->run();
        $this->readTeacher->run();
        $this->listAssociations->run();

        $this->updateClass->run();
        $this->updateTeacher->run();

        $this->readClass->run();
        $this->readTeacher->run();
        $this->listAssociations->run();

        $this->disassociate->run();
        $this->deleteTeacher->run();
        $this->deleteClass->run();

        $this->readClass->run();
        $this->readTeacher->run();
        $this->listAssociations->run();
    }
}