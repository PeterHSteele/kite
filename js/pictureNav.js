function KitePictureNav(){
	this.section = document.querySelector( '.picture-nav-section' );
	if ( ! this.section ) return;
	this.menu = this.section.getElementsByClassName( 'picture-nav' )[0];
	this.mask = this.section.getElementsByClassName( 'picture-nav-mask' )[0];
	this.image = null;
	this.fadeDelay = false;
	this.fadeTimeout = false;
	this.green = '#63efa3';
	//this.sourceSet = JSON.parse(this.section.dataset.sources);

	this.getLis = function(){
		if ( ! this.menu ){
			return false;
		}
		let lis = [];
		let currentLi = this.menu.firstChild;
		while ( currentLi ){
			lis.push( currentLi.getElementsByTagName( 'a' )[0] );
			currentLi = currentLi.nextElementSibling;
		}
		this.lis = lis;
	}

	this.resetNavFade = function(){
		this.mask.className = this.mask.className.replace( new RegExp(' fade', 'g'), '' );
		this.fadeDelay = false;
	}

	this.setBg=function( val ){
		this.section.style.background = val;
	}

	this.handleHover = function( event ){
		const source = event.target.dataset.source,
			  { green } = this;
		if ( ! source ) return;

		if ( ! this.fadeDelay ){
			this.fadeDelay = true;
		} else {
			window.clearTimeout( this.fadeTimeout );
		}
		this.mask.className += ' fade';

		this.fadeTimeout = window.setTimeout( () => {
				this.resetNavFade();
				this.setBg( source ? "url(" + source + ")" : green );
			}, 300);
	}

	this.handleLeave = function(e){
		if ( ! e.target.dataset.source ){
			return;
		}
		const { green } = this;
		
		if ( ! this.fadeDelay ){
			this.fadeDelay = true;
			this.mask.className += ' fade';

			window.setTimeout( () => {
				this.resetNavFade();
				this.setBg( green );
			}, 300);
		} else {
			window.clearTimeout( this.fadeTimeout );
			this.setBg( green );
			this.mask.className = this.mask.className.replace( new RegExp(' fade', 'g'), '' );
		}
		window.clearTimeout( this.fadeAnimation );
	}

	this.addListeners = function(){
		this.lis.forEach( li => {
			li.addEventListener( 'mouseenter', this.handleHover.bind(this) );
			li.addEventListener( 'mouseleave' , this.handleLeave.bind(this) );
		})
	}

	this.run = function(){
		this.getLis();
		this.addListeners();
	}
}

const kitePictureNav = new KitePictureNav();
kitePictureNav.run();

function Kite_Parallax(){
	this.image = document.querySelector( '.kite-parallax-image' );
	this.body = document.getElementsByTagName('body')[0];

	this.handleScroll = function(){
		const translation = -1 * this.image.getBoundingClientRect().y/2;
		console.log('translation', translation);
		this.image.style.transform = 'translate3d( 0px,' + translation  + 'px, 0px)';
	}

	this.addListeners = function(){
		const handleScroll = this.handleScroll.bind(this)
		console.log( this.handleScroll );
		window.addEventListener( 'scroll', this.handleScroll.bind( this ));
	}
}


const kiteParallax = new Kite_Parallax();
kiteParallax.addListeners();