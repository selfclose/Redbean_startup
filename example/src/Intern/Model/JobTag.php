<?php
namespace Intern\Model;

use Intern\ConcatTrait\NameTrait;
use Intern\Controller\RedBeanController;

class JobTag extends RedBeanController
{
    use NameTrait;

    function __construct($id = 0)
    {
        parent::__construct($id);
    }
}