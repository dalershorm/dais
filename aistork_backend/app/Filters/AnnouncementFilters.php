<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class AnnouncementFilters extends QueryFilter
{
	/**
	 * Filtering with given real_estate_type_id
	 *
	 * @param  int  $real_estate_type_id
	 *
	 * @return Builder
	 */
	public function real_estate_type_id($real_estate_type_id = '')
	{
        if($real_estate_type_id != '')
        return $this->builder->where('real_estate_type_id', $real_estate_type_id);
	}

    /**
	 * Filtering with given number_of_rooms
	 *
	 * @param  int  $number_of_rooms
	 *
	 * @return Builder
	 */
	public function number_of_rooms($number_of_rooms)
	{
        return $this->builder->where('number_of_rooms', $number_of_rooms);
	}

    /**
	 * Filtering with given city_id
	 *
	 * @param  $city_id
	 *
	 * @return Builder
	 */
    public function city_id($city_id = '')
    {
        if($city_id != '')
    	return $this->builder->where('city_id', $city_id);
    }

    /**
	 * Filtering with given street_id
	 *
	 * @param  $street_id
	 *
	 * @return Builder
	 */
    public function street_id($street_id = '')
    {
        if($street_id != '')
    	return $this->builder->where('street_id', $street_id);
    }

    /**
	 * Filtering with given area_m2
	 *
	 * @param  $area_m2
	 *
	 * @return Builder
	 */
    public function area_m2($area_m2 = '')
    {
        if($area_m2 != '')
    	return $this->builder->where('area_m2', $area_m2);
    }

    /**
	 * Filtering with given price_from
	 *
	 * @param  $price_from
	 *
	 * @return Builder
	 */
    public function price_from($price_from = '')
    {
        if($price_from != '')
    	return $this->builder->where('total_cost', '>=', $price_from);
    }

    /**
	 * Filtering with given price_to
	 *
	 * @param  $price_to
	 *
	 * @return Builder
	 */
    public function price_to($price_to = '')
    {
        if($price_to != '')
    	return $this->builder->where('total_cost', '<=', $price_to);
    }

    /**
	 * Filtering with given installment
	 *
	 * @param  $installment
	 *
	 * @return Builder
	 */
    public function installment($installment = '')
    {
        if($installment != '')
    	return $this->builder->where('installment', $installment);
    }

    /**
	 * Filtering with given images
	 *
	 * @param  $images
	 *
	 * @return Builder
	 */
    public function images($images = '')
    {
        if($images != '')
    	return $this->builder->whereNotNull('images');
    }

    /**
	 * Filtering with given cost_per_m2_from
	 *
	 * @param  $cost_per_m2_from
	 *
	 * @return Builder
	 */
    public function cost_per_m2_from($cost_per_m2_from = '')
    {
        if($cost_per_m2_from != '')
    	return $this->builder->where('cost_per_m2', '>=', $cost_per_m2_from);
    }

    /**
	 * Filtering with given cost_per_m2_to
	 *
	 * @param  $cost_per_m2_to
	 *
	 * @return Builder
	 */
    public function cost_per_m2_to($cost_per_m2_to = '')
    {
        if($cost_per_m2_to != '')
    	return $this->builder->where('cost_per_m2', '<=', $cost_per_m2_to);
    }

    /**
	 * Filtering with given year_built
	 *
	 * @param  $year_built
	 *
	 * @return Builder
	 */
    public function year_built($year_built = '')
    {
        if($year_built != '')
    	return $this->builder->where('year_built', $year_built);
    }

    /**
	 * Filtering with given ceiling_height
	 *
	 * @param  $ceiling_height
	 *
	 * @return Builder
	 */
    public function ceiling_height($ceiling_height = '')
    {
        if($ceiling_height != '')
    	return $this->builder->where('ceiling_height', $ceiling_height);
    }

    /**
	 * Filtering with given parking
	 *
	 * @param  $parking
	 *
	 * @return Builder
	 */
    public function parking($parking = '')
    {
        if($parking != '')
    	return $this->builder->where('parking', $parking);
    }

    /**
	 * Filtering with given elevator_id
	 *
	 * @param  $elevator_id
	 *
	 * @return Builder
	 */
    public function elevator_id($elevator_id = '')
    {
        if($elevator_id != '')
    	return $this->builder->where('elevator_id', $elevator_id);
    }

    /**
	 * Filtering with given status_id
	 *
	 * @param  $status_id
	 *
	 * @return Builder
	 */
    public function status_id($status_id = '')
    {
        if($status_id != '')
    	return $this->builder->where('status_id', $status_id);
    }

    /**
	 * Filtering with given storey
	 *
	 * @param  $storey
	 *
	 * @return Builder
	 */
    public function storey($storey = '')
    {
        if($storey != '')
    	return $this->builder->where('storey', $storey);
    }

    /**
	 * Filtering with given number_of_storeys
	 *
	 * @param  $number_of_storeys
	 *
	 * @return Builder
	 */
    public function number_of_storeys($number_of_storeys = '')
    {
        if($number_of_storeys != '')
    	return $this->builder->where('number_of_storeys', $number_of_storeys);
    }

    /**
	 * Filtering with given sort
	 *
	 * @param  $sort
	 *
	 * @return Builder
	 */
    public function sort($sort = '')
    {
        if ($sort == 1) {
            $this->builder->orderBy('total_cost');
        } else if ($sort == 2) {
            $this->builder->orderBy('total_cost', 'DESC');
        } else if ($sort == 3) {
            $this->builder->latest();
        }
    }
}
