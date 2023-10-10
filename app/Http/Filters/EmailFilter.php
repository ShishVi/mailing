<?php

namespace App\Http\Filters;
use Illuminate\Database\Eloquent\Builder;


class EmailFilter extends AbstractFilter
{
    public const EMAIL = 'email';
    public const FIRST_NAME = 'first_name';
    public const LAST_NAME = 'last_name';

    protected function getCallbacks(): array
    {
        return [
            self::EMAIL => [$this, 'email'],
            self::FIRST_NAME => [$this, 'firstName'],
            self::LAST_NAME => [$this, 'lastName'],
        ];
    }

    public function email(Builder $builder, $value)
    {
        $builder->where('user_id', auth()->user()->id)->where('email', 'like', "%{$value}%");
    }

    public function firstName(Builder $builder, $value)
    {
        $builder->where('user_id', auth()->user()->id)->where('first_name', 'like', "%{$value}%");
    }

    public function lastName(Builder $builder, $value)
    {
        $builder->where('user_id', auth()->user()->id)->where('last_name', 'like', "%{$value}%");
    }

}
