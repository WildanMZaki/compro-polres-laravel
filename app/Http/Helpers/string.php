<?php

function sluger($str)
{
    return str_replace(' ', '-', strtolower($str));
}
