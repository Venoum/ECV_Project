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

  public function get_section ()
  {

    echo
    '
    <section class="window-chat ' . $this->type . '" id="'. $this->slug . '">

      <div class="container-title">
        <div class="bt back">
          <svg viewBox="0 0 100 100" role="icon">
            <path fill="#780E3B" d="M30.43,50,75.59,4.84a2.83,2.83,0,0,0-4-4L24.41,48a2.82,2.82,0,0,0,0,4L71.59,99.16a2.85,2.85,0,0,0,2,.84,2.76,2.76,0,0,0,2-.84,2.82,2.82,0,0,0,0-4Z"/>
          </svg>
        </div>
        <h6 class="channel-name">'.$this->name.'</h6>
      </div>

      <div class="chat-interface-container">
        <div class="bt more-messages" v-on:click="loadMessages">
          <svg
            role="icon"
            viewBox="0 0 100 100">
            <path fill="white" d="M73.08,48.15H51.85V27.85a1.85,1.85,0,0,0-3.69,0V48.15H26.92a1.85,1.85,0,0,0,0,3.69H48.15V74a1.85,1.85,0,1,0,3.69,0V51.85H73.08a1.85,1.85,0,0,0,0-3.69Z"/>
          </svg>
          <p>de messages</p>
        </div>

        <div class="container-messages">
          <ul class="messages" id="'.$this->slug.'Message">
            <message-item
                v-for="message in messages"
                v-bind:message="message"
                v-bind:key="message.id"
              ></message-item>
          </ul>
        </div>

      </div>

      <form v-on:submit="sendMessage" class="send-message">


        <textarea class="message" id="'.$this->slug .'Input" autocomplete="off"></textarea>


        <button>
          <svg viewBox="0 0 100 100" role="icon">
            <path fill="#780E3B" d="M97.35,7.58a2,2,0,0,0-.76.15L3.3,45.7A4.4,4.4,0,0,0,.68,50a4.31,4.31,0,0,0,3.1,3.92L40.62,65,42,90.55a2,2,0,0,0,3.5,1.2l13.2-14.62L77.34,90a4.3,4.3,0,0,0,2.48.79,4.43,4.43,0,0,0,4.29-3.51L99.28,10A2,2,0,0,0,98.6,8,2,2,0,0,0,97.35,7.58ZM42,61.29,3.89,49.78,90.21,14.63Zm3.7,24.28-1-18.09,10.66,7.37Zm34.4,1.55L45.66,63.29,93.93,16.59Z"/>
            <path fill="#780E3B" d="M80.08,87.12,93.93,16.59,45.66,63.29Zm-.34-.85-33.29-23L93.13,18.06Z"/>
          </svg>
        </button>

      </form>


    </section>
    ';
  }

  public function get_list ()
  {
    echo '
    <li class="channel ' . $this->type .'" data-name="'.$this->slug.'">
      <svg viewBox="0 0 100 100" class="arrow" role="icon">
        <path fill="#780E3B" d="M30.43,50,75.59,4.84a2.83,2.83,0,0,0-4-4L24.41,48a2.82,2.82,0,0,0,0,4L71.59,99.16a2.85,2.85,0,0,0,2,.84,2.76,2.76,0,0,0,2-.84,2.82,2.82,0,0,0,0-4Z"/>
      </svg>
      <p>'.$this->name.'</p>
    </li>
    ';
  }
}

?>
