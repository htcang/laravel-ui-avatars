<?php

namespace Rackbeat\UIAvatars\Generators;

use LasseRafn\InitialAvatarGenerator\InitialAvatar;
use Rackbeat\UIAvatars\AvatarGeneratorInterface;

class LocalGenerator implements AvatarGeneratorInterface
{
	/** @var InitialAvatar */
	protected $service;

	public function __construct() {
		$this->service = new InitialAvatar();

		$this->length( config( 'ui-avatars.length' ) );
		$this->fontSize( config( 'ui-avatars.font_size' ) );
		$this->imageSize( config( 'ui-avatars.image_size' ) );
		$this->rounded( (bool) config( 'ui-avatars.rounded' ) );
		$this->smooth( (bool) config( 'ui-avatars.smooth_rounding' ) );
		$this->uppercase( (bool) config( 'ui-avatars.uppercase' ) );
		$this->backgroundColor( config( 'ui-avatars.background_color' ) );
		$this->fontColor( config( 'ui-avatars.font_color' ) );
	}

	public function name( $name ) {
		$this->service->name( $name );

		return $this;
	}

	public function length( $length ) {
		$this->service->length( $length );

		return $this;
	}

	public function fontSize( $fontSize ) {
		$this->service->fontSize( $fontSize );

		return $this;
	}

	public function imageSize( $imageSize ) {
		// Option to specify custom, or default to config.
		if ( $imageSize === null ) {
			return $this;
		}

		$this->service->size( $imageSize );

		return $this;
	}

	public function rounded( $rounded ) {
		$this->service->rounded( $rounded );

		return $this;
	}


	public function smooth( $smooth ) {
		$this->service->smooth( $smooth );

		return $this;
	}

	public function fontColor( $fontColor ) {
		$this->service->color( $fontColor );

		return $this;
	}

	public function backgroundColor( $backgroundColor ) {
		$this->service->background( $backgroundColor );

		return $this;
	}

	public function uppercase( $uppercase ) {
		$this->service->keepCase( ! $uppercase );

		return $this;
	}

	public function base64( $format = 'png', $quality = 100 ) {
		return $this->image()->stream( $format, $quality );
	}

	public function image() {
		return $this->service->generate();
	}

	public function initials() {
		return $this->service->getInitials();
	}
}