<?php

namespace App;

enum TaskStatus: int
{
    case APPROVED = 1;
    case CLOSED = 2;
    case PENDING = 3;
    case REJECTED = 4;

}
