<?php

namespace App\Helpers\Toastr;

use Illuminate\Session\Store;

class Toastr
{
    /**
     * @var Store $session
     */
    public $session;

    const KEY = 'toastr';

    /**
     * Toastr constructor.
     * @param Store $session
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * @param array $data
     */
    public function append($data = []) {
        $data = $this->safe($data);
        $toastr = $this->session->get(self::KEY);
        $toastr[] = $data;
        $this->session->flash(self::KEY, $toastr);
    }

    /**
     * @param array $data
     * @param string $key
     * @param mixed $default
     * @return array
     */
    public function safe($data = [], $key = null, $default = null) {
        $defaults = [
            'level' => 'info',
            'title' => '',
            'message' => '',
        ];
        $data = array_merge($defaults, $data);

        if ($key !== null) {
            return isset($data[$key]) ? $data[$key] : $default;
        }
        return $data;
    }

    public function script($data = []) {
        $level = $this->safe($data, 'level');
        $message = $this->safe($data, 'message');
        $title = $this->safe($data, 'title');
        return "toastr['{$level}']('{$message}', '{$title}');";
    }

    public function scriptAsync($data = [], $delay = 100) {
        $script = $this->script($data);
        return "window.setTimeout(function() { {$script} }, $delay);";
    }
}