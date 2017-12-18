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

  public function get_section()
  {

    echo
    '
    <section class="window-chat ' . $this->type . '" id="'. $this->slug . '">

      <h6 class="channel-name">'.$this->name.'</h6>

      <div class="bt more-messages" v-on:click="loadMessages">
        <p>+ de messages</p>
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

      <form v-on:submit="sendMessage">

        <div class="message-c">

          <div class="images-c">
          </div>

          <textarea class="message" id="'.$this->slug .'Input" autocomplete="off" ></textarea>

          <div class="message-button" data-button="buttonCamera">
            <p>camera</p>
          </div>

          <div class="message-button" data-button="buttonImport">
            <p>upload</p>
          </div>
        </div>

        <button>Send</button>

        <div class="hidden">
          <input type="file" accept="image/*" class="buttonImport"/>
          <input type="file" accept="image/*" capture="camera" class="buttonCamera"/>
        </div>

      </form>
    </section>
    ';
  }
}

?>
