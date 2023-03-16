<?php

namespace CircleToolkit\LaravelPluralize;

use Exception;

class PluralizeHelper 
{
    /**
     * Singular version of plurals.
     * 
     * @var string
     */
    protected ?string $singular;

    /**
     * Registered plurals.
     * 
     * @var array
     */
    protected array $plurals;

    /**
     * Construct object with a default singular value.
     */
    public function __construct(?string $singular = null) 
    {
        $this->singular = $singular;
        $this->plurals = [];
    }

    /**
     * Build a simple plural, it will ignore any other plurals registered in the object.
     * 
     * @param string $plural
     * @return string
     */
    public function as(string $plural): string
    {
        return "$this->singular|$plural";
    }

    /**
     * Register value for a plural. E.g.: {0} There are none.
     * 
     * @param int    $count
     * @param string $plural
     * 
     * @return self
     */
    public function case(array $cases, string $plural): self
    {
        $this->plurals[] = [
            'cases' => $cases,
            'range' => null,
            'plural' => $plural
        ];

        return $this;
    }

    /**
     * Register range of values for a plural. E.g.: {1, 20} There are some.
     * 
     * @param array  $range
     * @param string $plural
     * 
     * @return self
     */
    public function range(array $range, string $plural): self
    {
        $this->plurals[] = [
            'cases' => null,
            'range' => $range,
            'plural' => $plural
        ];

        return $this;
    }

    /**
     * Build the plural translation string.
     * 
     * @return string
     */
    public function build(): string
    {
        $output = [];

        foreach ($this->plurals as $v) {
            if ($v['cases']) {
                $cases = implode(', ', $v['cases']);
                $output[] = "{{$cases}} " . $v['plural'];
            } elseif ($v['range']) {
                $range = implode(', ', $v['range']);
                $output[] = "[{$range}] " . $v['plural'];
            } else {
                throw new Exception("Invalid plural array, no range nor cases.");
            }
        }

        return implode('|', $output);
    }
}
