<?php

// generale unique slug based on provided array
if (!function_exists('makeSlug')) {
    function makeSlug($str, $check = [])
    {
        $slug = Str::slug($str);

        if (in_array($slug, $check)) {
            $rand = 2;
            while (true) {
                if (!in_array($slug . '-' . $rand, $check)) {
                    $slug = $slug . '-' . $rand;
                    break;
                }
                $rand++;
            }
        }

        return $slug;
    }
}

// get user avatar with fallback image
if (!function_exists('userAvatar')) {
    function userAvatar($user = null)
    {
        $default = asset('img/empty-avatar.jpeg');
        if (!$user) {
            return $default;
        }

        return $user->avatar ? $user->avatar : $default;
    }
}

// transform snake\kebab\camel case to user friendly string
if (!function_exists('readable')) {
    function readable(string $s, $upperCaseEach = false)
    {
        if (str_contains($s, '-')) {
            $s = str_replace('-', ' ', $s);// kebab case
        } else if (str_contains($s, '_')) {
            $s = str_replace('_', ' ', $s);// snake case
        } else {
            $s = strtolower(preg_replace('/(?<!^)[A-Z]/', ' $0', $s));// camel case
        }

        return $upperCaseEach ? ucwords($s) : ucfirst($s);
    }
}

// print some message to separate log file
if (!function_exists('dlog')) {
    function dlog(string $text, array $array = [])
    {
        return Log::channel('dev')->info($text, $array);
    }
}

if (!function_exists('get_local_time')) {
    function get_local_time(){

//        $ip = file_get_contents("http://ipecho.net/plain");
      try{
          $ip = request()->ip();

          $url = 'http://ip-api.com/json/'.$ip;

          $tz = file_get_contents($url);

          $tz = json_decode($tz,true)['timezone'];

          $time_zone= $tz;
      }catch (Exception $exception){
          $time_zone=config('app.timezone');
      } finally {
          return $time_zone;
      }

    }
}

if (!function_exists('service_fee')) {
    function service_fee()
    {
        $setting=\App\Models\Setting::get('service_fee');
        return $setting??config('rent.service_fee');
    }
}

if (!function_exists('shipping_fee')) {
    function shipping_fee()
    {
        $setting=\App\Models\Setting::get('shipping_fee');
        return $setting??config('rent.shipping_fee');
    }
}

if (!function_exists('late_fee')) {
    function late_fee()
    {
        $setting=\App\Models\Setting::get('late_fee');
        return $setting??config('rent.late_fee');
    }
}

if (!function_exists('deposit_fee')) {
    function deposit_fee()
    {
        $setting=\App\Models\Setting::get('deposit_fee');
        return $setting??config('rent.deposit_fee');
    }
}

if (!function_exists('replace_setting_value')) {
    function replace_setting_value($search,$replace,$value)
    {
        return str_replace($search,$replace,$value);
    }
}
