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


class CliHandler
{
    private AssociateTeacherClass $associate;
    private DissociateTeacherClass $disassociate;
    private GetAssociations $listAssociations;
    private CreateClass $createClass;
    private ReadClass $readClass;
    private UpdateClass $updateClass;
    private DeleteClass $deleteClass;
    private CreateTeacher $createTeacher;
    private ReadTeacher $readTeacher;
    private UpdateTeacher $updateTeacher;
    private DeleteTeacher $deleteTeacher;


    /**
     * @param $connection
     */
    public function __construct($connection)
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


    public function handle()
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