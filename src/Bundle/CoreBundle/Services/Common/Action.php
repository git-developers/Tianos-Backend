<?php

namespace CoreBundle\Services\Common;

class Action
{
    const ACTION = 'Action';

    const CREATE = 'create';
    const CREATE_CHILD = 'createchild';
    const EDIT = 'edit';
    const VIEW = 'view';
    const DELETE = 'delete';
    const INFO = 'info';

    const CHANGE_PASSWORD = 'changepassword';

    const ASSIGN = 'assign';
    const UNASSIGN = 'unassign';

    const BOXLEFT_SEARCH = 'boxleft_search';
    const BOXRIGHT_SEARCH = 'boxright_search';
    const BOXLEFT_HAS_BOXRIGHT = 'boxleft_has_boxright';

    const BOXRIGHT_ASSIGN = 'boxright_assign';
    const BOXRIGHT_UNASSIGN = 'boxright_unassign';

    const ASSOCIATIVE_EDIT = 'associative_edit';

    const BOXRIGHT_ASSIGN_VIEW = 'boxright_assign_view';
    const BOXRIGHT_ASSIGN_EDIT = 'boxright_assign_edit';
    const BOXRIGHT_ASSIGN_CHILD = 'boxright_assign_child';
}



