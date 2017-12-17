<?php

// PASSER LES ELEMENT EN PRIVE

class Channel {

  protected $champs = ['type', 'name', 'slug'];

  public function __construct($type, $name, $id)
  {
    $this->type = $type;
    $this->name = $name;
    $this->slug = 'channel'.$id;
  }

  public function __get($attr_name)
	{
		if (in_array($attr_name, $this->champs))
				return $this->$attr_name;
		else
			die('Erreur à l\'attribut: '.$attr_name);
	}

  public function __set($attr_name, $attr_value)
	{
		if (in_array($attr_name, $this->champs))
			$this->$attr_name = $attr_value;
		else
			die('Erreur à l\'attribut: '.$attr_name);

	}

  // public function slugify ($text)
  // {
  //   // replace non letter or digits by -
  //   $text = preg_replace('~[^\pL\d]+~u', '-', $text);
  //
  //   // transliterate
  //   $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  //
  //   // remove unwanted characters
  //   $text = preg_replace('~[^-\w]+~', '', $text);
  //
  //   // trim
  //   $text = trim($text, '-');
  //
  //   // remove duplicate -
  //   $text = preg_replace('~-+~', '-', $text);
  //
  //   // lowercase
  //   $text = strtolower($text);
  //
  //   $this->slug = $text;
  // }
}

?>
