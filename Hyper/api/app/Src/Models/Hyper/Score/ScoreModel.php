<?php


namespace App\Src\Models\Hyper\Score;

class ScoreModel
{
    /**
     * @var float
     */
    private $total_shifts;

    /**
     * @return float
     */
    public function getTotalShifts(): ?float
    {
        return $this->total_shifts;
    }

    /**
     * @param float $total_shifts
     * @return ScoreModel
     */
    public function setTotalShifts(?float $total_shifts): ScoreModel
    {
        $this->total_shifts = $total_shifts;
        return $this;
    }
}
