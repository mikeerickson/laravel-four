<?php

use Illuminate\Routing\UrlGenerator as Url;

class Helpers {


	/**
	 * The encoding to use
	 *
	 * @var string
	 */
	protected $encoding = 'utf-8';

	/**
	 * The url generator instance
	 *
	 * @var Illuminate\Routing\UrlGenerator
	 */
	protected $url;

	/**
	 * Custom macros registered by the user
	 *
	 * @var array
	 */
	protected $macros = array();

	/**
	 * Build a new instance of HTML
	 *
	 * @param UrlGenerator $urlGenerator
	 */
	public function __construct(Url $urlGenerator = null)
	{
		$this->url = $urlGenerator;
	}

	/**
	 * Register a new macro with the HTML class
	 *
	 * @param string   $name     Its name
	 * @param Callable $callback A closure to use
	 *
	 * @return void
	 */
	public function macro($name, $callback)
	{
		$this->macros[$name] = $callback;
	}

	/**
	 * Convert HTML characters to HTML entities
	 *
	 * The encoding in $encoding will be used
	 *
	 * @param  string $value
	 * @return string
	 */
	public function entities($value)
	{
		return htmlentities($value, ENT_QUOTES, $this->encoding, false);
	}

	/**
	 * Convert HTML entities to HTML characters
	 *
	 * The encoding in $encoding will be used
	 *
	 * @param  string $value
	 * @return string
	 */
	public function decode($value)
	{
		return html_entity_decode($value, ENT_QUOTES, $this->encoding);
	}

	/**
	 * Wraps opening and closing HTML tags around the given input.
	 *
	 * @param  string $value
	 * @param  string $tag
	 * @return string
	 */
	public function wrapHTMLTag($value, $tag)
	{
		return '<' . $tag . '>' . $value . '</' . $tag . '>';
	}

	/**
	 * Convert HTML special characters
	 *
	 * The encoding in $encoding will be used
	 *
	 * @param  string $value
	 * @return string
	 */
	public function specialchars($value)
	{
		return htmlspecialchars($value, ENT_QUOTES, $this->encoding, false);
	}

	/**
	 * Generate a link to a JS file
	 *
	 * @param  string $url
	 * @param  array  $attributes
	 * @return string
	 */
	public function script($url, $attributes = array())
	{
		$url = $this->url->to($url);

		return '<script src="'.$url.'"'.$this->attributes($attributes).'></script>'.PHP_EOL;
	}

	/**
	 * Generate a link to a CSS file.
	 *
	 * If no media type is selected, "all" will be used
	 *
	 * @param  string $url
	 * @param  array  $attributes
	 * @return string
	 */
	public function style($url, $attributes = array())
	{
		$defaults = array('media' => 'all', 'type' => 'text/css', 'rel' => 'stylesheet');

		$attributes = $attributes + $defaults;

		$url = $this->url->to($url);

		return '<link href="'.$url.'"'.$this->attributes($attributes).'>'.PHP_EOL;
	}

	/**
	 * Generate a HTML span
	 *
	 * @param  string $value
	 * @param  array  $attributes
	 * @return string
	 */
	public function span($value, $attributes = array())
	{
		return '<span'.$this->attributes($attributes).'>'.$this->entities($value).'</span>';
	}

	/**
	 * Generate a HTML link
	 *
	 * @param  string $url
	 * @param  string $title
	 * @param  array  $attributes
	 * @param  bool   $https
	 * @return string
	 */
	public function to($url, $title = null, $attributes = array(), $parameters = array(), $https = null)
	{
		$url = $this->url->to($url, $parameters, $https);

		if (is_null($title)) $title = $url;

		return '<a href="'.$url.'"'.$this->attributes($attributes).'>'.$this->entities($title).'</a>';
	}

	/**
	 * Generate a HTTPS HTML link
	 *
	 * @param  string $url
	 * @param  string $title
	 * @param  array  $attributes
	 * @return string
	 */
	public function secure($url, $title = null, $parameters = array(), $attributes = array())
	{
		return $this->to($url, $title, $attributes, $parameters, true);
	}

	/**
	 * Generate a HTML link to an asset
	 *
	 * @param  string $url
	 * @param  string $title
	 * @param  array  $attributes
	 * @param  bool   $https
	 * @return string
	 */
	public function asset($url, $title = null, $attributes = array(), $https = null)
	{
		$url = $this->url->asset($url, $https);

		if (is_null($title)) $title = $url;

		return '<a href="'.$url.'"'.$this->attributes($attributes).'>'.$this->entities($title).'</a>';
	}

	/**
	 * Generate a HTTPS HTML link to an asset
	 *
	 * @param  string $url
	 * @param  string $title
	 * @param  array  $attributes
	 * @param  bool   $https
	 * @return string
	 */
	public function secureAsset($url, $title = null, $attributes = array())
	{
		return $this->asset($url, $title, $attributes, true);
	}

	/**
	 * Generate a HTML link to a route
	 *
	 * An array of parameters may be specified to fill in URI segment wildcards.
	 *
	 * @param  string $name
	 * @param  string $title
	 * @param  array  $parameters
	 * @param  array  $attributes
	 * @return string
	 */
	public function route($name, $title = null, $parameters = array(), $attributes = array(), $absolute = true)
	{
		return $this->to($this->url->route($name, $parameters, $absolute), $title, $attributes);
	}

	/**
	 * Generate a HTML link to a controller action
	 *
	 * An array of parameters may be specified to fill in URI segment wildcards.
	 *
	 * @param  string $action
	 * @param  string $title
	 * @param  array  $parameters
	 * @param  array  $attributes
	 * @return string
	 */
	public function action($action, $title = null, $parameters = array(), $attributes = array(), $absolute = true)
	{
		return $this->to($this->url->action($action, $parameters, $absolute), $title, $attributes);
	}

	/**
	 * Generate an HTML mailto link.
	 *
	 * The E-Mail address will be obfuscated to protect it from spam bots.
	 *
	 * @param  string $email
	 * @param  string $title
	 * @param  array  $attributes
	 * @return string
	 */
	public static function mailto($email, $title = null, $attributes = array())
	{
		//$email = $this->email($email);

		if (is_null($title)) $title = $email;

		$emailLink = '&#109;&#097;&#105;&#108;&#116;&#111;&#058;'.$email;

		return '<a href="'.$emailLink.'"</a>'.$email;

		//return '<a href="'.$email.'"'.$this->attributes($attributes).'>'.$this->entities($title).'</a>';
	}

	/**
	 * Obfuscate an e-mail address to prevent spam-bots from sniffing it.
	 *
	 * @param  string $email
	 * @return string
	 */
	public static function email($email)
	{
		//return str_replace('@', '&#64;', $this->obfuscate($email));
		return $email;
	}

	/**
	 * Generate an HTML image element.
	 *
	 * @param  string $url
	 * @param  string $alt
	 * @param  array  $attributes
	 * @return string
	 */
	public static function image($url, $alt = null, $attributes = array())
	{
		if (is_null($alt)) $alt = $url;

		$attributes['alt'] = $alt;

		return '<img src="'.$url.'"'.'>';
//		return '<img src="'.$this->url->to($url).'"'.$this->attributes($attributes).'>';
	}

	/**
	 * Generate an ordered list of items.
	 *
	 * @param  array  $list
	 * @param  array  $attributes
	 * @return string
	 */
	public function ol($list, $attributes = array())
	{
		return $this->listing('ol', $list, $attributes);
	}

	/**
	 * Generate an un-ordered list of items.
	 *
	 * @param  array  $list
	 * @param  array  $attributes
	 * @return string
	 */
	public function ul($list, $attributes = array())
	{
		return $this->listing('ul', $list, $attributes);
	}

	/**
	 * Generate an ordered or un-ordered list.
	 *
	 * @param  string $type
	 * @param  array  $list
	 * @param  array  $attributes
	 * @return string
	 */
	private function listing($type, $list, $attributes = array())
	{
		$html = '';

		if (count($list) == 0) return $html;

		foreach ($list as $key => $value)
		{
			// If the value is an array, we will recurse the function so that we can
			// produce a nested list within the list being built. Of course, nested
			// lists may exist within nested lists, etc.
			if (is_array($value))
			{
				if (is_int($key))
				{
					$html .= $this->listing($type, $value);
				}
				else
				{
					$html .= '<li>'.$key.$this->listing($type, $value).'</li>';
				}
			}
			else
			{
				$html .= '<li>'.$this->entities($value).'</li>';
			}
		}

		return '<'.$type.$this->attributes($attributes).'>'.$html.'</'.$type.'>';
	}

	/**
	 * Generate a definition list.
	 *
	 * @param  array  $list
	 * @param  array  $attributes
	 * @return string
	 */
	public function dl($list, $attributes = array())
	{
		$html = '';

		if (count($list) == 0) return $html;

		foreach ($list as $term => $description)
		{
			$html .= '<dt>'.$this->entities($term).'</dt>';
			$html .= '<dd>'.$this->entities($description).'</dd>';
		}

		return '<dl'.$this->attributes($attributes).'>'.$html.'</dl>';
	}

	/**
	 * Build a list of HTML attributes from an array
	 *
	 * @param  array  $attributes
	 * @return string
	 */
	public function attributes($attributes)
	{
		$html = array();

		foreach ((array) $attributes as $key => $value)
		{
			// For numeric keys, we will assume that the key and the value are the
			// same, as this will convert HTML attributes such as "required" that
			// may be specified as required="required", etc.
			if (is_numeric($key)) $key = $value;

			if ( ! is_null($value))
			{
				$html[] = $key.'="'.$this->entities($value).'"';
			}
		}

		return (count($html) > 0) ? ' '.implode(' ', $html) : '';
	}

	/**
	 * Obfuscate a string to prevent spam-bots from sniffing it
	 *
	 * @param  string $value
	 * @return string
	 */
	protected function obfuscate($value)
	{
		$safe = '';

		foreach (str_split($value) as $letter)
		{
			// To properly obfuscate the value, we will randomly convert each
			// letter to its entity or hexadecimal representation, keeping a
			// bot from sniffing the randomly obfuscated letters.
			switch (rand(1, 3))
			{
				case 1:
				$safe .= '&#'.ord($letter).';';
				break;

				case 2:
				$safe .= '&#x'.dechex(ord($letter)).';';
				break;

				case 3:
					$safe .= $letter;
			}
		}

		return $safe;
	}

	public function getUrlGenerator()
	{
		return $this->url;
	}

	/**
	 * Dynamically handle calls to custom macros.
	 *
	 * @param  string  $method
	 * @param  array   $parameters
	 *
	 * @return mixed
	 */
	public function __call($method, $parameters)
	{
		if (isset($this->macros[$method])) {
			return call_user_func_array($this->macros[$method], $parameters);
		}

		throw new \Exception("Method [$method] does not exist.");
	}


	public static function recMessage($currPage = 1, $perPage, $pageCount, $recCount ) {

		$startRec   = $currPage * $perPage - $pageCount+1;
		if($startRec > $pageCount)
			$startRec = ($currPage-1) * $perPage + 1;
		$endRec     = $startRec + $pageCount - 1;

		if($pageCount == $recCount )
			$startRec = 1;
		if($endRec >= $recCount)
				$endRec = $recCount;

		return $startRec.' to '.$endRec.' of '.$recCount;
	}

	const MY_SQL_DATE_FORMAT = '%Y-%m-%d %H:%M:%S';

	/**
	 * Returns twitter style time ago from supplied timestamp
	 * @param  timestamp $timestamp [description]
	 * @return string           	[description]
	 */
	public static function howLongAgo($timestamp) {
        $difference = time() - $timestamp;

        if($difference >= 60*60*24*365){        // if more than a year ago
            $int = intval($difference / (60*60*24*365));
            $s = ($int > 1) ? 's' : '';
            $r = $int . ' year' . $s . ' ago';
        } elseif($difference >= 60*60*24*7*5){  // if more than five weeks ago
            $int = intval($difference / (60*60*24*30));
            $s = ($int > 1) ? 's' : '';
            $r = $int . ' month' . $s . ' ago';
        } elseif($difference >= 60*60*24*7){        // if more than a week ago
            $int = intval($difference / (60*60*24*7));
            $s = ($int > 1) ? 's' : '';
            $r = $int . ' week' . $s . ' ago';
        } elseif($difference >= 60*60*24){      // if more than a day ago
            $int = intval($difference / (60*60*24));
            $s = ($int > 1) ? 's' : '';
            $r = $int . ' day' . $s . ' ago';
        } elseif($difference >= 60*60){         // if more than an hour ago
            $int = intval($difference / (60*60));
            $s = ($int > 1) ? 's' : '';
            $r = $int . ' hour' . $s . ' ago';
        } elseif($difference >= 60){            // if more than a minute ago
            $int = intval($difference / (60));
            $s = ($int > 1) ? 's' : '';
            $r = $int . ' minute' . $s . ' ago';
        } else {                                // if less than a minute ago
            $r = 'moments ago';
        }

        return $r;
	}

	public static function currentTime($format = self::MY_SQL_DATE_FORMAT) {
		return strftime($format, time() );
	}

	public static function formatPhone($data) {
		if (strlen($data)==10)
			return "(".substr($data, 0, 3).") ".substr($data, 3, 3)."-".substr($data,6);
		else
			return $data;
	}
}

