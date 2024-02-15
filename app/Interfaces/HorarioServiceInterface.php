<?php

namespace App\Interfaces;

use Carbon\Carbon;

interface HorarioServiceInterface
{
    public function isAvailableInternal($date, $doctorId, Carbon $start);
    public function getAvailableIntervals($date, $doctorId);
}
