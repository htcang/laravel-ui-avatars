<?php

namespace Rackbeat\UIAvatars\Generators;

use LasseRafn\InitialAvatarGenerator\InitialAvatar;
use Rackbeat\UIAvatars\AvatarGeneratorInterface;

class ApiGenerator implements AvatarGeneratorInterface
{
	protected $options = [];

	public function __construct() {
		$this->length( config( 'ui-avatars.length' ) );
		$this->fontSize( config( 'ui-avatars.font_size' ) );
		$this->imageSize( config( 'ui-avatars.image_size' ) );
		$this->rounded( (bool) config( 'ui-avatars.rounded' ) );
		$this->uppercase( (bool) config( 'ui-avatars.uppercase' ) );
		$this->backgroundColor( config( 'ui-avatars.background_color' ) );
		$this->fontColor( config( 'ui-avatars.font_color' ) );
	}

	public function name( $name ) {
		$this->options['name'] = $name;

		return $this;
	}

	public function length( $length ) {
		$this->options['length'] = $length;

		return $this;
	}

	public function fontSize( $fontSize ) {
		$this->options['font-size'] = $fontSize;

		return $this;
	}

	public function imageSize( $imageSize ) {
		$this->options['size'] = $imageSize;

		return $this;
	}

	public function rounded( $rounded ) {
		$this->options['rounded'] = $rounded;

		return $this;
	}

	public function fontColor( $fontColor ) {
		$this->options['color'] = str_replace('#', '', $fontColor);

		return $this;
	}

	public function backgroundColor( $backgroundColor ) {
		$this->options['background'] = str_replace('#', '', $backgroundColor);

		return $this;
	}

	public function uppercase( $uppercase ) {
		$this->options['uppercase'] = $uppercase;

		return $this;
	}

	public function base64() {
		return $this->image();
	}

	public function image() {
		return 'https://ui-avatars.com/api/?' . http_build_query( $this->options );
	}

	public function initials() {
		return ( new InitialAvatar )->name( $this->name )->getInitials();
	}

}