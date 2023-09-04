<?php


namespace App\Utils;


use Carbon\Carbon;

class DateRangeFilter
{

    private string $start_date;
    private ?string $end_date = null;

    /**
     * @return string|null
     */
    public function getEndDate(): ?string
    {
        return $this->end_date;
    }

    /**
     * @param string|null $end_date
     * @return DateRangeFilter
     */
    public function setEndDate(?string $end_date): DateRangeFilter
    {
        $this->end_date = $end_date;
        return $this;
    }

    public function filter($query)
    {
        [$start, $end] = $this->dateRange();

        return $query->whereBetween('created_at', [$start, $end]);
    }

    public function dateRange()
    {
        $range = $this->getStartDate();
        $end = Carbon::now()->endOfDay();

        switch ($range) {
            case 'week':
                $start = Carbon::now()->subWeek();
                break;
            case '12 days':
                $start = Carbon::now()->subDays(12);
                break;
            case 'month':
                $start = Carbon::now()->subMonth();
                break;
            default:
                $start = Carbon::now()->subDay();
                break;
        }


        return [$start->format('Y-m-d'), $end->format('Y-m-d H:i:s')];


    }

    /**
     * @return string
     */
    public function getStartDate(): string
    {
        return $this->start_date;
    }

    /**
     * @param string $start_date
     * @return DateRangeFilter
     */
    public function setStartDate(string $start_date): DateRangeFilter
    {
        $this->start_date = $start_date;
        return $this;
    }


}
